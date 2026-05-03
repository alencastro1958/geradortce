<?php

namespace App\Http\Controllers;

use App\Models\InstituicaoEnsino;
use App\Http\Requests\StoreInstituicaoEnsinoRequest;
use App\Http\Requests\UpdateInstituicaoEnsinoRequest;

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

    public function store(StoreInstituicaoEnsinoRequest $request)
    {
        $validated = $request->validated();

        $logradouro = $request->input('logradouro');
        if ($logradouro) {
            $numero = $request->input('numero');
            $complemento = $request->input('complemento');
            $endereco = $logradouro;
            if ($numero) {
                $endereco .= ', ' . $numero;
            }
            if ($complemento) {
                $endereco .= ' - ' . $complemento;
            }
            $validated['endereco'] = $endereco;
        }

        InstituicaoEnsino::create($validated);

        return redirect()->route('instituicoes.index')->with('success', 'Instituição cadastrada com sucesso.');
    }

    public function edit($id)
    {
        $instituicao = InstituicaoEnsino::findOrFail($id);
        $instituicao->load('representantesLegais');
        return view('instituicoes.edit', compact('instituicao'));
    }

    public function update(UpdateInstituicaoEnsinoRequest $request, $id)
    {
        $instituicao = InstituicaoEnsino::findOrFail($id);
        $validated = $request->validated();

        $logradouro = $request->input('logradouro');
        if ($logradouro) {
            $numero = $request->input('numero');
            $complemento = $request->input('complemento');
            $endereco = $logradouro;
            if ($numero) {
                $endereco .= ', ' . $numero;
            }
            if ($complemento) {
                $endereco .= ' - ' . $complemento;
            }
            $validated['endereco'] = $endereco;
        }

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
