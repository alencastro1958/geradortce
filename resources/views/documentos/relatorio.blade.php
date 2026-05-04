<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório Semestral de Estágio</title>
    <style>
        @page {
            size: A4;
            margin-top: 3.0cm;
            margin-right: 1.5cm;
            margin-bottom: 1.0cm;
            margin-left: 2.5cm;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.15;
            text-align: justify;
            padding-top: 0;
            padding-bottom: 0.5cm;
        }
        p {
            margin-top: 0;
            margin-bottom: 2pt;
        }
        h1 {
            font-family: Arial, sans-serif;
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 6pt;
        }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        /* Separação entre blocos de seção (1.5× = ~14pt) */
        .bloco {
            margin-top: 14pt;
        }
        /* Título de cada bloco numerado */
        .bloco-titulo {
            font-weight: bold;
            margin-bottom: 2pt;
        }
        .page-header {
            position: fixed;
            top: -2.5cm;
            left: 2.5cm;
            right: 1.5cm;
            height: 2.5cm;
            text-align: center;
        }
        .page-footer {
            position: fixed;
            bottom: 0.3cm;
            left: 2.5cm;
            right: 1.5cm;
            text-align: center;
            font-size: 8pt;
            border-top: 1px solid #ccc;
            padding-top: 3px;
        }
        .page-footer::after {
            display: block;
            text-align: center;
            font-size: 8pt;
            content: "Página " counter(page);
            margin-top: 2px;
        }
        .assinatura-linha {
            border-bottom: 1px solid #000;
            display: block;
            width: 60%;
            margin: 0 auto;
            height: 55px;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        @if(file_exists(public_path('images/AlencastroEstagios.png')))
        <img src="{{ public_path('images/AlencastroEstagios.png') }}" alt="Alencastro Estágios" style="max-width: 220px;">
        @else
        <p class="bold" style="font-size: 14pt; text-align: center; text-transform: uppercase;">ALENCASTRO CONSULTORIA-ESTÁGIOS</p>
        @endif
    </div>

    @php
        $estagiario = $estagio->estagiario;
        $empresa = $estagio->empresaConcedente;
        $periodo = $estagiario?->semestre_periodo_serie ?? $estagiario?->semestre_atual ?? $estagiario?->periodo;
        $cidade = $empresa?->cidade ?? 'Cidade';
        \Carbon\Carbon::setLocale('pt_BR');
        $hoje = \Carbon\Carbon::now();
        $dataExtenso = $cidade . ', ' . $hoje->format('d') . ' de ' . $hoje->translatedFormat('F') . ' de ' . $hoje->format('Y') . '.';
        $rel = $relatorio ?? null;
        $semestre = $rel?->semestre ?? null;
        $avaliacao = $rel?->avaliacao ?? null;
        $observacoes = $rel?->observacoes ?? null;
        $supervisorNome = $rel?->supervisorEstagio?->nome ?? $estagio->supervisorEstagio?->nome ?? null;
    @endphp

    <div class="text-center" style="margin-bottom: 8pt;">
        <h1>RELATÓRIO SEMESTRAL DE ESTÁGIO</h1>
    </div>

    <div class="bloco">
        <p class="bloco-titulo">1. DADOS DO ESTAGIÁRIO:</p>
        @if($estagiario?->nome)
            <p><span class="bold">Nome:</span> {{ $estagiario->nome }}</p>
        @endif
        @if($estagiario?->cpf)
            <p><span class="bold">CPF:</span> {{ $estagiario->cpf }}</p>
        @endif
        @if($estagiario?->rg)
            <p><span class="bold">RG:</span> {{ $estagiario->rg }}</p>
        @endif
        @if($estagiario?->curso)
            <p><span class="bold">Curso:</span> {{ $estagiario->curso }}</p>
        @endif
        @if($periodo)
            <p><span class="bold">Período/Semestre:</span> {{ $periodo }}</p>
        @endif
    </div>

    <div class="bloco">
        <p class="bloco-titulo">2. DADOS DA EMPRESA:</p>
        @if($empresa?->razao_social)
            <p><span class="bold">Razão Social:</span> {{ $empresa->razao_social }}</p>
        @endif
        @if($empresa?->cnpj)
            <p><span class="bold">CNPJ:</span> {{ $empresa->cnpj }}</p>
        @endif
        @if($empresa?->endereco || $empresa?->logradouro || $empresa?->bairro || $empresa?->cidade)
            @php
                $endEmpresa = $empresa?->logradouro
                    ? trim($empresa->logradouro . ($empresa->numero ? ', ' . $empresa->numero : '') . ($empresa->complemento ? ' - ' . $empresa->complemento : ''))
                    : $empresa?->endereco;
            @endphp
            <p><span class="bold">Endereço:</span> {{ $endEmpresa }}{{ $empresa?->bairro ? ' - ' . $empresa->bairro : '' }}{{ $empresa?->cidade ? ' - ' . $empresa->cidade : '' }}{{ $empresa?->estado ? '/' . $empresa->estado : '' }}</p>
        @endif
        @if($empresa?->supervisor_estagio_nome ?? $empresa?->supervisor_nome)
            <p><span class="bold">Supervisor:</span> {{ $empresa->supervisor_estagio_nome ?? $empresa->supervisor_nome }}</p>
        @endif
    </div>

    <div class="bloco">
        <p class="bloco-titulo">3. PERÍODO DO RELATÓRIO:</p>
        @if($estagio->data_inicio)
            <p><span class="bold">Data de Início do Estágio:</span> {{ $estagio->data_inicio->format('d/m/Y') }}</p>
        @endif
        @if($estagio->data_fim)
            <p><span class="bold">Data de Término:</span> {{ $estagio->data_fim->format('d/m/Y') }}</p>
        @endif
        <p style="margin-top: 4pt;">
            ({{ $semestre == 1 ? 'X' : '&nbsp;' }}) Relatório do 1º Semestre
            &nbsp;&nbsp;
            ({{ $semestre == 2 ? 'X' : '&nbsp;' }}) Relatório do 2º Semestre
            &nbsp;&nbsp;
            ({{ $semestre == 3 ? 'X' : '&nbsp;' }}) Relatório do 3º Semestre
            &nbsp;&nbsp;
            ({{ $semestre == 4 ? 'X' : '&nbsp;' }}) Relatório do 4º Semestre
        </p>
    </div>

    <div class="bloco">
        <p class="bloco-titulo">4. ATIVIDADES DESENVOLVIDAS NESTE PERÍODO:</p>
        @if($estagio->atividades)
            <p>{{ $estagio->atividades }}</p>
        @else
            <p>_______________________________________________________________</p>
        @endif
    </div>

    <div class="bloco">
        <p class="bloco-titulo">5. AVALIAÇÃO DO DESEMPENHO:</p>
        <p>
            ({{ $avaliacao == 'excelente' ? 'X' : '&nbsp;' }}) Excelente
            &nbsp;&nbsp;
            ({{ $avaliacao == 'bom' ? 'X' : '&nbsp;' }}) Bom
            &nbsp;&nbsp;
            ({{ $avaliacao == 'regular' ? 'X' : '&nbsp;' }}) Regular
            &nbsp;&nbsp;
            ({{ $avaliacao == 'insuficiente' ? 'X' : '&nbsp;' }}) Insuficiente
        </p>
    </div>

    <div class="bloco">
        <p class="bloco-titulo">6. OBSERVAÇÕES:</p>
        @if($observacoes)
            <p>{{ $observacoes }}</p>
        @else
            <p>_______________________________________________________________</p>
        @endif
    </div>

    <div style="margin-top: 20pt; text-align: left;">
        <p>{{ $dataExtenso }}</p>
    </div>

    <div style="margin-top: 30pt; text-align: center; page-break-inside: avoid; break-inside: avoid;">
        <div class="assinatura-linha"></div>
        <p class="bold">{{ $supervisorNome ?? 'Assinatura do Supervisor de Estágio' }}</p>
        <p style="font-size: 9pt; color: #555;">Supervisor de Estágio</p>
    </div>

    <div class="page-footer">
        <p>www.rotacerta-aprendizagem.com.br | admin@rotacerta-aprendizagem.com.br | (48) 99203-9611</p>
    </div>
</body>
</html>
