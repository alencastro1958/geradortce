<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropUnique(['cnpj']);
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->dropUnique(['cnpj']);
        });
    }

    public function down(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->unique('cnpj');
        });

        Schema::table('instituicao_ensinos', function (Blueprint $table) {
            $table->unique('cnpj');
        });
    }
};
