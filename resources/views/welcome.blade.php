<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rota Certa - Automação de TCEs e Estágios</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .bg-grid {
                background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
                background-size: 40px 40px;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900 bg-grid">
        <div class="relative min-h-screen">
            <!-- Navigation -->
            <nav class="sticky top-0 z-50 w-full glass">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 flex items-center gap-2">
                                <div class="p-2 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="text-2xl font-extrabold tracking-tight text-slate-900">
                                    Rota<span class="text-indigo-600">Certa</span>
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Painel de Controle</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Entrar</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Criar Conta</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <main>
                <div class="relative pt-16 pb-32 overflow-hidden">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                        <div class="text-center">
                            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight mb-8">
                                A maneira mais inteligente de <br>
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">gerar contratos de estágio</span>
                            </h1>
                            <p class="mt-4 text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                                Automatize a emissão de TCEs, gerencie seguros e mantenha o compliance jurídico da sua instituição de ensino em um só lugar.
                            </p>
                            <div class="mt-12 flex justify-center gap-4">
                                <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-all">
                                    Começar Agora Gratuitamente
                                </a>
                                <a href="#features" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold text-lg shadow-sm hover:bg-slate-50 transition-all">
                                    Ver Funcionalidades
                                </a>
                            </div>
                        </div>

                        <!-- Dashboard Preview -->
                        <div class="mt-20 relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 to-transparent z-10"></div>
                            <div class="rounded-3xl shadow-2xl border border-white/50 overflow-hidden glass p-4">
                                <div class="rounded-2xl overflow-hidden bg-slate-900 aspect-video flex items-center justify-center">
                                    <div class="text-center space-y-4">
                                        <div class="inline-flex p-4 bg-white/10 rounded-full animate-pulse">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-indigo-200 font-medium">Assista como funciona em 2 minutos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div id="features" class="py-24 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                            <!-- Feature 1 -->
                            <div class="group p-8 rounded-3xl bg-slate-50 border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-indigo-100 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-4 text-slate-900">Emissão Instantânea</h3>
                                <p class="text-slate-600 leading-relaxed">Gere o Termo de Compromisso de Estágio (TCE) em segundos com dados pré-preenchidos.</p>
                            </div>

                            <!-- Feature 2 -->
                            <div class="group p-8 rounded-3xl bg-slate-50 border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-100 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-4 text-slate-900">Seguros Integrados</h3>
                                <p class="text-slate-600 leading-relaxed">Mantenha o controle das apólices e seguradoras, garantindo a proteção total do estagiário.</p>
                            </div>

                            <!-- Feature 3 -->
                            <div class="group p-8 rounded-3xl bg-slate-50 border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                                <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-100 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-4 text-slate-900">Compliance Legal</h3>
                                <p class="text-slate-600 leading-relaxed">Contratos padronizados de acordo com a lei 11.788, evitando riscos jurídicos.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="bg-slate-50 border-t border-slate-200 py-12">
                    <div class="max-w-7xl mx-auto px-4 text-center">
                        <p class="text-slate-500">&copy; {{ date('Y') }} Rota Certa Aprendizagem. Todos os direitos reservados.</p>
                    </div>
                </footer>
            </main>
        </div>
    </body>
</html>
