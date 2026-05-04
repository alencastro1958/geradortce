<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $empresa->nome_fantasia ?: $empresa->razao_social }} — Portal da Empresa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <nav class="border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-600">Portal da Empresa</p>
                <h1 class="text-xl font-black">{{ $empresa->nome_fantasia ?: $empresa->razao_social }}</h1>
                <p class="text-xs text-slate-400">{{ url('/' . $empresa->slug . '/dashboard') }}</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('empresa.vagas.create', ['slug' => $empresa->slug]) }}" class="rounded-2xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-500">Nova vaga</a>
                <form method="POST" action="{{ route('empresa.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {!! session('success') !!}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
        @endif

        <section class="mt-4 rounded-2xl border border-sky-200 bg-sky-50 px-5 py-3 text-sm text-sky-800">
            As vagas ativas ficam disponíveis para candidatos em:
            <a href="{{ url('/vagas/oportunidades') }}" target="_blank" class="font-semibold underline hover:text-sky-600">{{ url('/vagas/oportunidades') }}</a>
        </section>

        <section class="mt-6 grid gap-4 md:grid-cols-3">
            <article class="rounded-3xl bg-slate-900 p-6 text-white shadow-xl">
                <p class="text-sm text-slate-300">Vagas cadastradas</p>
                <p class="mt-3 text-4xl font-black">{{ $vagas->count() }}</p>
            </article>
            <article class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">Vagas ativas</p>
                <p class="mt-3 text-4xl font-black text-sky-600">{{ $vagasAtivas }}</p>
            </article>
            <article class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">Candidaturas recebidas</p>
                <p class="mt-3 text-4xl font-black text-emerald-600">{{ $totalCandidaturas }}</p>
            </article>
        </section>

        <section class="mt-8 rounded-[32px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
            <div class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black">Cadastro de Vagas</h2>
                    <p class="text-sm text-slate-500">Gerencie as oportunidades de estágio publicadas pela sua empresa.</p>
                </div>
                <a href="{{ route('empresa.vagas.create', ['slug' => $empresa->slug]) }}" class="rounded-2xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-sky-500 hover:text-sky-600">Cadastrar vaga</a>
            </div>

            @if($vagas->isEmpty())
                <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center text-slate-500">
                    Nenhuma vaga cadastrada até o momento.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">
                                <th class="px-4 py-3">Código</th>
                                <th class="px-4 py-3">Título</th>
                                <th class="px-4 py-3">Modalidade</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Candidaturas</th>
                                <th class="px-4 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($vagas as $vaga)
                                <tr>
                                    <td class="px-4 py-4 font-mono text-xs text-slate-500">{{ $vaga->codigo_vaga }}</td>
                                    <td class="px-4 py-4">
                                        <p class="font-semibold text-slate-900">{{ $vaga->titulo }}</p>
                                        <p class="text-xs text-slate-500">{{ $vaga->area_atuacao }}@if($vaga->cidade_estado) — {{ $vaga->cidade_estado }}@endif</p>
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $vaga->modalidade ?: '—' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $vaga->ativa ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $vaga->ativa ? 'Ativa' : 'Encerrada' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $vaga->candidaturas_count }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('empresa.vagas.edit', ['slug' => $empresa->slug, 'vaga' => $vaga]) }}" class="rounded-xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-sky-500 hover:text-sky-600">Editar</a>
                                            <form method="POST" action="{{ route('empresa.vagas.destroy', ['slug' => $empresa->slug, 'vaga' => $vaga]) }}" onsubmit="return confirm('Excluir esta vaga?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-xl border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>
</body>
</html>
    <nav class="border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-600">Portal da Empresa</p>
                <h1 class="text-xl font-black">{{ $empresa->nome_fantasia ?: $empresa->razao_social }}</h1>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('empresa.vagas.create') }}" class="rounded-2xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-500">Nova vaga</a>
                <form method="POST" action="{{ route('empresa.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {!! session('success') !!}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
        @endif

        <section class="mt-4 rounded-2xl border border-sky-200 bg-sky-50 px-5 py-3 text-sm text-sky-800">
            🔗 As vagas ativas ficam disponíveis em:
            <a href="{{ url('/vagas/oportunidades') }}" target="_blank" class="font-semibold underline hover:text-sky-600">{{ url('/vagas/oportunidades') }}</a>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            <article class="rounded-3xl bg-slate-900 p-6 text-white shadow-xl">
                <p class="text-sm text-slate-300">Vagas cadastradas</p>
                <p class="mt-3 text-4xl font-black">{{ $vagas->count() }}</p>
            </article>
            <article class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">Vagas ativas</p>
                <p class="mt-3 text-4xl font-black text-sky-600">{{ $vagasAtivas }}</p>
            </article>
            <article class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <p class="text-sm text-slate-500">Candidaturas recebidas</p>
                <p class="mt-3 text-4xl font-black text-emerald-600">{{ $totalCandidaturas }}</p>
            </article>
        </section>

        <section class="mt-8 rounded-[32px] bg-white p-6 shadow-xl ring-1 ring-slate-200">
            <div class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black">Cadastro de Vagas</h2>
                    <p class="text-sm text-slate-500">Gerencie as oportunidades de estagio publicadas pela sua empresa.</p>
                </div>
                <a href="{{ route('empresa.vagas.create') }}" class="rounded-2xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-sky-500 hover:text-sky-600">Cadastrar vaga</a>
            </div>

            @if($vagas->isEmpty())
                <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center text-slate-500">
                    Nenhuma vaga cadastrada ate o momento.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">
                                <th class="px-4 py-3">Codigo</th>
                                <th class="px-4 py-3">Titulo</th>
                                <th class="px-4 py-3">Modalidade</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Candidaturas</th>
                                <th class="px-4 py-3 text-right">Acoes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($vagas as $vaga)
                                <tr>
                                    <td class="px-4 py-4 font-mono text-xs text-slate-500">{{ $vaga->codigo_vaga }}</td>
                                    <td class="px-4 py-4">
                                        <p class="font-semibold text-slate-900">{{ $vaga->titulo }}</p>
                                        <p class="text-xs text-slate-500">{{ $vaga->area_atuacao }} @if($vaga->cidade_estado) - {{ $vaga->cidade_estado }} @endif</p>
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $vaga->modalidade ?: 'Nao informado' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $vaga->ativa ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $vaga->ativa ? 'Ativa' : 'Encerrada' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $vaga->candidaturas_count }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('empresa.vagas.edit', $vaga) }}" class="rounded-xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-sky-500 hover:text-sky-600">Editar</a>
                                            <form method="POST" action="{{ route('empresa.vagas.destroy', $vaga) }}" onsubmit="return confirm('Excluir esta vaga?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-xl border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>
</body>
</html>