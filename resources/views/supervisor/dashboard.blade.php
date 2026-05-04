<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Portal do Supervisor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    {{-- Navbar --}}
    <nav class="bg-white border-b shadow-sm px-6 py-4 flex items-center justify-between">
        <div>
            <span class="font-bold text-lg text-indigo-700">Portal do Supervisor</span>
            <span class="text-gray-400 text-sm ml-2">Alencastro Consultoria</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('supervisor.logout') }}">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:underline">Sair</button>
            </form>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-800 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Meus Estágios Supervisionados</h2>

        @forelse($estagios as $estagio)
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-4">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $estagio->estagiario->nome }}</h3>
                        <p class="text-sm text-gray-500">
                            CPF: {{ $estagio->estagiario->cpf }}
                            &nbsp;|&nbsp;
                            Início: {{ \Carbon\Carbon::parse($estagio->data_inicio)->format('d/m/Y') }}
                            &nbsp;|&nbsp;
                            Previsão: {{ \Carbon\Carbon::parse($estagio->data_termino)->format('d/m/Y') }}
                        </p>
                    </div>
                    <a href="{{ route('supervisor.relatorio.criar', $estagio) }}"
                        class="inline-block px-5 py-2 rounded-xl bg-indigo-600 text-white font-semibold text-sm hover:bg-indigo-500 shadow transition">
                        + Novo Relatório
                    </a>
                </div>

                {{-- Relatórios existentes --}}
                @if($estagio->relatorios->count())
                    <table class="w-full text-sm border-t pt-4">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="pb-2 pr-4">Semestre</th>
                                <th class="pb-2 pr-4">Avaliação</th>
                                <th class="pb-2 pr-4">Status</th>
                                <th class="pb-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estagio->relatorios->sortBy('semestre') as $rel)
                                <tr class="border-b last:border-0">
                                    <td class="py-2 pr-4 font-medium">{{ $rel->labelSemestre() }}</td>
                                    <td class="py-2 pr-4">{{ $rel->labelAvaliacao() }}</td>
                                    <td class="py-2 pr-4">
                                        @if($rel->status === 'finalizado')
                                            <span class="px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Finalizado</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">Rascunho</span>
                                        @endif
                                    </td>
                                    <td class="py-2 flex gap-3">
                                        @if($rel->status !== 'finalizado')
                                            <a href="{{ route('supervisor.relatorio.editar', $rel) }}" class="text-indigo-600 hover:underline">Editar</a>
                                        @endif
                                        <a href="{{ route('supervisor.relatorio.pdf', $rel) }}" target="_blank" class="text-blue-600 hover:underline">PDF</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-sm text-gray-400 mt-2">Nenhum relatório emitido ainda.</p>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow p-8 text-center text-gray-500">
                Nenhum estágio ativo vinculado a você no momento.
            </div>
        @endforelse
    </div>
</body>
</html>
