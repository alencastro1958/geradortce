<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relatorio extends Model
{
    protected $table = 'relatorios';

    protected $fillable = [
        'estagio_id',
        'supervisor_estagio_id',
        'semestre',
        'avaliacao',
        'observacoes',
        'status',
        'gerado_em',
    ];

    protected function casts(): array
    {
        return [
            'semestre'   => 'integer',
            'gerado_em'  => 'datetime',
        ];
    }

    public function estagio(): BelongsTo
    {
        return $this->belongsTo(Estagio::class);
    }

    public function supervisorEstagio(): BelongsTo
    {
        return $this->belongsTo(SupervisorEstagio::class, 'supervisor_estagio_id');
    }

    public function labelSemestre(): string
    {
        return match ($this->semestre) {
            1 => '1º Semestre',
            2 => '2º Semestre',
            3 => '3º Semestre',
            4 => '4º Semestre',
            default => $this->semestre . 'º Semestre',
        };
    }

    public function labelAvaliacao(): string
    {
        return match ($this->avaliacao) {
            'excelente'    => 'Excelente',
            'bom'          => 'Bom',
            'regular'      => 'Regular',
            'insuficiente' => 'Insuficiente',
            default        => '—',
        };
    }
}
