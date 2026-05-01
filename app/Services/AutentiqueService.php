<?php

namespace App\Services;

use App\Models\Documento;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutentiqueService
{
    protected string $token;
    protected string $baseUrl;

    public function __construct()
    {
        $this->token = config('services.autentique.token');
        $this->baseUrl = 'https://api.autentique.com.br/v2/graphql';
    }

    public function enviarParaAssinatura(Documento $documento, array $signers): array
    {
        $query = $this->buildMutation($documento, $signers);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])
            ->timeout(30)
            ->post($this->baseUrl, ['query' => $query]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['data']['create_document']['id'])) {
                    $documentId = $data['data']['create_document']['id'];

                    $documento->update([
                        'autentique_document_id' => $documentId,
                        'status' => 'assinado',
                    ]);

                    return ['success' => true, 'document_id' => $documentId];
                }

                Log::error('Autentique response error', $data);
                return ['success' => false, 'error' => 'Resposta inválida da API'];
            }

            Log::error('Autentique HTTP error', ['status' => $response->status(), 'body' => $response->body()]);
            return ['success' => false, 'error' => 'Falha na comunicação com Autentique'];
        } catch (\Exception $e) {
            Log::error('Autentique exception', ['message' => $e->getMessage()]);
            return ['success' => false, 'error' => 'Erro ao enviar para assinatura'];
        }
    }

    protected function buildMutation(Documento $documento, array $signers): string
    {
        $signersList = array_map(function ($signer, $index) {
            return sprintf(
                '{ email: "%s", auth: "email", action: "sign", order: %d }',
                $signer['email'],
                $index + 1
            );
        }, $signers, array_keys($signers));

        $signersJson = implode(', ', $signersList);

        return <<<GRAPHQL
        mutation {
            create_document(
                document: {
                    name: "{$documento->nome_arquivo}",
                    file: { url: "{$documento->caminho_arquivo}" }
                    signers: [{$signersJson}]
                }
            ) {
                id
                name
            }
        }
        GRAPHQL;
    }

    public function verificarStatus(string $autentiqueDocumentId): array
    {
        $query = <<<GRAPHQL
        query {
            document(id: "{$autentiqueDocumentId}") {
                id
                name
                status
                signatures {
                    email
                    status
                    signed_at
                }
            }
        }
        GRAPHQL;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])
            ->timeout(15)
            ->post($this->baseUrl, ['query' => $query]);

            if ($response->successful()) {
                return $response->json();
            }

            return ['error' => 'Falha ao verificar status'];
        } catch (\Exception $e) {
            Log::error('Autentique status check error', ['message' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }
}
