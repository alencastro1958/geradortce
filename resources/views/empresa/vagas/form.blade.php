<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-6 py-8">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('empresa.dashboard') }}" class="text-sm font-medium text-sky-600 hover:underline">Voltar ao dashboard</a>
                <h1 class="mt-2 text-3xl font-black">{{ $pageTitle }}</h1>
                <p class="mt-1 text-sm text-slate-500">{{ $pageSubtitle }}</p>
            </div>
            <form method="POST" action="{{ route('empresa.logout') }}">
                @csrf
                <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Sair</button>
            </form>
        </div>

        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ $route }}" class="space-y-8">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Empresa</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Nome</label>
                        <input type="text" name="nome_empresa" value="{{ old('nome_empresa', $vaga->nome_empresa) }}" required class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">CNPJ</label>
                        <input type="text" name="cnpj_empresa" value="{{ old('cnpj_empresa', $vaga->cnpj_empresa) }}" required class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Ramo</label>
                        <input type="text" name="ramo_empresa" value="{{ old('ramo_empresa', $vaga->ramo_empresa) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Endereco</label>
                        <input type="text" name="endereco_empresa" value="{{ old('endereco_empresa', $vaga->endereco_empresa) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Descricao</label>
                        <textarea name="descricao_empresa" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('descricao_empresa', $vaga->descricao_empresa) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Contato</label>
                        <input type="text" name="contato_empresa" value="{{ old('contato_empresa', $vaga->contato_empresa) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">E-mail</label>
                        <input type="email" name="email_empresa" value="{{ old('email_empresa', $vaga->email_empresa) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Telefone</label>
                        <input type="text" name="telefone_empresa" value="{{ old('telefone_empresa', $vaga->telefone_empresa) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Vaga</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Titulo</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $vaga->titulo) }}" required class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Area</label>
                        <input type="text" name="area_atuacao" value="{{ old('area_atuacao', $vaga->area_atuacao) }}" required class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Quantidade</label>
                        <input type="number" min="1" name="quantidade" value="{{ old('quantidade', $vaga->quantidade) }}" required class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Local</label>
                        <select name="modalidade" class="w-full rounded-2xl border-slate-200">
                            @foreach(['Presencial', 'Hibrido', 'Remoto'] as $modalidade)
                                <option value="{{ $modalidade }}" @selected(old('modalidade', $vaga->modalidade) === $modalidade)>{{ $modalidade }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Cidade/Estado</label>
                        <input type="text" name="cidade_estado" value="{{ old('cidade_estado', $vaga->cidade_estado) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Inicio previsto</label>
                        <input type="date" name="inicio_previsto" value="{{ old('inicio_previsto', optional($vaga->inicio_previsto)->format('Y-m-d')) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Perfil</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Formacao aceita</label>
                        <textarea name="formacao_aceita" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('formacao_aceita', $vaga->formacao_aceita) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Cursos</label>
                        <textarea name="cursos" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('cursos', $vaga->cursos) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Periodo minimo</label>
                        <input type="text" name="periodo_minimo" value="{{ old('periodo_minimo', $vaga->periodo_minimo) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Competencias</label>
                        <textarea name="competencias" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('competencias', $vaga->competencias) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Conhecimentos desejaveis</label>
                        <textarea name="conhecimentos_desejaveis" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('conhecimentos_desejaveis', $vaga->conhecimentos_desejaveis) }}</textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Atividades</h2>
                <div class="mt-5">
                    <label class="mb-1 block text-sm font-medium text-slate-700">Atividades previstas</label>
                    <textarea name="atividades" rows="5" class="w-full rounded-2xl border-slate-200" placeholder="- Atividade 1&#10;- Atividade 2&#10;- Atividade 3">{{ old('atividades', $vaga->atividades) }}</textarea>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Carga horaria</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Horas/dia</label>
                        <input type="text" name="horas_dia" value="{{ old('horas_dia', $vaga->horas_dia) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Dias</label>
                        <input type="text" name="dias" value="{{ old('dias', $vaga->dias) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Horario</label>
                        <input type="text" name="horario" value="{{ old('horario', $vaga->horario) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Flexibilidade</label>
                        <input type="text" name="flexibilidade" value="{{ old('flexibilidade', $vaga->flexibilidade) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Beneficios</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Bolsa</label>
                        <input type="number" step="0.01" min="0" name="bolsa_auxilio" value="{{ old('bolsa_auxilio', $vaga->bolsa_auxilio) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Transporte</label>
                        <input type="text" name="transporte" value="{{ old('transporte', $vaga->transporte) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Alimentacao</label>
                        <input type="text" name="alimentacao" value="{{ old('alimentacao', $vaga->alimentacao) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Seguro</label>
                        <input type="text" name="seguro" value="{{ old('seguro', $vaga->seguro) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Outros</label>
                        <textarea name="outros_beneficios" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('outros_beneficios', $vaga->outros_beneficios) }}</textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Contratacao</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Obrigatorio/nao obrigatorio</label>
                        <select name="contratacao_tipo" class="w-full rounded-2xl border-slate-200">
                            <option value="Obrigatorio" @selected(old('contratacao_tipo', $vaga->contratacao_tipo) === 'Obrigatorio')>Obrigatorio</option>
                            <option value="Nao obrigatorio" @selected(old('contratacao_tipo', $vaga->contratacao_tipo) === 'Nao obrigatorio')>Nao obrigatorio</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Duracao</label>
                        <input type="text" name="duracao" value="{{ old('duracao', $vaga->duracao) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Possibilidade de efetivacao</label>
                        <input type="text" name="possibilidade_efetivacao" value="{{ old('possibilidade_efetivacao', $vaga->possibilidade_efetivacao) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Processo seletivo</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Etapas</label>
                        <textarea name="etapas" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('etapas', $vaga->etapas) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Prazo</label>
                        <input type="date" name="prazo" value="{{ old('prazo', optional($vaga->prazo)->format('Y-m-d')) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Retorno</label>
                        <textarea name="retorno" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('retorno', $vaga->retorno) }}</textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Candidatura</h2>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">Link</label>
                        <input type="url" name="link_candidatura" value="{{ old('link_candidatura', $vaga->link_candidatura) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-700">E-mail</label>
                        <input type="email" name="email_candidatura" value="{{ old('email_candidatura', $vaga->email_candidatura) }}" class="w-full rounded-2xl border-slate-200">
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-slate-700">Instrucoes</label>
                        <textarea name="instrucoes_candidatura" rows="3" class="w-full rounded-2xl border-slate-200">{{ old('instrucoes_candidatura', $vaga->instrucoes_candidatura) }}</textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-[28px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <h2 class="text-lg font-black uppercase tracking-[0.2em] text-slate-800">Observacoes</h2>
                <div class="mt-5 space-y-4">
                    <textarea name="observacoes" rows="4" class="w-full rounded-2xl border-slate-200">{{ old('observacoes', $vaga->observacoes) }}</textarea>
                    <label class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <input type="hidden" name="ativa" value="0">
                        <input type="checkbox" name="ativa" value="1" @checked(old('ativa', $vaga->ativa)) class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                        Manter vaga ativa para divulgacao
                    </label>
                </div>
            </section>

            <div class="flex items-center justify-end gap-3 pb-8">
                <a href="{{ route('empresa.dashboard') }}" class="rounded-2xl px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-200">Cancelar</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold uppercase tracking-[0.2em] text-white transition hover:bg-sky-600">{{ $submitLabel }}</button>
            </div>
        </form>
    </div>
</body>
</html>