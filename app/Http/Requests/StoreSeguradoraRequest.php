<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\BrasilValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreSeguradoraRequest extends FormRequest
{
    use BrasilValidationRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'razao_social' => 'nullable|string|max:255',
            'cnpj' => $this->cnpjRegexRule(),
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:50',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => $this->cepRegexRule(),
            'telefone' => 'nullable|string|max:255',
            'email' => $this->emailRule(),
            'apolice_numero' => 'nullable|string|max:255',
            'valor_cobertura' => 'nullable|numeric',
            'capital_segurado' => 'nullable|numeric',
            'inicio_vigencia' => 'nullable|date',
            'fim_vigencia' => 'nullable|date',
            'susep_vida_em_grupo' => 'nullable|string|max:255',
            'susep_acidentes_pessoais' => 'nullable|string|max:255',
            'capital_morte_acidental' => 'nullable|numeric',
            'capital_morte_acidental_extenso' => 'nullable|string|max:255',
            'arquivo_apolice' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }

    public function messages(): array
    {
        return $this->brasilValidationMessages();
    }
}
