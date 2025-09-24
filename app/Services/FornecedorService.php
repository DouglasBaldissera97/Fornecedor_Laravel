<?php

namespace App\Services;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class FornecedorService
{
    /**
     * Remove caracteres especiais do CNPJ.
     *
     * @param string $cnpj
     * @return string
     */
    protected function sanitizeCnpj(string $cnpj): string
    {
        return preg_replace('/[^0-9]/', '', $cnpj);
    }

    /**
     * Cria um novo fornecedor com transação e sanitização do CNPJ.
     *
     * @param array $data
     * @return Fornecedor
     * @throws \Exception
     */
    public function createFornecedor(array $data): Fornecedor
    {
        // Inicia a transação do banco de dados
        DB::beginTransaction();


        try {
            // Sanitiza o CNPJ antes de usar
            $data['cnpj'] = $this->sanitizeCnpj($data['cnpj']);
            // Adiciona a data de criação antes de salvar
            $data['criado_em'] = Carbon::now();

            // Cria o fornecedor no banco de dados
            $fornecedor = Fornecedor::create($data);

            // Confirma a transação
            DB::commit();

            return $fornecedor;
        } catch (Exception $e) {
            // Reverte a transação em caso de erro
            DB::rollBack();
            
            // Lança a exceção novamente para ser capturada pelo Controller
            throw $e;
        }
    }
}