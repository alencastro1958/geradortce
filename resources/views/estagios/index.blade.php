<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Gestão de TCEs (Estágios)') }}
            </h2>
            <a href="{{ route('estagios.create') }}" class="group relative inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-indigo-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 hover:bg-indigo-700 shadow-lg hover:shadow-indigo-500/50 transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Gerar Novo TCE
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-r-xl animate-bounce-short">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Estagiário</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Empresa / Instituição</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Período</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($estagios as $estagio)
                                    <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $estagio->estagiario->nome }}</div>
                                            <div class="text-xs text-gray-500">{{ $estagio->estagiario->cpf }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 font-medium">{{ $estagio->empresaConcedente->nome_fantasia }}</div>
                                            <div class="text-xs text-gray-500 italic">{{ $estagio->instituicaoEnsino->nome }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($estagio->data_inicio)->format('d/m/Y') }} a 
                                                {{ \Carbon\Carbon::parse($estagio->data_fim)->format('d/m/Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClasses = [
                                                    'pendente' => 'bg-yellow-100 text-yellow-800',
                                                    'ativo' => 'bg-green-100 text-green-800',
                                                    'concluido' => 'bg-blue-100 text-blue-800',
                                                    'rescindido' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$estagio->status] ?? 'bg-gray-100' }}">
                                                {{ ucfirst($estagio->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('estagios.gerar-documento', $estagio->id) }}" target="_blank" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Gerar Documento (PDF/Impressão)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('estagios.edit', $estagio->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('estagios.destroy', $estagio->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente remover este registro de estágio?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Excluir">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-xl font-medium text-gray-400">Nenhum TCE gerado até o momento</p>
                                                <a href="{{ route('estagios.create') }}" class="mt-4 text-indigo-600 hover:text-indigo-800 font-semibold">Gerar o primeiro TCE agora &rarr;</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $estagios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
