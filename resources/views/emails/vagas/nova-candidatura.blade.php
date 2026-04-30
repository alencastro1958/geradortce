<x-mail::message>
# Nova Candidatura Recebida

Olá, **{{ $vaga->empresa->razao_social }}**.

Uma nova candidatura foi registrada para a vaga: **{{ $vaga->titulo }}** ({{ $vaga->codigo_vaga }}).

**Dados do Candidato:**
- **Nome:** {{ $estagiario->nome }}
- **Curso:** {{ $estagiario->curso }}
- **E-mail:** {{ $estagiario->email }}
- **Telefone:** {{ $estagiario->telefone }}

Você pode visualizar mais detalhes e o currículo do candidato acessando o painel.

<x-mail::button :url="config('app.url') . '/vagas/' . $vaga->id">
Ver Candidato no Painel
</x-mail::button>

Atenciosamente,<br>
Equipe {{ config('app.name') }}
</x-mail::message>
