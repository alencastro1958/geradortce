@extends('estagios.pdfs.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="text-decoration: underline;">RELATÓRIO DE ATIVIDADES DE ESTÁGIO (SEMESTRAL)</h2>
    </div>

    <div class="section-title">IDENTIFICAÇÃO</div>
    <table>
        <tr>
            <td class="label">Estagiário:</td>
            <td>{{ $estagio->estagiario->nome }}</td>
        </tr>
        <tr>
            <td class="label">Empresa:</td>
            <td>{{ $estagio->empresaConcedente->razao_social }}</td>
        </tr>
        <tr>
            <td class="label">Período Avaliado:</td>
            <td>{{ \Carbon\Carbon::parse($estagio->data_inicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="section-title">DESCRIÇÃO DAS ATIVIDADES REALIZADAS</div>
    <div style="padding: 15px; border: 1px solid #ddd; min-height: 150px;">
        {!! nl2br(e($estagio->atividades)) !!}
    </div>

    <div class="section-title">AVALIAÇÃO DO SUPERVISOR</div>
    <p>O estagiário vem cumprindo as atividades propostas com zelo e dedicação, demonstrando evolução técnica e profissional no ambiente de trabalho.</p>

    <div class="signatures">
        <table>
            <tr>
                <td>
                    <div class="signature-line"></div><br>
                    {{ $estagio->estagiario->nome }}<br>
                    (Estagiário)
                </td>
                <td>
                    <div class="signature-line"></div><br>
                    {{ $estagio->empresaConcedente->supervisor_nome }}<br>
                    (Supervisor - Unidade Concedente)
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 50px;">
                    <div class="signature-line"></div><br>
                    {{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}<br>
                    (Instituição de Ensino)
                </td>
            </tr>
        </table>
    </div>
@endsection
