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
                                <div class="col-span-2">
                                    <label for="mantenedora" class="block text-sm font-medium text-gray-700 mb-1">Instituição Mantenedora</label>
                                    <input type="text" name="mantenedora" id="mantenedora" value="{{ old('mantenedora', $empresa->mantenedora) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
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
                                    <label for="logradouro" class="block text-sm font-medium text-gray-700 mb-1">Logradouro</label>
                                    <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $empresa->logradouro) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="numero" class="block text-sm font-medium text-gray-700 mb-1">Nº do Logradouro</label>
                                    <input type="text" name="numero" id="numero" value="{{ old('numero', $empresa->numero) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="complemento" class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento', $empresa->complemento) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
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
                                    <label for="email_secundario" class="block text-sm font-medium text-gray-700 mb-1">E-mail Secundário</label>
                                    <input type="email" name="email_secundario" id="email_secundario" value="{{ old('email_secundario', $empresa->email_secundario) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $empresa->telefone) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="telefone_secundario" class="block text-sm font-medium text-gray-700 mb-1">Telefone Secundário</label>
                                    <input type="text" name="telefone_secundario" id="telefone_secundario" value="{{ old('telefone_secundario', $empresa->telefone_secundario) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                            </div>
                        </div>

                        <!-- Representante Legal (gerenciado abaixo) -->

                        <!-- Dados do Supervisor de Estágio (gerenciado abaixo) -->

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
                                    <input type="text" name="contato_nome" id="contato_nome" value="{{ old('contato_nome', $empresa->contato_nome ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="contato_fone" class="block text-sm font-medium text-gray-700 mb-1">Fone</label>
                                    <input type="text" name="contato_fone" id="contato_fone" value="{{ old('contato_fone', $empresa->contato_fone ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="contato_email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="contato_email" id="contato_email" value="{{ old('contato_email', $empresa->contato_email ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2">
                                    <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                                    <textarea name="observacoes" id="observacoes" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">{{ old('observacoes', $empresa->observacoes ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Representante Legal -->
                        @php $ufs = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']; @endphp
                        <div>
                            <div class="flex items-center justify-between border-b pb-2 mb-6 mt-8">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                    Representante Legal
                                </h3>
                                <a href="/representantes/empresa/{{ $empresa->id }}/criar" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-white bg-green-600 hover:bg-green-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                    Incluir Novo Representante Legal
                                </a>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                    <input type="text" name="responsavel_legal_nome" value="{{ old('responsavel_legal_nome', $empresa->responsavel_legal_nome ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                                    <input type="text" name="responsavel_legal_cpf" value="{{ old('responsavel_legal_cpf', $empresa->responsavel_legal_cpf ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="000.000.000-00">
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">RG nº</label>
                                        <input type="text" name="responsavel_legal_rg" value="{{ old('responsavel_legal_rg', $empresa->responsavel_legal_rg ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Órgão Emissor</label>
                                        <input type="text" name="responsavel_legal_rg_orgao_emissor" value="{{ old('responsavel_legal_rg_orgao_emissor', $empresa->responsavel_legal_rg_orgao_emissor ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                        <select name="responsavel_legal_rg_uf" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                            <option value="">--</option>
                                            @foreach($ufs as $uf)
                                                <option value="{{ $uf }}" {{ old('responsavel_legal_rg_uf', $empresa->responsavel_legal_rg_uf ?? '') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cargo</label>
                                    <input type="text" name="responsavel_legal_cargo" value="{{ old('responsavel_legal_cargo', $empresa->responsavel_legal_cargo ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nacionalidade</label>
                                    <input type="text" name="responsavel_legal_nacionalidade" value="{{ old('responsavel_legal_nacionalidade', $empresa->responsavel_legal_nacionalidade ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Brasileiro(a)">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                                    <input type="date" name="responsavel_legal_data_nascimento" value="{{ old('responsavel_legal_data_nascimento', isset($empresa) && $empresa->responsavel_legal_data_nascimento ? $empresa->responsavel_legal_data_nascimento->format('Y-m-d') : '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="responsavel_legal_email" value="{{ old('responsavel_legal_email', $empresa->responsavel_legal_email ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
                                    <input type="text" name="responsavel_legal_celular" value="{{ old('responsavel_legal_celular', $empresa->responsavel_legal_celular ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Celular 2</label>
                                    <input type="text" name="responsavel_legal_celular2" value="{{ old('responsavel_legal_celular2', $empresa->responsavel_legal_celular2 ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                                    <input type="text" name="responsavel_legal_whatsapp" value="{{ old('responsavel_legal_whatsapp', $empresa->responsavel_legal_whatsapp ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div class="col-span-2 grid grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Principal?</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_principal" value="1" {{ old('responsavel_legal_principal', $empresa->responsavel_legal_principal ?? '') == '1' ? 'checked' : '' }}> Sim</label>
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_principal" value="0" {{ old('responsavel_legal_principal', $empresa->responsavel_legal_principal ?? '0') == '0' ? 'checked' : '' }}> Não</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Ativo?</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_ativo" value="1" {{ old('responsavel_legal_ativo', $empresa->responsavel_legal_ativo ?? '1') == '1' ? 'checked' : '' }}> Sim</label>
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_ativo" value="0" {{ old('responsavel_legal_ativo', $empresa->responsavel_legal_ativo ?? '') == '0' ? 'checked' : '' }}> Não</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Assina Documentos?</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_assina_documentos" value="1" {{ old('responsavel_legal_assina_documentos', $empresa->responsavel_legal_assina_documentos ?? '') == '1' ? 'checked' : '' }}> Sim</label>
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_assina_documentos" value="0" {{ old('responsavel_legal_assina_documentos', $empresa->responsavel_legal_assina_documentos ?? '0') == '0' ? 'checked' : '' }}> Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Observações do Representante</label>
                                    <textarea name="responsavel_legal_observacoes" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">{{ old('responsavel_legal_observacoes', $empresa->responsavel_legal_observacoes ?? '') }}</textarea>
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

                    <!-- Supervisores de Estágio -->
                    <div class="border-t border-gray-100 pt-8 mt-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                Supervisores de Estágio
                            </h3>
                            <a href="{{ route('supervisores.create', $empresa) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Incluir Supervisor
                            </a>
                        </div>
                        @if($empresa->supervisores->isEmpty())
                            <p class="text-gray-400 text-sm italic">Nenhum supervisor cadastrado.</p>
                        @else
                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200 text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Nome</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Cargo</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Formação</th>
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Ativo?</th>
                                            <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach($empresa->supervisores as $sup)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 font-medium text-gray-900">{{ $sup->nome }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $sup->cargo ?? '—' }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $sup->formacao ?? '—' }}</td>
                                            <td class="px-4 py-3">
                                                @if($sup->ativo)
                                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Sim</span>
                                                @else
                                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Não</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <a href="{{ route('supervisores.edit', [$empresa, $sup]) }}" class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100 mr-2">Editar</a>
                                                <form method="POST" action="{{ route('supervisores.destroy', [$empresa, $sup]) }}" class="inline" onsubmit="return confirm('Confirmar exclusão?')">
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

                    <!-- Representantes Legais -->
                    <div class="border-t border-gray-100 pt-8 mt-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Representantes Legais
                            </h3>
                            <a href="/representantes/empresa/{{ $empresa->id }}/criar" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-white bg-green-600 hover:bg-green-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Incluir Representante Legal
                            </a>
                        </div>
                        @if($empresa->representantesLegais->isEmpty())
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
                                            <th class="px-4 py-3 text-left font-medium text-gray-600">Assina?</th>
                                            <th class="px-4 py-3 text-right font-medium text-gray-600">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach($empresa->representantesLegais as $rep)
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
                                            <td class="px-4 py-3">
                                                @if($rep->assina_documentos)
                                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Sim</span>
                                                @else
                                                    <span class="text-gray-400 text-xs">Não</span>
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
