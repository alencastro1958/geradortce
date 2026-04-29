<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('instituicoes.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Instituições de Ensino</h5>
                        <p class="font-normal text-gray-700">Gerenciar IES parceiras</p>
                    </a>
                    
                    <a href="{{ route('empresas.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Empresas Concedentes</h5>
                        <p class="font-normal text-gray-700">Gerenciar empresas de estágio</p>
                    </a>

                    <a href="{{ route('estagiarios.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Estagiários</h5>
                        <p class="font-normal text-gray-700">Gerenciar alunos e dados</p>
                    </a>

                    <a href="{{ route('estagios.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Estágios (TCEs)</h5>
                        <p class="font-normal text-gray-700">Gerenciar termos de compromisso</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
