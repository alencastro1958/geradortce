<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupervisorEstagio extends Model
{
    protected $table = 'supervisores_estagio';

    protected $fillable = [
        'empresa_concedente_id', 'user_id', 'nome', 'data_nascimento', 'cpf', 'rg',
        'rg_orgao_emissor', 'rg_uf', 'cargo', 'celular', 'email',
        'formacao', 'orgao_regulamentador', 'outras_formacoes', 'observacoes',
        'tempo_atividade', 'registro_profissional', 'setor', 'matricula',
        'ativo', 'acessa_processo_seletivo', 'assina_documentos',
    ];

    protected function casts(): array {
        return [
            'data_nascimento' => 'date',
            'ativo' => 'boolean',
            'acessa_processo_seletivo' => 'boolean',
            'assina_documentos' => 'boolean',
        ];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relatorios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Relatorio::class, 'supervisor_estagio_id');
    }

    public function empresaConcedente(): BelongsTo {
        return $this->belongsTo(EmpresaConcedente::class);
    }
}
