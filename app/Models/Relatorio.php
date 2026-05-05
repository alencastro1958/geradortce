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
        // ── Período
        'data_inicio_periodo',
        'data_fim_periodo',
        // ── Atividades
        'atividades_descricao',
        'relacao_curso',
        // ── Competências individuais
        'comp_pontualidade',
        'comp_iniciativa',
        'comp_trabalho_equipe',
        'comp_qualidade_tecnica',
        'comp_relacionamento',
        'comp_etica_sigilo',
        // ── Parecer e avaliação geral
        'parecer_descritivo',
        'avaliacao',
        // ── Frequência / carga horária
        'horas_previstas',
        'horas_cumpridas',
        'faltas_justificadas',
        'faltas_nao_justificadas',
        'obs_ausencias',
        // ── Observações rápidas (campo legado, mantido)
        'observacoes',
        'status',
        'gerado_em',
    ];

    protected function casts(): array
    {
        return [
            'semestre'             => 'integer',
            'horas_previstas'      => 'integer',
            'horas_cumpridas'      => 'integer',
            'data_inicio_periodo'  => 'date',
            'data_fim_periodo'     => 'date',
            'gerado_em'            => 'datetime',
        ];
    }

    /** Valores válidos para os campos de competência */
    public static array $escalaCompetencias = [
        'insuficiente' => 'Insuficiente',
        'regular'      => 'Regular',
        'bom'          => 'Bom',
        'otimo'        => 'Ótimo',
        'excelente'    => 'Excelente',
    ];

    /** Lista das competências avaliadas */
    public static array $competencias = [
        'comp_pontualidade'     => 'Pontualidade e Assiduidade',
        'comp_iniciativa'        => 'Iniciativa e Proatividade',
        'comp_trabalho_equipe'   => 'Trabalho em Equipe',
        'comp_qualidade_tecnica' => 'Qualidade Técnica das Atividades',
        'comp_relacionamento'    => 'Relacionamento Interpessoal',
        'comp_etica_sigilo'      => 'Ética e Sigilo Profissional',
    ];

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
