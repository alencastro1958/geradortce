<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('nome_arquivo')->nullable()->after('tipo');
            $table->string('caminho_arquivo')->nullable()->after('nome_arquivo');
            $table->string('hash')->nullable()->after('caminho_arquivo');
            $table->string('status')->default('pendente')->after('hash');
            $table->timestamp('signed_at')->nullable()->after('status');
            $table->string('autentique_document_id')->nullable()->change();
            $table->string('status_assinatura')->nullable()->change();
            $table->string('arquivo_path')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropColumn(['nome_arquivo', 'caminho_arquivo', 'hash', 'status', 'signed_at']);
        });
    }
};