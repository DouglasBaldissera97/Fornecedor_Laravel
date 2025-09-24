<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;

Route::get('/', function () {
    return view('welcome');
});