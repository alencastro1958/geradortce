<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('relatorios', function (Blueprint $table) {
            // ── Período do relatório ──────────────────────────────────────────────
            $table->date('data_inicio_periodo')->nullable()->after('semestre');
            $table->date('data_fim_periodo')->nullable()->after('data_inicio_periodo');

            // ── Atividades desenvolvidas ──────────────────────────────────────────
            $table->text('atividades_descricao')->nullable()->after('data_fim_periodo');
            $table->text('relacao_curso')->nullable()->after('atividades_descricao');

            // ── Competências individuais (escala: insuficiente → excelente) ───────
            $escala = ['insuficiente', 'regular', 'bom', 'otimo', 'excelente'];

            $table->enum('comp_pontualidade',       $escala)->nullable()->after('relacao_curso');
            $table->enum('comp_iniciativa',          $escala)->nullable()->after('comp_pontualidade');
            $table->enum('comp_trabalho_equipe',     $escala)->nullable()->after('comp_iniciativa');
            $table->enum('comp_qualidade_tecnica',   $escala)->nullable()->after('comp_trabalho_equipe');
            $table->enum('comp_relacionamento',      $escala)->nullable()->after('comp_qualidade_tecnica');
            $table->enum('comp_etica_sigilo',        $escala)->nullable()->after('comp_relacionamento');

            // ── Parecer descritivo do supervisor ─────────────────────────────────
            $table->text('parecer_descritivo')->nullable()->after('comp_etica_sigilo');

            // ── Frequência e carga horária ────────────────────────────────────────
            $table->unsignedSmallInteger('horas_previstas')->nullable()->after('parecer_descritivo');
            $table->unsignedSmallInteger('horas_cumpridas')->nullable()->after('horas_previstas');
            $table->string('faltas_justificadas',     50)->nullable()->after('horas_cumpridas');
            $table->string('faltas_nao_justificadas', 50)->nullable()->after('faltas_justificadas');
            $table->text('obs_ausencias')->nullable()->after('faltas_nao_justificadas');
        });
    }

    public function down(): void
    {
        Schema::table('relatorios', function (Blueprint $table) {
            $table->dropColumn([
                'data_inicio_periodo',
                'data_fim_periodo',
                'atividades_descricao',
                'relacao_curso',
                'comp_pontualidade',
                'comp_iniciativa',
                'comp_trabalho_equipe',
                'comp_qualidade_tecnica',
                'comp_relacionamento',
                'comp_etica_sigilo',
                'parecer_descritivo',
                'horas_previstas',
                'horas_cumpridas',
                'faltas_justificadas',
                'faltas_nao_justificadas',
                'obs_ausencias',
            ]);
        });
    }
};
