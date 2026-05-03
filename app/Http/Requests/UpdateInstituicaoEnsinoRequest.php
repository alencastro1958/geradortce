<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\BrasilValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstituicaoEnsinoRequest extends FormRequest
{
    use BrasilValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'cnpj' => $this->cnpjRegexRule(
                'required|' . Rule::unique('instituicao_ensinos', 'cnpj')->ignore($id)
            ),
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'mantenedora' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:50',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => $this->cepRegexRule(),
            'telefone' => 'nullable|string|max:255',
            'telefone_secundario' => 'nullable|string|max:255',
            'email' => $this->emailRule(),
            'email_secundario' => $this->emailRule(),
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => $this->cpfRegexRule(),
            'responsavel_legal_rg' => 'nullable|string|max:255',
            'responsavel_legal_email' => $this->emailRule(),
            'responsavel_legal_whatsapp' => 'nullable|string|max:255',
            'responsavel_legal_rg_orgao_emissor' => 'nullable|string|max:50',
            'responsavel_legal_rg_uf' => 'nullable|string|max:2',
            'responsavel_legal_nacionalidade' => 'nullable|string|max:100',
            'responsavel_legal_data_nascimento' => 'nullable|date',
            'responsavel_legal_celular' => 'nullable|string|max:20',
            'responsavel_legal_celular2' => 'nullable|string|max:20',
            'responsavel_legal_principal' => 'nullable|boolean',
            'responsavel_legal_ativo' => 'nullable|boolean',
            'responsavel_legal_assina_documentos' => 'nullable|boolean',
            'responsavel_legal_observacoes' => 'nullable|string',
            'contato_nome' => 'nullable|string|max:255',
            'contato_fone' => 'nullable|string|max:255',
            'contato_email' => 'nullable|email|max:255',
            'observacoes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return $this->brasilValidationMessages();
    }
}
