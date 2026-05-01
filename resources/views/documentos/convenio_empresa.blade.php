<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Convênio Empresa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6; padding: 30px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .mb-1 { margin-bottom: 15px; }
        .mb-2 { margin-bottom: 25px; }
        .mb-3 { margin-bottom: 35px; }
        .mt-2 { margin-top: 20px; }
        p { margin-bottom: 8px; text-align: justify; }
    </style>
</head>
<body>
    <div class="text-center mb-2">
        <h1 class="bold">TERMΟ DE CONVÊNIO PARA REALIZAÇÃO DE ESTÁGIO</h1>
        <p>ENTRE EMPRESA E INSTITUIÇÃO DE ENSINO</p>
    </div>

    <p class="mb-1">Pelo presente instrumento, de um lado <span class="bold">{{ $estagio->empresaConcedente->razao_social }}</span>, pessoa jurídica de direito privado, com sede à {{ $estagio->empresaConcedente->endereco }}, {{ $estagio->empresaConcedente->bairro }} - {{ $estagio->empresaConcedente->cidade }}/{{ $estagio->empresaConcedente->estado }} - CEP: {{ $estagio->empresaConcedente->cep }}, CNPJ {{ $estagio->empresaConcedente->cnpj }}, representado por seu representante legal <span class="bold">{{ $estagio->empresaConcedente->responsavel_legal_nome }}</span>, <span class="bold">{{ $estagio->empresaConcedente->responsavel_legal_cargo }}</span>, daquiopor diante denominado <span class="bold">CONCEDENTE DO ESTÁGIO</span> e, de outro, <span class="bold">{{ $estagio->instituicaoEnsino->razao_social }}</span>, pessoa jurídica de direito privado, com sede à {{ $estagio->instituicaoEnsino->endereco }}, {{ $estagio->instituicaoEnsino->bairro }} - {{ $estagio->instituicaoEnsino->cidade }}/{{ $estagio->instituicaoEnsino->estado }} - CEP: {{ $estagio->instituicaoEnsino->cep }}, CNPJ {{ $estagio->instituicaoEnsino->cnpj }}, representado por seu representante legal <span class="bold">{{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</span>, <span class="bold">{{ $estagio->instituicaoEnsino->responsavel_legal_cargo }}</span>, daquiopor diante denominado <span class="bold">INSTITUIÇÃO DE ENSINO</span>, têm entre si como justo e acordado o presente Termo de Convênio para Realização de Estágio, mediante as seguintes cláusulas:</p>

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
</body>
</html>