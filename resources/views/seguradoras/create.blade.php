<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('seguradoras.index') }}" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-3xl bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 leading-tight">
                {{ __('Cadastrar Nova Seguradora') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-xl shadow-2xl sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('seguradoras.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-1">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="00.000.000/0000-00">
                            @error('cnpj') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome da Seguradora *</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Ex: Porto Seguro, SulAmérica...">
                            @error('nome') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="razao_social" class="block text-sm font-medium text-gray-700 mb-1">Razão Social</label>
                            <input type="text" name="razao_social" id="razao_social" value="{{ old('razao_social') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Razão Social completa">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                                <input type="text" name="cep" id="cep" value="{{ old('cep') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="00000-000">
                            </div>
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                <input type="text" name="estado" id="estado" value="{{ old('estado') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="UF">
                            </div>
                        </div>

                        <div>
                            <label for="logradouro" class="block text-sm font-medium text-gray-700 mb-1">Logradouro</label>
                            <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Rua, avenida, etc.">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="numero" class="block text-sm font-medium text-gray-700 mb-1">Nº do Logradouro</label>
                                <input type="text" name="numero" id="numero" value="{{ old('numero') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="complemento" class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                                <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="bairro" class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="cidade" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="apolice_numero" class="block text-sm font-medium text-gray-700 mb-1">Número da Apólice</label>
                            <input type="text" name="apolice_numero" id="apolice_numero" value="{{ old('apolice_numero') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Número do contrato ou apólice coletiva">
                            @error('apolice_numero') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="susep_vida_em_grupo" class="block text-sm font-medium text-gray-700 mb-1">Processo SUSEP Vida em Grupo</label>
                                <input type="text" name="susep_vida_em_grupo" id="susep_vida_em_grupo" value="{{ old('susep_vida_em_grupo') }}" placeholder="Ex: 001-065570/95" maxlength="30" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="susep_acidentes_pessoais" class="block text-sm font-medium text-gray-700 mb-1">Processo SUSEP Acidentes Pessoais</label>
                                <input type="text" name="susep_acidentes_pessoais" id="susep_acidentes_pessoais" value="{{ old('susep_acidentes_pessoais') }}" placeholder="Ex: 10.003496/01-54" maxlength="30" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="capital_morte_acidental" class="block text-sm font-medium text-gray-700 mb-1">Capital Segurado (Morte Acidental)</label>
                                <input type="number" step="0.01" name="capital_morte_acidental" id="capital_morte_acidental" value="{{ old('capital_morte_acidental') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="0,00">
                            </div>
                            <div>
                                <label for="capital_morte_acidental_extenso" class="block text-sm font-medium text-gray-700 mb-1">Capital Segurado por Extenso</label>
                                <input type="text" name="capital_morte_acidental_extenso" id="capital_morte_acidental_extenso" value="{{ old('capital_morte_acidental_extenso') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="arquivo_apolice" class="block text-sm font-medium text-gray-700 mb-1">Arquivo da Apólice (PDF/Imagem)</label>
                            <input type="file" name="arquivo_apolice" id="arquivo_apolice" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('arquivo_apolice') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Pessoa de Contato -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Pessoa de Contato
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2 md:col-span-1">
                                    <label for="contato_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                    <input type="text" name="contato_nome" id="contato_nome" value="{{ old('contato_nome') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="contato_fone" class="block text-sm font-medium text-gray-700 mb-1">Fone</label>
                                    <input type="text" name="contato_fone" id="contato_fone" value="{{ old('contato_fone') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label for="contato_email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="contato_email" id="contato_email" value="{{ old('contato_email') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div class="col-span-2">
                                    <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                                    <textarea name="observacoes" id="observacoes" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">{{ old('observacoes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Representante Legal -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mb-6 mt-8 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Representante Legal
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                    <input type="text" name="responsavel_legal_nome" value="{{ old('responsavel_legal_nome') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                                    <input type="text" name="responsavel_legal_cpf" value="{{ old('responsavel_legal_cpf') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="000.000.000-00">
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">RG nº</label>
                                        <input type="text" name="responsavel_legal_rg" value="{{ old('responsavel_legal_rg') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Órgão Emissor</label>
                                        <input type="text" name="responsavel_legal_rg_orgao_emissor" value="{{ old('responsavel_legal_rg_orgao_emissor') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="SSP">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">UF</label>
                                        <select name="responsavel_legal_rg_uf" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                            <option value="">--</option>
                                            @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf)
                                                <option value="{{ $uf }}" {{ old('responsavel_legal_rg_uf') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cargo</label>
                                    <input type="text" name="responsavel_legal_cargo" value="{{ old('responsavel_legal_cargo') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nacionalidade</label>
                                    <input type="text" name="responsavel_legal_nacionalidade" value="{{ old('responsavel_legal_nacionalidade') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="Brasileiro(a)">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                                    <input type="date" name="responsavel_legal_data_nascimento" value="{{ old('responsavel_legal_data_nascimento') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                    <input type="email" name="responsavel_legal_email" value="{{ old('responsavel_legal_email') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
                                    <input type="text" name="responsavel_legal_celular" value="{{ old('responsavel_legal_celular') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Celular 2</label>
                                    <input type="text" name="responsavel_legal_celular2" value="{{ old('responsavel_legal_celular2') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                                    <input type="text" name="responsavel_legal_whatsapp" value="{{ old('responsavel_legal_whatsapp') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md" placeholder="(00) 00000-0000">
                                </div>
                                <div class="col-span-2 grid grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Principal?</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_principal" value="1" {{ old('responsavel_legal_principal') == '1' ? 'checked' : '' }}> Sim</label>
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_principal" value="0" {{ old('responsavel_legal_principal', '0') == '0' ? 'checked' : '' }}> Não</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Ativo?</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_ativo" value="1" {{ old('responsavel_legal_ativo', '1') == '1' ? 'checked' : '' }}> Sim</label>
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_ativo" value="0" {{ old('responsavel_legal_ativo') == '0' ? 'checked' : '' }}> Não</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Assina Documentos?</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_assina_documentos" value="1" {{ old('responsavel_legal_assina_documentos') == '1' ? 'checked' : '' }}> Sim</label>
                                            <label class="flex items-center gap-2"><input type="radio" name="responsavel_legal_assina_documentos" value="0" {{ old('responsavel_legal_assina_documentos', '0') == '0' ? 'checked' : '' }}> Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                                    <textarea name="responsavel_legal_observacoes" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-shadow hover:shadow-md">{{ old('responsavel_legal_observacoes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-8 border-t border-gray-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
