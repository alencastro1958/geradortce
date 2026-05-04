<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relatório – Portal do Supervisor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white border-b shadow-sm px-6 py-4 flex items-center justify-between">
        <div>
            <a href="{{ route('supervisor.dashboard') }}" class="text-indigo-600 hover:underline text-sm">← Voltar</a>
            <span class="font-bold text-lg text-indigo-700 ml-4">Editar Relatório – {{ $relatorio->labelSemestre() }}</span>
        </div>
        <form method="POST" action="{{ route('supervisor.logout') }}">@csrf
            <button type="submit" class="text-sm text-red-600 hover:underline">Sair</button>
        </form>
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-indigo-50 rounded-2xl p-4 mb-6 text-sm text-indigo-900">
            <strong>Estagiário:</strong> {{ $estagio->estagiario->nome }}
            &nbsp;|&nbsp;
            <strong>CPF:</strong> {{ $estagio->estagiario->cpf }}
        </div>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('supervisor.relatorio.atualizar', $relatorio) }}" class="bg-white rounded-2xl shadow p-8 space-y-6">
            @csrf
            @method('PUT')

            @include('supervisor.relatorio._form')

            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('supervisor.dashboard') }}" class="px-6 py-3 rounded-xl text-gray-700 hover:bg-gray-100">Cancelar</a>
                <button type="submit" name="finalizar" value="0"
                    class="px-6 py-3 rounded-xl border border-indigo-600 text-indigo-600 font-semibold hover:bg-indigo-50 transition">
                    Salvar Rascunho
                </button>
                <button type="submit" name="finalizar" value="1"
                    class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 shadow transition">
                    Finalizar e Gerar PDF
                </button>
            </div>
        </form>
    </div>
</body>
</html>
