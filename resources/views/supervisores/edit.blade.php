<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('empresas.edit', $empresa) }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-gray-800">Editar Supervisor de Estágio</h2>
                <p class="text-sm text-gray-500">{{ $empresa->nome_fantasia ?? $empresa->razao_social }}</p>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <ul class="list-disc list-inside text-sm text-red-700">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('supervisores.update', [$empresa, $supervisor]) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    @include('supervisores._form', ['supervisor' => $supervisor])
                    <div class="flex justify-end gap-4 pt-6 border-t">
                        <a href="{{ route('empresas.edit', $empresa) }}" class="px-6 py-3 rounded-xl text-gray-700 hover:bg-gray-100">Cancelar</a>
                        <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg">Atualizar Supervisor</button>
                    </div>
                </form>

                {{-- Acesso ao Portal do Supervisor --}}
                <div class="mt-8 pt-6 border-t">
                    <h3 class="font-bold text-gray-700 mb-3">Acesso ao Portal do Supervisor</h3>
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-xl text-sm text-green-800">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-800">{{ session('error') }}</div>
                    @endif

                    @if($supervisor->user_id)
                        <p class="text-sm text-green-700 mb-3">✓ Acesso ativo &mdash; Login: <strong>{{ $supervisor->email }}</strong></p>
                        <form method="POST" action="{{ route('supervisor.revogar-acesso', $supervisor) }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Revogar acesso de {{ $supervisor->nome }}?')"
                                class="px-5 py-2 rounded-xl border border-red-500 text-red-600 text-sm hover:bg-red-50 transition">
                                Revogar Acesso
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-gray-500 mb-1">Este supervisor ainda não possui acesso ao Portal. Crie um login abaixo.</p>
                        <p class="text-sm text-gray-700 mb-4">Login (e-mail): <strong>{{ $supervisor->email }}</strong></p>
                        <form method="POST" action="{{ route('supervisor.criar-acesso', $supervisor) }}"
                            class="flex flex-wrap gap-4 items-end"
                            x-data="{ show1: false, show2: false }">
                            @csrf
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Senha</label>
                                <div class="relative">
                                    <input :type="show1 ? 'text' : 'password'" name="password" required minlength="8"
                                        placeholder="Mínimo 8 caracteres"
                                        class="rounded-xl border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 pr-10 w-52">
                                    <button type="button" @click="show1 = !show1"
                                        class="absolute inset-y-0 right-2 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg x-show="!show1" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg x-show="show1" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Confirmar Senha</label>
                                <div class="relative">
                                    <input :type="show2 ? 'text' : 'password'" name="password_confirmation" required
                                        placeholder="Repita a senha"
                                        class="rounded-xl border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 pr-10 w-52">
                                    <button type="button" @click="show2 = !show2"
                                        class="absolute inset-y-0 right-2 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg x-show="!show2" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg x-show="show2" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                    </button>
                                </div>
                            </div>
                            <button type="submit"
                                class="px-6 py-2 rounded-xl font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 shadow text-sm transition">
                                Criar Acesso
                            </button>
                        </form>
                        @error('password')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
