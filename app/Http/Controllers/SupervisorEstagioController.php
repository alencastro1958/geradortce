<?php
namespace App\Http\Controllers;

use App\Models\EmpresaConcedente;
use App\Models\SupervisorEstagio;
use Illuminate\Http\Request;

class SupervisorEstagioController extends Controller
{
    public function create(EmpresaConcedente $empresa)
    {
        return view('supervisores.create', compact('empresa'));
    }

    public function store(Request $request, EmpresaConcedente $empresa)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'cpf' => 'nullable|string|max:20',
            'rg' => 'nullable|string|max:30',
            'rg_orgao_emissor' => 'nullable|string|max:50',
            'rg_uf' => 'nullable|string|max:2',
            'cargo' => 'nullable|string|max:100',
            'celular' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'formacao' => 'nullable|string|max:255',
            'orgao_regulamentador' => 'nullable|string|max:255',
            'outras_formacoes' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'tempo_atividade' => 'nullable|string|max:100',
            'registro_profissional' => 'nullable|string|max:100',
            'setor' => 'nullable|string|max:255',
            'matricula' => 'nullable|string|max:100',
            'ativo' => 'nullable|boolean',
            'acessa_processo_seletivo' => 'nullable|boolean',
            'assina_documentos' => 'nullable|boolean',
        ]);

        $validated['empresa_concedente_id'] = $empresa->id;
        $validated['ativo'] = $request->boolean('ativo', true);
        $validated['acessa_processo_seletivo'] = $request->boolean('acessa_processo_seletivo');
        $validated['assina_documentos'] = $request->boolean('assina_documentos');

        SupervisorEstagio::create($validated);

        return redirect()->route('empresas.edit', $empresa)->with('success', 'Supervisor de estágio adicionado com sucesso.');
    }

    public function edit(EmpresaConcedente $empresa, SupervisorEstagio $supervisor)
    {
        return view('supervisores.edit', compact('empresa', 'supervisor'));
    }

    public function update(Request $request, EmpresaConcedente $empresa, SupervisorEstagio $supervisor)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'cpf' => 'nullable|string|max:20',
            'rg' => 'nullable|string|max:30',
            'rg_orgao_emissor' => 'nullable|string|max:50',
            'rg_uf' => 'nullable|string|max:2',
            'cargo' => 'nullable|string|max:100',
            'celular' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'formacao' => 'nullable|string|max:255',
            'orgao_regulamentador' => 'nullable|string|max:255',
            'outras_formacoes' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'tempo_atividade' => 'nullable|string|max:100',
            'registro_profissional' => 'nullable|string|max:100',
            'setor' => 'nullable|string|max:255',
            'matricula' => 'nullable|string|max:100',
            'ativo' => 'nullable|boolean',
            'acessa_processo_seletivo' => 'nullable|boolean',
            'assina_documentos' => 'nullable|boolean',
        ]);

        $validated['ativo'] = $request->boolean('ativo', true);
        $validated['acessa_processo_seletivo'] = $request->boolean('acessa_processo_seletivo');
        $validated['assina_documentos'] = $request->boolean('assina_documentos');

        $supervisor->update($validated);

        return redirect()->route('empresas.edit', $empresa)->with('success', 'Supervisor de estágio atualizado com sucesso.');
    }

    public function destroy(EmpresaConcedente $empresa, SupervisorEstagio $supervisor)
    {
        $supervisor->delete();
        return redirect()->route('empresas.edit', $empresa)->with('success', 'Supervisor removido com sucesso.');
    }
}
