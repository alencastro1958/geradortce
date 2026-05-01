<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

readonly class EmpresaConcedente extends Model
{
    use HasFactory;

    protected $table = 'empresa_concedentes';

    protected $fillable = [
        'user_id', 'cnpj', 'razao_social', 'nome_fantasia', 'endereco', 'bairro',
        'cidade', 'estado', 'cep', 'telefone', 'email', 'responsavel_legal_nome',
        'responsavel_legal_cargo', 'supervisor_estagio_nome', 'supervisor_estagio_cargo'
    ];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'cnpj' => Encrypted::class,
            'responsavel_legal_cargo' => Encrypted::class,
            'supervisor_estagio_cargo' => Encrypted::class,
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
