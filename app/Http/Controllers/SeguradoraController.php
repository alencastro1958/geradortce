<?php

namespace App\Http\Controllers;

use App\Models\Seguradora;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'razao_social' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'apolice_numero' => 'nullable|string|max:255',
            'arquivo_apolice' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

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

    public function update(Request $request, Seguradora $seguradora)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'razao_social' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'apolice_numero' => 'nullable|string|max:255',
            'arquivo_apolice' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

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
