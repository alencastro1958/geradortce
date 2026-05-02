<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Conclusão de Estágio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page {
            size: A4;
            margin-top: 4.0cm;
            margin-right: 2.5cm;
            margin-bottom: 1.0cm;
            margin-left: 1.5cm;
        }
        body { margin: 0; font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6; padding-bottom: 1.0cm; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .mb-1 { margin-bottom: 15px; }
        .mb-2 { margin-bottom: 25px; }
        .mb-3 { margin-bottom: 35px; }
        .mt-2 { margin-top: 20px; }
        p { margin-bottom: 10px; }
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
        <h1 class="uppercase bold">Certificado de Conclusão de Estágio</h1>
    </div>

    <div class="mb-2">
        <p class="text-center">Certificamos para os devidos fins que <span class="bold">{{ $estagio->estagiario->nome }}</span>, regularmente matriculado(a) no curso de <span class="bold">{{ $estagio->estagiario->curso }}</span> da <span class="bold">{{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}</span>, concluiu com êxito o estágio obrigatório/não obrigatório supervisionado(a) realizado(a) na empresa <span class="bold">{{ $estagio->empresaConcedente->nome_fantasia ?? $estagio->empresaConcedente->razao_social }}</span>.</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">Período de Réalização:</span> {{ $estagio->data_inicio->format('d/m/Y') }} a {{ $estagio->data_fim->format('d/m/Y') }}</p>
        <p><span class="bold">Carga Horária:</span> {{ $estagio->carga_horaria_semanal }} horas semanais / {{ ($estagio->data_inicio->diffInDays($estagio->data_fim) / 7) * $estagio->carga_horaria_semanal }} horas totais</p>
    </div>

    <div class="mb-2">
        <p><span class="bold">Atividades Desenvolvidas:</span></p>
        <p>{{ $estagio->atividades ?? 'Atividades compatíveis com a área de formação do estagiário.' }}</p>
    </div>

    <div class="mb-2">
        <p>Vale salientar que o(a) estudiante demonstrou interesse, responsabilidade e compromisso durante touto o período de estágio, desenvolv todas às atividades propuestas de forma satisfatória.</p>
    </div>

    <div class="mb-3 mt-2">
        <p class="text-center">Este certificado é válido para todos os efeitos legais.</p>
    </div>

    <div class="mb-3 mt-2">
        <p class="text-right">{{ $estagio->instituicaoEnsino->cidade }}, {{ now()->format('d') }} de {{ now()->format('M') }} de {{ now()->format('Y') }}</p>
    </div>

    <div class="text-center mt-2">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">{{ $estagio->instituicaoEnsino->responsavel_legal_nome }}</p>
        <p>Coordenador(a) de Curso / Representante da IES</p>
    </div>

    <div class="page-footer">
        <p>www.rotacerta-aprendizagem.com.br | admin@rotacerta-aprendizagem.com.br | (48) 99203-9611</p>
    </div>
</body>
</html>
