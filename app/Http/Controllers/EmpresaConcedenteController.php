<?php

namespace App\Http\Controllers;

use App\Models\EmpresaConcedente;
use App\Http\Requests\StoreEmpresaConcedenteRequest;
use App\Http\Requests\UpdateEmpresaConcedenteRequest;

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

    public function store(StoreEmpresaConcedenteRequest $request)
    {
        $validated = $request->validated();
        $validated['autoriza_envio_mensagens'] = $request->has('autoriza_envio_mensagens');

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

        EmpresaConcedente::create($validated);

        return redirect()->route('empresas.index')->with('success', 'Empresa cadastrada com sucesso.');
    }

    public function edit(EmpresaConcedente $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(UpdateEmpresaConcedenteRequest $request, EmpresaConcedente $empresa)
    {
        $validated = $request->validated();
        $validated['autoriza_envio_mensagens'] = $request->has('autoriza_envio_mensagens');

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

        $empresa->update($validated);

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso.');
    }

    public function destroy(EmpresaConcedente $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa removida com sucesso.');
    }
}
