<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstituicaoEnsino extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cnpj', 'nome', 'endereco', 'bairro', 'cidade', 'estado',
        'cep', 'telefone', 'email', 'responsavel_nome', 'responsavel_cargo'
    ];

    protected function casts(): array
    {
        return [];
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
