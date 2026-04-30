<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgenteIntegracao;

class AgenteIntegracaoSeeder extends Seeder
{
    public function run(): void
    {
        AgenteIntegracao::updateOrCreate(
            ['cnpj' => '18.785.582/0001-24'],
            [
                'nome_fantasia' => 'ALENCASTRO CONSULTORIA-ESTÁGIOS',
                'razao_social' => 'DIOGO LUÍS ALENCASTRO DA SILVA-ME',
                'endereco' => 'Av. Mauro Ramos, 1722 Aptº 92 - Bloco 08',
                'bairro' => 'Centro',
                'cep' => '88020-304',
                'cidade' => 'Florianópolis',
                'estado' => 'Santa Catarina',
                'telefone' => '(48) 99111-8686',
                'email' => 'diogo@alencastroestagios.com.br',
                'responsavel_legal_nome' => 'Diogo Luís Alencastro da Silva',
            ]
        );
    }
}
