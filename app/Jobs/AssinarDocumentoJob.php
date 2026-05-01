<?php

namespace App\Jobs;

use App\Models\Documento;
use App\Services\AutentiqueService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssinarDocumentoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public Documento $documento,
        public array $signers
    ) {}

    public function handle(AutentiqueService $autentiqueService): void
    {
        $documento = $this->documento->fresh();

        if (!$documento->caminho_arquivo || !file_exists($documento->caminho_arquivo)) {
            $this->fail(new \RuntimeException('Arquivo não encontrado para assinatura'));

            $documento->update(['status' => 'erro']);

            return;
        }

        $result = $autentiqueService->enviarParaAssinatura($documento, $this->signers);

        if (!$result['success']) {
            $documento->update(['status' => 'erro']);
            throw new \RuntimeException($result['error'] ?? 'Falha ao enviar para Autentique');
        }

        $documento->update(['status' => 'assinado']);
    }

    public function failed(\Throwable $exception): void
    {
        $this->documento->update([
            'status' => 'erro',
        ]);
    }
}