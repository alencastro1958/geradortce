{{-- Partial: formulário do relatório semestral --}}
<div class="space-y-6">

    {{-- Semestre --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Semestre do Relatório *</label>
        <div class="flex flex-wrap gap-4">
            @foreach([1 => '1º Semestre', 2 => '2º Semestre', 3 => '3º Semestre', 4 => '4º Semestre'] as $val => $label)
                <label class="flex items-center gap-2 cursor-pointer {{ in_array($val, $semestresUsados) ? 'opacity-40 cursor-not-allowed' : '' }}">
                    <input type="radio" name="semestre" value="{{ $val }}"
                        {{ old('semestre', $relatorio->semestre ?? '') == $val ? 'checked' : '' }}
                        {{ in_array($val, $semestresUsados) ? 'disabled' : '' }}
                        required
                        class="text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('semestre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Avaliação --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Avaliação do Desempenho *</label>
        <div class="flex flex-wrap gap-4">
            @foreach(['excelente' => 'Excelente', 'bom' => 'Bom', 'regular' => 'Regular', 'insuficiente' => 'Insuficiente'] as $val => $label)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="avaliacao" value="{{ $val }}"
                        {{ old('avaliacao', $relatorio->avaliacao ?? '') == $val ? 'checked' : '' }}
                        required
                        class="text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('avaliacao')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Observações --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Observações
            <span class="font-normal text-gray-400">(máx. 200 caracteres)</span>
        </label>
        <textarea name="observacoes" maxlength="200" rows="4"
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            placeholder="Comentários sobre o desempenho do estagiário...">{{ old('observacoes', $relatorio->observacoes ?? '') }}</textarea>
        <p class="text-xs text-gray-400 mt-1" id="char-count">
            <span id="chars-used">{{ strlen(old('observacoes', $relatorio->observacoes ?? '')) }}</span>/200 caracteres
        </p>
        @error('observacoes')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

</div>

<script>
    const obs = document.querySelector('[name="observacoes"]');
    const counter = document.getElementById('chars-used');
    if (obs && counter) {
        obs.addEventListener('input', () => { counter.textContent = obs.value.length; });
    }
</script>
