@extends('estagios.pdfs.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="text-decoration: underline;">ACORDO DE COOPERAÇÃO PARA REALIZAÇÃO DE ESTÁGIO</h2>
        <p>(Entre Instituição de Ensino e Agente de Integração)</p>
    </div>

    <p>Pelo presente instrumento jurídico, as partes abaixo qualificadas celebram entre si este Acordo de Cooperação, mediante as cláusulas e condições seguintes:</p>

    <div class="section-title">1. INTERVENIENTE (AGENTE DE INTEGRAÇÃO)</div>
    <table>
        <tr>
            <td class="label">Razão Social:</td>
            <td>{{ $agente->razao_social ?? 'ALENCASTRO CONSULTORIA-ESTÁGIOS' }}</td>
        </tr>
        <tr>
            <td class="label">CNPJ:</td>
            <td>{{ $agente->cnpj ?? '18.785.582/0001-24' }}</td>
        </tr>
        <tr>
            <td class="label">Representante:</td>
            <td>{{ $agente->responsavel_legal_nome ?? 'Diogo Luís Alencastro da Silva' }}</td>
        </tr>
    </table>

    <div class="section-title">2. INSTITUIÇÃO DE ENSINO</div>
    <table>
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

    <div class="section-title">CLÁUSULA PRIMEIRA - DO OBJETO</div>
    <p>O presente Acordo de Cooperação tem por objetivo estabelecer as condições para a realização de estágios de estudantes da INSTITUIÇÃO DE ENSINO em Unidades Concedentes (Empresas), com a interveniência do AGENTE DE INTEGRAÇÃO, nos termos da Lei nº 11.788/2008.</p>

    <div class="section-title">CLÁUSULA SEGUNDA - DAS OBRIGAÇÕES</div>
    <p>O AGENTE DE INTEGRAÇÃO atuará como auxiliar no processo de aperfeiçoamento do estágio, identificando oportunidades, encaminhando estudantes e cuidando da parte administrativa e documental (emissão de TCEs, relatórios, etc.).</p>

    <div class="section-title">CLÁUSULA TERCEIRA - DA VIGÊNCIA</div>
    <p>Este acordo terá vigência de 05 (cinco) anos a partir da data de sua assinatura, podendo ser rescindido por qualquer das partes mediante aviso prévio de 30 dias.</p>

    <div style="margin-top: 40px; text-align: right;">
        Florianópolis, {{ date('d') }} de {{ \Carbon\Carbon::now()->locale('pt_BR')->monthName }} de {{ date('Y') }}.
    </div>

    <div class="signatures">
        <table>
            <tr>
                <td>
                    <div class="signature-line"></div><br>
                    {{ $agente->razao_social ?? 'ALENCASTRO CONSULTORIA-ESTÁGIOS' }}<br>
                    (Agente de Integração)
                </td>
                <td>
                    <div class="signature-line"></div><br>
                    {{ $estagio->instituicaoEnsino->nome_fantasia ?? $estagio->instituicaoEnsino->razao_social }}<br>
                    (Instituição de Ensino)
                </td>
            </tr>
        </table>
    </div>
@endsection
