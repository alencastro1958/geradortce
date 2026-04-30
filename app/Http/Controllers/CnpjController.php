<?php

namespace App\Http\Controllers;

use App\Services\CnpjService;
use Illuminate\Http\Request;

class CnpjController extends Controller
{
    protected $cnpjService;

    public function __construct(CnpjService $cnpjService)
    {
        $this->cnpjService = $cnpjService;
    }

    public function consultar(Request $request)
    {
        $request->validate([
            'cnpj' => 'required|string'
        ]);

        $dados = $this->cnpjService->consultar($request->cnpj);

        return response()->json($dados);
    }
}
