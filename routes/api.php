<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;

Route::get('/fornecedores', [FornecedorController::class, 'index']);
Route::post('/fornecedores', [FornecedorController::class, 'store']);