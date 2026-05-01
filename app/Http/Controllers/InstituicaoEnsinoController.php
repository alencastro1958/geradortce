<?php

namespace App\Http\Controllers;

use App\Models\InstituicaoEnsino;
use Illuminate\Http\Request;

class InstituicaoEnsinoController extends Controller
{
    public function index()
    {
        $instituicoes = InstituicaoEnsino::latest()->paginate(10);
        return view('instituicoes.index', compact('instituicoes'));
    }

    public function create()
    {
        return view('instituicoes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cnpj' => 'required|unique:instituicao_ensinos,cnpj',
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
        ]);

        InstituicaoEnsino::create($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição cadastrada com sucesso.');
    }

    public function edit($id)
    {
        $instituicao = InstituicaoEnsino::findOrFail($id);
        return view('instituicoes.edit', compact('instituicao'));
    }

    public function update(Request $request, $id)
    {
        $instituicao = InstituicaoEnsino::findOrFail($id);

        $validated = $request->validate([
            'cnpj' => 'required|unique:instituicao_ensinos,cnpj,' . $id,
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
        ]);

        $instituicao->update($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $instituicao = InstituicaoEnsino::findOrFail($id);
        $instituicao->delete();
        return redirect()->route('instituicoes.index')->with('success', 'Instituição removida com sucesso.');
    }
}