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
            'telefone_secundario' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'email_secundario' => 'nullable|email|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => 'nullable|string|max:255',
            'responsavel_legal_rg' => 'nullable|string|max:255',
            'responsavel_legal_email' => 'nullable|email|max:255',
            'responsavel_legal_whatsapp' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        InstituicaoEnsino::create($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição cadastrada com sucesso.');
    }

    public function edit(InstituicaoEnsino $instituicao)
    {
        return view('instituicoes.edit', ['instituicao' => $instituicao]);
    }

    public function update(Request $request, InstituicaoEnsino $instituicao)
    {
        $excecaoCnpj = '82.951.328/0001-58';
        $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
        $cnpjExcecaoLimpo = preg_replace('/\D/', '', $excecaoCnpj);

        $rules = [
            'cnpj' => $cnpjLimpo === $cnpjExcecaoLimpo ? 'required' : 'required|unique:instituicao_ensinos,cnpj,' . $instituicao->id,
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'mantenedora' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'telefone_secundario' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'email_secundario' => 'nullable|email|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => 'nullable|string|max:255',
            'responsavel_legal_rg' => 'nullable|string|max:255',
            'responsavel_legal_email' => 'nullable|email|max:255',
            'responsavel_legal_whatsapp' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        $instituicao->update($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição atualizada com sucesso.');
    }

    public function destroy(InstituicaoEnsino $instituicao)
    {
        $instituicao->delete();
        return redirect()->route('instituicoes.index')->with('success', 'Instituição removida com sucesso.');
    }
}
