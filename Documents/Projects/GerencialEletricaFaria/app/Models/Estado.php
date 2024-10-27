<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    protected $table = 'ESTADO';

    protected $fillable = [
        'nome_estado',
        'uf_estado',
        'codigo_estado',
    ];

    public function cidades(): HasMany
    {
        return $this->hasMany(Cidade::class, 'id_estado', 'id_estado');
    }
}
