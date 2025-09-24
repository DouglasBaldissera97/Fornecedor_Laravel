<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory;
    // use SoftDeletes; // se quiser habilitar exclusão lógica

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'criado_em'
    ];

    public $timestamps = false; // porque você usa 'criado_em' manual
}
