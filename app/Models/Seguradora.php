<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seguradora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'razao_social', 'cnpj', 'contato_nome', 'contato_fone', 'contato_email', 'observacoes', 'telefone', 'email', 'apolice_numero', 'arquivo_apolice',
        'valor_cobertura', 'capital_segurado', 'inicio_vigencia', 'fim_vigencia',
        'susep_vida_em_grupo', 'susep_acidentes_pessoais', 'capital_morte_acidental', 'capital_morte_acidental_extenso',
        'endereco', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'
    ];

    protected function casts(): array
    {
        return [
            'inicio_vigencia' => 'date',
            'fim_vigencia' => 'date',
            'valor_cobertura' => 'decimal:2',
            'capital_segurado' => 'decimal:2',
            'capital_morte_acidental' => 'decimal:2',
        ];
    }

    public function estagios(): HasMany
    {
        return $this->hasMany(Estagio::class);
    }
}
