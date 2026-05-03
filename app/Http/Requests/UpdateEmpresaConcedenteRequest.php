<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\BrasilValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmpresaConcedenteRequest extends FormRequest
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
        $empresa = $this->route('empresa');
        $empresaId = is_object($empresa) ? $empresa->id : $empresa;

        $excecaoCnpj = '82951328000158';
        $cnpjLimpo = preg_replace('/\D/', '', (string) $this->input('cnpj'));

        $uniqueRule = Rule::unique('empresa_concedentes', 'cnpj')->ignore($empresaId);
        $cnpjRuleBase = $cnpjLimpo === $excecaoCnpj ? 'required' : 'required|' . $uniqueRule;

        return [
            'cnpj' => $this->cnpjRegexRule($cnpjRuleBase),
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
            'email' => $this->emailRule(),
            'email_secundario' => $this->emailRule(),
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => $this->cpfRegexRule(),
            'responsavel_legal_rg' => 'nullable|string|max:255',
            'responsavel_legal_email' => $this->emailRule(),
            'responsavel_legal_whatsapp' => 'nullable|string|max:255',
            'autoriza_envio_mensagens' => 'nullable|boolean',
            'supervisor_nome' => 'nullable|string|max:255',
            'supervisor_cargo' => 'nullable|string|max:100',
            'supervisor_formacao' => 'nullable|string|max:255',
            'supervisor_tempo_atividade' => 'nullable|string|max:100',
            'supervisor_cpf' => $this->cpfRegexRule(),
            'supervisor_rg' => 'nullable|string|max:20',
            'supervisor_email' => $this->emailRule(),
            'supervisor_telefone_whatsapp' => 'nullable|string|max:20',
            'supervisor_registro_profissional' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return $this->brasilValidationMessages();
    }
}
