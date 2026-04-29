<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('empresas.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Editar Empresa: ') }} <span class="text-gray-700 font-medium">{{ $empresa->razao_social }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('empresas.update', $empresa->id) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Identificação da Empresa -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                </svg>
                                Identificação da Empresa
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label for="razao_social" class="block text-sm font-medium text-gray-700 mb-1">Razão Social *</label>
                                    <input type="text" name="razao_social" id="razao_social" value="{{ old('razao_social', $empresa->razao_social) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    @error('razao_social') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="nome_fantasia" class="block text-sm font-medium text-gray-700 mb-1">Nome Fantasia</label>
                                    <input type="text" name="nome_fantasia" id="nome_fantasia" value="{{ old('nome_fantasia', $empresa->nome_fantasia) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-1">CNPJ *</label>
                                    <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj', $empresa->cnpj) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    @error('cnpj') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Localização e Contato -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                Localização e Contato
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label for="endereco" class="block text-sm font-medium text-gray-700 mb-1">Endereço Completo</label>
                                    <input type="text" name="endereco" id="endereco" value="{{ old('endereco', $empresa->endereco) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="bairro" class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $empresa->bairro) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label for="cidade" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $empresa->cidade) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                    <div>
                                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                        <input type="text" name="estado" id="estado" value="{{ old('estado', $empresa->estado) }}" maxlength="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $empresa->email) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $empresa->telefone) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                            </div>
                        </div>

                        <!-- Responsáveis -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                Responsáveis
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="responsavel_legal_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome do Responsável Legal</label>
                                    <input type="text" name="responsavel_legal_nome" id="responsavel_legal_nome" value="{{ old('responsavel_legal_nome', $empresa->responsavel_legal_nome) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="responsavel_legal_cargo" class="block text-sm font-medium text-gray-700 mb-1">Cargo do Responsável</label>
                                    <input type="text" name="responsavel_legal_cargo" id="responsavel_legal_cargo" value="{{ old('responsavel_legal_cargo', $empresa->responsavel_legal_cargo) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="supervisor_estagio_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome do Supervisor de Estágio</label>
                                    <input type="text" name="supervisor_estagio_nome" id="supervisor_estagio_nome" value="{{ old('supervisor_estagio_nome', $empresa->supervisor_estagio_nome) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="supervisor_estagio_cargo" class="block text-sm font-medium text-gray-700 mb-1">Cargo do Supervisor</label>
                                    <input type="text" name="supervisor_estagio_cargo" id="supervisor_estagio_cargo" value="{{ old('supervisor_estagio_cargo', $empresa->supervisor_estagio_cargo) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('empresas.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Atualizar Empresa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
