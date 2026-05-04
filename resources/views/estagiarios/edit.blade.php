<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('estagiarios.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Editar Estagiário: ') }} <span class="text-gray-700 font-medium">{{ $estagiario->nome }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('estagiarios.update', $estagiario->id) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Dados Pessoais -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Dados Pessoais
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- CPF PRIMEIRO -->
                                <div class="col-span-2 md:col-span-1">
                                    <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF *</label>
                                    <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $estagiario->cpf) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="000.000.000-00">
                                    @error('cpf') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
                                    <input type="text" name="nome" id="nome" data-case="upper" value="{{ old('nome', $estagiario->nome) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    @error('nome') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label for="rg" class="block text-sm font-medium text-gray-700 mb-1">RG</label>
                                    <input type="text" name="rg" id="rg" value="{{ old('rg', $estagiario->rg) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $estagiario->data_nascimento) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                                    <input type="text" name="cep" id="cep" value="{{ old('cep', $estagiario->cep) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="00000-000">
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
                                Contato e Endereço
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $estagiario->email) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $estagiario->telefone) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div class="col-span-2">
                                    <label for="logradouro" class="block text-sm font-medium text-gray-700 mb-1">Logradouro</label>
                                    <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $estagiario->logradouro) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="numero" class="block text-sm font-medium text-gray-700 mb-1">Nº do Logradouro</label>
                                    <input type="text" name="numero" id="numero" value="{{ old('numero', $estagiario->numero) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="complemento" class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento', $estagiario->complemento) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="bairro" class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $estagiario->bairro) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label for="cidade" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $estagiario->cidade) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                    <div>
                                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                        <input type="text" name="estado" id="estado" value="{{ old('estado', $estagiario->estado) }}" maxlength="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dados Acadêmicos -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.827a1 1 0 00-.788 0l-7 3a1 1 0 000 1.846l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.846l-7-3z" />
                                    <path d="M3 10v4a1 1 0 00.553.894l6 3a1 1 0 00.894 0l6-3a1 1 0 00.553-.894v-4l-7 3a1 1 0 00-.788 0l-7-3z" />
                                </svg>
                                Dados Acadêmicos
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label for="curso" class="block text-sm font-medium text-gray-700 mb-1">Curso</label>
                                    <input type="text" name="curso" id="curso" value="{{ old('curso', $estagiario->curso) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="matricula" class="block text-sm font-medium text-gray-700 mb-1">Matrícula</label>
                                    <input type="text" name="matricula" id="matricula" value="{{ old('matricula', $estagiario->matricula) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="semestre_periodo_serie" class="block text-sm font-medium text-gray-700 mb-1">Semestre/Período/Série</label>
                                    <input type="text" name="semestre_periodo_serie" id="semestre_periodo_serie" value="{{ old('semestre_periodo_serie', $estagiario->semestre_periodo_serie) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="curso_data_inicio" class="block text-sm font-medium text-gray-700 mb-1">Data de Início do Curso (Mês/Ano)</label>
                                    <input type="text" name="curso_data_inicio" id="curso_data_inicio" value="{{ old('curso_data_inicio', $estagiario->curso_data_inicio) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="MM/AAAA">
                                </div>
                                <div>
                                    <label for="curso_data_conclusao_prevista" class="block text-sm font-medium text-gray-700 mb-1">Data de Conclusão Prevista (Mês/Ano)</label>
                                    <input type="text" name="curso_data_conclusao_prevista" id="curso_data_conclusao_prevista" value="{{ old('curso_data_conclusao_prevista', $estagiario->curso_data_conclusao_prevista) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="MM/AAAA">
                                </div>
                            </div>
                        </div>

                        <!-- Responsável (Menor de Idade) -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                </svg>
                                Responsável Legal (Obrigatório se menor de idade)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="responsavel_legal_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome do Responsável</label>
                                    <input type="text" name="responsavel_legal_nome" id="responsavel_legal_nome" value="{{ old('responsavel_legal_nome', $estagiario->responsavel_legal_nome) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="responsavel_legal_cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF do Responsável</label>
                                    <input type="text" name="responsavel_legal_cpf" id="responsavel_legal_cpf" value="{{ old('responsavel_legal_cpf', $estagiario->responsavel_legal_cpf) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="000.000.000-00">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('estagiarios.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Atualizar Estagiário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
