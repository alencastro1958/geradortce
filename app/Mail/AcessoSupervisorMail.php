<?php

namespace App\Mail;

use App\Models\SupervisorEstagio;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcessoSupervisorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly SupervisorEstagio $supervisor,
        public readonly string $senha,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Seu acesso ao Portal do Supervisor – Alencastro Estágios',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.supervisor.acesso-criado',
            with: [
                'loginUrl'  => route('supervisor.login'),
                'email'     => $this->supervisor->email,
                'senha'     => $this->senha,
                'nome'      => $this->supervisor->nome,
                'empresa'   => $this->supervisor->empresaConcedente?->nome_fantasia
                            ?: $this->supervisor->empresaConcedente?->razao_social
                            ?: 'sua empresa',
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
