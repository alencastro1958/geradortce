<?php

namespace App\Http\Requests\Concerns;

trait BrasilValidationRules
{
    protected function cnpjRegexRule(string $baseRule = 'nullable'): string
    {
        return $baseRule . '|regex:/^\d{2}\.?\d{3}\.?\d{3}\/?\d{4}-?\d{2}$/';
    }

    protected function cpfRegexRule(string $baseRule = 'nullable'): string
    {
        return $baseRule . '|regex:/^\d{3}\.?\d{3}\.?\d{3}-?\d{2}$/';
    }

    protected function cepRegexRule(string $baseRule = 'nullable'): string
    {
        return $baseRule . '|regex:/^\d{5}-?\d{3}$/';
    }

    protected function emailRule(string $baseRule = 'nullable'): string
    {
        return $baseRule . '|email|max:255';
    }

    protected function brasilValidationMessages(): array
    {
        return [
            'cnpj.regex' => 'CNPJ inválido.',
            'cpf.regex' => 'CPF inválido.',
            'cep.regex' => 'CEP inválido.',
            'email.email' => 'E-mail inválido.',
            'email_secundario.email' => 'E-mail secundário inválido.',
            'responsavel_legal_email.email' => 'E-mail do responsável legal inválido.',
            'supervisor_email.email' => 'E-mail do supervisor inválido.',
        ];
    }
}
