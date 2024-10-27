<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncm extends Model
{
    use HasFactory;

    protected $table = 'NCM';

    protected $fillable = [
        'id_ncm',
        'codigo_ncm',
        'descricao_ncm',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true; // Habilita os timestamps

    public function produtos() 
    {
        return $this->hasMany(Produto::class, 'id_ncm');
    }
}



