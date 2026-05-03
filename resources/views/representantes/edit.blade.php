<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800">Editar Representante Legal</h2>
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
                <form method="POST" action="{{ route('representantes.update', $representante) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    @include('representantes._form', ['representante' => $representante])
                    <div class="flex justify-end gap-4 pt-6 border-t">
                        <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl text-gray-700 hover:bg-gray-100">Cancelar</a>
                        <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-500 hover:to-teal-500 shadow-lg">Atualizar Representante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
