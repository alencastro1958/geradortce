<?php

namespace App\Http\Controllers;

use App\Models\EmpresaConcedente;
use Illuminate\Http\Request;

class EmpresaConcedenteController extends Controller
{
    public function index()
    {
        $empresas = EmpresaConcedente::latest()->paginate(10);
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $excecaoCnpj = '82.951.328/0001-58';
        $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
        $cnpjExcecaoLimpo = preg_replace('/\D/', '', $excecaoCnpj);

        $rules = [
            'cnpj' => $cnpjLimpo === $cnpjExcecaoLimpo ? 'required' : 'required|unique:empresa_concedentes,cnpj',
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'email_secundario' => 'nullable|email|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => 'nullable|string|max:255',
            'responsavel_legal_rg' => 'nullable|string|max:255',
            'responsavel_legal_email' => 'nullable|email|max:255',
            'responsavel_legal_whatsapp' => 'nullable|string|max:255',
            'autoriza_envio_mensagens' => 'nullable|boolean',
            'supervisor_nome' => 'nullable|string|max:255',
            'supervisor_cargo' => 'nullable|string|max:100',
            'supervisor_tempo_atividade' => 'nullable|string|max:100',
            'supervisor_cpf' => 'nullable|string|max:20',
            'supervisor_rg' => 'nullable|string|max:20',
            'supervisor_email' => 'nullable|email|max:255',
            'supervisor_telefone_whatsapp' => 'nullable|string|max:20',
            'supervisor_registro_profissional' => 'nullable|string|max:100',
        ];

        $validated = $request->validate($rules);
        $validated['autoriza_envio_mensagens'] = $request->has('autoriza_envio_mensagens');

        EmpresaConcedente::create($validated);

        return redirect()->route('empresas.index')->with('success', 'Empresa cadastrada com sucesso.');
    }

    public function edit(EmpresaConcedente $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, EmpresaConcedente $empresa)
    {
        $excecaoCnpj = '82.951.328/0001-58';
        $cnpjLimpo = preg_replace('/\D/', '', $request->cnpj);
        $cnpjExcecaoLimpo = preg_replace('/\D/', '', $excecaoCnpj);

        $rules = [
            'cnpj' => $cnpjLimpo === $cnpjExcecaoLimpo ? 'required' : 'required|unique:empresa_concedentes,cnpj,' . $empresa->id,
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'telefone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'email_secundario' => 'nullable|email|max:255',
            'responsavel_legal_nome' => 'nullable|string|max:255',
            'responsavel_legal_cargo' => 'nullable|string|max:255',
            'responsavel_legal_cpf' => 'nullable|string|max:255',
            'responsavel_legal_rg' => 'nullable|string|max:255',
            'responsavel_legal_email' => 'nullable|email|max:255',
            'responsavel_legal_whatsapp' => 'nullable|string|max:255',
            'autoriza_envio_mensagens' => 'nullable|boolean',
            'supervisor_nome' => 'nullable|string|max:255',
            'supervisor_cargo' => 'nullable|string|max:100',
            'supervisor_tempo_atividade' => 'nullable|string|max:100',
            'supervisor_cpf' => 'nullable|string|max:20',
            'supervisor_rg' => 'nullable|string|max:20',
            'supervisor_email' => 'nullable|email|max:255',
            'supervisor_telefone_whatsapp' => 'nullable|string|max:20',
            'supervisor_registro_profissional' => 'nullable|string|max:100',
        ];

        $validated = $request->validate($rules);
        $validated['autoriza_envio_mensagens'] = $request->has('autoriza_envio_mensagens');

        $empresa->update($validated);

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso.');
    }

    public function destroy(EmpresaConcedente $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa removida com sucesso.');
    }
}
