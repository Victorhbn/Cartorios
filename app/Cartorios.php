<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartorios extends Model
{
    protected $fillable = [
        'nome', 'email', 'razao', 'documento', 'cep', 'endereco', 'bairro', 'cidade', 'uf', 'telefone', 'email', 'tabeliao', 'ativo'
    ];
}
