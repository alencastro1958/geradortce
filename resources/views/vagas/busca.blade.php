<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oportunidades de Estágio — Portal de Vagas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <nav class="border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-600">Portal de Vagas</p>
                <h1 class="text-xl font-black">Oportunidades de Estágio</h1>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros de Busca -->
            <div class="mb-10 bg-white/70 backdrop-blur-md p-6 rounded-3xl shadow-xl border border-gray-100">
                <form action="{{ route('vagas.busca') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </span>
                            <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por título, área ou código..." class="pl-10 w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        </div>
                    </div>
                    <button type="submit" class="px-8 py-2 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg hover:shadow-indigo-500/30">
                        Filtrar Oportunidades
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Grid de Vagas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($vagas as $vaga)
                    <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold uppercase tracking-wider">
                                    {{ $vaga->area_atuacao }}
                                </span>
                                <span class="text-gray-400 text-xs font-mono">
                                    {{ $vaga->codigo_vaga }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $vaga->titulo }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                                {{ $vaga->empresa->razao_social }}
                            </p>
                            
                            <div class="space-y-2 mb-6">
                                <div class="flex items-center text-sm text-gray-600 gap-2">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Bolsa: R$ {{ number_format($vaga->bolsa_auxilio, 2, ',', '.') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-600 gap-2">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $vaga->horario }}
                                </div>
                            </div>

                            <form action="{{ route('vagas.candidatar', $vaga) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-3 bg-gray-900 text-white font-bold rounded-2xl hover:bg-indigo-600 transition-all shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-1">
                                    Candidatar-se Agora
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="inline-block p-6 bg-gray-50 rounded-full mb-4">
                            <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-xl font-medium">Nenhuma vaga encontrada para sua busca.</p>
                        <a href="{{ route('vagas.busca') }}" class="text-indigo-600 hover:underline mt-2 inline-block">Limpar filtros</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $vagas->links() }}
            </div>
        </div>
    </div>
</body>
</html>
