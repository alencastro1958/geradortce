<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Estagio;
use App\Models\Estagiario;
use App\Models\EmpresaConcedente;
use App\Models\InstituicaoEnsino;
use App\Models\Seguradora;
use App\Models\SupervisorEstagio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $supervisoresPorEmpresa = SupervisorEstagio::where('ativo', true)
            ->get(['id', 'empresa_concedente_id', 'nome', 'cargo'])
            ->groupBy('empresa_concedente_id');

        return view('estagios.create', compact('estagiarios', 'empresas', 'instituicoes', 'seguradoras', 'supervisoresPorEmpresa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'seguradora_id' => 'nullable|exists:seguradoras,id',
            'supervisor_estagio_id' => 'nullable|exists:supervisores_estagio,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer|min:1|max:40',
            'valor_bolsa' => 'nullable|numeric|min:0',
            'valor_auxilio_transporte' => 'nullable|numeric|min:0',
            'atividades' => 'nullable|string',
            'status' => 'required|in:pendente,ativo,concluido,rescindido',
        ]);

        Estagio::create($validated);

        return redirect()->route('estagios.index')->with('success', 'Estágio cadastrado com sucesso.');
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
        $supervisoresPorEmpresa = SupervisorEstagio::where('ativo', true)
            ->get(['id', 'empresa_concedente_id', 'nome', 'cargo'])
            ->groupBy('empresa_concedente_id');

        return view('estagios.edit', compact('estagio', 'estagiarios', 'empresas', 'instituicoes', 'seguradoras', 'supervisoresPorEmpresa'));
    }

    public function update(Request $request, Estagio $estagio)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'seguradora_id' => 'nullable|exists:seguradoras,id',
            'supervisor_estagio_id' => 'nullable|exists:supervisores_estagio,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer|min:1|max:40',
            'valor_bolsa' => 'nullable|numeric|min:0',
            'valor_auxilio_transporte' => 'nullable|numeric|min:0',
            'atividades' => 'nullable|string',
            'status' => 'required|in:pendente,ativo,concluido,rescindido',
        ]);

        $estagio->update($validated);

        return redirect()->route('estagios.index')->with('success', 'Estágio atualizado com sucesso.');
    }

    public function destroy(Estagio $estagio)
    {
        $estagio->delete();

        return redirect()->route('estagios.index')->with('success', 'Estágio removido com sucesso.');
    }

    public function gerarDocumento(Request $request, Estagio $estagio)
    {
        $tipo = $request->get('tipo', 'tce');
        $estagio->load(['estagiario', 'empresaConcedente', 'instituicaoEnsino', 'seguradora']);

        $views = [
            'tce' => 'documentos.tce',
            'certificado' => 'documentos.certificado',
            'relatorio' => 'documentos.relatorio',
            'convenio_ies' => 'documentos.convenio_ies',
            'convenio_empresa' => 'documentos.convenio_empresa',
        ];

        $nomeView = $views[$tipo] ?? 'documentos.tce';
        $nomeFile = strtoupper($tipo) . '_' . $estagio->id . '_' . date('YmdHis');

        $pdf = Pdf::loadView($nomeView, compact('estagio'));

        return $pdf->setPaper('a4')->stream($nomeFile . '.pdf');
    }

    public function baixarDocumento(Request $request, Estagio $estagio)
    {
        $tipo = $request->get('tipo', 'tce');
        $estagio->load(['estagiario', 'empresaConcedente', 'instituicaoEnsino', 'seguradora']);

        $views = [
            'tce' => 'documentos.tce',
            'certificado' => 'documentos.certificado',
            'relatorio' => 'documentos.relatorio',
            'convenio_ies' => 'documentos.convenio_ies',
            'convenio_empresa' => 'documentos.convenio_empresa',
        ];

        $nomeView = $views[$tipo] ?? 'documentos.tce';
        $nomeArquivo = strtoupper($tipo) . '_' . $estagio->estagiario->cpf . '_' . date('YmdHis') . '.pdf';
        
        $pdf = Pdf::loadView($nomeView, compact('estagio'));

        $caminho = 'documentos/' . $nomeArquivo;
        Storage::put($caminho, $pdf->output());

        Documento::create([
            'estagio_id' => $estagio->id,
            'tipo' => strtoupper($tipo),
            'nome_arquivo' => $nomeArquivo,
            'caminho_arquivo' => $caminho,
            'status' => 'gerado',
        ]);

        return $pdf->setPaper('a4')->download($nomeArquivo);
    }
}