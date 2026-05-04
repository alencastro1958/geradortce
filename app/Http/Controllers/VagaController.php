<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use App\Models\EmpresaConcedente;
use App\Models\Candidatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VagaController extends Controller
{
    /**
     * Listagem de vagas para empresas/admin
     */
    public function index()
    {
        $vagas = Vaga::with('empresa')->latest()->paginate(10);
        return view('vagas.index', compact('vagas'));
    }

    /**
     * Busca pública de vagas para estudantes
     */
    public function buscaPublica(Request $request)
    {
        $query = Vaga::where('ativa', true)->with('empresa');

        if ($request->busca) {
            $query->where(function($q) use ($request) {
                $q->where('titulo', 'like', "%{$request->busca}%")
                  ->orWhere('area_atuacao', 'like', "%{$request->busca}%")
                  ->orWhere('codigo_vaga', 'like', "%{$request->busca}%");
            });
        }

        $vagas = $query->latest()->paginate(12);
        return view('vagas.busca', compact('vagas'));
    }

    public function create()
    {
        $empresas = EmpresaConcedente::all();
        return view('vagas.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa_id' => 'required|exists:empresa_concedentes,id',
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'area_atuacao' => 'required|string|max:255',
            'bolsa_auxilio' => 'nullable|numeric',
            'horario' => 'required|string|max:255',
        ]);

        Vaga::create($validated);

        return redirect()->route('vagas.index')->with('success', 'Vaga aberta com sucesso!');
    }

    /**
     * Lógica de Candidatura
     */
    public function candidatar(Request $request, Vaga $vaga)
    {
        // Supõe-se que o aluno está logado ou identificado
        // Para este exemplo, usaremos o ID do estagiário se houver um vínculo
        $estagiario = auth()->user()->estagiario;

        if (!$estagiario) {
            return redirect('/candidate-se')->with('error', 'Você só poderá se candidatar às vagas após realizar seu cadastro.');
        }

        // Verifica se já se candidatou
        $jaCandidatou = Candidatura::where('vaga_id', $vaga->id)
            ->where('estagiario_id', $estagiario->id)
            ->exists();

        if ($jaCandidatou) {
            return back()->with('info', 'Você já se candidatou a esta vaga.');
        }

        Candidatura::create([
            'vaga_id' => $vaga->id,
            'estagiario_id' => $estagiario->id,
        ]);

        // Envio de E-mails
        $empresa = $vaga->empresa;

        // E-mail para a Empresa: usa email_candidatura da vaga se definido, senão o email da empresa
        $emailDestino = $vaga->email_candidatura ?: ($empresa?->email ?? null);
        if ($emailDestino && ($empresa?->autoriza_envio_mensagens || $vaga->email_candidatura)) {
            Mail::to($emailDestino)->send(new \App\Mail\NovaCandidatura($vaga, $estagiario));
        }

        // E-mail de confirmação para o Candidato
        if ($estagiario->email) {
            Mail::to($estagiario->email)->send(new \App\Mail\ConfirmacaoCandidatura($vaga));
        }

        return back()->with('success', 'Candidatura enviada com sucesso! Verifique seu e-mail para confirmação.');
    }
}
