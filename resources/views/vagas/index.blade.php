<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Gestão de Vagas') }}
            </h2>
            <a href="{{ route('vagas.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:from-blue-500 hover:to-indigo-500 active:from-blue-700 active:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Nova Vaga
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100">
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl animate-bounce">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-gray-100">
                                    <th class="px-6 py-4 text-sm font-bold text-gray-600 uppercase tracking-wider">Código</th>
                                    <th class="px-6 py-4 text-sm font-bold text-gray-600 uppercase tracking-wider">Vaga / Empresa</th>
                                    <th class="px-6 py-4 text-sm font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-sm font-bold text-gray-600 uppercase tracking-wider text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($vagas as $vaga)
                                    <tr class="hover:bg-gray-50/50 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg font-mono text-xs font-bold">
                                                {{ $vaga->codigo_vaga }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $vaga->titulo }}</div>
                                            <div class="text-xs text-gray-500">{{ $vaga->empresa->razao_social }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($vaga->ativa)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Ativa
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Encerrada
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Ver Candidatos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                    </svg>
                                                </button>
                                                <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                                            Nenhuma vaga cadastrada no momento.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $vagas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
