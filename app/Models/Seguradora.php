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
        'nome', 'cnpj', 'contato_nome', 'telefone', 'email', 'apolice_numero',
        'valor_cobertura', 'inicio_vigencia', 'fim_vigencia', 'endereco', 'bairro', 'cidade', 'estado', 'cep'
    ];

    protected function casts(): array
    {
        return [
            'cnpj' => Encrypted::class,
            'inicio_vigencia' => 'date',
            'fim_vigencia' => 'date',
            'valor_cobertura' => 'decimal:2',
        ];
    }

    public function estagios(): HasMany
    {
        return $this->hasMany(Estagio::class);
    }
}
