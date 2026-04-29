<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Instituições de Ensino') }}
            </h2>
            <a href="{{ route('instituicoes.create') }}" class="group relative px-6 py-3 font-semibold text-white rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
                <span class="relative flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nova Instituição
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-8 rounded-2xl bg-green-50 p-4 shadow-sm border border-green-100 flex items-center animate-fade-in-down">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Glassmorphism Card -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    @if($instituicoes->count() > 0)
                        <div class="overflow-x-auto rounded-2xl shadow-sm border border-gray-100">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Razão Social</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">CNPJ</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contato</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach($instituicoes as $inst)
                                        <tr class="hover:bg-blue-50/50 transition-colors duration-200 group">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-xl bg-gradient-to-br from-indigo-100 to-blue-100 text-indigo-600 font-bold shadow-inner">
                                                        {{ substr($inst->razao_social, 0, 1) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">{{ $inst->razao_social }}</div>
                                                        <div class="text-sm text-gray-500">{{ $inst->nome_fantasia ?? 'Sem nome fantasia' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $inst->cnpj }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $inst->email ?? '-' }}</div>
                                                <div class="text-sm text-gray-500">{{ $inst->telefone ?? '-' }}</div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    <a href="{{ route('instituicoes.edit', $inst->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('instituicoes.destroy', $inst->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta Instituição?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $instituicoes->links() }}
                        </div>
                    @else
                        <div class="text-center py-16 flex flex-col items-center justify-center">
                            <div class="bg-indigo-50 p-6 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Nenhuma instituição cadastrada</h3>
                            <p class="text-gray-500 max-w-sm mx-auto mb-6">Comece cadastrando a primeira Instituição de Ensino parceira para poder emitir os Termos de Compromisso.</p>
                            <a href="{{ route('instituicoes.create') }}" class="px-6 py-3 font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors duration-300">
                                Cadastrar Primeira Instituição
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.4s ease-out forwards;
        }
    </style>
</x-app-layout>
