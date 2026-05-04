<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Convênio Empresa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page {
            size: A4;
            margin-top: 4.0cm;
            margin-right: 1.5cm;
            margin-bottom: 1.0cm;
            margin-left: 2.5cm;
        }
        body { margin: 0; font-family: Arial, sans-serif; font-size: 11pt; line-height: 1.15; padding-top: 0; padding-bottom: 1.0cm; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .mb-1 { margin-bottom: 15px; }
        .mb-2 { margin-bottom: 25px; }
        .mb-3 { margin-bottom: 35px; }
        .mt-2 { margin-top: 20px; }
        p { margin-bottom: 8px; text-align: justify; }
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
        .page-footer::after {
            display: block;
            text-align: center;
            font-size: 8pt;
            content: "Página " counter(page) " de " counter(pages);
            margin-top: 2px;
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
        $empresa = $estagio->empresaConcedente;
        $ies = $estagio->instituicaoEnsino;
        $empresaCidadeEstado = trim(implode('/', array_filter([$empresa?->cidade, $empresa?->estado])));
        $iesCidadeEstado = trim(implode('/', array_filter([$ies?->cidade, $ies?->estado])));
    @endphp
    <div class="text-center mb-2">
        <h1 class="bold">TERMΟ DE CONVÊNIO PARA REALIZAÇÃO DE ESTÁGIO</h1>
        <p>ENTRE EMPRESA E INSTITUIÇÃO DE ENSINO</p>
    </div>

    <p class="mb-1">
        Pelo presente instrumento, de um lado
        @if($empresa?->razao_social) <span class="bold">{{ $empresa->razao_social }}</span>@endif,
        pessoa jurídica de direito privado
        @if($empresa?->endereco || $empresa?->bairro || $empresaCidadeEstado || $empresa?->cep)
            , com sede à
            @if($empresa?->endereco) {{ $empresa->endereco }}@endif
            @if($empresa?->bairro), {{ $empresa->bairro }}@endif
            @if($empresaCidadeEstado) - {{ $empresaCidadeEstado }}@endif
            @if($empresa?->cep) - CEP: {{ $empresa->cep }}@endif
        @endif
        @if($empresa?->cnpj)
            , CNPJ {{ $empresa->cnpj }}
        @endif
        @if($empresa?->responsavel_legal_nome)
            , representado por seu representante legal <span class="bold">{{ $empresa->responsavel_legal_nome }}</span>
        @endif
        @if($empresa?->responsavel_legal_cargo)
            , <span class="bold">{{ $empresa->responsavel_legal_cargo }}</span>
        @endif
        , denominado <span class="bold">CONCEDENTE DO ESTÁGIO</span> e, de outro,
        @if($ies?->razao_social) <span class="bold">{{ $ies->razao_social }}</span>@endif,
        pessoa jurídica de direito privado
        @if($ies?->endereco || $ies?->bairro || $iesCidadeEstado || $ies?->cep)
            , com sede à
            @if($ies?->endereco) {{ $ies->endereco }}@endif
            @if($ies?->bairro), {{ $ies->bairro }}@endif
            @if($iesCidadeEstado) - {{ $iesCidadeEstado }}@endif
            @if($ies?->cep) - CEP: {{ $ies->cep }}@endif
        @endif
        @if($ies?->cnpj)
            , CNPJ {{ $ies->cnpj }}
        @endif
        @if($ies?->responsavel_legal_nome)
            , representado por seu representante legal <span class="bold">{{ $ies->responsavel_legal_nome }}</span>
        @endif
        @if($ies?->responsavel_legal_cargo)
            , <span class="bold">{{ $ies->responsavel_legal_cargo }}</span>
        @endif
        , denominado <span class="bold">INSTITUIÇÃO DE ENSINO</span>, têm entre si como justo e acordado o presente Termo de Convênio para Realização de Estágio, mediante as seguintes cláusulas:
    </p>

    <div class="mb-2">
        <p><span class="bold">CLÁUSULA PRIMEIRA - DO OBJETO</span></p>
        <p>O presente Convênio tem por objeto a concessão de estágio aos alunos da INSTITUIÇÃO DE ENSINO, visando ao aprendizado práticoernero e complementar do ensinoaprendizagem.</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">CLÁUSULA SEGUNDA - DAS CONDIÇÕES DE REALIZAÇÃO DO ESTÁGIO</span></p>
        <p>O estágio será realizado de acordo com a Lei nº 11.788/2008, sendo supervisionado pela CONCEDE por intermédio de profissional ocupante de cargo ou função compatible com a área de formação do estagiário.</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">CLÁUSULA TERCEIRA - DA REMUNERAÇÃO</span></p>
        <p>O estágio poderá ser remunerado, a critério da CONCEDENTE DO ESTÁGIO, mediante bolsa-auxílio a ser definida de comum acordo entre as partes.</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">CLÁUSULA QUARTA - DA SEGURANÇA</span></p>
        <p>A CONCEDENTE DO ESTÁGIO se obriga a contratar seguro contra acidentes pessoais em favor do estagiário.</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">CLÁUSULA QUINTA - DA VIGÊNCIA</span></p>
        <p>O presente Convênio terá vigência de {{ $estagio->data_inicio->format('d/m/Y') }} a {{ $estagio->data_fim->format('d/m/Y') }} e poderá ser prorrogado mediante termoratificativo.</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">CLÁUSULA SEXTA - DO FORO</span></p>
        <p>Fica eleito o foro da Comarca de {{ $estagio->empresaConcedente->cidade }} para dirimir quaisquer dúvidas oriundas deste Convênio.</p>
    </div>

    <div style="page-break-inside: avoid; break-inside: avoid;">
    <p>E, por estarem assim, justas e accordadas, assinam o presente instrumento em {{ $estagio->empresaConcedente->cidade }}, {{ now()->format('d') }} de {{ now()->format('M') }} de {{ now()->format('Y') }}</p>

    <div class="mb-1 mt-2 text-center">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">{{ $estagio->empresaConcedente->responsavel_legal_nome }}</p>
        <p>Representante da {{ $estagio->empresaConcedente->nome_fantasia ?? $estagio->empresaConcedente->razao_social }}</p>
    </div>

    <div class="mb-1 text-center">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">{{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</p>
        <p>Representante da {{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}</p>
    </div>
    </div>{{-- fim bloco assinaturas --}}

    <div class="page-footer">
        <p>www.rotacerta-aprendizagem.com.br | admin@rotacerta-aprendizagem.com.br | (48) 99203-9611</p>
    </div>
</body>
</html>
