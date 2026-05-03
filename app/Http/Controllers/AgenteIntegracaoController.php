<?php

namespace App\Http\Controllers;

use App\Models\AgenteIntegracao;
use Illuminate\Http\Request;

class AgenteIntegracaoController extends Controller
{
    public function index()
    {
        $agente = AgenteIntegracao::first();
        return view('agente_integracao.index', compact('agente'));
    }

    public function update(Request $request)
    {
        $agente = AgenteIntegracao::first() ?? new AgenteIntegracao();

        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'responsavel_legal_nome' => 'required|string|max:255',
            'contato_nome' => 'nullable|string|max:255',
            'contato_fone' => 'nullable|string|max:255',
            'contato_email' => 'nullable|email|max:255',
            'observacoes' => 'nullable|string',
        ]);

        $agente->fill($validated);
        $agente->save();

        return redirect()->route('agente.index')->with('success', 'Dados da Agência Integradora atualizados com sucesso!');
    }
}
