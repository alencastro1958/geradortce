<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('seguradoras.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Editar Seguradora: ') }} <span class="text-gray-700 font-medium">{{ $seguradora->nome }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('seguradoras.update', $seguradora->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-1">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj', $seguradora->cnpj) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="00.000.000/0000-00">
                        </div>

                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome da Seguradora *</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome', $seguradora->nome) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                            @error('nome') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="razao_social" class="block text-sm font-medium text-gray-700 mb-1">Razão Social</label>
                            <input type="text" name="razao_social" id="razao_social" value="{{ old('razao_social', $seguradora->razao_social) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                                <input type="text" name="cep" id="cep" value="{{ old('cep', $seguradora->cep) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                <input type="text" name="estado" id="estado" value="{{ old('estado', $seguradora->estado) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="logradouro" class="block text-sm font-medium text-gray-700 mb-1">Logradouro</label>
                            <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $seguradora->logradouro) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="numero" class="block text-sm font-medium text-gray-700 mb-1">Nº do Logradouro</label>
                                <input type="text" name="numero" id="numero" value="{{ old('numero', $seguradora->numero) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="complemento" class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                                <input type="text" name="complemento" id="complemento" value="{{ old('complemento', $seguradora->complemento) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="bairro" class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $seguradora->bairro) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="cidade" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $seguradora->cidade) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $seguradora->telefone) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $seguradora->email) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="apolice_numero" class="block text-sm font-medium text-gray-700 mb-1">Número da Apólice</label>
                            <input type="text" name="apolice_numero" id="apolice_numero" value="{{ old('apolice_numero', $seguradora->apolice_numero) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('apolice_numero') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="susep_vida_em_grupo" class="block text-sm font-medium text-gray-700 mb-1">Processo SUSEP Vida em Grupo</label>
                                <input type="text" name="susep_vida_em_grupo" id="susep_vida_em_grupo" value="{{ old('susep_vida_em_grupo', $seguradora->susep_vida_em_grupo) }}" placeholder="Ex: 001-065570/95" maxlength="30" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="susep_acidentes_pessoais" class="block text-sm font-medium text-gray-700 mb-1">Processo SUSEP Acidentes Pessoais</label>
                                <input type="text" name="susep_acidentes_pessoais" id="susep_acidentes_pessoais" value="{{ old('susep_acidentes_pessoais', $seguradora->susep_acidentes_pessoais) }}" placeholder="Ex: 10.003496/01-54" maxlength="30" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="capital_morte_acidental" class="block text-sm font-medium text-gray-700 mb-1">Capital Segurado (Morte Acidental)</label>
                                <input type="number" step="0.01" name="capital_morte_acidental" id="capital_morte_acidental" value="{{ old('capital_morte_acidental', $seguradora->capital_morte_acidental) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="0,00">
                            </div>
                            <div>
                                <label for="capital_morte_acidental_extenso" class="block text-sm font-medium text-gray-700 mb-1">Capital Segurado por Extenso</label>
                                <input type="text" name="capital_morte_acidental_extenso" id="capital_morte_acidental_extenso" value="{{ old('capital_morte_acidental_extenso', $seguradora->capital_morte_acidental_extenso) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Pessoa de Contato -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Pessoa de Contato
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2 md:col-span-1">
                                    <label for="contato_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                    <input type="text" name="contato_nome" id="contato_nome" value="{{ old('contato_nome', $seguradora->contato_nome ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="contato_fone" class="block text-sm font-medium text-gray-700 mb-1">Fone</label>
                                    <input type="text" name="contato_fone" id="contato_fone" value="{{ old('contato_fone', $seguradora->contato_fone ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="contato_email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="contato_email" id="contato_email" value="{{ old('contato_email', $seguradora->contato_email ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2">
                                    <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                                    <textarea name="observacoes" id="observacoes" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">{{ old('observacoes', $seguradora->observacoes ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('seguradoras.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Atualizar Seguradora
                            </button>
                        </div>
                    </form>

                    <!-- Representantes Legais -->
                    <div class="border-t border-gray-100 pt-8 mt-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Representantes Legais
                            </h3>
                            <a href="/representantes/seguradora/{{ $seguradora->id }}/criar" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-white bg-green-600 hover:bg-green-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Incluir Representante Legal
                            </a>
                        </div>
                        @if($seguradora->representantesLegais->isEmpty())
                            <p class="text-gray-400 text-sm italic">Nenhum representante legal cadastrado.</p>
                        @else
                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200 text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Nome</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Cargo</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Principal?</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Ativo?</th>
                                            <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach($seguradora->representantesLegais as $rep)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 font-medium text-gray-900">{{ $rep->nome }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $rep->cargo ?? '—' }}</td>
                                            <td class="px-4 py-3">
                                                @if($rep->principal)
                                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sim</span>
                                                @else
                                                    <span class="text-gray-400 text-xs">Não</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($rep->ativo)
                                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Sim</span>
                                                @else
                                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Não</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <a href="/representantes/{{ $rep->id }}/editar" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 mr-2">Editar</a>
                                                <form method="POST" action="/representantes/{{ $rep->id }}" class="inline" onsubmit="return confirm('Confirmar exclusão?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
