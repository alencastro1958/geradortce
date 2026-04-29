<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('estagios.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Gerar Novo TCE (Estágio)') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('estagios.store') }}" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Estagiário -->
                            <div class="md:col-span-2">
                                <label for="estagiario_id" class="block text-sm font-bold text-gray-700 mb-2">Estagiário *</label>
                                <select name="estagiario_id" id="estagiario_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                    <option value="">Selecione o estagiário</option>
                                    @foreach($estagiarios as $estagiario)
                                        <option value="{{ $estagiario->id }}" {{ old('estagiario_id') == $estagiario->id ? 'selected' : '' }}>
                                            {{ $estagiario->nome }} ({{ $estagiario->cpf }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('estagiario_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Empresa Concedente -->
                            <div>
                                <label for="empresa_concedente_id" class="block text-sm font-bold text-gray-700 mb-2">Empresa Concedente *</label>
                                <select name="empresa_concedente_id" id="empresa_concedente_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                    <option value="">Selecione a empresa</option>
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id }}" {{ old('empresa_concedente_id') == $empresa->id ? 'selected' : '' }}>
                                            {{ $empresa->nome_fantasia }} ({{ $empresa->cnpj }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('empresa_concedente_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Instituição de Ensino -->
                            <div>
                                <label for="instituicao_ensino_id" class="block text-sm font-bold text-gray-700 mb-2">Instituição de Ensino *</label>
                                <select name="instituicao_ensino_id" id="instituicao_ensino_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                    <option value="">Selecione a instituição</option>
                                    @foreach($instituicoes as $instituicao)
                                        <option value="{{ $instituicao->id }}" {{ old('instituicao_ensino_id') == $instituicao->id ? 'selected' : '' }}>
                                            {{ $instituicao->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instituicao_ensino_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Seguradora -->
                            <div>
                                <label for="seguradora_id" class="block text-sm font-bold text-gray-700 mb-2">Seguradora (Opcional)</label>
                                <select name="seguradora_id" id="seguradora_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                    <option value="">Selecione a seguradora</option>
                                    @foreach($seguradoras as $seguradora)
                                        <option value="{{ $seguradora->id }}" {{ old('seguradora_id') == $seguradora->id ? 'selected' : '' }}>
                                            {{ $seguradora->nome }} ({{ $seguradora->apolice_numero }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('seguradora_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Status do Estágio *</label>
                                <select name="status" id="status" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                    <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="ativo" {{ old('status', 'ativo') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="concluido" {{ old('status') == 'concluido' ? 'selected' : '' }}>Concluído</option>
                                    <option value="rescindido" {{ old('status') == 'rescindido' ? 'selected' : '' }}>Rescindido</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-gray-100 pt-8">
                            <!-- Datas -->
                            <div>
                                <label for="data_inicio" class="block text-sm font-bold text-gray-700 mb-2">Data de Início *</label>
                                <input type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                @error('data_inicio') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="data_fim" class="block text-sm font-bold text-gray-700 mb-2">Data de Término *</label>
                                <input type="date" name="data_fim" id="data_fim" value="{{ old('data_fim') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow">
                                @error('data_fim') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="carga_horaria_semanal" class="block text-sm font-bold text-gray-700 mb-2">Carga Horária (Semanal) *</label>
                                <div class="relative">
                                    <input type="number" name="carga_horaria_semanal" id="carga_horaria_semanal" value="{{ old('carga_horaria_semanal', 30) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow" placeholder="Horas">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">hrs</span>
                                    </div>
                                </div>
                                @error('carga_horaria_semanal') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 pt-8">
                            <!-- Valores -->
                            <div>
                                <label for="valor_bolsa" class="block text-sm font-bold text-gray-700 mb-2">Valor da Bolsa Auxílio (R$)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">R$</span>
                                    </div>
                                    <input type="number" step="0.01" name="valor_bolsa" id="valor_bolsa" value="{{ old('valor_bolsa') }}" class="w-full rounded-xl border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow" placeholder="0,00">
                                </div>
                                @error('valor_bolsa') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="valor_auxilio_transporte" class="block text-sm font-bold text-gray-700 mb-2">Auxílio Transporte (R$)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">R$</span>
                                    </div>
                                    <input type="number" step="0.01" name="valor_auxilio_transporte" id="valor_auxilio_transporte" value="{{ old('valor_auxilio_transporte') }}" class="w-full rounded-xl border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow" placeholder="0,00">
                                </div>
                                @error('valor_auxilio_transporte') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-8">
                            <label for="atividades" class="block text-sm font-bold text-gray-700 mb-2">Atividades a serem desenvolvidas</label>
                            <textarea name="atividades" id="atividades" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow" placeholder="Descreva as principais tarefas do estagiário...">{{ old('atividades') }}</textarea>
                            @error('atividades') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-10 mt-10 border-t border-gray-100">
                            <a href="{{ route('estagios.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-10 py-4 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-2xl hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                Gerar Registro de Estágio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
