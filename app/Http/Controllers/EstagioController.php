<?php

namespace App\Http\Controllers;

use App\Models\Estagio;
use App\Models\InstituicaoEnsino;
use App\Models\EmpresaConcedente;
use App\Models\Estagiario;
use Illuminate\Http\Request;

class EstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::with(['estagiario', 'empresaConcedente', 'instituicaoEnsino'])->latest()->paginate(10);
        return view('estagios.index', compact('estagios'));
    }

    public function create()
    {
        $estagiarios = Estagiario::all();
        $empresas = EmpresaConcedente::all();
        $instituicoes = InstituicaoEnsino::all();
        return view('estagios.create', compact('estagiarios', 'empresas', 'instituicoes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer',
            'valor_bolsa' => 'nullable|numeric',
            'valor_auxilio_transporte' => 'nullable|numeric',
            'atividades' => 'nullable|string',
        ]);

        Estagio::create($validated);

        return redirect()->route('estagios.index')->with('success', 'TCE criado com sucesso.');
    }

    public function edit(Estagio $estagio)
    {
        $estagiarios = Estagiario::all();
        $empresas = EmpresaConcedente::all();
        $instituicoes = InstituicaoEnsino::all();
        return view('estagios.edit', compact('estagio', 'estagiarios', 'empresas', 'instituicoes'));
    }

    public function update(Request $request, Estagio $estagio)
    {
        $validated = $request->validate([
            'estagiario_id' => 'required|exists:estagiarios,id',
            'empresa_concedente_id' => 'required|exists:empresa_concedentes,id',
            'instituicao_ensino_id' => 'required|exists:instituicao_ensinos,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'carga_horaria_semanal' => 'required|integer',
            'valor_bolsa' => 'nullable|numeric',
            'valor_auxilio_transporte' => 'nullable|numeric',
            'atividades' => 'nullable|string',
        ]);

        $estagio->update($validated);

        return redirect()->route('estagios.index')->with('success', 'TCE atualizado com sucesso.');
    }

    public function destroy(Estagio $estagio)
    {
        $estagio->delete();
        return redirect()->route('estagios.index')->with('success', 'TCE removido com sucesso.');
    }
}
