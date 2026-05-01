<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estagiario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nome', 'cpf', 'rg', 'data_nascimento', 'estado_civil',
        'endereco', 'bairro', 'cidade', 'estado', 'cep', 'telefone', 'email',
        'curso', 'semestre_atual', 'matricula', 'responsavel_legal_nome', 'responsavel_legal_cpf'
    ];

    protected function casts(): array
    {
        return [
            'cpf' => Encrypted::class,
            'rg' => Encrypted::class,
            'data_nascimento' => 'date',
            'responsavel_legal_cpf' => Encrypted::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function estagios(): HasMany
    {
        return $this->hasMany(Estagio::class);
    }
}
