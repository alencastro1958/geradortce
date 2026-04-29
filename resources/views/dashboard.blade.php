<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
            {{ __('Dashboard do Gestor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Boas Vindas -->
            <div class="mb-8 bg-gradient-to-r from-indigo-600 to-blue-700 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold mb-2">Olá, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-indigo-100 text-lg max-w-2xl">Bem-vindo ao sistema Gerador de TCEs. Aqui você pode gerenciar todas as etapas do processo de estágio de forma automatizada e profissional.</p>
                </div>
                <!-- Círculos Decorativos -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 bg-white/10 w-64 h-64 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 bg-blue-400/20 w-80 h-80 rounded-full blur-3xl"></div>
            </div>

            <!-- Grid de Atalhos Rápidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Instituições -->
                <a href="{{ route('instituicoes.index') }}" class="group bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Instituições</h3>
                    <p class="text-gray-500 text-sm">Gerencie as IES parceiras e seus dados de contato.</p>
                </a>

                <!-- Empresas -->
                <a href="{{ route('empresas.index') }}" class="group bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Empresas</h3>
                    <p class="text-gray-500 text-sm">Controle as empresas concedentes de vagas de estágio.</p>
                </a>

                <!-- Estagiários -->
                <a href="{{ route('estagiarios.index') }}" class="group p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-orange-50 text-orange-600 rounded-2xl group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Estagiários</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestão de estudantes e responsáveis</p>
                </a>

                <!-- Seguradoras -->
                <a href="{{ route('seguradoras.index') }}" class="group p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-purple-50 text-purple-600 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Seguradoras</h3>
                    <p class="text-sm text-gray-500 mt-1">Apólices e coberturas</p>
                </a>

                <!-- Estágios -->
                <a href="{{ route('estagios.index') }}" class="group p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-orange-50 text-orange-600 rounded-2xl group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900">Estágios (TCEs)</h3>
                    <p class="text-sm text-gray-500 mt-1">Geração de termos e contratos</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
