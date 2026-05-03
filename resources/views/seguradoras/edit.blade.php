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
                                <input type="text" name="susep_vida_em_grupo" id="susep_vida_em_grupo" value="{{ old('susep_vida_em_grupo', $seguradora->susep_vida_em_grupo) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="susep_acidentes_pessoais" class="block text-sm font-medium text-gray-700 mb-1">Processo SUSEP Acidentes Pessoais</label>
                                <input type="text" name="susep_acidentes_pessoais" id="susep_acidentes_pessoais" value="{{ old('susep_acidentes_pessoais', $seguradora->susep_acidentes_pessoais) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('seguradoras.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Atualizar Seguradora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
