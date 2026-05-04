<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estagio_id')->constrained('estagios')->onDelete('cascade');
            $table->foreignId('supervisor_estagio_id')->constrained('supervisores_estagio')->onDelete('cascade');
            $table->tinyInteger('semestre')->unsigned()->comment('1 a 4');
            $table->enum('avaliacao', ['excelente', 'bom', 'regular', 'insuficiente'])->nullable();
            $table->string('observacoes', 200)->nullable();
            $table->enum('status', ['rascunho', 'finalizado'])->default('rascunho');
            $table->timestamp('gerado_em')->nullable();
            $table->timestamps();
            $table->unique(['estagio_id', 'semestre'], 'relatorio_unico_semestre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorios');
    }
};
