<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha – Portal do Supervisor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-indigo-100 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Recuperar Acesso</h1>
                <p class="text-sm text-gray-500 mt-1">Portal do Supervisor – Alencastro Estágios</p>
            </div>

            @if(session('status'))
                <div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <p class="text-sm text-gray-600 mb-5">
                Informe o e-mail cadastrado como supervisor. Enviaremos um link para você criar uma nova senha.
            </p>

            <form method="POST" action="{{ route('supervisor.password.email') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2"
                        placeholder="seu@email.com.br">
                </div>
                <button type="submit"
                    class="w-full py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg transition">
                    Enviar link de redefinição
                </button>
            </form>

            <div class="mt-5 text-center">
                <a href="{{ route('supervisor.login') }}" class="text-sm text-indigo-600 hover:underline">
                    ← Voltar ao login
                </a>
            </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-4">
            &copy; {{ date('Y') }} Alencastro Consultoria – Todos os direitos reservados
        </p>
    </div>
</body>
</html>
