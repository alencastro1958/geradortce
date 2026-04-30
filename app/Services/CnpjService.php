<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CnpjService
{
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.cnpj.token');
        // URL base padrão da API Estagee para Receita
        $this->baseUrl = 'https://api.estagee.com.br/receita/cnpj';
    }

    public function consultar($cnpj)
    {
        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ])
                ->timeout(10)
                ->get($this->baseUrl . '/' . $cnpj);

            if ($response->successful()) {
                return $response->json();
            }

            // Tenta fallback com v1
            $fallbackUrl = 'https://api.estagee.com.br/receita/v1/cnpj';
            $responseFallback = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ])
                ->timeout(10)
                ->get($fallbackUrl . '/' . $cnpj);

            if ($responseFallback->successful()) {
                return $responseFallback->json();
            }

            // Tenta fallback com BrasilAPI (Gratuita e sem token necessário para volume baixo)
            $brasilApiUrl = 'https://brasilapi.com.br/api/cnpj/v1';
            $responseBrasil = Http::withoutVerifying()
                ->timeout(10)
                ->get($brasilApiUrl . '/' . $cnpj);

            if ($responseBrasil->successful()) {
                $data = $responseBrasil->json();
                return [
                    'razao_social' => $data['razao_social'] ?? $data['nome'],
                    'nome_fantasia' => $data['nome_fantasia'] ?? $data['fantasia'] ?? null,
                    'logradouro' => $data['logradouro'],
                    'numero' => $data['numero'],
                    'bairro' => $data['bairro'],
                    'cidade' => $data['municipio'],
                    'estado' => $data['uf'],
                    'cep' => $data['cep'],
                ];
            }

            Log::error('Erro na consulta CNPJ Estagee e BrasilAPI: ' . $response->status(), [
                'cnpj' => $cnpj,
                'status_estagee' => $response->status(),
                'status_brasil' => $responseBrasil->status()
            ]);

            return ['error' => 'Não foi possível localizar os dados deste CNPJ em nenhum serviço.'];
        } catch (\Exception $e) {
            Log::error('Falha de conexão com APIs de CNPJ: ' . $e->getMessage());
            return ['error' => 'Falha na comunicação com o serviço de dados. Verifique a conexão do servidor.'];
        }
    }
}
