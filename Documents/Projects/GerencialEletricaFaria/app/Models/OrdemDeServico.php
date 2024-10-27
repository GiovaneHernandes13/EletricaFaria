<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Pessoa;
use App\Models\Status;
use App\Models\ItensOrdem;


class OrdemDeServico extends Model
{
    protected $table = 'ORDEM_DE_SERVICOS';
    protected $primaryKey = 'id_ordem_servico';
    public $timestamps = false;


    protected $fillable = [
        'id_funcionario',
        'data_abertura',
        'data_fechamento',
        'descricao_servico',
        'quantidade_servico',
        'preco_unitario_servico',
        'total_servico',
        'id_status',
        'id_pessoa',
        'nome_ordem',
    ];

    // Relacionamento com Pessoa
    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'id_pessoa', 'id');
    }

    // Relacionamento com Status
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'id_status', 'id_status');
    }

    // Relacionamento com Funcionario
    public function funcionario(): BelongsTo
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario', 'id_funcionario');
    }

    // Relacionamento com Itens da Ordem de Serviço
    public function itens(): HasMany
    {
        return $this->hasMany(ItensOrdem::class, 'id_ordem_servico', 'id_ordem_servico');
    }
}
