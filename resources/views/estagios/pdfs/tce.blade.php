@extends('estagios.pdfs.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="text-decoration: underline;">TERMO DE COMPROMISSO DE ESTÁGIO (TCE)</h2>
    </div>

    <div class="section-title">1. IDENTIFICAÇÃO DAS PARTES</div>
    
    <table>
        <tr>
            <td colspan="2" class="label">INSTITUIÇÃO DE ENSINO (IES)</td>
        </tr>
        <tr>
            <td class="label">Razão Social:</td>
            <td>{{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}</td>
        </tr>
        <tr>
            <td class="label">CNPJ:</td>
            <td>{{ $estagio->instituicaoEnsino->cnpj }}</td>
        </tr>
        <tr>
            <td class="label">Endereço:</td>
            <td>{{ $estagio->instituicaoEnsino->endereco }}, {{ $estagio->instituicaoEnsino->cidade }}-{{ $estagio->instituicaoEnsino->estado }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="2" class="label">UNIDADE CONCEDENTE (EMPRESA)</td>
        </tr>
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
            <td>{{ $estagio->empresaConcedente->endereco }}, {{ $estagio->empresaConcedente->bairro }}, {{ $estagio->empresaConcedente->cidade }}-{{ $estagio->empresaConcedente->estado }}</td>
        </tr>
        <tr>
            <td class="label">Supervisor:</td>
            <td>{{ $estagio->empresaConcedente->supervisor_nome }} ({{ $estagio->empresaConcedente->supervisor_cargo }})</td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="2" class="label">ESTAGIÁRIO(A)</td>
        </tr>
        <tr>
            <td class="label">Nome:</td>
            <td>{{ $estagio->estagiario->nome }}</td>
        </tr>
        <tr>
            <td class="label">CPF:</td>
            <td>{{ $estagio->estagiario->cpf }}</td>
        </tr>
        <tr>
            <td class="label">Curso:</td>
            <td>{{ $estagio->estagiario->curso }}</td>
        </tr>
    </table>

    <div class="section-title">2. CONDIÇÕES DO ESTÁGIO</div>
    
    <table>
        <tr>
            <td class="label">Vigência:</td>
            <td>De {{ \Carbon\Carbon::parse($estagio->data_inicio)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($estagio->data_fim)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">Carga Horária:</td>
            <td>{{ $estagio->carga_horaria_semanal }} horas semanais</td>
        </tr>
        <tr>
            <td class="label">Horário:</td>
            <td>Das {{ $estagio->horario_inicio ? \Carbon\Carbon::parse($estagio->horario_inicio)->format('H:i') : '--:--' }} às {{ $estagio->horario_fim ? \Carbon\Carbon::parse($estagio->horario_fim)->format('H:i') : '--:--' }} com {{ $estagio->intervalo ?? 'intervalo a combinar' }}</td>
        </tr>
        <tr>
            <td class="label">Bolsa Auxílio:</td>
            <td>R$ {{ number_format($estagio->valor_bolsa, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Auxílio Transporte:</td>
            <td>R$ {{ number_format($estagio->valor_auxilio_transporte, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Seguro Acidentes:</td>
            <td>Apólice nº {{ $estagio->apolice_numero ?? ($estagio->seguradora->apolice_numero ?? 'N/A') }} - {{ $estagio->seguradora->nome ?? 'Próprio' }}</td>
        </tr>
    </table>

    <div class="section-title">3. ATIVIDADES</div>
    <div style="padding: 10px; border: 1px solid #ddd; min-height: 100px;">
        {!! nl2br(e($estagio->atividades)) !!}
    </div>

    <div class="signatures">
        <table>
            <tr>
                <td>
                    <div class="signature-line"></div><br>
                    {{ $estagio->empresaConcedente->razao_social }}<br>
                    (Unidade Concedente)
                </td>
                <td>
                    <div class="signature-line"></div><br>
                    {{ $estagio->estagiario->nome }}<br>
                    (Estagiário)
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 60px;">
                    <div class="signature-line"></div><br>
                    {{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}<br>
                    (Instituição de Ensino)
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 60px;">
                    <div class="signature-line"></div><br>
                    {{ $agente->razao_social ?? 'ALENCASTRO CONSULTORIA-ESTÁGIOS' }}<br>
                    (Agente de Integração)
                </td>
            </tr>
        </table>
    </div>
@endsection
