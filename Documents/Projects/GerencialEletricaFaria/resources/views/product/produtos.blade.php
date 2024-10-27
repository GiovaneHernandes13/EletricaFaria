@extends('layout.index')
@section('conteudo')

    <!-- Caixa de texto para pesquisar produtos -->
    <div class="search-container">
        <input class="pesquisa" type="text" id="searchProduct" placeholder="Pesquisar produtos..." onkeyup="searchProducts()">
        <a class="btn_add" href="{{ route('produto.create') }}">ADD Produto</a>
    </div>

    <table class="table">
        <thead>
            <tr class="table-header">
                <th class="table-cell">ID</th>
                <th class="table-cell">Nome</th>
                <th class="table-cell">Descrição</th>
                <th class="table-cell">Preço</th>
                <th class="table-cell">Ações</th>
            </tr>
        </thead>
        <tbody id="productList">
            @foreach ($produtos as $produto)
                <tr class="table-row">
                    <td class="table-cell">{{ $produto->id_produto }}</td>
                    <td class="table-cell">{{ $produto->nome_produto }}</td>
                    <td class="table-cell">{{ $produto->descricao }}</td>
                    <td class="table-cell">{{ $produto->preco }}</td>
                    <td class="table-cell icons-container">
                        <a href="{{ route('produto.edit', $produto) }}">
                            <img class="icons" src="{{ asset('img/edit.png') }}" alt="Editar">
                        </a>
                        <a href="{{ route('produto.show', $produto) }}">
                            <img class="icons" src="{{ asset('img/documento.png') }}" alt="">
                        </a>
                        <form action="{{ route('produto.destroy', $produto) }}" method="POST" class="delete-button" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img class="icons" src="{{ asset('img/excluir.png') }}" alt="Excluir">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
