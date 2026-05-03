<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\BrasilValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaConcedenteRequest extends FormRequest
{
    use BrasilValidationRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $excecaoCnpj = '82951328000158';
        $cnpjLimpo = preg_replace('/\D/', '', (string) $this->input('cnpj'));

        $cnpjRule = $cnpjLimpo === $excecaoCnpj
            ? $this->cnpjRegexRule('required')
            : $this->cnpjRegexRule('required|unique:empresa_concedentes,cnpj');

        return [
            'cnpj' => $cnpjRule,
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
