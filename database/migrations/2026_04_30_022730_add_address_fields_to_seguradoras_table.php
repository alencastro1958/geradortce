<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seguradoras', function (Blueprint $table) {
            if (!Schema::hasColumn('seguradoras', 'razao_social')) {
                $table->string('razao_social')->nullable()->after('nome');
            }
            if (!Schema::hasColumn('seguradoras', 'endereco')) {
                $table->string('endereco')->nullable()->after('cnpj');
            }
            if (!Schema::hasColumn('seguradoras', 'bairro')) {
                $table->string('bairro')->nullable()->after('endereco');
            }
            if (!Schema::hasColumn('seguradoras', 'cidade')) {
                $table->string('cidade')->nullable()->after('bairro');
            }
            if (!Schema::hasColumn('seguradoras', 'estado')) {
                $table->string('estado')->nullable()->after('cidade');
            }
            if (!Schema::hasColumn('seguradoras', 'cep')) {
                $table->string('cep')->nullable()->after('estado');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seguradoras', function (Blueprint $table) {
            $table->dropColumn(['razao_social', 'endereco', 'bairro', 'cidade', 'estado', 'cep']);
        });
    }
};
