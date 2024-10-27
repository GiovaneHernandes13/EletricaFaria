<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    public $timestamps = false;

    protected $table = 'ENDERECO';

    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'id_cidade',
    ];

    

    // Define the relationship with the "Cidade" model
    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class, 'id_cidade', 'id_cidade');
    }
}
