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
        'user_id', 'cnpj', 'razao_social', 'nome_fantasia', 'endereco', 'bairro', 'cidade', 'estado',
        'cep', 'telefone', 'telefone_secundario', 'email', 'email_secundario',
        'responsavel_legal_nome', 'responsavel_legal_cargo', 'responsavel_legal_cpf',
        'responsavel_legal_rg', 'responsavel_legal_email', 'responsavel_legal_whatsapp',
        'mantenedora', 'contato_nome', 'tipo_instituicao'
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
