<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'instituicao_ensinos',
            'empresa_concedentes',
            'seguradoras',
            'agente_integracao',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'contato_nome')) {
                    $table->string('contato_nome')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'contato_fone')) {
                    $table->string('contato_fone')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'contato_email')) {
                    $table->string('contato_email')->nullable();
                }
                if (!Schema::hasColumn($tableName, 'observacoes')) {
                    $table->text('observacoes')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'instituicao_ensinos',
            'empresa_concedentes',
            'seguradoras',
            'agente_integracao',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $columns = ['contato_fone', 'contato_email', 'observacoes'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn($tableName, $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
