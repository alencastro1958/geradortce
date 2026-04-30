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
        $excecaoCnpj = '82.951.328/0001-58';
        $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
        $cnpjExcecaoLimpo = preg_replace('/\D/', '', $excecaoCnpj);

        $rules = [
            'cnpj' => $cnpjLimpo === $cnpjExcecaoLimpo ? 'required' : 'required|unique:instituicao_ensinos,cnpj',
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'mantenedora' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        InstituicaoEnsino::create($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição cadastrada com sucesso.');
    }

    public function edit(InstituicaoEnsino $instituicoe)
    {
        return view('instituicoes.edit', ['instituicao' => $instituicoe]);
    }

    public function update(Request $request, InstituicaoEnsino $instituicoe)
    {
        $excecaoCnpj = '82.951.328/0001-58';
        $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
        $cnpjExcecaoLimpo = preg_replace('/\D/', '', $excecaoCnpj);

        $rules = [
            'cnpj' => $cnpjLimpo === $cnpjExcecaoLimpo ? 'required' : 'required|unique:instituicao_ensinos,cnpj,' . $instituicoe->id,
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'mantenedora' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        $instituicoe->update($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição atualizada com sucesso.');
    }

    public function destroy(InstituicaoEnsino $instituicoe)
    {
        $instituicoe->delete();
        return redirect()->route('instituicoes.index')->with('success', 'Instituição removida com sucesso.');
    }
}
