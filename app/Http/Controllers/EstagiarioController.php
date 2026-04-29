<?php

namespace App\Http\Controllers;

use App\Models\Estagiario;
use Illuminate\Http\Request;

class EstagiarioController extends Controller
{
    public function index()
    {
        $estagiarios = Estagiario::latest()->paginate(10);
        return view('estagiarios.index', compact('estagiarios'));
    }

    public function create()
    {
        return view('estagiarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|unique:estagiarios,cpf',
            'rg' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'estado_civil' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'curso' => 'nullable|string|max:255',
            'semestre_atual' => 'nullable|integer',
            'matricula' => 'nullable|string|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => 'nullable|string|max:255',
        ]);

        Estagiario::create($validated);

        return redirect()->route('estagiarios.index')->with('success', 'Estagiário cadastrado com sucesso.');
    }

    public function edit(Estagiario $estagiario)
    {
        return view('estagiarios.edit', compact('estagiario'));
    }

    public function update(Request $request, Estagiario $estagiario)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|unique:estagiarios,cpf,' . $estagiario->id,
            'rg' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'estado_civil' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'curso' => 'nullable|string|max:255',
            'semestre_atual' => 'nullable|integer',
            'matricula' => 'nullable|string|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => 'nullable|string|max:255',
        ]);

        $estagiario->update($validated);

        return redirect()->route('estagiarios.index')->with('success', 'Estagiário atualizado com sucesso.');
    }

    public function destroy(Estagiario $estagiario)
    {
        $estagiario->delete();
        return redirect()->route('estagiarios.index')->with('success', 'Estagiário removido com sucesso.');
    }
}
