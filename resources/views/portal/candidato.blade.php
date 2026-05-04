<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate-se — Alencastro Estágios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">

    {{-- Nav --}}
    <nav class="border-b border-slate-200 bg-white/95 backdrop-blur sticky top-0 z-10">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-600">Alencastro Estágios</p>
                <p class="text-lg font-black">Portal de Acesso</p>
            </div>
            <a href="{{ url('/vagas/oportunidades') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                Ver vagas disponíveis →
            </a>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl px-6 py-14">

        {{-- Cabeçalho --}}
        <div class="mb-12 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Bem-vindo</p>
            <h1 class="mt-2 text-4xl font-black leading-tight">Escolha como deseja acessar</h1>
            <p class="mt-3 text-slate-500">Selecione o portal correspondente ao seu perfil para realizar seu cadastro ou acessar sua conta.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 rounded-2xl border border-green-200 bg-green-50 px-5 py-3 text-sm text-green-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-3 text-sm text-red-800">{{ session('error') }}</div>
        @endif

        {{-- Cards --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Candidato --}}
            <div class="flex flex-col rounded-3xl bg-white p-7 shadow-xl ring-1 ring-slate-200 transition hover:shadow-2xl hover:-translate-y-1 duration-200">
                <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-black">Candidato</h2>
                <p class="mt-2 flex-1 text-sm text-slate-500">Estudante em busca de oportunidades de estágio. Acesse para criar seu perfil e se candidatar às vagas disponíveis.</p>
                <a href="{{ route('register') }}" class="mt-6 block rounded-2xl bg-indigo-600 px-4 py-3 text-center text-sm font-bold text-white transition hover:bg-indigo-500">
                    Cadastre-se como candidato
                </a>
                <a href="{{ route('login') }}" class="mt-2 block text-center text-xs text-slate-500 hover:text-indigo-600">
                    Já tenho cadastro → Entrar
                </a>
            </div>

            {{-- Instituição de Ensino --}}
            <div class="flex flex-col rounded-3xl bg-white p-7 shadow-xl ring-1 ring-slate-200 transition hover:shadow-2xl hover:-translate-y-1 duration-200">
                <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100 text-sky-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-black">Instituição de Ensino</h2>
                <p class="mt-2 flex-1 text-sm text-slate-500">Faculdades, universidades e escolas técnicas que desejam firmar convênio e acompanhar os estágios de seus alunos.</p>
                <a href="mailto:contato@rotacerta-aprendizagem.com.br" class="mt-6 block rounded-2xl bg-sky-600 px-4 py-3 text-center text-sm font-bold text-white transition hover:bg-sky-500">
                    Solicitar cadastro
                </a>
                <p class="mt-2 text-center text-xs text-slate-400">Entre em contato para iniciar o credenciamento</p>
            </div>

            {{-- Empresa --}}
            <div class="flex flex-col rounded-3xl bg-white p-7 shadow-xl ring-1 ring-slate-200 transition hover:shadow-2xl hover:-translate-y-1 duration-200">
                <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h2 class="text-xl font-black">Empresa</h2>
                <p class="mt-2 flex-1 text-sm text-slate-500">Empresas concedentes que desejam publicar vagas de estágio e gerenciar candidatos pela plataforma.</p>
                <a href="{{ route('empresa.login') }}" class="mt-6 block rounded-2xl bg-emerald-600 px-4 py-3 text-center text-sm font-bold text-white transition hover:bg-emerald-500">
                    Acessar portal da empresa
                </a>
                <p class="mt-2 text-center text-xs text-slate-400">Credenciais fornecidas pela Alencastro Estágios</p>
            </div>

            {{-- Vagas --}}
            <div class="flex flex-col rounded-3xl bg-slate-900 p-7 shadow-xl text-white transition hover:shadow-2xl hover:-translate-y-1 duration-200">
                <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-black">Vagas</h2>
                <p class="mt-2 flex-1 text-sm text-slate-300">Consulte todas as oportunidades de estágio disponíveis no momento, sem precisar de cadastro.</p>
                <a href="{{ url('/vagas/oportunidades') }}" class="mt-6 block rounded-2xl bg-white px-4 py-3 text-center text-sm font-bold text-slate-900 transition hover:bg-slate-100">
                    Ver oportunidades
                </a>
                <p class="mt-2 text-center text-xs text-slate-400">Acesso público — sem login necessário</p>
            </div>

        </div>

        {{-- Rodapé --}}
        <p class="mt-14 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} Alencastro Consultoria Estágios · <a href="mailto:contato@rotacerta-aprendizagem.com.br" class="hover:text-slate-600">contato@rotacerta-aprendizagem.com.br</a>
        </p>

    </main>
</body>
</html>
