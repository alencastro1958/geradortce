<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Converte o campo date para string para aceitar texto livre como "Contratação Imediata"
        DB::statement('ALTER TABLE vagas MODIFY inicio_previsto VARCHAR(100) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE vagas MODIFY inicio_previsto DATE NULL');
    }
};
