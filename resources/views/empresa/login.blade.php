<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso da Empresa - Portal de Vagas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top,_#eff6ff,_#dbeafe_45%,_#f8fafc_100%)] flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="rounded-[28px] border border-white/70 bg-white/90 shadow-2xl backdrop-blur p-8">
            <div class="mb-8 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-600">Portal da Empresa</p>
                <h1 class="mt-3 text-3xl font-black text-slate-900">Cadastro de Vagas</h1>
                <p class="mt-2 text-sm text-slate-500">Acesso exclusivo para empresas conveniadas.</p>
            </div>

            @if($errors->any())
                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('empresa.login.submit') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border-slate-200 px-4 py-3 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Senha</label>
                    <input type="password" name="password" required class="w-full rounded-2xl border-slate-200 px-4 py-3 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                    Manter-me conectado
                </label>
                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-bold uppercase tracking-[0.2em] text-white transition hover:bg-sky-600">
                    Entrar
                </button>
                <div class="text-center">
                    <a href="{{ url('/forgot-password') }}" class="text-xs text-slate-500 hover:text-sky-600 hover:underline">
                        Esqueci minha senha
                    </a>
                </div>
            </form>
            <div class="mt-6 border-t border-slate-100 pt-5 text-center">
                <p class="text-xs text-slate-500">Estudante buscando oportunidades de estágio?</p>
                <a href="{{ url('/vagas/oportunidades') }}" class="mt-1 inline-block text-sm font-semibold text-sky-600 hover:underline">
                    Acessar o Portal de Vagas →
                </a>
                <p class="mt-1 text-xs text-slate-400">{{ url('/vagas/oportunidades') }}</p>
            </div>
        </div>
    </div>
</body>
</html>