<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório Semestral de Estágio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page {
            size: A4;
            margin-top: 4.0cm;
            margin-right: 1.5cm;
            margin-bottom: 1.0cm;
            margin-left: 2.5cm;
        }
        body { margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6; padding-top: 0; padding-bottom: 1.0cm; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .mb-1 { margin-bottom: 15px; }
        .mb-2 { margin-bottom: 25px; }
        .mb-3 { margin-bottom: 35px; }
        .mt-2 { margin-top: 20px; }
        p { margin-bottom: 8px; }
        .page-header {
            position: fixed;
            top: -2.5cm;
            left: 2.5cm;
            right: 1.5cm;
            height: 3.0cm;
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
    </style>
</head>
<body>
    <div class="page-header">
        @if(file_exists(public_path('images/AlencastroEstagios.png')))
        <img src="{{ public_path('images/AlencastroEstagios.png') }}" alt="Alencastro Estágios" style="max-width: 220px;">
        @else
        <p class="bold uppercase" style="font-size: 14pt;">ALENCASTRO CONSULTORIA-ESTÁGIOS</p>
        @endif
    </div>
    @php
        $estagiario = $estagio->estagiario;
        $empresa = $estagio->empresaConcedente;
        $periodo = $estagiario?->periodo;
    @endphp
    <div class="text-center mb-2">
        <h1 class="bold">RELATÓRIO SEMESTRAL DE ESTÁGIO</h1>
    </div>

    <div class="mb-2">
        <p><span class="bold">1. DADOS DO ESTAGIÁRIO:</span></p>
        @if($estagiario?->nome)
            <p>Nome: {{ $estagiario->nome }}</p>
        @endif
        @if($estagiario?->cpf)
            <p>CPF: {{ $estagiario->cpf }}</p>
        @endif
        @if($estagiario?->rg)
            <p>RG: {{ $estagiario->rg }}</p>
        @endif
        @if($estagiario?->curso)
            <p>Curso: {{ $estagiario->curso }}</p>
        @endif
        @if($periodo)
            <p>Período: {{ $periodo }}</p>
        @endif
    </div>

    <div class="mb-2">
        <p><span class="bold">2. DADOS DA EMPRESA:</span></p>
        @if($empresa?->razao_social)
            <p>Razão Social: {{ $empresa->razao_social }}</p>
        @endif
        @if($empresa?->cnpj)
            <p>CNPJ: {{ $empresa->cnpj }}</p>
        @endif
        @if($empresa?->endereco || $empresa?->bairro || $empresa?->cidade || $empresa?->estado)
            <p>Endereço: {{ $empresa->endereco }}{{ $empresa?->bairro ? ', ' . $empresa->bairro : '' }}{{ $empresa?->cidade || $empresa?->estado ? ' - ' : '' }}{{ $empresa->cidade }}{{ $empresa?->estado ? '/' . $empresa->estado : '' }}</p>
        @endif
        @if($empresa?->supervisor_estagio_nome)
            <p>Supervisor: {{ $empresa->supervisor_estagio_nome }}</p>
        @endif
    </div>

    <div class="mb-2">
        <p><span class="bold">3. PERÍODO DO RELATÓRIO:</span></p>
        @if($estagio->data_inicio)
            <p>Data de Início do Estágio: {{ $estagio->data_inicio->format('d/m/Y') }}</p>
        @endif
        @if($estagio->data_fim)
            <p>Data de Término: {{ $estagio->data_fim->format('d/m/Y') }}</p>
        @endif
    </div>

    <div class="mb-2">
        @if($estagio->atividades)
            <p><span class="bold">4. ATIVIDADES DESENVOLVIDAS NESTE PERÍODO:</span></p>
            <p>{{ $estagio->atividades }}</p>
        @endif
    </div>

    <div class="mb-2">
        <p><span class="bold">5. AVALIAÇÃO DO DESEMPENHO:</span></p>
        <p>( ) Excelente ( ) Bom ( ) Regular ( ) Insuficiente</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">6. OBSERVAÇÕES:</span></p>
        <p>_______________________________________________________________</p>
    </div>

    @if($empresa?->cidade)
        <div class="mb-3 mt-2">
            <p class="text-right">{{ $empresa->cidade }}, {{ now()->format('d') }} de {{ now()->format('M') }} de {{ now()->format('Y') }}</p>
        </div>
    @endif

    <div class="mb-1 text-center">
        <p class="underline">&nbsp;</p>
        <p>Assinatura do Supervisor de Estágio</p>
    </div>

    <div class="page-footer">
        <p>www.rotacerta-aprendizagem.com.br | admin@rotacerta-aprendizagem.com.br | (48) 99203-9611</p>
    </div>
</body>
</html>
