<?php

namespace App\Http\Controllers;

use App\Models\Seguradora;
use App\Http\Requests\StoreSeguradoraRequest;
use App\Http\Requests\UpdateSeguradoraRequest;
use Illuminate\Support\Facades\Storage;

class SeguradoraController extends Controller
{
    public function index()
    {
        $seguradoras = Seguradora::latest()->paginate(10);
        return view('seguradoras.index', compact('seguradoras'));
    }

    public function create()
    {
        return view('seguradoras.create');
    }

    public function store(StoreSeguradoraRequest $request)
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

        if ($request->hasFile('arquivo_apolice')) {
            $path = $request->file('arquivo_apolice')->store('apolices', 'public');
            $validated['arquivo_apolice'] = $path;
        }

        Seguradora::create($validated);

        return redirect()->route('seguradoras.index')->with('success', 'Seguradora cadastrada com sucesso.');
    }

    public function edit(Seguradora $seguradora)
    {
        return view('seguradoras.edit', compact('seguradora'));
    }

    public function update(UpdateSeguradoraRequest $request, Seguradora $seguradora)
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

        if ($request->hasFile('arquivo_apolice')) {
            // Remove arquivo antigo se existir
            if ($seguradora->arquivo_apolice) {
                Storage::disk('public')->delete($seguradora->arquivo_apolice);
            }
            $path = $request->file('arquivo_apolice')->store('apolices', 'public');
            $validated['arquivo_apolice'] = $path;
        }

        $seguradora->update($validated);

        return redirect()->route('seguradoras.index')->with('success', 'Seguradora atualizada com sucesso.');
    }

    public function download(Seguradora $seguradora)
    {
        if (!$seguradora->arquivo_apolice || !Storage::disk('public')->exists($seguradora->arquivo_apolice)) {
            return back()->with('error', 'Arquivo não encontrado.');
        }

        return Storage::disk('public')->download($seguradora->arquivo_apolice);
    }

    public function destroy(Seguradora $seguradora)
    {
        if ($seguradora->arquivo_apolice) {
            Storage::disk('public')->delete($seguradora->arquivo_apolice);
        }
        $seguradora->delete();
        return redirect()->route('seguradoras.index')->with('success', 'Seguradora removida com sucesso.');
    }
}
