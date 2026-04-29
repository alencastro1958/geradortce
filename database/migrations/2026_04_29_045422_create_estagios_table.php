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
        Schema::create('estagios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estagiario_id')->constrained()->onDelete('cascade');
            $table->foreignId('empresa_concedente_id')->constrained()->onDelete('cascade');
            $table->foreignId('instituicao_ensino_id')->constrained()->onDelete('cascade');
            $table->foreignId('seguradora_id')->nullable()->constrained()->onDelete('set null');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('carga_horaria_semanal');
            $table->decimal('valor_bolsa', 10, 2)->nullable();
            $table->decimal('valor_auxilio_transporte', 10, 2)->nullable();
            $table->text('atividades')->nullable();
            $table->string('status')->default('pendente'); // pendente, ativo, concluido, rescindido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estagios');
    }
};
