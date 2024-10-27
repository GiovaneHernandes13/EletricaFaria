<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cest extends Model
{
    use HasFactory;

    protected $table = 'cest'; // Altere para o nome correto da tabela

    protected $fillable = [
        'codigo_cest',
        'descricao_cest'
    ];

    public function produtos() 
    {
        return $this->hasMany(Produto::class, 'id_cest');
    }
}
