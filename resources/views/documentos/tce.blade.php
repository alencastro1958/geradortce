<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Compromisso de Estágio - TCE</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; padding: 20px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-justify { text-align: justify; }
        .uppercase { text-transform: uppercase; }
        .bold { font-weight: bold; }
        .italic { font-style: italic; }
        .underline { text-decoration: underline; }
        .mb-1 { margin-bottom: 10px; }
        .mb-2 { margin-bottom: 20px; }
        .mb-3 { margin-bottom: 30px; }
        .mt-2 { margin-top: 20px; }
        .mt-3 { margin-top: 30px; }
        p { margin-bottom: 8px; text-align: justify; }
        .linha { border-bottom: 1px solid #000; display: inline-block; min-width: 300px; }
        .assinatura { width: 45%; float: left; text-align: center; margin-top: 30px; }
        .assinatura2 { width: 100%; text-align: center; margin-top: 30px; }
        .clear { clear: both; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="text-center mb-2">
        <h1>TERMΟ DE COMPROMISSO DE ESTÁGIO OBRIGATÓRIO</h1>
        <p>Lei nº 11.788, de 25 de setembro de 2008</p>
    </div>

    <p class="mb-2"><span class="bold">IDENTIFICAÇÃO DAS PARTES CONTRATANTES</span></p>
    
    <p><span class="bold">1. CONCEDENTE (Parte concedente do estágio):</span></p>
    <p>Razão Social: {{ $estagio->empresaConcedente->razao_social }}</p>
    <p>CNPJ: {{ $estagio->empresaConcedente->cnpj }}</p>
    <p>Endereço: {{ $estagio->empresaConcedente->endereco }}, {{ $estagio->empresaConcedente->bairro }} - {{ $estagio->empresaConcedente->cidade }}/{{ $estagio->empresaConcedente->estado }} - CEP: {{ $estagio->empresaConcedente->cep }}</p>
    <p>Representante Legal: {{ $estagio->empresaConcedente->responsavel_legal_nome }}</p>
    <p>Cargo: {{ $estagio->empresaConcedente->responsavel_legal_cargo }}</p>

    <p class="mt-2"><span class="bold">2. INSTITUIÇÃO DE ENSINO:</span></p>
    <p>Razão Social: {{ $estagio->instituicaoEnsino->razao_social }}</p>
    <p>CNPJ: {{ $estagio->instituicaoEnsino->cnpj }}</p>
    <p>Endereço: {{ $estagio->instituicaoEnsino->endereco }}, {{ $estagio->instituicaoEnsino->bairro }} - {{ $estagio->instituicaoEnsino->cidade }}/{{ $estagio->instituicaoEnsino->estado }} - CEP: {{ $estagio->instituicaoEnsino->cep }}</p>
    <p>Representante Legal: {{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</p>
    <p>Cargo: {{ $estagio->instituicaoEnsino->responsavel_legal_cargo }}</p>

    <p class="mt-2"><span class="bold">3. ESTAGIÁRIO:</span></p>
    <p>Nome: {{ $estagio->estagiario->nome }}</p>
    <p>CPF: {{ $estagio->estagiario->cpf }} | RG: {{ $estagio->estagiario->rg }}</p>
    <p>Telefone: {{ $estagio->estagiario->telefone }} | E-mail: {{ $estagio->estagiario->email }}</p>

    <p class="mt-2"><span class="bold">4. DADOS DO ESTÁGIO:</span></p>
    <p>Curso: {{ $estagio->estagiario->curso }}</p>
    <p>Período: {{ $estagio->estagiario->periodo ?? 'Não especificado' }}</p>
    <p>Data de Início: {{ $estagio->data_inicio->format('d/m/Y') }} a {{ $estagio->data_fim->format('d/m/Y') }}</p>
    <p>Carga Horária Semanal: {{ $estagio->carga_horaria_semanal }} horas</p>
    <p>Horário: {{ $estagio->horario_inicio ?? '08:00' }} às {{ $estagio->horario_fim ?? '14:00' }}</p>

    <p class="mt-2"><span class="bold">5. BOLSA E AUXÍLIO:</span></p>
    <p>Valor da Bolsa-Auxílio: R$ {{ number_format($estagio->valor_bolsa ?? 0, 2, ',', '.') }} ({{ $estagio->valor_bolsa ? 'extenso' : 'sem bolsa' }})</p>
    <p>Auxílio Transporte: R$ {{ number_format($estagio->valor_auxilio_transporte ?? 0, 2, ',', '.') }}</p>
    <p> other Benefits: R$ 0,00 (não especificado)</p>

    <p class="mt-2"><span class="bold">6. SEGURANÇA:</span></p>
    <p>Seguradora: {{ $estagio->seguradora->nome ?? 'Não informada' }}</p>
    <p>Nº da Apólice: {{ $estagio->apolice_numero ?? 'Não informado' }}</p>

    <p class="mt-2"><span class="bold">7. ATIVIDADES A SEREM DESENVOLVIDAS:</span></p>
    <p>{{ $estagio->atividades ?? 'Atividades compatíveis com a área de formação do estagiário.' }}</p>

    <p class="mt-2"><span class="bold">8. SUPERVISÃO:</span></p>
    <p>Supervisor de Estágio na Empresa: {{ $estagio->empresaConcedente->supervisor_estagio_nome ?? 'Não informado' }}</p>
    <p>Cargo: {{ $estagio->empresaConcedente->supervisor_estagio_cargo ?? 'Não informado' }}</p>
    <p>Coordenador na IES: {{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</p>

    <div class="assinatura2 mt-3">
        <p class="mb-2">_________________________________________________, {{ now()->format('d') }} de {{ now()->format('M') }} de {{ now()->format('Y') }}</p>
    </div>

    <div class="assinatura">
        <p class="underline">&nbsp;</p>
        <p>Assinatura do Representante da CONCEDENTE</p>
        <p>{{ $estagio->empresaConcedente->responsavel_legal_nome }}</p>
    </div>

    <div class="assinatura">
        <p class="underline">&nbsp;</p>
        <p>Assinatura do Representante da IES</p>
        <p>{{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</p>
    </div>

    <div class="clear"></div>

    <div class="assinatura2 mt-3">
        <p class="underline mb-1">&nbsp;</p>
        <p>Assinatura do ESTAGIÁRIO</p>
        <p>{{ $estagio->estagiario->nome }}</p>
    </div>
</body>
</html>