<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Fornecedor;

class FornecedorApiTest extends TestCase
{
    use RefreshDatabase; // Reseta o banco de dados antes de cada test
    /** @test */
    public function pode_criar_um_novo_fornecedor_com_dados_validos()
    {
        $fornecedorData = [
            'nome' => 'Fornecedor de Teste',
            'cnpj' => '12345678000190',
            'email' => 'teste@email.com'
        ];

        $response = $this->postJson('/api/fornecedores', $fornecedorData);

        $response->assertStatus(201)
                 ->assertJson([
                     'data' => [
                         'nome' => 'Fornecedor de Teste',
                         'cnpj' => '12345678000190',
                         'email' => 'teste@email.com'
                     ]
                 ]);

        $this->assertDatabaseHas('fornecedores', [
            'cnpj' => '12345678000190'
        ]);
    }

    /** @test */
    public function nao_pode_criar_um_fornecedor_com_dados_invalidos()
    {
        $fornecedorData = [
            'nome' => '',
            'cnpj' => '123',
            'email' => 'email-invalido'
        ];

        $response = $this->postJson('/api/fornecedores', $fornecedorData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['nome', 'cnpj', 'email']);

        $this->assertDatabaseMissing('fornecedores', [
            'email' => 'email-invalido',
        ]);
    }

    /** @test */
    public function pode_filtrar_fornecedores_por_nome()
    {
        Fornecedor::factory()->create(['nome' => 'Empresa Alfa']);
        Fornecedor::factory()->create(['nome' => 'Empresa Beta']);
        Fornecedor::factory()->create(['nome' => 'Empresa Teste']);

        $response = $this->getJson('/api/fornecedores?nome=Teste');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment([
                     'nome' => 'Empresa Teste'
                 ]);
    }
}