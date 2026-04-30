<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('instituicoes.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Nova Instituição de Ensino') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('instituicoes.store') }}" class="space-y-8">
                        @csrf

                        <!-- Dados Principais -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00-.504-.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Dados da Instituição
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- CNPJ PRIMEIRO -->
                                <div class="col-span-2 md:col-span-1">
                                    <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-1">CNPJ *</label>
                                    <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="00.000.000/0000-00">
                                    @error('cnpj') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label for="razao_social" class="block text-sm font-medium text-gray-700 mb-1">Razão Social *</label>
                                    <input type="text" name="razao_social" id="razao_social" value="{{ old('razao_social') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    @error('razao_social') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label for="mantenedora" class="block text-sm font-medium text-gray-700 mb-1">Instituição Mantenedora</label>
                                    <input type="text" name="mantenedora" id="mantenedora" value="{{ old('mantenedora') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label for="nome_fantasia" class="block text-sm font-medium text-gray-700 mb-1">Nome Fantasia</label>
                                    <input type="text" name="nome_fantasia" id="nome_fantasia" value="{{ old('nome_fantasia') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                                    <input type="text" name="cep" id="cep" value="{{ old('cep') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="00000-000">
                                </div>
                            </div>
                        </div>

                        <!-- Contato e Endereço -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Localização e Contato
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label for="endereco" class="block text-sm font-medium text-gray-700 mb-1">Endereço Completo</label>
                                    <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="bairro" class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label for="cidade" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                    <div>
                                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                        <input type="text" name="estado" id="estado" value="{{ old('estado') }}" maxlength="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                            </div>
                        </div>

                        <!-- Representante Legal -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Representante Legal (Assinatura)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="responsavel_legal_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome do Responsável</label>
                                    <input type="text" name="responsavel_legal_nome" id="responsavel_legal_nome" value="{{ old('responsavel_legal_nome') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="responsavel_legal_cargo" class="block text-sm font-medium text-gray-700 mb-1">Cargo do Responsável</label>
                                    <input type="text" name="responsavel_legal_cargo" id="responsavel_legal_cargo" value="{{ old('responsavel_legal_cargo') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('instituicoes.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Salvar Instituição
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
