@extends('estagios.pdfs.layout')

@section('content')
    <div style="text-align: center; margin: 80px 0;">
        <h1 style="font-size: 32px; color: #1a365d;">CERTIFICADO DE ESTÁGIO</h1>
    </div>

    <div style="text-align: justify; font-size: 16px; line-height: 2; margin: 40px;">
        Certificamos para os devidos fins que o(a) estudante <strong>{{ $estagio->estagiario->nome }}</strong>, 
        regularmente matriculado(a) no curso de {{ $estagio->estagiario->curso }} da <strong>{{ $estagio->instituicaoEnsino->nome }}</strong>, 
        realizou estágio profissional na empresa <strong>{{ $estagio->empresaConcedente->razao_social }}</strong>, 
        no período de {{ \Carbon\Carbon::parse($estagio->data_inicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($estagio->data_fim)->format('d/m/Y') }}, 
        com carga horária total aproximada de {{ $estagio->carga_horaria_semanal * \Carbon\Carbon::parse($estagio->data_inicio)->diffInWeeks(\Carbon\Carbon::parse($estagio->data_fim)) }} horas.
    </div>

    <p style="text-align: center; margin-top: 40px; font-size: 14px;">
        Durante este período, o(a) estagiário(a) desenvolveu atividades relacionadas à sua área de formação, demonstrando competência e ética profissional.
    </p>

    <div style="margin-top: 80px; text-align: center;">
        Florianópolis, {{ date('d') }} de {{ \Carbon\Carbon::now()->locale('pt_BR')->monthName }} de {{ date('Y') }}.
    </div>

    <div class="signatures">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; text-align: center;">
                    <div class="signature-line"></div><br>
                    <strong>{{ $estagio->empresaConcedente->razao_social }}</strong><br>
                    Unidade Concedente
                </td>
                <td style="width: 50%; text-align: center;">
                    <div class="signature-line"></div><br>
                    <strong>{{ $agente->razao_social ?? 'ALENCASTRO CONSULTORIA-ESTÁGIOS' }}</strong><br>
                    Agente de Integração
                </td>
            </tr>
        </table>
    </div>
@endsection
