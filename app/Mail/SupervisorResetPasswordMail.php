<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupervisorResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly string $token,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Redefinição de Senha – Portal do Supervisor',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.supervisor.redefinir-senha',
            with: [
                'resetUrl' => route('supervisor.password.reset', [
                    'token' => $this->token,
                    'email' => $this->user->email,
                ]),
                'nome'  => $this->user->name,
                'email' => $this->user->email,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
