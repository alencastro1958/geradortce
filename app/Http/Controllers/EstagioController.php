<?php

namespace App\Http\Controllers;

use App\Enums\DocumentoStatus;
use App\Enums\EstagioStatus;
use App\Jobs\GerarPdfJob;
use App\Models\AgenteIntegracao;
use App\Models\Candidatura;
use App\Models\Documento;
use App\Models\Estagio;
use App\Models\Estagiario;
use App\Models\EmpresaConcedente;
use App\Models\InstituicaoEnsino;
use App\Models\Seguradora;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class EstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::with(['estagiario', 'empresaConcedente', 'instituicaoEnsino'])
            ->latest()
            ->paginate(10);

        return view('estagios.index', compact('estagios'));
    }

    public function create()
    {
        $estagiarios = Estagiario::orderBy('nome')->get();
        $empresas = EmpresaConcedente::orderBy('nome_fantasia')->get();
        $instituicoes = InstituicaoEnsino::orderBy('nome')->get();
        $seguradoras = Seguradora::orderBy('nome')->get();

        return view('estagios.create', compact('estagiarios', 'empresas', 'instituicoes', 'seguradoras'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'seguradora_id' => 'nullable|exists:seguradoras,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer|min:1|max:40',
            'horario_inicio' => 'nullable',
            'horario_fim' => 'nullable',
            'intervalo' => 'nullable|string',
            'apolice_numero' => 'nullable|string',
            'valor_bolsa' => 'nullable|numeric|min:0',
            'valor_auxilio_transporte' => 'nullable|numeric|min:0',
            'atividades' => 'nullable|string',
            'status' => 'required|in:' . implode(',', EstagioStatus::values()),
        ]);

        Estagio::create($validated);

        return redirect()->route('estagios.index')->with('success', 'Estágio (TCE) cadastrado com sucesso.');
    }

    public function show(Estagio $estagio)
    {
        $estagio->load(['estagiario', 'empresaConcedente', 'instituicaoEnsino', 'seguradora', 'documentos']);

        return view('estagios.show', compact('estagio'));
    }

    public function edit(Estagio $estagio)
    {
        $estagiarios = Estagiario::orderBy('nome')->get();
        $empresas = EmpresaConcedente::orderBy('nome_fantasia')->get();
        $instituicoes = InstituicaoEnsino::orderBy('nome')->get();
        $seguradoras = Seguradora::orderBy('nome')->get();

        return view('estagios.edit', compact('estagio', 'estagiarios', 'empresas', 'instituicoes', 'seguradoras'));
    }

    public function update(Request $request, Estagio $estagio)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'seguradora_id' => 'nullable|exists:seguradoras,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer|min:1|max:40',
            'horario_inicio' => 'nullable',
            'horario_fim' => 'nullable',
            'intervalo' => 'nullable|string',
            'apolice_numero' => 'nullable|string',
            'valor_bolsa' => 'nullable|numeric|min:0',
            'valor_auxilio_transporte' => 'nullable|numeric|min:0',
            'atividades' => 'nullable|string',
            'status' => 'required|in:' . implode(',', EstagioStatus::values()),
        ]);

        $estagio->update($validated);

        return redirect()->route('estagios.index')->with('success', 'Estágio (TCE) atualizado com sucesso.');
    }

    public function destroy(Estagio $estagio)
    {
        $estagio->delete();

        return redirect()->route('estagios.index')->with('success', 'Estágio (TCE) removido com sucesso.');
    }

    public function gerarDocumento(Estagio $estagio, Request $request)
    {
        $tipo = $request->query('tipo', 'tce');

        $view = 'estagios.pdfs.' . $tipo;

        if (!view()->exists($view)) {
            return back()->with('error', 'Modelo de documento não encontrado.');
        }

        $documento = Documento::create([
            'estagio_id' => $estagio->id,
            'tipo' => $tipo,
            'status' => DocumentoStatus::GERANDO,
        ]);

        GerarPdfJob::dispatch($estagio, $tipo, $documento->id);

        return back()->with('info', 'Documento está sendo gerado em segundo plano. Você receberá uma notificação quando estiver pronto.');
    }
}

    public function create()
    {
        $estagiarios = Estagiario::orderBy('nome')->get();
        $empresas = EmpresaConcedente::orderBy('nome_fantasia')->get();
        $instituicoes = InstituicaoEnsino::orderBy('nome')->get();
        $seguradoras = Seguradora::orderBy('nome')->get();
        
        return view('estagios.create', compact('estagiarios', 'empresas', 'instituicoes', 'seguradoras'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'seguradora_id' => 'nullable|exists:seguradoras,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer|min:1|max:40',
            'horario_inicio' => 'nullable',
            'horario_fim' => 'nullable',
            'intervalo' => 'nullable|string',
            'apolice_numero' => 'nullable|string',
            'valor_bolsa' => 'nullable|numeric|min:0',
            'valor_auxilio_transporte' => 'nullable|numeric|min:0',
            'atividades' => 'nullable|string',
            'status' => 'required|in:pendente,ativo,concluido,rescindido',
        ]);

        Estagio::create($validated);

        return redirect()->route('estagios.index')->with('success', 'Estágio (TCE) cadastrado com sucesso.');
    }

    public function show(Estagio $estagio)
    {
        return view('estagios.show', compact('estagio'));
    }

    public function edit(Estagio $estagio)
    {
        $estagiarios = Estagiario::orderBy('nome')->get();
        $empresas = EmpresaConcedente::orderBy('nome_fantasia')->get();
        $instituicoes = InstituicaoEnsino::orderBy('nome')->get();
        $seguradoras = Seguradora::orderBy('nome')->get();

        return view('estagios.edit', compact('estagio', 'estagiarios', 'empresas', 'instituicoes', 'seguradoras'));
    }

    public function update(Request $request, Estagio $estagio)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'seguradora_id' => 'nullable|exists:seguradoras,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer|min:1|max:40',
            'horario_inicio' => 'nullable',
            'horario_fim' => 'nullable',
            'intervalo' => 'nullable|string',
            'apolice_numero' => 'nullable|string',
            'valor_bolsa' => 'nullable|numeric|min:0',
            'valor_auxilio_transporte' => 'nullable|numeric|min:0',
            'atividades' => 'nullable|string',
            'status' => 'required|in:pendente,ativo,concluido,rescindido',
        ]);

        $estagio->update($validated);

        return redirect()->route('estagios.index')->with('success', 'Estágio (TCE) atualizado com sucesso.');
    }

    public function destroy(Estagio $estagio)
    {
        $estagio->delete();
        return redirect()->route('estagios.index')->with('success', 'Estágio (TCE) removido com sucesso.');
    }

    public function gerarDocumento(Estagio $estagio, Request $request)
    {
        $tipo = $request->query('tipo', 'tce'); // tce, convenio_ies, convenio_empresa, relatorio, certificado
        $agente = \App\Models\AgenteIntegracao::first();

        $view = 'estagios.pdfs.' . $tipo;

        if (!view()->exists($view)) {
            return back()->with('error', 'Modelo de documento não encontrado.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($view, compact('estagio', 'agente'));
        
        $filename = strtoupper($tipo) . '_' . str_replace(' ', '_', $estagio->estagiario->nome) . '.pdf';
        
        return $pdf->download($filename);
    }
}
