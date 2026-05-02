<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Compromisso de Estágio - TCE</title>
    <style>
        @page {
            size: A4;
            margin-top: 4.0cm;
            margin-right: 1.5cm;
            margin-bottom: 1.0cm;
            margin-left: 2.5cm;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            text-align: justify;
            padding-top: 0;
            padding-bottom: 1.0cm;
        }
        p {
            margin-bottom: 4px;
            text-align: justify;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .mb-0 { margin-bottom: 0; }
        .mb-1 { margin-bottom: 6px; }
        .mb-2 { margin-bottom: 10px; }
        .mb-3 { margin-bottom: 15px; }
        .mt-1 { margin-top: 6px; }
        .mt-2 { margin-top: 10px; }
        .mt-3 { margin-top: 15px; }
        .linha { border-bottom: 1px solid #000; display: inline-block; min-width: 180px; }
        .linha-curta { border-bottom: 1px solid #000; display: inline-block; min-width: 80px; }
        .linha-media { border-bottom: 1px solid #000; display: inline-block; min-width: 120px; }
        .assinatura { width: 45%; float: left; text-align: center; margin-top: 30px; }
        .assinatura-centro { width: 100%; text-align: center; margin-top: 30px; }
        .clear { clear: both; }
        .uppercase { text-transform: uppercase; }
        .page-header {
            position: fixed;
            top: -2.5cm;
            left: 2.5cm;
            right: 1.5cm;
            height: 3.0cm;
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
        .assinaturas-stack {
            text-align: center;
        }
        .assinaturas-stack p {
            text-align: center;
        }
        .assinaturas-stack .assinatura-centro {
            margin-top: 12px;
        }
        .assinaturas-stack .assinatura-centro p {
            margin-bottom: 2px;
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

    <div class="text-center mb-2" style="width: 100%;">
        <p class="bold uppercase mt-1 text-center">Termo de Compromisso de Estágio - TCE</p>
        <p class="mt-1 text-center">(De acordo com o disposto da lei n.º 6.494/77 e no respective decreto de regulamentação n.º 87.497/82)</p>
    </div>

    <p class="text-justify mb-2">TERMO DE COMPROMISSO DE ESTÁGIO, instrumento jurídico cujo objetivo é formalizar as condições para realização de estágio, definido como ato educativo escolar supervisionado, desenvolvido no ambiente de trabalho, que visa a preparação para o trabalho produtivo do estudante, nos termos da Lei nº 11.788, de 25/09/2008, (Publicada no D.O.U. de 26.09.2008) que entre si celebram as partes a seguir nomeadas:</p>
    <p class="mb-2"></p>

    @php
        $instituicao = $estagio->instituicaoEnsino;
        $empresa = $estagio->empresaConcedente;
        $estagiario = $estagio->estagiario;
        $semestre = $estagiario?->semestre_atual ?? $estagiario?->periodo;
    @endphp

    <p class="bold mt-2 mb-1">INSTITUIÇÃO DE ENSINO</p>
    @if($instituicao?->razao_social || $instituicao?->cnpj)
        <p><span class="bold">Razão Social:</span> {{ $instituicao->razao_social }} @if($instituicao?->cnpj)<span class="bold">CNPJ:</span> {{ $instituicao->cnpj }}@endif</p>
    @endif
    @if($instituicao?->mantenedora)
        <p><span class="bold">Mantenedora:</span> {{ $instituicao->mantenedora }}</p>
    @endif
    @if($instituicao?->endereco || $instituicao?->complemento || $instituicao?->bairro)
        <p>
            @if($instituicao?->endereco)<span class="bold">Endereço:</span> {{ $instituicao->endereco }}@endif
            @if($instituicao?->complemento) <span class="bold">Complemento:</span> {{ $instituicao->complemento }}@endif
            @if($instituicao?->bairro) <span class="bold">Bairro:</span> {{ $instituicao->bairro }}@endif
        </p>
    @endif
    @if($instituicao?->cidade || $instituicao?->estado || $instituicao?->cep)
        <p>
            @if($instituicao?->cidade)<span class="bold">Cidade:</span> {{ $instituicao->cidade }}@endif
            @if($instituicao?->estado) <span class="bold">Estado:</span> {{ $instituicao->estado }}@endif
            @if($instituicao?->cep) <span class="bold">CEP:</span> {{ $instituicao->cep }}@endif
        </p>
    @endif
    @if($instituicao?->telefone || $instituicao?->email)
        <p>
            @if($instituicao?->telefone)<span class="bold">Telefone:</span> {{ $instituicao->telefone }}@endif
            @if($instituicao?->email) <span class="bold">Email:</span> {{ $instituicao->email }}@endif
        </p>
    @endif
    <p class="mb-2"></p>
    @if($instituicao?->responsavel_legal)
        <p><span class="bold">Responsável Legal:</span> {{ $instituicao->responsavel_legal }}</p>
    @endif

    <p class="bold mt-2 mb-1">UNIDADE CONCEDENTE DE ESTÁGIO</p>
    @if($empresa?->razao_social || $empresa?->cnpj)
        <p><span class="bold">Razão Social:</span> {{ $empresa->razao_social }} @if($empresa?->cnpj)<span class="bold">CNPJ:</span> {{ $empresa->cnpj }}@endif</p>
    @endif
    @if($empresa?->endereco || $empresa?->complemento || $empresa?->bairro)
        <p>
            @if($empresa?->endereco)<span class="bold">Endereço:</span> {{ $empresa->endereco }}@endif
            @if($empresa?->complemento) <span class="bold">Complemento:</span> {{ $empresa->complemento }}@endif
            @if($empresa?->bairro) <span class="bold">Bairro:</span> {{ $empresa->bairro }}@endif
        </p>
    @endif
    @if($empresa?->cidade || $empresa?->estado || $empresa?->cep)
        <p>
            @if($empresa?->cidade)<span class="bold">Cidade:</span> {{ $empresa->cidade }}@endif
            @if($empresa?->estado) <span class="bold">Estado:</span> {{ $empresa->estado }}@endif
            @if($empresa?->cep) <span class="bold">CEP:</span> {{ $empresa->cep }}@endif
        </p>
    @endif
    @if($empresa?->telefone || $empresa?->email)
        <p>
            @if($empresa?->telefone)<span class="bold">Telefone:</span> {{ $empresa->telefone }}@endif
            @if($empresa?->email) <span class="bold">Email:</span> {{ $empresa->email }}@endif
        </p>
    @endif
    <p class="mb-2"></p>
    @if($empresa?->responsavel_legal)
        <p><span class="bold">Responsável Legal:</span> {{ $empresa->responsavel_legal }}</p>
    @endif

    <p class="bold mt-2 mb-1">ESTAGIÁRIO(A)</p>
    @if($estagiario?->nome || $estagiario?->cpf || $estagiario?->rg)
        <p>
            @if($estagiario?->nome)<span class="bold">Nome:</span> {{ $estagiario->nome }}@endif
            @if($estagiario?->cpf) <span class="bold">CPF:</span> {{ $estagiario->cpf }}@endif
            @if($estagiario?->rg) <span class="bold">RG nº:</span> {{ $estagiario->rg }}@endif
        </p>
    @endif
    @if($estagiario?->endereco || $estagiario?->complemento || $estagiario?->bairro)
        <p>
            @if($estagiario?->endereco)<span class="bold">Endereço:</span> {{ $estagiario->endereco }}@endif
            @if($estagiario?->complemento) <span class="bold">Complemento:</span> {{ $estagiario->complemento }}@endif
            @if($estagiario?->bairro) <span class="bold">Bairro:</span> {{ $estagiario->bairro }}@endif
        </p>
    @endif
    @if($estagiario?->cidade || $estagiario?->estado || $estagiario?->cep)
        <p>
            @if($estagiario?->cidade)<span class="bold">Cidade:</span> {{ $estagiario->cidade }}@endif
            @if($estagiario?->estado) <span class="bold">Estado:</span> {{ $estagiario->estado }}@endif
            @if($estagiario?->cep) <span class="bold">CEP:</span> {{ $estagiario->cep }}@endif
        </p>
    @endif
    @if($estagiario?->telefone || $estagiario?->email)
        <p>
            @if($estagiario?->telefone)<span class="bold">Telefone:</span> {{ $estagiario->telefone }}@endif
            @if($estagiario?->email) <span class="bold">Email:</span> {{ $estagiario->email }}@endif
        </p>
    @endif
    @if($estagiario?->curso || $semestre || $estagiario?->matricula)
        <p>
            @if($estagiario?->curso)<span class="bold">Curso:</span> {{ $estagiario->curso }}@endif
            @if($semestre) <span class="bold">Semestre/Período/Série:</span> {{ $semestre }}@endif
            @if($estagiario?->matricula) <span class="bold">Matrícula nº:</span> {{ $estagiario->matricula }}@endif
        </p>
    @endif
    @if($estagio->data_inicio || $estagio->data_fim)
        <p>
            @if($estagio->data_inicio)<span class="bold">Data de Início:</span> {{ $estagio->data_inicio->format('d/m/Y') }}@endif
            @if($estagio->data_fim) <span class="bold">Data de Conclusão:</span> {{ $estagio->data_fim->format('d/m/Y') }}@endif
        </p>
    @endif
    <p class="mb-2"></p>

    <p class="bold mt-2 mb-1">AGENTE DE INTEGRAÇÃO - ALENCASTRO CONSULTORIA</p>
    <p><span class="bold">Razão Social:</span> DIOGO LUÍS ALENCASTRO DA SILVA-ME <span class="bold">CNPJ:</span> 18.785.582/0001-24</p>
    <p><span class="bold">Endereço:</span> Av. Mauro Ramos, 1722 Aptº 92 - Bloco 08 <span class="bold">Bairro:</span> Centro</p>
    <p><span class="bold">Cidade:</span> Florianópolis <span class="bold">Estado:</span> Santa Catarina <span class="bold">CEP:</span> 88020-304</p>
    <p><span class="bold">Telefone:</span> (48) 99203-9611 <span class="bold">Email:</span> admin@rotacerta-aprendizagem.com.br</p>
    <p><span class="bold">Responsável Legal:</span> Diogo Luís Alencastro da Silva</p>

    <p class="mb-2 mt-2">Conforme as cláusulas e condições seguintes:</p>
    <p class="mb-2"></p>

    <p class="bold">CLÁUSULA PRIMEIRA:</p>
    <p>A UNIDADE CONCEDENTE, neste ato, admite o(a) ESTAGIÁRIO(A) acima qualificado(a), observando as cláusulas do Termo de Convênio firmado com o AGENTE DE INTEGRAÇÃO, a legislação vigente (Lei nº 11.788/2008) e demais disposições estabelecidas pela INSTITUIÇÃO DE ENSINO.</p>

    <p class="bold mt-2">CLÁUSULA SEGUNDA:</p>
    <p>O estágio de estudantes da INSTITUIÇÃO DE ENSINO junto à UNIDADE CONCEDENTE, de caráter obrigatório ou não, deve propiciar a complementação do ensino e da aprendizagem profissional, especialmente na(s) área(s) do(s) respective(s) curso(s), visando à experiência prática complementar, em consonância com o currículo e horários escolares, conforme art. 1º da Lei nº 11.788/2008.</p>
    <p class="mt-2"><span class="bold">PARÁGRAFO PRIMEIRO:</span> O(A) ESTAGIÁRIO(A) desenvolverá as seguintes atividades, com foco pedagógico e educacional: O propósito do estágio é proporcionar à discente sua inserção na área de: {{ $estagio->estagiario->curso }}</p>
    @if($estagio->atividades)
        <p>Descrição das atividades: {{ $estagio->atividades }}</p>
    @endif
    <p class="mt-2"><span class="bold">PARÁGRAFO SEGUNDO:</span> A INSTITUIÇÃO DE ENSINO declara que as atividades acima relacionadas são compatíveis com a programação curricular do curso de {{ $estagio->estagiario->curso }}, para o qual há previsão de estágio curricular.</p>

    <p class="bold mt-2">CLÁUSULA TERCEIRA:</p>
    @if($empresa?->supervisor_estagio_nome || $empresa?->supervisor_estagio_cargo || $empresa?->supervisor_estagio_formacao || $empresa?->supervisor_estagio_cpf || $empresa?->supervisor_estagio_email || $empresa?->supervisor_estagio_telefone)
        <p>Atuará como Supervisor(a) de Estágio na Unidade Concedente:
            @if($empresa?->supervisor_estagio_nome) {{ $empresa->supervisor_estagio_nome }}@endif
            @if($empresa?->supervisor_estagio_cargo), {{ $empresa->supervisor_estagio_cargo }}@endif
            @if($empresa?->supervisor_estagio_formacao), {{ $empresa->supervisor_estagio_formacao }}@endif
            @if($empresa?->supervisor_estagio_cpf), CPF: {{ $empresa->supervisor_estagio_cpf }}@endif
            @if($empresa?->supervisor_estagio_email), e-mail: {{ $empresa->supervisor_estagio_email }}@endif
            @if($empresa?->supervisor_estagio_telefone), telefone: {{ $empresa->supervisor_estagio_telefone }}@endif.
        </p>
    @endif

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
    <p>O(A) ESTAGIÁRIO(A) obriga-se a: a) Cumprir com enimho a programação de estágio; b) Conhecer e cumprir as normas da UNIDADE CONCEDENTE, salvaguardando o sigilo de informações; c) Elaborar relatório de estágio semestralmente, conforme modelo do AGENTE DE INTEGRAÇÃO, obtendo a assinatura do supervisor e entregue-o nos canais indicadas; d) Comunicar imediatamente ao AGENTE DE INTEGRAÇÃO e à UNIDADE CONCEDENTE casos de trancamento de matrícula, desistência, reprovação ou transferência institucional; e) Cumprir as normas de Segurança do Trabalho, utilizando os equipamentos de proteção individual/coletiva fornecidos.</p>

    <p class="bold mt-2">CLÁUSULA DÉCIMA:</p>
    <p>O presente TERMO DE COMPROMISSO DE ESTÁGIO será encerrado: a) Automaticamente ao término do prazo estipulado; b) Por livre manifestação de vontade da UNIDADE CONCEDENTE ou do(a) ESTAGIÁRIO(A), mediante aviso prévio por escrito de, no mínimo, 7 (sete) dias; c) Mediante comprovação de rendimento insatisfatório ou descumprimento das normas disciplinares; d) Ao término do curso, mediante comunicação formal da data de colação de grau/formatura pelo(a) estudante; e) Por descumprimento das cláusulas deste instrumento ou da legislação pertinente.</p>

    <p class="bold mt-2">CLÁUSULA DÉCIMA PRIMEIRA:</p>
    <p>O presente instrumento celebra-se nos termos do Art. 3º da Lei nº 11.788/2008. Fica expressamente declarado que a relação jurídica aqui estabelecida não gera vínculo empregatício de qualquer natureza, mesmo sendo onerosa, constituindo-se este documento como prova da inexistência de tal vínculo.</p>

    <p class="mt-3">E, por estarem justos e contratados, as partes assinam o presente instrumento em vias de igual teor e forma.</p>

    <p class="mt-3">{{ $estagio->empresaConcedente->cidade ?? 'Cidade' }}, {{ now()->format('d') }} de {{ now()->translatedFormat('F') }} de {{ now()->format('Y') }}.</p>

    <div class="assinaturas-stack" style="width: 100%; margin: 0 auto;">
    <div class="assinatura-centro mt-3" style="text-align: center;">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">{{ $estagio->empresaConcedente->razao_social }}</p>
        <p>Unidade Concedente de Estágio</p>
    </div>

    <div class="assinatura-centro mt-3" style="text-align: center;">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">{{ $estagio->instituicaoEnsino->razao_social }}</p>
        <p>Instituição de Ensino</p>
    </div>

    <div class="assinatura-centro mt-3" style="text-align: center;">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">{{ $estagio->estagiario->nome }}</p>
        <p>Estagiário(a)</p>
    </div>

    <div class="assinatura-centro mt-3" style="text-align: center;">
        <p class="underline mb-1">&nbsp;</p>
        <p class="bold">ALENCASTRO CONSULTORIA-ESTÁGIOS</p>
        <p>Agente de Integração</p>
        <p>Diogo Luís Alencastro da Silva</p>
    </div>
    </div>

    <div class="page-footer">
        <p>www.rotacerta-aprendizagem.com.br | admin@rotacerta-aprendizagem.com.br | (48) 99203-9611</p>
    </div>
</body>
</html>
