<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CnpjService
{
    protected string $token;
    protected string $baseUrl;
    protected int $cacheTtl = 86400;

    public function __construct()
    {
        $this->token = config('services.cnpj.token');
        $this->baseUrl = config('services.cnpj.base_url', 'https://api.estagee.com.br/receita/cnpj');
    }

    public function consultar(string $cnpj): array
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        $cacheKey = "cnpj:{$cnpj}";

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($cnpj) {
            return $this->fetchFromApis($cnpj);
        });
    }

    protected function fetchFromApis(string $cnpj): array
    {
        $apis = [
            'estagee' => [
                'url' => $this->baseUrl . '/' . $cnpj,
                'headers' => ['Authorization' => 'Bearer ' . $this->token],
            ],
            'minhareceita' => [
                'url' => 'https://minhareceita.org/' . $cnpj,
                'headers' => [],
            ],
            'brasilapi_v2' => [
                'url' => 'https://brasilapi.com.br/api/cnpj/v2/' . $cnpj,
                'headers' => [],
            ],
        ];

        foreach ($apis as $api) {
            try {
                $response = Http::withoutVerifying()
                    ->withHeaders($api['headers'])
                    ->timeout(10)
                    ->get($api['url']);

                if ($response->successful()) {
                    return $this->normalizeResponse($response->json());
                }
            } catch (\Exception $e) {
                Log::warning("Falha na API {$api['url']}: " . $e->getMessage());
            }
        }

        return ['error' => 'Dados não encontrados. Por favor, preencha manualmente.'];
    }

    protected function normalizeResponse(array $data): array
    {
        return [
            'razao_social' => $data['razao_social'] ?? $data['nome'] ?? null,
            'nome_fantasia' => $data['nome_fantasia'] ?? $data['fantasia'] ?? null,
            'logradouro' => $data['logradouro'] ?? null,
            'numero' => $data['numero'] ?? null,
            'bairro' => $data['bairro'] ?? null,
            'cidade' => $data['municipio'] ?? null,
            'estado' => $data['uf'] ?? null,
            'cep' => $data['cep'] ?? null,
        ];
    }

    public function forget(string $cnpj): void
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        Cache::forget("cnpj:{$cnpj}");
    }
}
