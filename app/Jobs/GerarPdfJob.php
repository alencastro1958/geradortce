<?php

namespace App\Jobs;

use App\Models\Documento;
use App\Models\Estagio;
use App\Models\User;
use App\Notifications\DocumentoProntoNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class GerarPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Estagio $estagio,
        public string $tipo = 'tce',
        public ?int $documentoId = null
    ) {}

    public function handle(): void
    {
        $view = 'estagios.pdfs.' . $this->tipo;

        if (!view()->exists($view)) {
            throw new \RuntimeException("Modelo de documento não encontrado: {$view}");
        }

        $agente = \App\Models\AgenteIntegracao::first();

        $pdf = Pdf::loadView($view, [
            'estagio' => $this->estagio,
            'agente' => $agente,
        ]);

        $filename = strtoupper($this->tipo) . '_' . str_replace(' ', '_', $this->estagio->estagiario->nome) . '_' . time() . '.pdf';

        $path = storage_path("app/pdfs/{$filename}");

        File::ensureDirectoryExists(dirname($path));

        $pdf->save($path);

        if ($this->documentoId) {
            $documento = Documento::find($this->documentoId);

            $documento->update([
                'nome_arquivo' => $filename,
                'caminho_arquivo' => $path,
                'status' => 'pronto',
                'hash' => hash_file('sha256', $path),
            ]);

            $this->sendNotification($documento);
        }
    }

    protected function sendNotification(Documento $documento): void
    {
        $estagiario = $documento->estagio->estagiario;

        if ($estagiario->user) {
            $estagiario->user->notify(new DocumentoProntoNotification($documento));
        }
    }
}