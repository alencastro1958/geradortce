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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estagio_id')->constrained()->onDelete('cascade');
            $table->string('tipo'); // tce, relatorio, certificado, convenio_empresa, convenio_ies
            $table->string('autentique_document_id')->nullable();
            $table->string('status_assinatura')->default('pendente');
            $table->string('arquivo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
