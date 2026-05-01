<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Compromisso de Estágio</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; }
        h1 { font-size: 14pt; margin-bottom: 10px; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; text-decoration: underline; margin-bottom: 5px; }
        .field { margin-bottom: 3px; }
        .label { font-weight: bold; }
        .valor { border-bottom: 1px solid #000; padding: 2px 5px; min-width: 200px; }
        .assinaturas { margin-top: 40px; page-break-inside: avoid; }
        .assinatura { width: 50%; float: left; text-align: center; padding: 20px; }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="header">
        <h1>TERMO DE COMPROMISSO DE ESTÁGIO</h1>
        <p>Lei nº 11.788/2008</p>
    </div>

    <div class="section">
        <div class="section-title">1. PARTES CONTRATANTES</div>
        <div class="field"><span class="label">Instituição de Ensino:</span> {{ $estagio->instituicaoEnsino->razao_social }}</div>
        <div class="field"><span class="label">CNPJ:</span> {{ $estagio->instituicaoEnsino->cnpj }}</div>
        <div class="field"><span class="label">Endereço:</span> {{ $estagio->instituicaoEnsino->endereco }}, {{ $estagio->instituicaoEnsino->bairro }} - {{ $estagio->instituicaoEnsino->cidade }}/{{ $estagio->instituicaoEnsino->estado }} - CEP: {{ $estagio->instituicaoEnsino->cep }}</div>
    </div>

    <div class="section">
        <div class="section-title">2. CONCEDENTE</div>
        <div class="field"><span class="label">Empresa:</span> {{ $estagio->empresaConcedente->razao_social }}</div>
        <div class="field"><span class="label">CNPJ:</span> {{ $estagio->empresaConcedente->cnpj }}</div>
        <div class="field"><span class="label">Endereço:</span> {{ $estagio->empresaConcedente->endereco }}, {{ $estagio->empresaConcedente->bairro }} - {{ $estagio->empresaConcedente->cidade }}/{{ $estagio->empresaConcedente->estado }} - CEP: {{ $estagio->empresaConcedente->cep }}</div>
    </div>

    <div class="section">
        <div class="section-title">3. ESTAGIÁRIO</div>
        <div class="field"><span class="label">Nome:</span> {{ $estagio->estagiario->nome }}</div>
        <div class="field"><span class="label">CPF:</span> {{ $estagio->estagiario->cpf }}</div>
        <div class="field"><span class="label">RG:</span> {{ $estagio->estagiario->rg }}</div>
        <div class="field"><span class="label">Curso:</span> {{ $estagio->estagiario->curso }}</div>
        <div class="field"><span class="label">Período:</span> {{ $estagio->estagiario->periodo }}</div>
        <div class="field"><span class="label">Telefone:</span> {{ $estagio->estagiario->telefone }}</div>
        <div class="field"><span class="label">E-mail:</span> {{ $estagio->estagiario->email }}</div>
    </div>

    <div class="section">
        <div class="section-title">4. CONDIÇÕES DO ESTÁGIO</div>
        <div class="field"><span class="label">Data de Início:</span> {{ $estagio->data_inicio->format('d/m/Y') }}</div>
        <div class="field"><span class="label">Data de Término:</span> {{ $estagio->data_fim->format('d/m/Y') }}</div>
        <div class="field"><span class="label">Carga Horária Semanal:</span> {{ $estagio->carga_horaria_semanal }} horas</div>
        <div class="field"><span class="label">Horário:</span> {{ $estagio->horario_inicio ?? '' }} às {{ $estagio->horario_fim ?? '' }}</div>
        <div class="field"><span class="label">Valor da Bolsa:</span> R$ {{ number_format($estagio->valor_bolsa ?? 0, 2, ',', '.') }}</div>
        <div class="field"><span class="label">Auxílio Transporte:</span> R$ {{ number_format($estagio->valor_auxilio_transporte ?? 0, 2, ',', '.') }}</div>
    </div>

    <div class="section">
        <div class="section-title">5. SEGURADORA</div>
        @if($estagio->seguradora)
        <div class="field"><span class="label">Seguradora:</span> {{ $estagio->seguradora->nome }}</div>
        <div class="field"><span class="label">Apólice:</span> {{ $estagio->apolice_numero ?? $estagio->seguradora->apolice }}</div>
        @else
        <div class="field">Sem seguro cadastrado</div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">6. ATIVIDADES A SEREM DESENVOLVIDAS</div>
        <p>{{ $estagio->atividades ?? 'Não especificado' }}</p>
    </div>

    <div class="assinaturas clear">
        <div class="assinatura" style="float: left; width: 45%;">
            <p>_________________________________________________</p>
            <p><strong>Representante da Instituição de Ensino</strong></p>
            <p>{{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</p>
            <p>CPF: {{ $estagio->instituicaoEnsino->responsavel_legal_cpf }}</p>
        </div>
        <div class="assinatura" style="float: right; width: 45%;">
            <p>_________________________________________________</p>
            <p><strong>Representante da Empresa Concedente</strong></p>
            <p>{{ $estagio->empresaConcedente->responsavel_legal_nome }}</p>
            <p>CPF: {{ $estagio->empresaConcedente->cnpj }}</p>
        </div>
    </div>

    <div class="assinaturas clear" style="margin-top: 80px;">
        <div class="assinatura" style="float: left; width: 45%;">
            <p>_________________________________________________</p>
            <p><strong>Estagiário</strong></p>
            <p>{{ $estagio->estagiario->nome }}</p>
            <p>CPF: {{ $estagio->estagiario->cpf }}</p>
        </div>
    </div>
</body>
</html>