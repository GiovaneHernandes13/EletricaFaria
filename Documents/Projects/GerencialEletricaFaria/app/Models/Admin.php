<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cest extends Model
{
    use HasFactory;

    protected $table = 'admin'; // Altere para o nome correto da tabela

    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    public function produtos() 
    {
        return $this->hasMany(Produto::class, 'id_cest');
    }
}
