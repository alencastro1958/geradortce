<?php
namespace App\Http\Controllers;

use App\Models\EmpresaConcedente;
use Illuminate\Http\Request;

class ApiSupervisorController extends Controller
{
    public function byEmpresa(EmpresaConcedente $empresa)
    {
        $supervisores = $empresa->supervisores()
            ->where('ativo', true)
            ->orderBy('nome')
            ->get(['id', 'nome', 'cargo', 'formacao']);

        return response()->json($supervisores);
    }
}
