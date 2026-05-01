<?php

namespace Database\Factories;

use App\Models\Documento;
use App\Models\Estagio;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoFactory extends Factory
{
    protected $model = Documento::class;

    public function definition(): array
    {
        return [
            'estagio_id' => Estagio::factory(),
            'tipo' => $this->faker->randomElement(['tce', 'convenio_ies', 'convenio_empresa', 'relatorio', 'certificado']),
            'nome_arquivo' => $this->faker->uuid() . '.pdf',
            'caminho_arquivo' => storage_path('app/pdfs/' . $this->faker->uuid() . '.pdf'),
            'status' => $this->faker->randomElement(['pendente', 'gerando', 'pronto', 'assinado']),
            'hash' => $this->faker->sha256,
        ];
    }

    public function pronto(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pronto',
        ]);
    }
}
