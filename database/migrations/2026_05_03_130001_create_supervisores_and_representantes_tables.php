<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('supervisores_estagio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_concedente_id')->constrained('empresa_concedentes')->onDelete('cascade');
            $table->string('nome');
            $table->date('data_nascimento')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('rg_orgao_emissor')->nullable();
            $table->string('rg_uf', 2)->nullable();
            $table->string('cargo')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('formacao')->nullable();
            $table->string('orgao_regulamentador')->nullable();
            $table->text('outras_formacoes')->nullable();
            $table->text('observacoes')->nullable();
            $table->string('tempo_atividade')->nullable();
            $table->string('registro_profissional')->nullable();
            $table->string('setor')->nullable();
            $table->string('matricula')->nullable();
            $table->boolean('ativo')->default(true);
            $table->boolean('acessa_processo_seletivo')->nullable();
            $table->boolean('assina_documentos')->nullable();
            $table->timestamps();
        });

        Schema::create('representantes_legais', function (Blueprint $table) {
            $table->id();
            $table->string('entidade_tipo'); // 'empresa', 'instituicao', 'seguradora', 'agente'
            $table->unsignedBigInteger('entidade_id');
            $table->index(['entidade_tipo', 'entidade_id']);
            $table->string('nome');
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('rg_orgao_emissor')->nullable();
            $table->string('rg_uf', 2)->nullable();
            $table->string('cargo')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('email')->nullable();
            $table->string('celular')->nullable();
            $table->string('celular2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('principal')->default(false);
            $table->boolean('ativo')->default(true);
            $table->boolean('assina_documentos')->default(false);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });

        // Add supervisor_estagio_id to estagios
        Schema::table('estagios', function (Blueprint $table) {
            if (!Schema::hasColumn('estagios', 'supervisor_estagio_id')) {
                $table->foreignId('supervisor_estagio_id')
                    ->nullable()
                    ->constrained('supervisores_estagio')
                    ->onDelete('set null');
            }
        });
    }

    public function down(): void {
        Schema::table('estagios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supervisor_estagio_id');
        });
        Schema::dropIfExists('representantes_legais');
        Schema::dropIfExists('supervisores_estagio');
    }
};
