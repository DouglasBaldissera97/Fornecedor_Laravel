<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $nome = $request->query('nome');
        $fornecedores = Fornecedor::when($nome, fn($q) => $q->where('nome', 'like', "%$nome%"))->get();
        return response()->json($fornecedores);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:fornecedores,cnpj',
            'email' => 'nullable|email|max:255',
            'criado_em' => 'required|date'
        ]);

        $fornecedor = Fornecedor::create($data);
        return response()->json($fornecedor, 201);
    }
}
