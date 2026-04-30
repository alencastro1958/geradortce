@extends('estagios.pdfs.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="text-decoration: underline;">CONVÊNIO DE CONCESSÃO DE ESTÁGIO</h2>
        <p>(Entre Agente de Integração e Unidade Concedente)</p>
    </div>

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
    </table>

    <div class="section-title">2. UNIDADE CONCEDENTE (EMPRESA)</div>
    <table>
        <tr>
            <td class="label">Razão Social:</td>
            <td>{{ $estagio->empresaConcedente->razao_social }}</td>
        </tr>
        <tr>
            <td class="label">CNPJ:</td>
            <td>{{ $estagio->empresaConcedente->cnpj }}</td>
        </tr>
        <tr>
            <td class="label">Representante:</td>
            <td>{{ $estagio->empresaConcedente->responsavel_legal_nome }}</td>
        </tr>
    </table>

    <div class="section-title">CLÁUSULA PRIMEIRA - DO OBJETO</div>
    <p>O presente convênio visa a cooperação mútua para a viabilização de estágios curriculares obrigatórios e não obrigatórios aos estudantes das Instituições de Ensino conveniadas ao AGENTE DE INTEGRAÇÃO.</p>

    <div class="section-title">CLÁUSULA SEGUNDA - DA OPERACIONALIZAÇÃO</div>
    <p>A UNIDADE CONCEDENTE comunicará ao AGENTE DE INTEGRAÇÃO a existência de vagas. O AGENTE DE INTEGRAÇÃO selecionará e encaminhará os estudantes, providenciando a documentação legal (TCE) e o Seguro de Acidentes Pessoais, quando contratado através do Agente.</p>

    <div class="section-title">CLÁUSULA TERCEIRA - DA TAXA DE SERVIÇO</div>
    <p>Pela prestação dos serviços de recrutamento, seleção e administração do estágio, a UNIDADE CONCEDENTE pagará ao AGENTE DE INTEGRAÇÃO a taxa mensal acordada entre as partes para cada estagiário ativo.</p>

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
                    {{ $estagio->empresaConcedente->razao_social }}<br>
                    (Unidade Concedente)
                </td>
            </tr>
        </table>
    </div>
@endsection
