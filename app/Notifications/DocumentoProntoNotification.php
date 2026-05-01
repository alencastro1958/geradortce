<?php

namespace App\Notifications;

use App\Models\Documento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentoProntoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Documento $documento
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $estagio = $this->documento->estagio;

        return (new MailMessage)
            ->subject("Documento {$this->documento->tipo} pronto para download")
            ->greeting("Olá, {$notifiable->name}!")
            ->line("O documento {$this->documento->tipo} do estágio de {$estagio->estagiario->nome} foi gerado com sucesso.")
            ->action('Baixar Documento', route('documentos.download', $this->documento->id))
            ->line('Este documento está disponível para download por 30 dias.')
            ->salutation('Atenciosamente, Equipe Gerador de TCEs');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Documento pronto',
            'message' => "O documento {$this->documento->tipo} está pronto para download.",
            'documento_id' => $this->documento->id,
            'estagio_id' => $this->documento->estagio_id,
        ];
    }
}