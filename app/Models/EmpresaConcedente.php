<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmpresaConcedente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cnpj', 'razao_social', 'nome_fantasia', 'endereco', 'bairro',
        'cidade', 'estado', 'cep', 'telefone', 'email', 'responsavel_legal_nome',
        'responsavel_legal_cargo', 'supervisor_estagio_nome', 'supervisor_estagio_cargo'
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
