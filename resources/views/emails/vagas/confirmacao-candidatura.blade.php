<x-mail::message>
# Candidatura Confirmada!

Olá, **{{ $vaga->empresa->razao_social }}**. Ops, corrigindo...

Olá, **Estagiário(a)**.

Sua candidatura para a vaga **{{ $vaga->titulo }}** na empresa **{{ $vaga->empresa->razao_social }}** foi recebida com sucesso.

**Detalhes da Vaga:**
- **Código:** {{ $vaga->codigo_vaga }}
- **Área:** {{ $vaga->area_atuacao }}
- **Bolsa:** R$ {{ number_format($vaga->bolsa_auxilio, 2, ',', '.') }}

Fique atento ao seu e-mail e telefone, pois a empresa entrará em contato caso seu perfil seja selecionado para as próximas etapas.

Desejamos boa sorte!

Atenciosamente,<br>
Equipe {{ config('app.name') }}
</x-mail::message>
