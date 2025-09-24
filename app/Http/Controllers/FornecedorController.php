<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Http\Requests\StoreFornecedorRequest;
use App\Services\FornecedorService;
use App\Http\Resources\FornecedorResource;
use Exception;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $nome = $request->query('nome');
        $fornecedores = Fornecedor::when($nome, fn($q) => $q->where('nome', 'like', "%$nome%"))->get();
        // return response()->json($fornecedores);
        // Use FornecedorResource::collection() para transformar a coleção
        return FornecedorResource::collection($fornecedores);
    }

    public function store(StoreFornecedorRequest $request, FornecedorService $fornecedorService)
    {
        // $data = $request->validated(); // Apenas use o método validated()

        // $fornecedor = Fornecedor::create($data);
        // return response()->json($fornecedor, 201);

        try {
            $fornecedor = $fornecedorService->createFornecedor($request->validated());
            // return response()->json($fornecedor, 201);
            // Retorne uma nova instância do Resource
            return new FornecedorResource($fornecedor);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao criar fornecedor: ' . $e->getMessage()], 500);
        }
    }
}
