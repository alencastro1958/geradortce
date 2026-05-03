<?php

namespace App\Http\Controllers;

use App\Models\Estagiario;
use App\Http\Requests\StoreEstagiarioRequest;
use App\Http\Requests\UpdateEstagiarioRequest;

class EstagiarioController extends Controller
{
    public function index()
    {
        $estagiarios = Estagiario::latest()->paginate(10);
        return view('estagiarios.index', compact('estagiarios'));
    }

    public function create()
    {
        return view('estagiarios.create');
    }

    public function store(StoreEstagiarioRequest $request)
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

        Estagiario::create($validated);

        return redirect()->route('estagiarios.index')->with('success', 'Estagiário cadastrado com sucesso.');
    }

    public function edit(Estagiario $estagiario)
    {
        return view('estagiarios.edit', compact('estagiario'));
    }

    public function update(UpdateEstagiarioRequest $request, Estagiario $estagiario)
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

        $estagiario->update($validated);

        return redirect()->route('estagiarios.index')->with('success', 'Estagiário atualizado com sucesso.');
    }

    public function destroy(Estagiario $estagiario)
    {
        $estagiario->delete();
        return redirect()->route('estagiarios.index')->with('success', 'Estagiário removido com sucesso.');
    }
}
