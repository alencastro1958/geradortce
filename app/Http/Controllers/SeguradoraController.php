<?php

namespace App\Http\Controllers;

use App\Models\Seguradora;
use Illuminate\Http\Request;

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
            'apolice_numero' => 'nullable|string|max:255',
        ]);

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
            'apolice_numero' => 'nullable|string|max:255',
        ]);

        $seguradora->update($validated);

        return redirect()->route('seguradoras.index')->with('success', 'Seguradora atualizada com sucesso.');
    }

    public function destroy(Seguradora $seguradora)
    {
        $seguradora->delete();
        return redirect()->route('seguradoras.index')->with('success', 'Seguradora removida com sucesso.');
    }
}
