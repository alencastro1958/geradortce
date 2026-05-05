@php $ufs = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']; @endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
        <input type="text" name="nome" data-case="upper" value="{{ old('nome', $supervisor->nome ?? '') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('nome')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
        <input type="date" name="data_nascimento" value="{{ old('data_nascimento', isset($supervisor) && $supervisor?->data_nascimento ? $supervisor->data_nascimento->format('Y-m-d') : '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">CPF <span class="text-red-500">*</span></label>
        <input type="text" name="cpf" value="{{ old('cpf', $supervisor->cpf ?? '') }}" required
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('cpf') border-red-500 @enderror"
            placeholder="000.000.000-00">
        @error('cpf')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="grid grid-cols-3 gap-3">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">RG nº <span class="text-red-500">*</span></label>
            <input type="text" name="rg" value="{{ old('rg', $supervisor->rg ?? '') }}" required
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('rg') border-red-500 @enderror">
            @error('rg')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Órgão Emissor <span class="text-red-500">*</span></label>
            <input type="text" name="rg_orgao_emissor" value="{{ old('rg_orgao_emissor', $supervisor->rg_orgao_emissor ?? '') }}" required
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('rg_orgao_emissor') border-red-500 @enderror"
                placeholder="SSP">
            @error('rg_orgao_emissor')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">UF <span class="text-red-500">*</span></label>
            <select name="rg_uf" required
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('rg_uf') border-red-500 @enderror">
                <option value="">--</option>
                @foreach($ufs as $uf)
                    <option value="{{ $uf }}" {{ old('rg_uf', $supervisor->rg_uf ?? '') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                @endforeach
            </select>
            @error('rg_uf')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Cargo <span class="text-red-500">*</span></label>
        <input type="text" name="cargo" value="{{ old('cargo', $supervisor->cargo ?? '') }}" required
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('cargo') border-red-500 @enderror">
        @error('cargo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Celular <span class="text-red-500">*</span></label>
        <input type="text" name="celular" value="{{ old('celular', $supervisor->celular ?? '') }}" required
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('celular') border-red-500 @enderror"
            placeholder="(00) 00000-0000">
        @error('celular')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">E-mail <span class="text-red-500">*</span></label>
        <input type="email" name="email" value="{{ old('email', $supervisor->email ?? '') }}" required
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Formação <span class="text-red-500">*</span></label>
        <input type="text" name="formacao" value="{{ old('formacao', $supervisor->formacao ?? '') }}" required
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('formacao') border-red-500 @enderror">
        @error('formacao')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Órgão Regulamentador</label>
        <input type="text" name="orgao_regulamentador" value="{{ old('orgao_regulamentador', $supervisor->orgao_regulamentador ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ex: CRM, CREA...">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Registro Profissional</label>
        <input type="text" name="registro_profissional" value="{{ old('registro_profissional', $supervisor->registro_profissional ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Setor</label>
        <input type="text" name="setor" value="{{ old('setor', $supervisor->setor ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nº de Matrícula na Empresa</label>
        <input type="text" name="matricula" value="{{ old('matricula', $supervisor->matricula ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tempo de Experiência no Cargo <span class="text-red-500">*</span></label>
        <input type="text" name="tempo_atividade" value="{{ old('tempo_atividade', $supervisor->tempo_atividade ?? '') }}" required
            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('tempo_atividade') border-red-500 @enderror"
            placeholder="Ex: 3 anos">
        @error('tempo_atividade')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Outras Formações</label>
        <textarea name="outras_formacoes" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('outras_formacoes', $supervisor->outras_formacoes ?? '') }}</textarea>
    </div>
    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
        <textarea name="observacoes" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('observacoes', $supervisor->observacoes ?? '') }}</textarea>
    </div>
    <div class="col-span-2 grid grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ativo?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="radio" name="ativo" value="1" {{ old('ativo', $supervisor->ativo ?? true) ? 'checked' : '' }}> Sim</label>
                <label class="flex items-center gap-2"><input type="radio" name="ativo" value="0" {{ !old('ativo', $supervisor->ativo ?? true) ? 'checked' : '' }}> Não</label>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Acessa o Processo Seletivo?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="radio" name="acessa_processo_seletivo" value="1" {{ old('acessa_processo_seletivo', $supervisor->acessa_processo_seletivo ?? '') == '1' ? 'checked' : '' }}> Sim</label>
                <label class="flex items-center gap-2"><input type="radio" name="acessa_processo_seletivo" value="0" {{ old('acessa_processo_seletivo', $supervisor->acessa_processo_seletivo ?? '') == '0' ? 'checked' : '' }}> Não</label>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Assina Documentos?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="radio" name="assina_documentos" value="1" {{ old('assina_documentos', $supervisor->assina_documentos ?? '') == '1' ? 'checked' : '' }}> Sim</label>
                <label class="flex items-center gap-2"><input type="radio" name="assina_documentos" value="0" {{ old('assina_documentos', $supervisor->assina_documentos ?? '') == '0' ? 'checked' : '' }}> Não</label>
            </div>
        </div>
    </div>
</div>
