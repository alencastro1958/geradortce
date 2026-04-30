<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
            {{ __('Abrir Nova Vaga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('vagas.store') }}" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label for="empresa_id" class="block text-sm font-medium text-gray-700 mb-1">Empresa Ofertante *</label>
                                <select name="empresa_id" id="empresa_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    <option value="">Selecione a empresa</option>
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->razao_social }} ({{ $empresa->cnpj }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-2">
                                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título da Vaga *</label>
                                <input type="text" name="titulo" id="titulo" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Ex: Estagiário de Administração">
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label for="area_atuacao" class="block text-sm font-medium text-gray-700 mb-1">Área de Atuação *</label>
                                <input type="text" name="area_atuacao" id="area_atuacao" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Ex: Financeiro, TI, RH">
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label for="bolsa_auxilio" class="block text-sm font-medium text-gray-700 mb-1">Bolsa Auxílio (R$)</label>
                                <input type="number" step="0.01" name="bolsa_auxilio" id="bolsa_auxilio" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="0.00">
                            </div>

                            <div class="col-span-2">
                                <label for="horario" class="block text-sm font-medium text-gray-700 mb-1">Horário / Carga Horária *</label>
                                <input type="text" name="horario" id="horario" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Ex: 08:00 às 12:00 (20h semanais)">
                            </div>

                            <div class="col-span-2">
                                <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição da Vaga e Requisitos *</label>
                                <textarea name="descricao" id="descricao" rows="5" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Detalhe as atividades e o que se espera do candidato..."></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('vagas.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Publicar Vaga
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
