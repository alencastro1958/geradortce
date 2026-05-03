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
        'user_id', 'cnpj', 'razao_social', 'nome_fantasia', 'endereco', 'logradouro', 'numero', 'complemento',
        'bairro', 'cidade', 'estado', 'cep', 'telefone', 'telefone_secundario', 'email', 'email_secundario',
        'responsavel_legal_nome', 'responsavel_legal_cargo', 'responsavel_legal_cpf',
        'responsavel_legal_rg', 'responsavel_legal_email', 'responsavel_legal_whatsapp',
        'responsavel_legal_rg_orgao_emissor', 'responsavel_legal_rg_uf', 'responsavel_legal_nacionalidade',
        'responsavel_legal_data_nascimento', 'responsavel_legal_celular', 'responsavel_legal_celular2',
        'responsavel_legal_principal', 'responsavel_legal_ativo', 'responsavel_legal_assina_documentos',
        'responsavel_legal_observacoes',
        'mantenedora', 'contato_nome', 'contato_fone', 'contato_email', 'observacoes', 'tipo_instituicao'
    ];

    protected function casts(): array
    {
        return [
            'responsavel_legal_data_nascimento' => 'date',
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

    public function representantesLegais(): HasMany
    {
        return $this->hasMany(\App\Models\RepresentanteLegal::class, 'entidade_id')
                    ->where('entidade_tipo', 'instituicao');
    }
}
