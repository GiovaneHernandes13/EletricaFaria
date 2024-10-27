<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrdemDeServico;

class Funcionario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'funcionarios';
    protected $primaryKey = 'id_funcionario';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'telefone',
        'email',
        'data_contratacao',
        'cargo',
        'salario',
    ];

    protected $casts = [
        // Adicione aqui se necessário
    ];

    public function ordensDeServico(): HasMany
    {
        return $this->hasMany(OrdemDeServico::class, 'id_funcionario', 'id_funcionario');
    }
    
}
