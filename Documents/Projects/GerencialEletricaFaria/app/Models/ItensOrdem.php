<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItensOrdem extends Model
{
    protected $table = 'itens_ordem';
    protected $primaryKey = 'id_item_ordem';

    protected $fillable = [
        'id_produto',
        'quantidade',
        'preco_unitario',
        'id_ordem_servico',
        'total_produto',
    ];

    // Relacionamento com Produto
    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }

    // Relacionamento com Ordem de Serviço
    public function ordemDeServico(): BelongsTo
    {
        return $this->belongsTo(OrdemDeServico::class, 'id_ordem_servico', 'id_ordem_servico');
    }
}
