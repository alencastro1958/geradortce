<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Compromisso de Estágio - TCE</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 10pt; line-height: 1.4; padding: 15px; max-width: 800px; margin: 0 auto; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-justify { text-align: justify; }
        .bold { font-weight: bold; }
        .mb-1 { margin-bottom: 8px; }
        .mb-2 { margin-bottom: 12px; }
        .mb-3 { margin-bottom: 15px; }
        .mt-2 { margin-top: 12px; }
        .mt-3 { margin-top: 15px; }
        p { margin-bottom: 5px; }
        .linha { border-bottom: 1px solid #000; display: inline-block; min-width: 200px; }
        .linha-curta { border-bottom: 1px solid #000; display: inline-block; min-width: 100px; }
        .assinatura { width: 45%; float: left; text-align: center; margin-top: 25px; }
        .assinatura-centro { width: 100%; text-align: center; margin-top: 25px; }
        .clear { clear: both; }
        .uppercase { text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="text-center mb-2">
        <img src="{{ asset('images/alencastro-estagios.png') }}" alt="Alencastro Estágios" style="max-width: 200px; max-height: 80px;">
        <p style="font-size: 9pt;">www.alencastroestagios.com.br | diogo@alencastroestagios.com.br</p>
    </div>

    <div class="text-center mb-2">
        <p class="bold uppercase" style="font-size: 12pt;">TERMO DE COMPROMISSO DE ESTÁGIO - TCE</p>
        <p style="font-size: 8pt;">(De acordo com o disposto da lei n.º 6.494/77 e no respective decreto de regulamentação n.º 87.497/82)</p>
        <p style="font-size: 8pt;">(Condições de Realização de Estágio)</p>
    </div>

    <p class="mb-1 text-justify">TERMO DE COMPROMISSO DE ESTÁGIO, instrumento jurídico cujo objetivo é formalizar as condições para realização de estágio, definido como ato educativo escolar supervisionado, desenvolvido no ambiente de trabalho, que visa a preparação para o trabalho produtivo do estudante, nos termos da Lei nº 11.788, de 25/09/2008, (Publicada no D.O.U. de 26.09.2008) que entre si celebram as partes a seguir nomeadas:</p>

    <p class="bold mb-1 mt-2">INSTITUIÇÃO DE ENSINO</p>
    <p><span class="bold">Razão Social:</span> {{ $estagio->instituicaoEnsino->razao_social }} <span class="linha"></span> <span class="bold">CNPJ:</span> {{ $estagio->instituicaoEnsino->cnpj }}</p>
    @if($estagio->instituicaoEnsino->mantenedora)
    <p><span class="bold">Mantenedora:</span> {{ $estagio->instituicaoEnsino->mantenedora }}</p>
    @endif
    <p><span class="bold">Endereço:</span> {{ $estagio->instituicaoEnsino->endereco }}
    @if($estagio->instituicaoEnsino->complemento), {{ $estagio->instituicaoEnsino->complemento }}@endif - {{ $estagio->instituicaoEnsino->bairro }} - CEP: {{ $estagio->instituicaoEnsino->cep }}</p>
    <p><span class="bold">Cidade:</span> {{ $estagio->instituicaoEnsino->cidade }} <span class="linha-curta"></span> <span class="bold">Estado:</span> {{ $estagio->instituicaoEnsino->estado }}</p>
    <p><span class="bold">Telefone:</span> {{ $estagio->instituicaoEnsino->telefone }} <span class="linha-curta"></span> <span class="bold">Email:</span> {{ $estagio->instituicaoEnsino->email }}</p>
    <p><span class="bold">Responsável Legal:</span> {{ $estagio->instituicaoEnsino->responsavel_legal_nome }} <span class="linha-curta"></span> <span class="bold">CPF:</span> {{ $estagio->instituicaoEnsino->responsavel_legal_cpf }}</p>
    @if($estagio->instituicaoEnsino->responsavel_legal_rg)
    <p><span class="bold">RG nº:</span> {{ $estagio->instituicaoEnsino->responsavel_legal_rg }}</p>
    @endif

    <p class="bold mb-1 mt-3">UNIDADE CONCEDENTE DE ESTÁGIO</p>
    <p><span class="bold">Razão Social:</span> {{ $estagio->empresaConcedente->razao_social }} <span class="linha"></span> <span class="bold">CNPJ:</span> {{ $estagio->empresaConcedente->cnpj }}</p>
    @if($estagio->empresaConcedente->mantenedora)
    <p><span class="bold">Mantenedora:</span> {{ $estagio->empresaConcedente->mantenedora }}</p>
    @endif
    <p><span class="bold">Endereço:</span> {{ $estagio->empresaConcedente->endereco }}
    @if($estagio->empresaConcedente->complemento), {{ $estagio->empresaConcedente->complemento }}@endif - {{ $estagio->empresaConcedente->bairro }} - CEP: {{ $estagio->empresaConcedente->cep }}</p>
    <p><span class="bold">Cidade:</span> {{ $estagio->empresaConcedente->cidade }} <span class="linha-curta"></span> <span class="bold">Estado:</span> {{ $estagio->empresaConcedente->estado }}</p>
    <p><span class="bold">Telefone:</span> {{ $estagio->empresaConcedente->telefone }} <span class="linha-curta"></span> <span class="bold">Email:</span> {{ $estagio->empresaConcedente->email }}</p>
    <p><span class="bold">Responsável Legal:</span> {{ $estagio->empresaConcedente->responsavel_legal_nome }} <span class="linha-curta"></span> <span class="bold">CPF:</span> {{ $estagio->empresaConcedente->responsavel_legal_cpf }}</p>
    @if($estagio->empresaConcedente->responsavel_legal_rg)
    <p><span class="bold">RG nº:</span> {{ $estagio->empresaConcedente->responsavel_legal_rg }}</p>
    @endif

    <p class="bold mb-1 mt-3">ESTAGIÁRIO</p>
    <p><span class="bold">Nome:</span> {{ $estagio->estagiario->nome }} <span class="linha"></span> <span class="bold">CPF:</span> {{ $estagio->estagiario->cpf }}
    @if($estagio->estagiario->rg) <span class="bold">RG nº:</span> {{ $estagio->estagiario->rg }}@endif</p>
    <p><span class="bold">Endereço:</span> {{ $estagio->estagiario->endereco }}
    @if($estagio->estagiario->complemento), {{ $estagio->estagiario->complemento }}@endif - {{ $estagio->estagiario->bairro }} - CEP: {{ $estagio->estagiario->cep }}</p>
    <p><span class="bold">Cidade:</span> {{ $estagio->estagiario->cidade }} <span class="linha-curta"></span> <span class="bold">Estado:</span> {{ $estagio->estagiario->estado }}</p>
    <p><span class="bold">Telefone:</span> {{ $estagio->estagiario->telefone }} <span class="linha-curta"></span> <span class="bold">Email:</span> {{ $estagio->estagiario->email }}</p>
    <p><span class="bold">Curso:</span> {{ $estagio->estagiario->curso }} <span class="linha-curta"></span> <span class="bold">Semestre/Período/Série:</span> {{ $estagio->estagiario->semestre_atual ?? $estagio->estagiario->periodo ?? '___' }} <span class="linha-curta"></span> <span class="bold">Matrícula nº:</span> {{ $estagio->estagiario->matricula ?? '___' }}</p>
    <p><span class="bold">Data de Início:</span> {{ $estagio->data_inicio->format('d/m/Y') }} <span class="linha-curta"></span> <span class="bold">Data de Conclusão:</span> {{ $estagio->data_fim->format('d/m/Y') }}</p>

    <p class="bold mb-1 mt-3">AGENTE DE INTEGRAÇÃO - ALENCASTRO CONSULTORIA</p>
    <p><span class="bold">Razão Social:</span> DIOGO LUÍS ALENCASTRO DA SILVA-ME <span class="linha-curta"></span> <span class="bold">CNPJ:</span> 18.785.582/0001-24</p>
    <p><img src="{{ asset('images/logo-pequena.png') }}" alt="Alencastro" style="max-height: 30px; vertical-align: middle;"></p>
    <p><span class="bold">Endereço:</span> Av. Mauro Ramos, 1722 Aptº 92 - Bloco 08 <span class="linha-curta"></span> <span class="bold">Bairro:</span> Centro <span class="linha-curta"></span> <span class="bold">CEP:</span> 88020-304</p>
    <p><span class="bold">Cidade:</span> Florianópolis <span class="linha-curta"></span> <span class="bold">Estado:</span> Santa Catarina</p>
    <p><span class="bold">Telefone:</span> (48) 99111-8686 <span class="linha-curta"></span> <span class="bold">Email:</span> diogo@alencastroconsultoria.com.br</p>
    <p><span class="bold">Responsável Legal:</span> Diogo Luís Alencastro da Silva</p>

    <p class="mb-2 mt-2">Conforme as cláusulas e condições seguintes:</p>

    <p class="bold">CLÁUSULA PRIMEIRA:</p>
    <p class="text-justify">A UNIDADE CONCEDENTE, neste ato, admite o(a) ESTAGIÁRIO(A) acima qualificado(a), observando as cláusulas do Termo de Convênio firmado com o AGENTE DE INTEGRAÇÃO, a legislação vigente (Lei nº 11.788/2008) e demais disposições estabelecidas pela INSTITUIÇÃO DE ENSINO.</p>

    <p class="bold mt-2">CLÁUSULA SEGUNDA:</p>
    <p class="text-justify">O estágio de estudantes da INSTITUIÇÃO DE ENSINO junto à UNIDADE CONCEDENTE, de caráter obrigatório ou não, deve propiciar a complementação do ensino e da aprendizagem profissional, especialmente na(s) área(s) do(s) respective(s) curso(s), visando à experiência prática complementar, em consonância com o currículo e horários escolares, conforme art. 1º da Lei nº 11.788/2008.</p>
    <p class="mt-2"><span class="bold">PARÁGRAFO PRIMEIRO:</span> O(A) ESTAGIÁRIO(A) desenvolverá as seguintes atividades, com foco pedagógico e educacional: O propósito do estágio é proporcionar à discente sua inserção na área de: {{ $estagio->estagiario->curso }}</p>
    <p>Descrição das atividades: {{ $estagio->atividades ?? 'À combinar com o supervisor de estágio' }}</p>
    <p class="mt-2"><span class="bold">PARÁGRAFO SEGUNDO:</span> A INSTITUIÇÃO DE ENSINO declara que as atividades acima relacionadas são compatíveis com a programação curricular do curso de {{ $estagio->estagiario->curso }}, para o qual há previsão de estágio curricular.</p>

    <p class="bold mt-2">CLÁUSULA TERCEIRA:</p>
    <p>Atuará como Supervisora de Estágio na Unidade Concedente: {{ $estagio->empresaConcedente->supervisor_estagio_nome ?? '___' }}, {{ $estagio->empresaConcedente->supervisor_estagio_cargo ?? 'Cargo' }}, {{ $estagio->empresaConcedente->supervisor_estagio_formacao ?? 'formação' }}, CPF: {{ $estagio->empresaConcedente->supervisor_estagio_cpf ?? '___' }}, e-mail: {{ $estagio->empresaConcedente->supervisor_estagio_email ?? '___' }}, telefone: {{ $estagio->empresaConcedente->supervisor_estagio_telefone ?? '___' }}.</p>

    <p class="bold mt-2">CLÁUSULA QUARTA:</p>
    <p>A duração do estágio será de {{ $estagio->data_inicio->diffInMonths($estagio->data_fim) }} ({{ $estagio->data_inicio->diffInMonths($estagio->data_fim) }}) meses, com início em {{ $estagio->data_inicio->format('d/m/Y') }} e término previsto em {{ $estagio->data_fim->format('d/m/Y') }}.</p>
    <p><span class="bold">PARÁGRAFO ÚNICO:</span> O período total do estágio não poderá exceder 24 (vinte e quatro) meses na mesma Unidade Concedente, nos termos do Art. 11 da Lei nº 11.788/2008.</p>

    <p class="bold mt-2">CLÁUSULA QUINTA:</p>
    <p>O estágio terá jornada de até {{ $estagio->carga_horaria_semanal }} ({{ $estagio->carga_horaria_semanal }}) horas semanais, de segunda a sexta-feira, no horário das {{ $estagio->horario_inicio ?? '08' }}h{{ $estagio->horario_inicio_minuto ?? '00' }} às {{ $estagio->horario_fim ?? '14' }}h{{ $estagio->horario_fim_minuto ?? '00' }}, compreendendo {{ $estagio->carga_horaria_semanal / 5 }} horas diárias.</p>
    <p><span class="bold">Parágrafo Único:</span> Nos períodos de avaliação de aprendizagem da Instituição de Ensino, comprovados mediante calendário acadêmico, a carga horária será reduzida à metade, conforme determina o § 1º do Art. 10 da Lei nº 11.788/2008.</p>

    <p class="bold mt-2">CLÁUSULA SEXTA:</p>
    <p>A UNIDADE CONCEDENTE pagará mensalmente, diretamente à ESTAGIÁRIA, a importância de R$ {{ number_format($estagio->valor_bolsa ?? 0, 2, ',', '.') }} ({{ $estagio->valor_bolsa ? number_format($estagio->valor_bolsa, 2, ',', '.') : '___' }} reais) a título de Bolsa-Auxílio. Este pagamento será efetuado até o quinto dia útil subsequente ao fechamento da folha de frequência da estagiária.</p>
    <p><span class="bold">PARÁGRAFO PRIMEIRO:</span> O pagamento da Bolsa-Auxílio será proporcional à frequência da estudante. Ressalta-se que a bolsa de estágio goza de isenção de Imposto de Renda, conforme legislação vigente. Eventuais complementações de valor ficam a critério da UNIDADE CONCEDENTE.</p>
    <p><span class="bold">PARÁGRAFO SEGUNDO:</span> A UNIDADE CONCEDENTE oferecerá ao(à) estagiário(a) auxílio transporte no valor mensal de R$ {{ number_format($estagio->valor_auxilio_transporte ?? 0, 2, ',', '.') }} ({{ $estagio->valor_auxilio_transporte ? number_format($estagio->valor_auxilio_transporte, 2, ',', '.') : '___' }} reais e centavos (se houver)) ou o equivalente ao deslocamento real, conforme opção da concedente.</p>
    <p><span class="bold">PARÁGRAFO TERCEIRO:</span> O(A) estagiário(a) fará jus a um recesso remunerado de 30 (trinta) dias, a ser usufruído preferencialmente durante suas férias escolares, caso o estágio tenha duração igual ou superior a um ano. Caso a duração seja inferior a um ano, o recesso será concedido de forma proporcional. Durante o período de recesso, a percepção da bolsa-auxílio será mantida integralmente.</p>

    <p class="bold mt-2">CLÁUSULA SÉTIMA:</p>
    <p>No período de vigência do presente TCE, o(a) ESTAGIÁRIO(A) terá cobertura de Seguro de Acidentes Pessoais, contratado pela Unidade Concedente junto à Seguradora {{ $estagio->seguradora->nome ?? '___' }}, Apólice nº {{ $estagio->apolice_numero ?? $estagio->seguradora->apolice_numero ?? '___' }} ({{ $estagio->seguradora->cnpj ?? '___' }}), com capital segurado de R$ {{ number_format($estagio->seguradora->capital_segurado ?? $estagio->seguradora->valor_cobertura ?? 0, 2, ',', '.') }}, para Morte Acidental ou Invalidez Permanente Total ou Parcial por Acidente, nos termos do Inciso IV do Art. 9º da Lei nº 11.788/2008.</p>

    <p class="bold mt-2">CLÁUSULA OITAVA:</p>
    <p>São obrigações da UNIDADE CONCEDENTE: a) Elaborar programa de estágio compatível com o currículo escolar; b) Ofertar instalações adequadas para atividades de aprendizagem social, profissional e cultural; c) Indicar funcionário de seu quadro de pessoal, com formação ou experiência profissional na área de conhecimento do curso da estagiária, para orientar e supervisionar até 10 (dez) estagiários simultaneamente; d) Fornecer subsídios à INSTITUIÇÃO DE ENSINO para acompanhamento, coordenação e avaliação do estágio; e) Elaborar relatório de estágio semestralmente, disponibilizado pelo AGENTE DE INTEGRAÇÃO, nos prazos e padrões estabelecidos; f) Entregar, por ocasião do desligamento, termo de realização de estágio com indicação resumida das atividades, períodos e avaliação de desempenho; g) Reduzir a carga horária do estágio à metade nos períodos de avaliação de aprendizagem da Instituição de Ensino; h) Conceder recesso conforme disposto na Cláusula Sexta, Parágrafo Terceiro; i) Aplicar ao(à) estagiário(a) a legislação de saúde e segurança do trabalho; j) Informar todas as normas de Segurança do Trabalho, fornecendo EPIs/EPCs quando necessário, vedando a exposição a riscos sem a devida proteção.</p>

    <p class="bold mt-2">CLÁUSULA NONA:</p>
    <p>O(A) ESTAGIÁRIO(A) obriga-se a: a) Cumprir com empenho a programação de estágio; b) Conhecer e cumprir as normas da UNIDADE CONCEDENTE, salvaguardando o sigilo de informações; c) Elaborar relatório de estágio semestralmente, conforme modelo do AGENTE DE INTEGRAÇÃO, obtendo a assinatura do supervisor e entregando-o nos canais indicados; d) Comunicar imediatamente ao AGENTE DE INTEGRAÇÃO e à UNIDADE CONCEDENTE casos de trancamento de matrícula, desistência, reprovação ou transferência institucional; e) Cumprir as normas de Segurança do Trabalho, utilizando os equipamentos de proteção individual/coletiva fornecidos.</p>

    <p class="bold mt-2">CLÁUSULA DÉCIMA:</p>
    <p>O presente TERMO DE COMPROMISSO DE ESTÁGIO será encerrado: a) Automaticamente ao término do prazo estipulado; b) Por livre manifestação de vontade da UNIDADE CONCEDENTE ou do(a) ESTAGIÁRIO(A), mediante aviso prévio por escrito de, no mínimo, 7 (sete) dias; c) Mediante comprovação de rendimento insatisfatório ou descumprimento das normas disciplinares; d) Ao término do curso, mediante comunicação formal da data de colação de grau/formatura pelo(a) estudante; e) Por descumprimento das cláusulas deste instrumento ou da legislação pertinente.</p>

    <p class="bold mt-2">CLÁUSULA DÉCIMA PRIMEIRA:</p>
    <p>O presente instrumento celebra-se nos termos do Art. 3º da Lei nº 11.788/2008. Fica expressamente declarado que a relação jurídica aqui estabelecida não gera vínculo empregatício de qualquer natureza, mesmo sendo onerosa, constituindo-se este documento como prova da inexistência de tal vínculo.</p>

    <p class="mt-3">E, por estarem justos e contratados, as partes assinam o presente instrumento em vias de igual teor e forma.</p>

    <p class="mt-3 text-right">{{ $estagio->empresaConcedente->cidade ?? 'Cidade' }}, {{ now()->format('d') }} de {{ now()->translatedFormat('F') }} de {{ now()->format('Y') }}.</p>

    <div class="assinatura">
        <p class="underline mb-1">&nbsp;</p>
        <p><span class="bold">Unidade Concedente de Estágio</span></p>
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
        <p><span class="bold">ALENCASTRO CONSULTORIA-ESTÁGIOS</span></p>
        <p>Agente de Integração</p>
        <p>Diogo Luís Alencastro da Silva</p>
        <p>diogo@alencastroestagios.com.br</p>
    </div>
</body>
</html>