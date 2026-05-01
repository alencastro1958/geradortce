<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de Compromisso de Estágio - {{ $estagio->estagiario->nome }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .title {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        .clause {
            margin-bottom: 15px;
            text-align: justify;
        }
        .clause-title {
            font-weight: bold;
        }
        .signature-grid {
            margin-top: 50px;
            display: grid;
            grid-template-cols: 1fr 1fr;
            gap: 50px;
        }
        .signature-box {
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 5px;
            font-size: 10pt;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 9pt;
            color: #666;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .label {
            font-weight: bold;
            background-color: #f9f9f9;
            width: 30%;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="position: fixed; top: 20px; right: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #4F46E5; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            🖨️ Imprimir / Salvar PDF
        </button>
    </div>

    <div class="header">
        <div class="title">Gerador de TCEs</div>
        <div class="subtitle">Termo de Compromisso de Estágio (TCE)</div>
    </div>

    <div class="section">
        <div class="clause">
            Pelo presente instrumento particular, as partes abaixo qualificadas celebram entre si este Termo de Compromisso de Estágio, nos termos da Lei nº 11.788/2008.
        </div>
    </div>

    <div class="section">
        <div class="section-title">1. UNIDADE CONCEDENTE (EMPRESA)</div>
        <table class="data-table">
            <tr>
                <td class="label">Razão Social:</td>
                <td>{{ $estagio->empresaConcedente->razao_social }}</td>
            </tr>
            <tr>
                <td class="label">CNPJ:</td>
                <td>{{ $estagio->empresaConcedente->cnpj }}</td>
            </tr>
            <tr>
                <td class="label">Endereço:</td>
                <td>{{ $estagio->empresaConcedente->logradouro }}, {{ $estagio->empresaConcedente->numero }} - {{ $estagio->empresaConcedente->bairro }} - {{ $estagio->empresaConcedente->cidade }}/{{ $estagio->empresaConcedente->estado }}</td>
            </tr>
            <tr>
                <td class="label">Representante:</td>
                <td>{{ $estagio->empresaConcedente->representante_legal_nome }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">2. ESTAGIÁRIO(A)</div>
        <table class="data-table">
            <tr>
                <td class="label">Nome:</td>
                <td>{{ $estagio->estagiario->nome }}</td>
            </tr>
            <tr>
                <td class="label">CPF:</td>
                <td>{{ $estagio->estagiario->cpf }}</td>
            </tr>
            <tr>
                <td class="label">RG:</td>
                <td>{{ $estagio->estagiario->rg }}</td>
            </tr>
            <tr>
                <td class="label">Endereço:</td>
                <td>{{ $estagio->estagiario->logradouro }}, {{ $estagio->estagiario->numero }} - {{ $estagio->estagiario->bairro }} - {{ $estagio->estagiario->cidade }}/{{ $estagio->estagiario->estado }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">3. INSTITUIÇÃO DE ENSINO</div>
        <table class="data-table">
            <tr>
                <td class="label">Instituição:</td>
                <td>{{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}</td>
            </tr>
            <tr>
                <td class="label">CNPJ:</td>
                <td>{{ $estagio->instituicaoEnsino->cnpj }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">4. CONDIÇÕES DO ESTÁGIO</div>
        <table class="data-table">
            <tr>
                <td class="label">Vigência:</td>
                <td>De {{ \Carbon\Carbon::parse($estagio->data_inicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($estagio->data_fim)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">Carga Horária:</td>
                <td>{{ $estagio->carga_horaria_semanal }} horas semanais</td>
            </tr>
            <tr>
                <td class="label">Bolsa Auxílio:</td>
                <td>R$ {{ number_format($estagio->valor_bolsa, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Auxílio Transporte:</td>
                <td>R$ {{ number_format($estagio->valor_auxilio_transporte, 2, ',', '.') }}</td>
            </tr>
            @if($estagio->seguradora)
            <tr>
                <td class="label">Seguro Acidentes:</td>
                <td>{{ $estagio->seguradora->nome }} - Apólice: {{ $estagio->seguradora->apolice_numero }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="section">
        <div class="clause">
            <span class="clause-title">CLÁUSULA PRIMEIRA - DO OBJETO:</span> O estágio visa ao aprendizado de competências próprias da atividade profissional e à contextualização curricular, objetivando o desenvolvimento do educando para a vida cidadã e para o trabalho.
        </div>
        <div class="clause">
            <span class="clause-title">CLÁUSULA SEGUNDA - DAS ATIVIDADES:</span> Durante o período de estágio, o(a) ESTAGIÁRIO(A) desenvolverá as seguintes atividades: {{ $estagio->atividades ?? 'Atividades relacionadas ao curso de formação.' }}
        </div>
        <div class="clause">
            <span class="clause-title">CLÁUSULA TERCEIRA - DA INEXISTÊNCIA DE VÍNCULO:</span> O estágio não cria vínculo empregatício de qualquer natureza entre o(a) ESTAGIÁRIO(A) e a UNIDADE CONCEDENTE, nos termos do art. 3º da Lei nº 11.788/2008.
        </div>
    </div>

    <div class="section" style="text-align: right; margin-top: 40px;">
        {{ config('app.city', 'São Paulo') }}, {{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }}
    </div>

    <div class="signature-grid">
        <div class="signature-box">
            {{ $estagio->empresaConcedente->razao_social }}<br>
            (UNIDADE CONCEDENTE)
        </div>
        <div class="signature-box">
            {{ $estagio->estagiario->nome }}<br>
            (ESTAGIÁRIO)
        </div>
        <div class="signature-box">
            {{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}<br>
            (INSTITUIÇÃO DE ENSINO)
        </div>
        @if($estagio->estagiario->responsavel_legal_nome)
        <div class="signature-box">
            {{ $estagio->estagiario->responsavel_legal_nome }}<br>
            (RESPONSÁVEL LEGAL)
        </div>
        @endif
    </div>

    <div class="footer">
        Este documento foi gerado eletronicamente pelo Sistema Gerador de TCEs.
    </div>
</body>
</html>
