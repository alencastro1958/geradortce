<?php

namespace App\Mail;

use App\Models\Vaga;
use App\Models\Estagiario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NovaCandidatura extends Mailable
{
    use Queueable, SerializesModels;

    public $vaga;
    public $estagiario;

    public function __construct(Vaga $vaga, Estagiario $estagiario)
    {
        $this->vaga = $vaga;
        $this->estagiario = $estagiario;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova Candidatura para a Vaga: ' . $this->vaga->titulo,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.vagas.nova-candidatura',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
