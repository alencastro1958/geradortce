<?php

namespace App\Mail;

use App\Models\Vaga;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacaoCandidatura extends Mailable
{
    use Queueable, SerializesModels;

    public $vaga;

    public function __construct(Vaga $vaga)
    {
        $this->vaga = $vaga;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Candidatura Confirmada: ' . $this->vaga->titulo,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.vagas.confirmacao-candidatura',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
