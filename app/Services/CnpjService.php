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
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/' . $cnpj);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Erro na consulta CNPJ Estagee: ' . $response->status(), [
                'cnpj' => $cnpj,
                'response' => $response->body()
            ]);

            return ['error' => 'Não foi possível localizar os dados deste CNPJ.'];
        } catch (\Exception $e) {
            Log::error('Falha de conexão com API Estagee: ' . $e->getMessage());
            return ['error' => 'Falha na comunicação com o serviço de dados.'];
        }
    }
}
