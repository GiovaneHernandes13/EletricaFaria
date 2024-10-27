<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pessoa extends Model
{
    protected $table = 'pessoas';

    protected $fillable = [
        'tipo', 'cpf', 'cnpj', 'rg', 'inscricao_estadual', 'nome', 'email', 
        'telefone', 'data_nascimento', 'data_fundacao', 'id_endereco', 
        'razao_social', 'fantasia', 'apelido'
    ];
    
    // Define the relationship with the "Endereco" model
    public function endereco(): BelongsTo
    {
        return $this->belongsTo(Endereco::class, 'id_endereco', 'id_endereco');
    }

    // Custom logic for Pessoa Física or Pessoa Jurídica
    public function isPessoaFisica(): bool
    {
        return $this->tipo === 1;
    }

    public function isPessoaJuridica(): bool
    {
        return $this->tipo === 2;
    }
}


