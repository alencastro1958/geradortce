<x-mail::message>
# Recuperação de Login

Olá, **{{ $user->name }}**.

Segue abaixo seu login para acessar o sistema:

**Login (E-mail):** {{ $user->email }}

Se você não solicitou esta recuperação, ignore este e-mail.

<x-mail::button :url="route('login')">
Acessar o Sistema
</x-mail::button>

Atenciosamente,<br>
Equipe {{ config('app.name') }}
</x-mail::message>