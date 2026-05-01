<?php

namespace App\Models;

use App\Enums\EstagioStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estagio extends Model
{
    use HasFactory;

    protected $fillable = [
        'estagiario_id', 'empresa_concedente_id', 'instituicao_ensino_id', 'seguradora_id',
        'data_inicio', 'data_fim', 'carga_horaria_semanal', 'valor_bolsa', 'valor_auxilio_transporte',
        'atividades', 'status', 'horario_inicio', 'horario_fim', 'intervalo', 'apolice_numero'
    ];

    protected function casts(): array
    {
        return [
            'data_inicio' => 'date',
            'data_fim' => 'date',
            'valor_bolsa' => 'decimal:2',
            'valor_auxilio_transporte' => 'decimal:2',
            'status' => EstagioStatus::class,
        ];
    }

    public function estagiario(): BelongsTo
    {
        return $this->belongsTo(Estagiario::class);
    }

    public function empresaConcedente(): BelongsTo
    {
        return $this->belongsTo(EmpresaConcedente::class);
    }

    public function instituicaoEnsino(): BelongsTo
    {
        return $this->belongsTo(InstituicaoEnsino::class);
    }

    public function seguradora(): BelongsTo
    {
        return $this->belongsTo(Seguradora::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }
}
