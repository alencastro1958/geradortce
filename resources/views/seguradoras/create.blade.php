<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('seguradoras.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Cadastrar Nova Seguradora') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('seguradoras.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome da Seguradora *</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Ex: Porto Seguro, SulAmérica...">
                            @error('nome') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="apolice_numero" class="block text-sm font-medium text-gray-700 mb-1">Número da Apólice</label>
                            <input type="text" name="apolice_numero" id="apolice_numero" value="{{ old('apolice_numero') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Número do contrato ou apólice coletiva">
                            @error('apolice_numero') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                            <a href="{{ route('seguradoras.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                Salvar Seguradora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
