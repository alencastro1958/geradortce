<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->string('slug', 100)->nullable()->unique()->after('nome_fantasia');
        });
    }

    public function down(): void
    {
        Schema::table('empresa_concedentes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
