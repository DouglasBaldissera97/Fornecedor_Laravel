<?php

namespace App\Services;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorService
{
    public function criarFornecedor(array $data): Fornecedor
    {
        // Sanitização do CNPJ
        $data['cnpj'] = preg_replace('/\D/', '', $data['cnpj']);

        // Salvar dentro de uma transação
        return DB::transaction(function() use ($data) {
            return Fornecedor::create($data);
        });
    }
}
