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

    private function regrasValidacao(): array
    {
        return [
            'nome'             => 'required|string|max:255',
            'data_nascimento'  => 'nullable|date',
            'cpf'              => 'required|string|max:20',
            'rg'               => 'required|string|max:30',
            'rg_orgao_emissor' => 'required|string|max:50',
            'rg_uf'            => 'required|string|max:2',
            'cargo'            => 'required|string|max:100',
            'celular'          => 'required|string|max:20',
            'email'            => 'required|email|max:255',
            'formacao'         => 'required|string|max:255',
            'orgao_regulamentador'  => 'nullable|string|max:255',
            'outras_formacoes'      => 'nullable|string',
            'observacoes'           => 'nullable|string',
            'tempo_atividade'       => 'required|string|max:100',
            'registro_profissional' => 'nullable|string|max:100',
            'setor'    => 'nullable|string|max:255',
            'matricula' => 'nullable|string|max:100',
            'ativo'                    => 'nullable|boolean',
            'acessa_processo_seletivo' => 'nullable|boolean',
            'assina_documentos'        => 'nullable|boolean',
        ];
    }

    private function mensagensValidacao(): array
    {
        return [
            'cpf.required'              => 'O CPF é obrigatório.',
            'rg.required'               => 'O RG é obrigatório.',
            'rg_orgao_emissor.required' => 'O Órgão Emissor do RG é obrigatório.',
            'rg_uf.required'            => 'A UF do RG é obrigatória.',
            'cargo.required'            => 'O Cargo é obrigatório.',
            'celular.required'          => 'O Celular é obrigatório.',
            'email.required'            => 'O E-mail é obrigatório.',
            'email.email'               => 'Informe um e-mail válido.',
            'formacao.required'         => 'A Formação é obrigatória.',
            'tempo_atividade.required'  => 'O Tempo de Experiência no Cargo é obrigatório.',
        ];
    }

    public function store(Request $request, EmpresaConcedente $empresa)
    {
        $validated = $request->validate($this->regrasValidacao(), $this->mensagensValidacao());

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
        $validated = $request->validate($this->regrasValidacao(), $this->mensagensValidacao());

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
