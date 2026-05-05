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
        $empresa    = $estagio->empresaConcedente;
        $ies        = $estagio->instituicaoEnsino ?? null;
        $periodo    = $estagiario?->semestre_periodo_serie ?? $estagiario?->semestre_atual ?? $estagiario?->periodo;
        $cidade     = $empresa?->cidade ?? 'Cidade';
        \Carbon\Carbon::setLocale('pt_BR');
        $hoje       = \Carbon\Carbon::now();
        $dataExtenso = $cidade . ', ' . $hoje->format('d') . ' de ' . $hoje->translatedFormat('F') . ' de ' . $hoje->format('Y') . '.';
        $rel        = $relatorio ?? null;
        $semestre   = $rel?->semestre ?? null;
        $avaliacao  = $rel?->avaliacao ?? null;
        $supervisorNome  = $rel?->supervisorEstagio?->nome ?? $estagio->supervisorEstagio?->nome ?? null;
        $supervisorCargo = $rel?->supervisorEstagio?->cargo ?? $estagio->supervisorEstagio?->cargo ?? null;
        $escala     = \App\Models\Relatorio::$escalaCompetencias;
        $competencias = \App\Models\Relatorio::$competencias;
    @endphp

    <div class="text-center" style="margin-bottom: 8pt;">
        <h1>RELATÓRIO SEMESTRAL DE ESTÁGIO CURRICULAR</h1>
        <p style="font-size:9pt; color:#555;">(Conforme Lei nº 11.788/2008)</p>
    </div>

    {{-- ── 1. DADOS DE IDENTIFICAÇÃO ─────────────────────────────────────── --}}
    <div class="bloco">
        <p class="bloco-titulo">1. DADOS DE IDENTIFICAÇÃO</p>

        <p class="bold underline" style="margin-top:4pt;">Dados do(a) Estagiário(a)</p>
        @if($estagiario?->nome)
            <p><span class="bold">Nome Completo:</span> {{ $estagiario->nome }}</p>
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
            <p><span class="bold">Período/Semestre Atual:</span> {{ $periodo }}</p>
        @endif
        @if($estagiario?->matricula)
            <p><span class="bold">Matrícula na IES:</span> {{ $estagiario->matricula }}</p>
        @endif
        @if($ies?->nome)
            <p><span class="bold">Instituição de Ensino (IES):</span> {{ $ies->nome }}</p>
        @endif

        <p class="bold underline" style="margin-top:8pt;">Dados da Unidade Concedente</p>
        @if($empresa?->razao_social)
            <p><span class="bold">Razão Social:</span> {{ $empresa->razao_social }}</p>
        @endif
        @if($empresa?->cnpj)
            <p><span class="bold">CNPJ:</span> {{ $empresa->cnpj }}</p>
        @endif
        @php
            $endEmpresa = $empresa?->logradouro
                ? trim($empresa->logradouro
                    . ($empresa->numero    ? ', ' . $empresa->numero    : '')
                    . ($empresa->complemento ? ' - ' . $empresa->complemento : ''))
                : $empresa?->endereco;
        @endphp
        @if($endEmpresa || $empresa?->bairro || $empresa?->cidade)
            <p>
                <span class="bold">Endereço Completo:</span>
                {{ $endEmpresa }}
                {{ $empresa?->bairro  ? ' - ' . $empresa->bairro  : '' }}
                {{ $empresa?->cidade  ? ' - ' . $empresa->cidade  : '' }}
                {{ $empresa?->estado  ? '/'   . $empresa->estado  : '' }}
                {{ $empresa?->cep     ? ' – CEP: ' . $empresa->cep : '' }}
            </p>
        @endif
        @if($estagio->setor_departamento ?? null)
            <p><span class="bold">Setor/Departamento:</span> {{ $estagio->setor_departamento }}</p>
        @endif

        <p class="bold underline" style="margin-top:8pt;">Dados do Supervisor na Unidade Concedente</p>
        @if($supervisorNome)
            <p><span class="bold">Nome do Supervisor:</span> {{ $supervisorNome }}</p>
        @endif
        @if($supervisorCargo)
            <p><span class="bold">Cargo/Função:</span> {{ $supervisorCargo }}</p>
        @endif
        @if($rel?->supervisorEstagio?->formacao_academica ?? null)
            <p><span class="bold">Formação Acadêmica:</span> {{ $rel->supervisorEstagio->formacao_academica }}</p>
        @endif
        @if($rel?->supervisorEstagio?->email ?? null)
            <p><span class="bold">E-mail:</span> {{ $rel->supervisorEstagio->email }}</p>
        @endif
        @if($rel?->supervisorEstagio?->telefone ?? null)
            <p><span class="bold">Telefone:</span> {{ $rel->supervisorEstagio->telefone }}</p>
        @endif
    </div>

    {{-- ── 2. PERÍODO DE REFERÊNCIA ─────────────────────────────────────── --}}
    <div class="bloco">
        <p class="bloco-titulo">2. PERÍODO DE REFERÊNCIA</p>
        <p>
            ( {{ $semestre == 1 ? 'X' : '&nbsp;' }} )&nbsp;1º Semestre&nbsp;&nbsp;&nbsp;
            ( {{ $semestre == 2 ? 'X' : '&nbsp;' }} )&nbsp;2º Semestre&nbsp;&nbsp;&nbsp;
            ( {{ $semestre == 3 ? 'X' : '&nbsp;' }} )&nbsp;3º Semestre&nbsp;&nbsp;&nbsp;
            ( {{ $semestre == 4 ? 'X' : '&nbsp;' }} )&nbsp;4º Semestre
        </p>
        <p>
            <span class="bold">Data de Início do Período:</span>
            {{ $rel?->data_inicio_periodo ? $rel->data_inicio_periodo->format('d/m/Y') : '___/___/______' }}
            &nbsp;&nbsp;&nbsp;
            <span class="bold">Data de Fim do Período:</span>
            {{ $rel?->data_fim_periodo ? $rel->data_fim_periodo->format('d/m/Y') : '___/___/______' }}
        </p>
    </div>

    {{-- ── 3. RESUMO DAS ATIVIDADES DESENVOLVIDAS ───────────────────────── --}}
    <div class="bloco">
        <p class="bloco-titulo">3. RESUMO DAS ATIVIDADES DESENVOLVIDAS</p>
        @if($rel?->atividades_descricao)
            <p>{{ $rel->atividades_descricao }}</p>
        @else
            <p>&nbsp;</p><p>&nbsp;</p><p>_________________________________________________________________________</p>
        @endif

        @if($rel?->relacao_curso)
            <p class="bold" style="margin-top:6pt;">Relação com o Curso:</p>
            <p>{{ $rel->relacao_curso }}</p>
        @endif
    </div>

    {{-- ── 4. FREQUÊNCIA E CARGA HORÁRIA ───────────────────────────────── --}}
    <div class="bloco">
        <p class="bloco-titulo">4. FREQUÊNCIA E CARGA HORÁRIA</p>
        <p>
            <span class="bold">Total de Horas Previstas no TCE:</span>
            {{ $rel?->horas_previstas ?? '______' }} horas
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span class="bold">Total de Horas Efetivamente Cumpridas:</span>
            {{ $rel?->horas_cumpridas ?? '______' }} horas
        </p>
        <p>
            <span class="bold">Faltas Justificadas:</span>
            {{ $rel?->faltas_justificadas ?? '______' }}
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span class="bold">Faltas Não Justificadas:</span>
            {{ $rel?->faltas_nao_justificadas ?? '______' }}
        </p>
        @if($rel?->obs_ausencias)
            <p><span class="bold">Observações sobre Ausências:</span> {{ $rel->obs_ausencias }}</p>
        @endif
    </div>

    {{-- ── 5. AVALIAÇÃO DE DESEMPENHO E APRENDIZADO ─────────────────────── --}}
    <div class="bloco">
        <p class="bloco-titulo">5. AVALIAÇÃO DE DESEMPENHO E APRENDIZADO</p>
        <p style="font-size:9pt; margin-bottom:4pt;">(Preenchimento pelo Supervisor da Unidade Concedente)</p>

        {{-- Tabela de competências --}}
        <table style="width:100%; border-collapse:collapse; font-size:9pt; margin-top:4pt;">
            <thead>
                <tr style="background:#f0f4ff;">
                    <th style="border:1px solid #ccc; padding:4pt 6pt; text-align:left; width:40%;">Competência</th>
                    @foreach($escala as $val => $lbl)
                        <th style="border:1px solid #ccc; padding:4pt 4pt; text-align:center;">{{ $lbl }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($competencias as $campo => $nomComp)
                    <tr>
                        <td style="border:1px solid #ccc; padding:4pt 6pt;">{{ $nomComp }}</td>
                        @foreach($escala as $val => $lbl)
                            <td style="border:1px solid #ccc; padding:4pt 4pt; text-align:center;">
                                {{ ($rel?->{$campo} ?? null) === $val ? '(X)' : '( )' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Parecer descritivo --}}
        @if($rel?->parecer_descritivo)
            <p class="bold" style="margin-top:8pt;">Parecer Descritivo do Supervisor:</p>
            <p>{{ $rel->parecer_descritivo }}</p>
        @else
            <p class="bold" style="margin-top:8pt;">Parecer Descritivo do Supervisor:</p>
            <p>_________________________________________________________________________</p>
            <p>_________________________________________________________________________</p>
        @endif
    </div>

    {{-- ── 6. AVALIAÇÃO GERAL ────────────────────────────────────────────── --}}
    <div class="bloco">
        <p class="bloco-titulo">6. AVALIAÇÃO GERAL DO DESEMPENHO</p>
        <p>
            ( {{ $avaliacao === 'excelente'    ? 'X' : '&nbsp;' }} )&nbsp;Excelente&nbsp;&nbsp;&nbsp;
            ( {{ $avaliacao === 'bom'          ? 'X' : '&nbsp;' }} )&nbsp;Bom&nbsp;&nbsp;&nbsp;
            ( {{ $avaliacao === 'regular'      ? 'X' : '&nbsp;' }} )&nbsp;Regular&nbsp;&nbsp;&nbsp;
            ( {{ $avaliacao === 'insuficiente' ? 'X' : '&nbsp;' }} )&nbsp;Insuficiente
        </p>
        @if($rel?->observacoes)
            <p style="margin-top:4pt;"><span class="bold">Observações:</span> {{ $rel->observacoes }}</p>
        @endif
    </div>

    {{-- ── 7. DECLARAÇÕES E ASSINATURAS ────────────────────────────────── --}}
    <div class="bloco" style="margin-top:20pt;">
        <p style="text-align:left;">{{ $dataExtenso }}</p>
    </div>

    <div style="margin-top:24pt; page-break-inside:avoid; break-inside:avoid;">
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="width:48%; text-align:center; padding:0 12pt;">
                    <div class="assinatura-linha"></div>
                    <p class="bold">{{ $estagiario?->nome ?? 'Assinatura do(a) Estagiário(a)' }}</p>
                    <p style="font-size:9pt; color:#555;">Estagiário(a)</p>
                </td>
                <td style="width:4%;"></td>
                <td style="width:48%; text-align:center; padding:0 12pt;">
                    <div class="assinatura-linha"></div>
                    <p class="bold">{{ $supervisorNome ?? 'Assinatura do Supervisor' }}</p>
                    <p style="font-size:9pt; color:#555;">
                        Supervisor de Estágio
                        @if($supervisorCargo) – {{ $supervisorCargo }} @endif
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-footer">
        <p>www.alencastroestagios.com.br | admin@alencastroestagios.com.br | (62) 99999-0000</p>
    </div>
</body>
</html>



