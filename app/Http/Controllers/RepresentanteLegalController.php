<?php
namespace App\Http\Controllers;

use App\Models\RepresentanteLegal;
use App\Models\EmpresaConcedente;
use App\Models\InstituicaoEnsino;
use App\Models\Seguradora;
use App\Models\AgenteIntegracao;
use Illuminate\Http\Request;

class RepresentanteLegalController extends Controller
{
    private function getEntidade(string $tipo, int $id)
    {
        return match($tipo) {
            'empresa' => EmpresaConcedente::findOrFail($id),
            'instituicao' => InstituicaoEnsino::findOrFail($id),
            'seguradora' => Seguradora::findOrFail($id),
            'agente' => AgenteIntegracao::findOrFail($id),
            default => abort(404),
        };
    }

    private function getRedirectRoute(string $tipo, $entidade)
    {
        return match($tipo) {
            'empresa' => redirect()->route('empresas.edit', $entidade),
            'instituicao' => redirect()->route('instituicoes.edit', $entidade->id),
            'seguradora' => redirect()->route('seguradoras.edit', $entidade),
            'agente' => redirect()->route('agente.index'),
            default => redirect()->back(),
        };
    }

    public function create(string $tipo, int $entidadeId)
    {
        $entidade = $this->getEntidade($tipo, $entidadeId);
        return view('representantes.create', compact('tipo', 'entidade'));
    }

    public function store(Request $request, string $tipo, int $entidadeId)
    {
        $entidade = $this->getEntidade($tipo, $entidadeId);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:20',
            'rg' => 'nullable|string|max:30',
            'rg_orgao_emissor' => 'nullable|string|max:50',
            'rg_uf' => 'nullable|string|max:2',
            'cargo' => 'nullable|string|max:100',
            'nacionalidade' => 'nullable|string|max:100',
            'data_nascimento' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'celular' => 'nullable|string|max:20',
            'celular2' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'principal' => 'nullable|boolean',
            'ativo' => 'nullable|boolean',
            'assina_documentos' => 'nullable|boolean',
            'observacoes' => 'nullable|string',
        ]);

        $validated['entidade_tipo'] = $tipo;
        $validated['entidade_id'] = $entidadeId;
        $validated['principal'] = $request->boolean('principal');
        $validated['ativo'] = $request->boolean('ativo', true);
        $validated['assina_documentos'] = $request->boolean('assina_documentos');

        RepresentanteLegal::create($validated);

        return $this->getRedirectRoute($tipo, $entidade)->with('success', 'Representante Legal adicionado com sucesso.');
    }

    public function edit(RepresentanteLegal $representante)
    {
        $tipo = $representante->entidade_tipo;
        $entidade = $this->getEntidade($tipo, $representante->entidade_id);
        return view('representantes.edit', compact('representante', 'tipo', 'entidade'));
    }

    public function update(Request $request, RepresentanteLegal $representante)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:20',
            'rg' => 'nullable|string|max:30',
            'rg_orgao_emissor' => 'nullable|string|max:50',
            'rg_uf' => 'nullable|string|max:2',
            'cargo' => 'nullable|string|max:100',
            'nacionalidade' => 'nullable|string|max:100',
            'data_nascimento' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'celular' => 'nullable|string|max:20',
            'celular2' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'principal' => 'nullable|boolean',
            'ativo' => 'nullable|boolean',
            'assina_documentos' => 'nullable|boolean',
            'observacoes' => 'nullable|string',
        ]);

        $validated['principal'] = $request->boolean('principal');
        $validated['ativo'] = $request->boolean('ativo', true);
        $validated['assina_documentos'] = $request->boolean('assina_documentos');

        $representante->update($validated);

        $tipo = $representante->entidade_tipo;
        $entidade = $this->getEntidade($tipo, $representante->entidade_id);

        return $this->getRedirectRoute($tipo, $entidade)->with('success', 'Representante Legal atualizado com sucesso.');
    }

    public function destroy(RepresentanteLegal $representante)
    {
        $tipo = $representante->entidade_tipo;
        $entidadeId = $representante->entidade_id;
        $entidade = $this->getEntidade($tipo, $entidadeId);
        $representante->delete();
        return $this->getRedirectRoute($tipo, $entidade)->with('success', 'Representante Legal removido com sucesso.');
    }
}
