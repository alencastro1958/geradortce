<?php

namespace Tests\Unit;

use App\Enums\DocumentoStatus;
use App\Enums\EstagioStatus;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_estagio_status_enum_values(): void
    {
        $this->assertEquals('pendente', EstagioStatus::PENDENTE->value);
        $this->assertEquals('ativo', EstagioStatus::ATIVO->value);
        $this->assertEquals('concluido', EstagioStatus::CONCLUIDO->value);
        $this->assertEquals('rescindido', EstagioStatus::RESCINDIDO->value);
    }

    public function test_documento_status_enum_values(): void
    {
        $this->assertEquals('pendente', DocumentoStatus::PENDENTE->value);
        $this->assertEquals('gerando', DocumentoStatus::GERANDO->value);
        $this->assertEquals('pronto', DocumentoStatus::PRONTO->value);
        $this->assertEquals('assinado', DocumentoStatus::ASSINADO->value);
    }

    public function test_estagio_status_has_four_cases(): void
    {
        $statuses = EstagioStatus::cases();
        $this->assertCount(4, $statuses);
    }

    public function test_documento_status_has_seven_cases(): void
    {
        $statuses = DocumentoStatus::cases();
        $this->assertCount(7, $statuses);
    }
}
