@php $ufs = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']; @endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
        <input type="text" name="nome" value="{{ old('nome', $representante->nome ?? '') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('nome')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
        <input type="text" name="cpf" value="{{ old('cpf', $representante->cpf ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="000.000.000-00">
    </div>
    <div class="grid grid-cols-3 gap-3">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">RG nº</label>
            <input type="text" name="rg" value="{{ old('rg', $representante->rg ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Órgão Emissor</label>
            <input type="text" name="rg_orgao_emissor" value="{{ old('rg_orgao_emissor', $representante->rg_orgao_emissor ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="SSP">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">UF</label>
            <select name="rg_uf" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">--</option>
                @foreach($ufs as $uf)
                    <option value="{{ $uf }}" {{ old('rg_uf', $representante->rg_uf ?? '') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Cargo</label>
        <input type="text" name="cargo" value="{{ old('cargo', $representante->cargo ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nacionalidade</label>
        <input type="text" name="nacionalidade" value="{{ old('nacionalidade', $representante->nacionalidade ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Brasileiro(a)">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
        <input type="date" name="data_nascimento" value="{{ old('data_nascimento', isset($representante) && $representante?->data_nascimento ? $representante->data_nascimento->format('Y-m-d') : '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
        <input type="email" name="email" value="{{ old('email', $representante->email ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
        <input type="text" name="celular" value="{{ old('celular', $representante->celular ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="(00) 00000-0000">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Celular 2</label>
        <input type="text" name="celular2" value="{{ old('celular2', $representante->celular2 ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="(00) 00000-0000">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
        <input type="text" name="whatsapp" value="{{ old('whatsapp', $representante->whatsapp ?? '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="(00) 00000-0000">
    </div>
    <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
        <textarea name="observacoes" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('observacoes', $representante->observacoes ?? '') }}</textarea>
    </div>
    <div class="col-span-2 grid grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Principal?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="radio" name="principal" value="1" {{ old('principal', $representante->principal ?? false) ? 'checked' : '' }}> Sim</label>
                <label class="flex items-center gap-2"><input type="radio" name="principal" value="0" {{ !old('principal', $representante->principal ?? false) ? 'checked' : '' }}> Não</label>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ativo?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="radio" name="ativo" value="1" {{ old('ativo', $representante->ativo ?? true) ? 'checked' : '' }}> Sim</label>
                <label class="flex items-center gap-2"><input type="radio" name="ativo" value="0" {{ !old('ativo', $representante->ativo ?? true) ? 'checked' : '' }}> Não</label>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Assina Documentos?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2"><input type="radio" name="assina_documentos" value="1" {{ old('assina_documentos', $representante->assina_documentos ?? false) ? 'checked' : '' }}> Sim</label>
                <label class="flex items-center gap-2"><input type="radio" name="assina_documentos" value="0" {{ !old('assina_documentos', $representante->assina_documentos ?? false) ? 'checked' : '' }}> Não</label>
            </div>
        </div>
    </div>
</div>
