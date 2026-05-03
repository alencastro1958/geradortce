<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\BrasilValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreEstagiarioRequest extends FormRequest
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
            'cpf' => $this->cpfRegexRule('required|unique:estagiarios,cpf'),
            'rg' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'estado_civil' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:50',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => $this->cepRegexRule(),
            'telefone' => 'nullable|string|max:255',
            'email' => $this->emailRule(),
            'curso' => 'nullable|string|max:255',
            'semestre_atual' => 'nullable|integer',
            'periodo' => 'nullable|string|max:255',
            'semestre_periodo_serie' => 'nullable|string|max:255',
            'curso_data_inicio' => 'nullable|string|max:50',
            'curso_data_conclusao_prevista' => 'nullable|string|max:50',
            'matricula' => 'nullable|string|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => $this->cpfRegexRule(),
        ];
    }

    public function messages(): array
    {
        return $this->brasilValidationMessages();
    }
}
