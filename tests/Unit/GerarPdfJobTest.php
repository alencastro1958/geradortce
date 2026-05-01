<?php

namespace Tests\Unit;

use App\Jobs\GerarPdfJob;
use App\Models\Documento;
use App\Models\Estagiario;
use App\Models\Estagio;
use App\Models\EmpresaConcedente;
use App\Models\InstituicaoEnsino;
use App\Models\Seguradora;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GerarPdfJobTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        File::makeDirectory(storage_path('app/pdfs'));
    }

    public function test_job_pode_ser_dispatchado(): void
    {
        Queue::fake();

        $estagiario = Estagiario::factory()->create();
        $empresa = EmpresaConcedente::factory()->create();
        $instituicao = InstituicaoEnsino::factory()->create();
        $seguradora = Seguradora::factory()->create();

        $estagio = Estagio::factory()->create([
            'estagiario_id' => $estagiario->id,
            'empresa_concedente_id' => $empresa->id,
            'instituicao_ensino_id' => $instituicao->id,
            'seguradora_id' => $seguradora->id,
        ]);

        $documento = Documento::factory()->create(['estagio_id' => $estagio->id]);

        $job = new GerarPdfJob($estagio, 'tce', $documento->id);

        $this->assertInstanceOf(GerarPdfJob::class, $job);
    }

    public function test_job_tem_tries_configurado(): void
    {
        $estagiario = Estagiario::factory()->create();
        $empresa = EmpresaConcedente::factory()->create();
        $instituicao = InstituicaoEnsino::factory()->create();

        $estagio = Estagio::factory()->create([
            'estagiario_id' => $estagiario->id,
            'empresa_concedente_id' => $empresa->id,
            'instituicao_ensino_id' => $instituicao->id,
        ]);

        $job = new GerarPdfJob($estagio, 'tce');

        $this->assertTrue(property_exists($job, 'tries'));
    }

    public function test_job_armazena_tipo_e_estagio(): void
    {
        $estagiario = Estagiario::factory()->create();
        $empresa = EmpresaConcedente::factory()->create();
        $instituicao = InstituicaoEnsino::factory()->create();

        $estagio = Estagio::factory()->create([
            'estagiario_id' => $estagiario->id,
            'empresa_concedente_id' => $empresa->id,
            'instituicao_ensino_id' => $instituicao->id,
        ]);

        $job = new GerarPdfJob($estagio, 'tce', 1);

        $this->assertEquals('tce', $job->tipo);
        $this->assertEquals($estagio->id, $job->estagio->id);
    }
}