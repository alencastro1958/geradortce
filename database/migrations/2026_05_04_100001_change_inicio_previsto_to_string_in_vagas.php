<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE vagas MODIFY inicio_previsto VARCHAR(100) NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE vagas ALTER COLUMN inicio_previsto TYPE VARCHAR(100)');
        }
        // SQLite já aceita qualquer tipo de dado em qualquer coluna — nenhuma ação necessária
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE vagas MODIFY inicio_previsto DATE NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE vagas ALTER COLUMN inicio_previsto TYPE DATE USING inicio_previsto::date');
        }
    }
};
