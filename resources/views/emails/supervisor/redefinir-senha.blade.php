@component('mail::message')
# Redefinição de Senha

Olá, **{{ $nome }}**!

Recebemos uma solicitação para redefinir a senha da sua conta no **Portal do Supervisor – Alencastro Estágios**.

Clique no botão abaixo para criar uma nova senha. O link é válido por **60 minutos**.

@component('mail::button', ['url' => $resetUrl, 'color' => 'primary'])
Redefinir minha senha
@endcomponent

Se você não solicitou a redefinição de senha, ignore este e-mail — sua senha permanece a mesma.

---

Caso o botão não funcione, copie e cole o link abaixo no seu navegador:

`{{ $resetUrl }}`

---

Atenciosamente,  
**Alencastro Consultoria – Estágios**
@endcomponent
