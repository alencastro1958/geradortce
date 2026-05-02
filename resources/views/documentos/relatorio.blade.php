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
            margin-right: 2.5cm;
            margin-bottom: 1.0cm;
            margin-left: 1.5cm;
        }
        body { margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6; padding-top: 3.5cm; padding-bottom: 1.0cm; }
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
            top: 0.5cm;
            left: 1.5cm;
            right: 2.5cm;
            height: 3.0cm;
            text-align: center;
        }
        .page-footer {
            position: fixed;
            bottom: 0.3cm;
            left: 1.5cm;
            right: 2.5cm;
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
    <div class="text-center mb-2">
        <h1 class="bold">RELATÓRIO SEMESTRAL DE ESTÁGIO</h1>
    </div>

    <div class="mb-2">
        <p><span class="bold">1. DADOS DO ESTAGIÁRIO:</span></p>
        <p>Nome: {{ $estagio->estagiario->nome }}</p>
        <p>CPF: {{ $estagio->estagiario->cpf }} | RG: {{ $estagio->estagiario->rg }}</p>
        <p>Curso: {{ $estagio->estagiario->curso }}</p>
        <p>Período: {{ $estagio->estagiario->periodo ?? 'Não especificado' }}</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">2. DADOS DA EMPRESA:</span></p>
        <p>Razão Social: {{ $estagio->empresaConcedente->razao_social }}</p>
        <p>CNPJ: {{ $estagio->empresaConcedente->cnpj }}</p>
        <p>Endereço: {{ $estagio->empresaConcedente->endereco }}, {{ $estagio->empresaConcedente->bairro }} - {{ $estagio->empresaConcedente->cidade }}/{{ $estagio->empresaConcedente->estado }}</p>
        <p>Supervisor: {{ $estagio->empresaConcedente->supervisor_estagio_nome ?? 'Não informado' }}</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">3. PERÍODO DO RELATÓRIO:</span></p>
        <p>Data de Início do Estágio: {{ $estagio->data_inicio->format('d/m/Y') }}</p>
        <p>Data de Término: {{ $estagio->data_fim->format('d/m/Y') }}</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">4. ATIVIDADES DESENVOLVIDAS NESTE PERÍODO:</span></p>
        <p>{{ $estagio->atividades ?? 'Atividades compatíveis com a área de formação.' }}</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">5. AVALIAÇÃO DO DESEMPENHO:</span></p>
        <p>( ) Excelente ( ) Bom ( ) Regular ( ) Insuficiente</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">6. OBSERVAÇÕES:</span></p>
        <p>_______________________________________________________________</p>
    </div>

    <div class="mb-3 mt-2">
        <p class="text-right">{{ $estagio->empresaConcedente->cidade }}, {{ now()->format('d') }} de {{ now()->format('M') }} de {{ now()->format('Y') }}</p>
    </div>

    <div class="mb-1 text-center">
        <p class="underline">&nbsp;</p>
        <p>Assinatura do Supervisor de Estágio</p>
    </div>

    <div class="page-footer">
        <p>www.rotacerta-aprendizagem.com.br | admin@rotacerta-aprendizagem.com.br | (48) 99203-9611</p>
    </div>
</body>
</html>
