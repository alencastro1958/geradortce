<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Documento de Estágio</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            color: #666;
        }
        .content {
            margin: 20px 0;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            background-color: #f0f0f0;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table td {
            padding: 5px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 30%;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
        }
        .signatures {
            margin-top: 60px;
            width: 100%;
        }
        .signatures table {
            border: none;
        }
        .signatures td {
            border: none;
            text-align: center;
            padding-top: 40px;
            width: 33%;
        }
        .signature-line {
            border-top: 1px solid #000;
            padding-top: 5px;
            display: inline-block;
            width: 80%;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $agente->razao_social ?? 'ALENCASTRO CONSULTORIA-ESTÁGIOS' }}</h1>
        <p>
            CNPJ: {{ $agente->cnpj ?? '18.785.582/0001-24' }} | 
            {{ $agente->endereco ?? 'Av. Mauro Ramos, 1722 Aptº 92 - Bloco 08' }}, {{ $agente->bairro ?? 'Centro' }} | 
            CEP: {{ $agente->cep ?? '88020-304' }} | {{ $agente->cidade ?? 'Florianópolis' }}-{{ $agente->estado ?? 'SC' }}
        </p>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        Documento gerado automaticamente pelo Sistema de Gestão de Estágios em {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
