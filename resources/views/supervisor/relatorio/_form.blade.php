{{-- Partial: formulário completo do relatório semestral --}}
@php
    $escala = \App\Models\Relatorio::$escalaCompetencias;
    $competencias = \App\Models\Relatorio::$competencias;
    $rel = $relatorio ?? null;
@endphp
<div class="space-y-8">

    {{-- ── 1. Semestre ─────────────────────────────────────────────────────── --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Semestre do Relatório *</label>
        <div class="flex flex-wrap gap-4">
            @foreach([1 => '1º Semestre', 2 => '2º Semestre', 3 => '3º Semestre', 4 => '4º Semestre'] as $val => $label)
                <label class="flex items-center gap-2 cursor-pointer {{ in_array($val, $semestresUsados) ? 'opacity-40 cursor-not-allowed' : '' }}">
                    <input type="radio" name="semestre" value="{{ $val }}"
                        {{ old('semestre', $rel->semestre ?? '') == $val ? 'checked' : '' }}
                        {{ in_array($val, $semestresUsados) ? 'disabled' : '' }}
                        required
                        class="text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('semestre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- ── 2. Período de referência ─────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Data de Início do Período</label>
            <input type="date" name="data_inicio_periodo"
                value="{{ old('data_inicio_periodo', $rel?->data_inicio_periodo?->format('Y-m-d')) }}"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            @error('data_inicio_periodo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Data de Fim do Período</label>
            <input type="date" name="data_fim_periodo"
                value="{{ old('data_fim_periodo', $rel?->data_fim_periodo?->format('Y-m-d')) }}"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            @error('data_fim_periodo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- ── 3. Atividades desenvolvidas ─────────────────────────────────────── --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Resumo das Atividades Desenvolvidas
            <span class="font-normal text-gray-400">(descreva as tarefas realizadas no período)</span>
        </label>
        <textarea name="atividades_descricao" rows="5" maxlength="3000"
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            placeholder="Descreva de forma clara e objetiva as atividades realizadas durante o semestre, relacionando-as com o Plano de Atividades do TCE...">{{ old('atividades_descricao', $rel?->atividades_descricao) }}</textarea>
        @error('atividades_descricao')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Relação com o Curso
        </label>
        <textarea name="relacao_curso" rows="3" maxlength="1000"
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            placeholder="Como as atividades contribuíram para a formação acadêmica e profissional do estagiário?">{{ old('relacao_curso', $rel?->relacao_curso) }}</textarea>
        @error('relacao_curso')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- ── 4. Competências individuais ─────────────────────────────────────── --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Avaliação de Competências</label>
        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-gray-700 w-56">Competência</th>
                        @foreach($escala as $val => $label)
                            <th class="px-3 py-3 text-center font-semibold text-gray-600">{{ $label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($competencias as $campo => $nomComp)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-800 font-medium">{{ $nomComp }}</td>
                            @foreach($escala as $val => $lbl)
                                <td class="px-3 py-3 text-center">
                                    <input type="radio" name="{{ $campo }}" value="{{ $val }}"
                                        {{ old($campo, $rel?->{$campo}) == $val ? 'checked' : '' }}
                                        class="text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                                </td>
                            @endforeach
                        </tr>
                        @error($campo)<tr><td colspan="6"><p class="text-red-500 text-xs px-4 pb-2">{{ $message }}</p></td></tr>@enderror
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── 5. Parecer descritivo ───────────────────────────────────────────── --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Parecer Descritivo do Supervisor
            <span class="font-normal text-gray-400">(pontos fortes, áreas de melhoria, evolução no semestre)</span>
        </label>
        <textarea name="parecer_descritivo" rows="4" maxlength="2000"
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            placeholder="Comentários sobre o desempenho, postura profissional e evolução do estagiário...">{{ old('parecer_descritivo', $rel?->parecer_descritivo) }}</textarea>
        @error('parecer_descritivo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- ── 6. Avaliação geral ──────────────────────────────────────────────── --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Avaliação Geral do Desempenho *</label>
        <div class="flex flex-wrap gap-4">
            @foreach(['excelente' => 'Excelente', 'bom' => 'Bom', 'regular' => 'Regular', 'insuficiente' => 'Insuficiente'] as $val => $label)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="avaliacao" value="{{ $val }}"
                        {{ old('avaliacao', $rel?->avaliacao) == $val ? 'checked' : '' }}
                        required
                        class="text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('avaliacao')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- ── 7. Frequência e carga horária ──────────────────────────────────── --}}
    <fieldset class="border border-gray-200 rounded-xl p-5">
        <legend class="text-sm font-semibold text-gray-700 px-2">Frequência e Carga Horária</legend>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-2">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Horas Previstas (TCE)</label>
                <input type="number" name="horas_previstas" min="0" max="9999"
                    value="{{ old('horas_previstas', $rel?->horas_previstas) }}"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Ex: 300">
                @error('horas_previstas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Horas Cumpridas</label>
                <input type="number" name="horas_cumpridas" min="0" max="9999"
                    value="{{ old('horas_cumpridas', $rel?->horas_cumpridas) }}"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Ex: 290">
                @error('horas_cumpridas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Faltas Justificadas</label>
                <input type="text" name="faltas_justificadas" maxlength="50"
                    value="{{ old('faltas_justificadas', $rel?->faltas_justificadas) }}"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Ex: 0 dias">
                @error('faltas_justificadas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Faltas Não Justificadas</label>
                <input type="text" name="faltas_nao_justificadas" maxlength="50"
                    value="{{ old('faltas_nao_justificadas', $rel?->faltas_nao_justificadas) }}"
                    class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    placeholder="Ex: 0 dias">
                @error('faltas_nao_justificadas')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-xs font-medium text-gray-600 mb-1">Observações sobre Ausências</label>
            <textarea name="obs_ausencias" rows="2" maxlength="1000"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                placeholder="Mencione motivos de faltas relevantes, atestados ou períodos de recesso...">{{ old('obs_ausencias', $rel?->obs_ausencias) }}</textarea>
            @error('obs_ausencias')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </fieldset>

    {{-- ── 8. Observações rápidas (legado) ────────────────────────────────── --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Observações Adicionais
            <span class="font-normal text-gray-400">(opcional, máx. 200 caracteres)</span>
        </label>
        <textarea name="observacoes" maxlength="200" rows="2"
            id="obs-rapidas"
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            placeholder="Anotações rápidas complementares...">{{ old('observacoes', $rel?->observacoes) }}</textarea>
        <p class="text-xs text-gray-400 mt-1">
            <span id="chars-used">{{ strlen(old('observacoes', $rel?->observacoes ?? '')) }}</span>/200 caracteres
        </p>
        @error('observacoes')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

</div>

<script>
    const obs = document.getElementById('obs-rapidas');
    const counter = document.getElementById('chars-used');
    if (obs && counter) {
        obs.addEventListener('input', () => { counter.textContent = obs.value.length; });
    }
</script>
