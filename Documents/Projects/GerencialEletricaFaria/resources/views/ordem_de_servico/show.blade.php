@extends('layout.index')

@section('conteudo')

<h2 class="titulo-os">Detalhes da Ordem de Serviço</h2>

    <ul class="detalhes-os">
        <li><strong>ID:</strong> {{ $ordem->id_ordem_servico }}</li>
        <li><strong>Nome da O.S.:</strong> {{ $ordem->nome_ordem }}</li>
        <li><strong>Cliente:</strong> {{ $ordem->pessoa->nome ?? 'N/A' }}</li>
        <li><strong>Funcionário:</strong> {{ $ordem->funcionario->nome ?? 'N/A' }}</li>
        <li><strong>Data de Abertura:</strong> {{ $ordem->data_abertura }}</li>
        <li><strong>Status:</strong> {{ $ordem->status->descricao_status ?? 'N/A' }}</li>
        <li><strong>Data de Fechamento:</strong> {{ $ordem->data_fechamento ?? 'Ainda em aberto' }}</li>
    </ul>

    <h4 class="mao-de-obra-titulo">Mão de Obra</h4>
    <ul class="mao-de-obra">
        <li><strong>Quantidade de Serviço:</strong> {{ $ordem->quantidade_servico }}</li>
        <li><strong>Descrição do Serviço:</strong> {{ $ordem->descricao_servico }}</li>
        <li><strong>Preço Unitário:</strong> {{ $ordem->preco_unitario_servico }}</li>
        <li><strong>Total do Serviço:</strong> {{ $ordem->total_servico }}</li>
    </ul>

    <h3 class="itens-os-titulo">Itens da Ordem de Serviço</h3>

    @foreach($ordem->itens as $item)
        <ul class="item-os">
            <li><strong>Produto:</strong> {{ $item->produto->nome_produto ?? 'N/A' }}</li>
            <li><strong>Quantidade:</strong> {{ $item->quantidade }}</li>
            <li><strong>Preço Unitário:</strong> {{ $item->preco_unitario }}</li>
            <li><strong>Total:</strong> {{ $item->total_item }}</li>
        </ul>
    @endforeach

    <h4 class="total-geral">Total Geral da O.S.:</h4>
    <p class="valor-total">{{ $ordem->total_geral }}</p>

    <a href="{{ route('ordem-servico.pdf', $ordem->id_ordem_servico) }}" class="botao-pdf">
        <img class="icons" src="{{ asset('img/pdf.png') }}" alt="Gerar PDF" title="Gerar PDF">
        Gerar PDF
    </a>
    

@endsection
