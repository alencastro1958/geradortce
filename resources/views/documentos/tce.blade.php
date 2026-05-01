<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Compromisso de Estágio - TCE</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 10pt; line-height: 1.3; padding: 15px; max-width: 800px; margin: 0 auto; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-justify { text-align: justify; }
        .bold { font-weight: bold; }
        .mb-1 { margin-bottom: 8px; }
        .mb-2 { margin-bottom: 12px; }
        .mb-3 { margin-bottom: 15px; }
        .mt-2 { margin-top: 12px; }
        .mt-3 { margin-top: 15px; }
        p { margin-bottom: 4px; }
        .linha { border-bottom: 1px solid #000; display: inline-block; min-width: 200px; }
        .linha-curta { border-bottom: 1px solid #000; display: inline-block; min-width: 80px; }
        .assinatura { width: 45%; float: left; text-align: center; margin-top: 20px; }
        .assinatura-centro { width: 100%; text-align: center; margin-top: 20px; }
        .clear { clear: both; }
        .uppercase { text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="text-center mb-2">
        <p class="bold uppercase" style="font-size: 12pt;">ALENCASTRO CONSULTORIA-ESTÁGIOS</p>
        <p style="font-size: 9pt;">Agência de Integração de Estágios</p>
        <p style="font-size: 8pt;">www.alencastroestagios.com.br | diogo@alencastroestagios.com.br</p>
    </div>

    <div class="text-center mb-2">
        <p class="bold uppercase">Termo de Compromisso de Estágio - TCE</p>
        <p style="font-size: 8pt;">(De acordo com o disposto da lei n.º 6.494/77 e no respectivo decreto de regulamentação n.º 87.497/82)</p>
    </div>

    <p class="mb-1 text-justify">TERMO DE COMPROMISSO DE ESTÁGIO, instrumento jurídico cujo objetivo é formalizar as condições para realização de estágio, definido como ato educativo escolar supervisionado, desenvolvido no ambiente de trabalho, que visa a preparação para o trabalho produtivo do estudante, nos termos da Lei nº 11.788, de 25/09/2008, (Publicada no D.O.U. de 26.09.2008) que entre si celebram as partes a seguir nomeadas:</p>

    <p class="bold mb-1 mt-2">INSTITUIÇÃO DE ENSINO</p>
    <p><span class="bold">Razão Social:</span> {{ $estagio->instituicaoEnsino->razao_social }} <span class="linha"></span></p>
    @if($estagio->instituicaoEnsino->cnpj)
    <p><span class="bold">CNPJ:</span> {{ $estagio->instituicaoEnsino->cnpj }}</p>
    @endif
    @if($estagio->instituicaoEnsino->mantenedora)
    <p><span class="bold">Mantenedora:</span> {{ $estagio->instituicaoEnsino->mantenedora }}</p>
    @endif
    <p><span class="bold">Endereço:</span> {{ $estagio->instituicaoEnsino->endereco }}
    @if($estagio->instituicaoEnsino->complemento), {{ $estagio->instituicaoEnsino->complemento }}@endif
    @if($estagio->instituicaoEnsino->bairro) - {{ $estagio->instituicaoEnsino->bairro }}@endif
    @if($estagio->instituicaoEnsino->cep) - CEP: {{ $estagio->instituicaoEnsino->cep }}@endif</p>
    <p><span class="bold">Cidade/Estado:</span> {{ $estagio->instituicaoEnsino->cidade }}/{{ $estagio->instituicaoEnsino->estado }}</p>
    @if($estagio->instituicaoEnsino->telefone)
    <p><span class="bold">Telefone:</span> {{ $estagio->instituicaoEnsino->telefone }}</p>
    @endif
    @if($estagio->instituicaoEnsino->email)
    <p><span class="bold">Email:</span> {{ $estagio->instituicaoEnsino->email }}</p>
    @endif
    @if($estagio->instituicaoEnsino->responsavel_legal_nome)
    <p><span class="bold">Responsável Legal:</span> {{ $estagio->instituicaoEnsino->responsavel_legal_nome }}
    @if($estagio->instituicaoEnsino->responsavel_legal_cpf), CPF: {{ $estagio->instituicaoEnsino->responsavel_legal_cpf }}@endif
    @if($estagio->instituicaoEnsino->responsavel_legal_rg), RG nº: {{ $estagio->instituicaoEnsino->responsavel_legal_rg }}@endif</p>
    @endif

    <p class="bold mb-1 mt-3">UNIDADE CONCEDENTE DE ESTÁGIO</p>
    <p><span class="bold">Razão Social:</span> {{ $estagio->empresaConcedente->razao_social }} <span class="linha"></span></p>
    @if($estagio->empresaConcedente->cnpj)
    <p><span class="bold">CNPJ:</span> {{ $estagio->empresaConcedente->cnpj }}</p>
    @endif
    @if($estagio->empresaConcedente->mantenedora)
    <p><span class="bold">Mantenedora:</span> {{ $estagio->empresaConcedente->mantenedora }}</p>
    @endif
    <p><span class="bold">Endereço:</span> {{ $estagio->empresaConcedente->endereco }}
    @if($estagio->empresaConcedente->complemento), {{ $estagio->empresaConcedente->complemento }}@endif
    @if($estagio->empresaConcedente->bairro) - {{ $estagio->empresaConcedente->bairro }}@endif
    @if($estagio->empresaConcedente->cep) - CEP: {{ $estagio->empresaConcedente->cep }}@endif</p>
    <p><span class="bold">Cidade/Estado:</span> {{ $estagio->empresaConcedente->cidade }}/{{ $estagio->empresaConcedente->estado }}</p>
    @if($estagio->empresaConcedente->telefone)
    <p><span class="bold">Telefone:</span> {{ $estagio->empresaConcedente->telefone }}</p>
    @endif
    @if($estagio->empresaConcedente->email)
    <p><span class="bold">Email:</span> {{ $estagio->empresaConcedente->email }}</p>
    @endif
    @if($estagio->empresaConcedente->responsavel_legal_nome)
    <p><span class="bold">Responsável Legal:</span> {{ $estagio->empresaConcedente->responsavel_legal_nome }}
    @if($estagio->empresaConcedente->responsavel_legal_cpf), CPF: {{ $estagio->empresaConcedente->responsavel_legal_cpf }}@endif
    @if($estagio->empresaConcedente->responsavel_legal_rg), RG nº: {{ $estagio->empresaConcedente->responsavel_legal_rg }}@endif</p>
    @endif

    <p class="bold mb-1 mt-3">ESTAGIÁRIO</p>
    <p><span class="bold">Nome:</span> {{ $estagio->estagiario->nome }}</p>
    <p><span class="bold">CPF:</span> {{ $estagio->estagiario->cpf }}
    @if($estagio->estagiario->rg), RG nº: {{ $estagio->estagiario->rg }}@endif</p>
    <p><span class="bold">Endereço:</span> {{ $estagio->estagiario->endereco }}
    @if($estagio->estagiario->complemento), {{ $estagio->estagiario->complemento }}@endif
    @if($estagio->estagiario->bairro) - {{ $estagio->estagiario->bairro }}@endif
    @if($estagio->estagiario->cep) - CEP: {{ $estagio->estagiario->cep }}@endif</p>
    <p><span class="bold">Cidade/Estado:</span> {{ $estagio->estagiario->cidade }}/{{ $estagio->estagiario->estado }}</p>
    @if($estagio->estagiario->telefone)
    <p><span class="bold">Telefone:</span> {{ $estagio->estagiario->telefone }}</p>
    @endif
    @if($estagio->estagiario->email)
    <p><span class="bold">Email:</span> {{ $estagio->estagiario->email }}</p>
    @endif
    <p><span class="bold">Curso:</span> {{ $estagio->estagiario->curso }}
    @if($estagio->estagiario->semestre_atual || $estagio->estagiario->periodo), {{ $estagio->estagiario->semestre_atual ?? $estagio->estagiario->periodo }}º período/série @endif
    @if($estagio->estagiario->matricula), Matrícula nº: {{ $estagio->estagiario->matricula }}@endif</p>
    <p><span class="bold">Período:</span> {{ $estagio->data_inicio->format('d/m/Y') }} a {{ $estagio->data_fim->format('d/m/Y') }}</p>

    <p class="bold mb-1 mt-3">AGENTE DE INTEGRAÇÃO - ALENCASTRO CONSULTORIA</p>
    <p><span class="bold">Razão Social:</span> DIOGO LUÍS ALENCASTRO DA SILVA-ME <span class="linha-curta"></span> <span class="bold">CNPJ:</span> 18.785.582/0001-24</p>
    <p><span class="bold">Endereço:</span> Av. Mauro Ramos, 1722 Aptº 92 - Centro - CEP: 88020-304</p>
    <p><span class="bold">Cidade/Estado:</span> Florianópolis/SC</p>
    <p><span class="bold">Contato:</span> (48) 99111-8686 | diogo@alencastroconsultoria.com.br</p>
    <p><span class="bold">Responsável:</span> Diogo Luís Alencastro da Silva</p>

    <p class="mb-2 mt-2">Conforme as cláusulas e condições seguintes:</p>

    <p class="bold">CLÁUSULA PRIMEIRA:</p>
    <p class="text-justify">A UNIDADE CONCEDENTE, neste ato, admite o(a) ESTAGIÁRIO(A) acima qualificado(a), observando as cláusulas do Termo de Convênio firmado com o AGENTE DE INTEGRAÇÃO, a legislação vigente (Lei nº 11.788/2008) e demais disposições estabelecidas pela INSTITUIÇÃO DE ENSINO.</p>

    <p class="bold mt-2">CLÁUSULA SEGUNDA:</p>
    <p class="text-justify">O estágio de estudantes da INSTITUIÇÃO DE ENSINO junto à UNIDADE CONCEDENTE, de caráter obrigatório ou não, deve propiciar a complementação do ensino e da aprendizagem profissional.</p>
    <p class="mt-2"><span class="bold">PARÁGRAFO PRIMEIRO:</span> O(A) ESTAGIÁRIO(A) desenvolverá as seguintes atividades:</p>
    <p>{{ $estagio->atividades ?? 'Atividades compatíveis com a área de formação do curso.' }}</p>
    <p class="mt-2"><span class="bold">PARÁGRAFO SEGUNDO:</span> A INSTITUIÇÃO DE ENSINO declara que as atividades são compatíveis com a programação curricular do curso de {{ $estagio->estagiario->curso }}.</p>

    <p class="bold mt-2">CLÁUSULA TERCEIRA:</p>
    @if($estagio->empresaConcedente->supervisor_estagio_nome)
    <p>Supervisor de Estágio: {{ $estagio->empresaConcedente->supervisor_estagio_nome }}@if($estagio->empresaConcedente->supervisor_estagio_cargo), {{ $estagio->empresaConcedente->supervisor_estagio_cargo }}@endif.</p>
    @else
    <p>Supervisor de Estágio: A definir.</p>
    @endif

    <p class="bold mt-2">CLÁUSULA QUARTA:</p>
    <p>Duração: {{ $estagio->data_inicio->diffInMonths($estagio->data_fim) }} meses ({{ $estagio->data_inicio->format('d/m/Y') }} a {{ $estagio->data_fim->format('d/m/Y') }}).</p>
    <p><span class="bold">PARÁGRAFO ÚNICO:</span> O período total não poderá exceder 24 meses, conforme Art. 11 da Lei nº 11.788/2008.</p>

    <p class="bold mt-2">CLÁUSULA QUINTA:</p>
    <p>Jornada: {{ $estagio->carga_horaria_semanal }} horas semanais, de segunda a sexta-feira.</p>
    @if($estagio->horario_inicio)
    <p>Horário: {{ $estagio->horario_inicio }}@if(isset($estagio->horario_inicio_minuto)):{{ $estagio->horario_inicio_minuto }}@endif às {{ $estagio->horario_fim ?? '' }}@if(isset($estagio->horario_fim_minuto)):{{ $estagio->horario_fim_minuto }}@endif.</p>
    @endif

    <p class="bold mt-2">CLÁUSULA SEXTA:</p>
    <p>Bolsa-Auxílio: R$ {{ number_format($estagio->valor_bolsa ?? 0, 2, ',', '.') }} mensais.</p>
    @if($estagio->valor_auxilio_transporte > 0)
    <p>Auxílio Transporte: R$ {{ number_format($estagio->valor_auxilio_transporte, 2, ',', '.') }} mensais.</p>
    @endif
    <p>Recesso: 30 dias quando estágio ≥ 1 ano, caso contrário proporcional.</p>

    <p class="bold mt-2">CLÁUSULA SÉTIMA:</p>
    @if($estagio->seguradora)
    <p>Seguro: {{ $estagio->seguradora->nome }}, Apólice nº {{ $estagio->apolice_numero ?? $estagio->seguradora->apolice_numero }}.</p>
    @else
    <p>Seguro: A contratar pela Unidade Concedente.</p>
    @endif

    <p class="bold mt-2">CLÁUSULA OITAVA:</p>
    <p>São obrigações da UNIDADE CONCEDENTE: elaborar programa de estágio, oferecer instalações adequadas, indicar supervisor, fornecer relatórios, aplicar legislação de saúde e segurança do trabalho.</p>

    <p class="bold mt-2">CLÁUSULA NONA:</p>
    <p>São obrigações do(a) ESTAGIÁRIO(A): cumprir programação, conhecer normas da empresa, elaborar relatórios, comunicar casos de trancamento/desistência.</p>

    <p class="bold mt-2">CLÁUSULA DÉCIMA:</p>
    <p>O TCE será encerrado: a) ao término do prazo; b) por aviso prévio de 7 dias; c) por rendimento insatisfatório; d) ao término do curso; e) por descumprimento de cláusulas.</p>

    <p class="bold mt-2">CLÁUSULA DÉCIMA PRIMEIRA:</p>
    <p>Este instrumento não gera vínculo empregatício, nos termos do Art. 3º da Lei nº 11.788/2008.</p>

    <p class="mt-3">E, por estarem justos e contratados, assinam o presente instrumento.</p>

    <p class="mt-2 text-right">{{ $estagio->empresaConcedente->cidade ?? 'Cidade' }}, {{ now()->format('d') }} de {{ now()->translatedFormat('F') }} de {{ now()->format('Y') }}.</p>

    <div class="assinatura">
        <p class="underline mb-1">&nbsp;</p>
        <p><span class="bold">Unidade Concedente</span></p>
        <p>{{ $estagio->empresaConcedente->razao_social }}</p>
    </div>

    <div class="assinatura">
        <p class="underline mb-1">&nbsp;</p>
        <p><span class="bold">Instituição de Ensino</span></p>
        <p>{{ $estagio->instituicaoEnsino->razao_social }}</p>
    </div>

    <div class="clear"></div>

    <div class="assinatura-centro mt-3">
        <p class="underline mb-1">&nbsp;</p>
        <p><span class="bold">Estagiário(a)</span></p>
        <p>{{ $estagio->estagiario->nome }}</p>
    </div>

    <div class="assinatura-centro mt-3">
        <p class="underline mb-1">&nbsp;</p>
        <p><span class="bold">ALENCASTRO CONSULTORIA</span></p>
        <p>Agente de Integração</p>
        <p>Diogo Luís Alencastro da Silva</p>
    </div>
</body>
</html>