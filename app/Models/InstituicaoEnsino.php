<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

readonly class InstituicaoEnsino extends Model
{
    use HasFactory;

    protected $table = 'instituicao_ensinos';

    protected $fillable = [
        'user_id', 'cnpj', 'nome', 'endereco', 'bairro', 'cidade', 'estado',
        'cep', 'telefone', 'email', 'responsavel_nome', 'responsavel_cargo'
    ];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'cnpj' => Encrypted::class,
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
