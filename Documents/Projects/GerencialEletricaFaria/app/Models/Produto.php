<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $primaryKey = 'id_produto';
    protected $keyType = 'int';

    protected $fillable = [
        'nome_produto',
        'descricao',
        'preco',
        'estoque',
        'preco_custo',
        'id_ncm',
        'id_cest',
    ];

    public function cest()
    {
        return $this->belongsTo(Cest::class, 'id_cest', 'id_cest');
    }

    public function ncm()
    {
        return $this->belongsTo(NCM::class, 'id_ncm', 'id_ncm');
    }

    // Relacionamento com Itens da Ordem de Serviço
    public function itensOrdem(): HasMany
    {
        return $this->hasMany(ItensOrdem::class, 'id_produto', 'id_produto');
    }

    protected $casts = [
        'preco' => 'decimal:2',
        'preco_custo' => 'decimal:2',
        'estoque' => 'integer',
    ];
}
