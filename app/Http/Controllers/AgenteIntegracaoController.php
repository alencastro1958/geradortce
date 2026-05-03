<?php

namespace App\Http\Controllers;

use App\Models\AgenteIntegracao;
use App\Models\RepresentanteLegal;
use Illuminate\Http\Request;

class AgenteIntegracaoController extends Controller
{
    public function index()
    {
        $agente = AgenteIntegracao::first();
        $representantes = RepresentanteLegal::where('entidade_tipo', 'agente')
            ->where('entidade_id', $agente->id ?? 0)
            ->get();
        return view('agente_integracao.index', compact('agente', 'representantes'));
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
            'responsavel_legal_cpf' => 'nullable|string|max:20',
            'responsavel_legal_cargo' => 'nullable|string|max:100',
            'responsavel_legal_rg' => 'nullable|string|max:30',
            'responsavel_legal_email' => 'nullable|email|max:255',
            'responsavel_legal_whatsapp' => 'nullable|string|max:20',
            'responsavel_legal_rg_orgao_emissor' => 'nullable|string|max:50',
            'responsavel_legal_rg_uf' => 'nullable|string|max:2',
            'responsavel_legal_nacionalidade' => 'nullable|string|max:100',
            'responsavel_legal_data_nascimento' => 'nullable|date',
            'responsavel_legal_celular' => 'nullable|string|max:20',
            'responsavel_legal_celular2' => 'nullable|string|max:20',
            'responsavel_legal_principal' => 'nullable|boolean',
            'responsavel_legal_ativo' => 'nullable|boolean',
            'responsavel_legal_assina_documentos' => 'nullable|boolean',
            'responsavel_legal_observacoes' => 'nullable|string',
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
