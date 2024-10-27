<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cidade extends Model
{
    protected $table = 'CIDADE';

    protected $fillable = [
        'id_estado',
        'nome_cidade',
    ];

    // Define the relationship with the "Estado" model
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'id_estado', 'id_estado');
    }
}
