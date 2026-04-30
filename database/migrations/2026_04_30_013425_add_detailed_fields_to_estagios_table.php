<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estagios', function (Blueprint $table) {
            if (!Schema::hasColumn('estagios', 'horario_inicio')) {
                $table->time('horario_inicio')->nullable();
            }
            if (!Schema::hasColumn('estagios', 'horario_fim')) {
                $table->time('horario_fim')->nullable();
            }
            if (!Schema::hasColumn('estagios', 'intervalo')) {
                $table->string('intervalo')->nullable();
            }
            if (!Schema::hasColumn('estagios', 'apolice_numero')) {
                $table->string('apolice_numero')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('estagios', function (Blueprint $table) {
            $table->dropColumn(['horario_inicio', 'horario_fim', 'intervalo', 'apolice_numero']);
        });
    }
};
