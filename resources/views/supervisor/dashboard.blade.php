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

        {{-- Cabeçalho com contador --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Estagiários Supervisionados</h2>
            <div class="flex items-center gap-2">
                @php $total = $estagios->count(); $limite = 10; @endphp
                <span class="text-sm font-semibold px-4 py-1.5 rounded-full
                    {{ $total >= $limite ? 'bg-red-100 text-red-700' : ($total >= 8 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                    {{ $total }} / {{ $limite }} estagiários
                </span>
                @if($total >= $limite)
                    <span class="text-xs text-red-600 font-medium">Limite atingido (Lei nº 11.788/2008)</span>
                @endif
            </div>
        </div>

        {{-- Alerta de limite --}}
        @if($total >= $limite)
            <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded-xl text-sm text-red-800">
                <strong>⚠ Limite máximo atingido.</strong> Conforme o Art. 9º da Lei nº 11.788/2008, cada supervisor pode acompanhar no máximo <strong>10 estagiários</strong> simultaneamente.
            </div>
        @elseif($total >= 8)
            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-300 rounded-xl text-sm text-yellow-800">
                <strong>Atenção:</strong> Você está próximo do limite máximo de 10 estagiários permitido por lei.
            </div>
        @endif

        {{-- Tabela resumo de estagiários --}}
        @if($estagios->count())
            <div class="bg-white rounded-2xl shadow mb-8 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-indigo-50 text-indigo-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-5 py-3 text-left">#</th>
                            <th class="px-5 py-3 text-left">Estagiário</th>
                            <th class="px-5 py-3 text-left">Curso</th>
                            <th class="px-5 py-3 text-left">Início</th>
                            <th class="px-5 py-3 text-left">Término</th>
                            <th class="px-5 py-3 text-left">Status</th>
                            <th class="px-5 py-3 text-left">Relatórios</th>
                            <th class="px-5 py-3 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($estagios as $i => $estagio)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 text-gray-400 font-mono">{{ $i + 1 }}</td>
                                <td class="px-5 py-3">
                                    <div class="font-semibold text-gray-800">{{ $estagio->estagiario->nome }}</div>
                                    <div class="text-xs text-gray-400">CPF: {{ $estagio->estagiario->cpf }}</div>
                                </td>
                                <td class="px-5 py-3 text-gray-600">{{ $estagio->estagiario->curso ?? '—' }}</td>
                                <td class="px-5 py-3 text-gray-600">
                                    {{ $estagio->data_inicio ? $estagio->data_inicio->format('d/m/Y') : '—' }}
                                </td>
                                <td class="px-5 py-3 text-gray-600">
                                    {{ $estagio->data_fim ? $estagio->data_fim->format('d/m/Y') : '—' }}
                                </td>
                                <td class="px-5 py-3">
                                    @php $st = $estagio->status->value ?? $estagio->status; @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                        {{ $st === 'ativo' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($st) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    @php $relEmitidos = $estagio->relatorios->count(); @endphp
                                    <span class="text-gray-600">{{ $relEmitidos }} / 4</span>
                                    @foreach($estagio->relatorios->sortBy('semestre') as $rel)
                                        <span class="ml-1 px-1.5 py-0.5 rounded text-xs
                                            {{ $rel->status === 'finalizado' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $rel->semestre }}º
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex gap-2 flex-wrap">
                                        @if($estagio->relatorios->count() < 4)
                                            <a href="{{ route('supervisor.relatorio.criar', $estagio) }}"
                                                class="px-3 py-1 rounded-lg bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-500 transition">
                                                + Relatório
                                            </a>
                                        @endif
                                        @foreach($estagio->relatorios->where('status', '!=', 'finalizado') as $rel)
                                            <a href="{{ route('supervisor.relatorio.editar', $rel) }}"
                                                class="px-3 py-1 rounded-lg border border-indigo-400 text-indigo-600 text-xs font-semibold hover:bg-indigo-50 transition">
                                                Editar {{ $rel->semestre }}º
                                            </a>
                                        @endforeach
                                        @foreach($estagio->relatorios as $rel)
                                            <a href="{{ route('supervisor.relatorio.pdf', $rel) }}" target="_blank"
                                                class="px-3 py-1 rounded-lg border border-gray-300 text-gray-600 text-xs hover:bg-gray-50 transition">
                                                PDF {{ $rel->semestre }}º
                                            </a>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Rodapé informativo --}}
            <p class="text-xs text-gray-400 text-center">
                Conforme Art. 9º da Lei nº 11.788/2008 – cada supervisor pode acompanhar no máximo <strong>10 estagiários</strong> por vez.
            </p>
        @else
            <div class="bg-white rounded-2xl shadow p-8 text-center text-gray-500">
                Nenhum estágio ativo vinculado a você no momento.
            </div>
        @endif
    </div>
</body>
</html>
