<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seguradoras', function (Blueprint $table) {
            if (!Schema::hasColumn('seguradoras', 'cnpj')) {
                $table->string('cnpj')->nullable()->after('nome');
            }
            if (!Schema::hasColumn('seguradoras', 'arquivo_apolice')) {
                $table->string('arquivo_apolice')->nullable()->after('apolice_numero');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seguradoras', function (Blueprint $table) {
            $table->dropColumn(['cnpj', 'arquivo_apolice']);
        });
    }
};
