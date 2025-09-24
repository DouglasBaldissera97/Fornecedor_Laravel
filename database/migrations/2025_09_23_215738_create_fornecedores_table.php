<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();                        // id auto-increment
            $table->string('nome', 255);         // nome obrigatório
            $table->string('cnpj', 14)->unique(); // cnpj obrigatório e único
            $table->string('email', 255)->nullable(); // email opcional
            $table->dateTime('criado_em');       // data de criação
            $table->softDeletes();               // para softDeletes (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
