@component('mail::message')
# Olá, {{ $nome }}!

Você foi designado(a) como **Supervisor(a) de Estágio** na empresa **{{ $empresa }}** pelo sistema **Alencastro Estágios**.

Suas credenciais de acesso ao portal estão abaixo. O relatório semestral de estágio deve ser preenchido e emitido **a cada 6 meses**, conforme a Lei nº 11.788/2008.

---

## Dados de Acesso

| Campo  | Valor |
|--------|-------|
| **Endereço do portal** | [{{ $loginUrl }}]({{ $loginUrl }}) |
| **E-mail (login)** | {{ $email }} |
| **Senha** | {{ $senha }} |

> **Recomendamos que você altere sua senha no primeiro acesso.**

---

@component('mail::button', ['url' => $loginUrl, 'color' => 'primary'])
Acessar o Portal do Supervisor
@endcomponent

---

## Como emitir o Relatório Semestral

1. Acesse o portal com seu e-mail e senha.
2. No dashboard, localize o estagiário pelo nome.
3. Clique em **"Novo Relatório"** no cartão do estagiário.
4. Preencha as informações do período, atividades desenvolvidas, avaliação de competências e carga horária.
5. Escolha **"Salvar Rascunho"** para continuar depois, ou **"Finalizar e Gerar PDF"** para emitir o documento oficial.

O relatório deve ser gerado **a cada 6 meses**, nos períodos estabelecidos pela instituição de ensino do(a) estagiário(a).

---

Em caso de dúvidas, entre em contato com a equipe Alencastro Estágios.

Atenciosamente,  
**Alencastro Consultoria – Estágios**
@endcomponent
