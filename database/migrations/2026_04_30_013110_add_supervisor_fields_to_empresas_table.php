<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            if (!Schema::hasColumn('empresa_concedentes', 'supervisor_nome')) {
                $table->string('supervisor_nome')->nullable();
                $table->string('supervisor_cargo')->nullable();
                $table->string('supervisor_tempo_atividade')->nullable();
                $table->string('supervisor_cpf')->nullable();
                $table->string('supervisor_rg')->nullable();
                $table->string('supervisor_email')->nullable();
                $table->string('supervisor_telefone_whatsapp')->nullable();
                $table->string('supervisor_registro_profissional')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropColumn([
                'supervisor_nome',
                'supervisor_cargo',
                'supervisor_tempo_atividade',
                'supervisor_cpf',
                'supervisor_rg',
                'supervisor_email',
                'supervisor_telefone_whatsapp',
                'supervisor_registro_profissional'
            ]);
        });
    }
};
