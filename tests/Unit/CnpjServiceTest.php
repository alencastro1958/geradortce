<?php

namespace Tests\Unit;

use App\Services\CnpjService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class CnpjServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_consultar_cnpj_retorna_dados_quando_sucesso(): void
    {
        Http::fake([
            '*' => Http::response([
                'razao_social' => 'Empresa Teste LTDA',
                'nome_fantasia' => 'Teste',
                'logradouro' => 'Rua Teste',
                'numero' => '100',
                'bairro' => 'Centro',
                'municipio' => 'São Paulo',
                'uf' => 'SP',
                'cep' => '01000-000',
            ], 200),
        ]);

        $service = new CnpjService();
        $result = $service->consultar('12.345.678/0001-90');

        $this->assertEquals('Empresa Teste LTDA', $result['razao_social']);
        $this->assertEquals('Teste', $result['nome_fantasia']);
    }

    public function test_consultar_cnpjusa_cache(): void
    {
        Cache::put('cnpj:12345678000190', ['razao_social' => 'Cached'], 86400);

        $service = new CnpjService();
        $result = $service->consultar('12.345.678/0001-90');

        $this->assertEquals('Cached', $result['razao_social']);

        Http::assertSent(fn ($request) => false);
    }

    public function test_consultar_cnpj_retorna_erro_quando_falha(): void
    {
        Http::fake([
            '*' => Http::response(null, 500),
        ]);

        $service = new CnpjService();
        $result = $service->consultar('12.345.678/0001-90');

        $this->assertArrayHasKey('error', $result);
    }

    public function test_forget_limpa_cache(): void
    {
        Cache::put('cnpj:12345678000190', ['test'], 86400);

        $service = new CnpjService();
        $service->forget('12.345.678/0001-90');

        $this->assertNull(Cache::get('cnpj:12345678000190'));
    }
}