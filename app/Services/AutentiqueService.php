<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutentiqueService
{
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.autentique.token');
        $this->baseUrl = 'https://api.autentique.com.br/v2/graphql';
    }

    /**
     * Exemplo de envio de documento para assinatura
     */
    public function enviarDocumento($pdfPath, $signers)
    {
        // Lógica para Autentique v2 GraphQL
        // Por enquanto apenas registrando a intenção e validando o token
        if (!$this->token) {
            Log::error('Autentique Token não configurado no .env');
            return false;
        }

        return true;
    }
}
