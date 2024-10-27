@extends('layout.index')

@section('conteudo')
    <a class="btn_add" href="{{ route('pessoas.create') }}">ADD Cliente</a>
    <table class="table">
        <thead>
            <tr class="table-header">
                <th class="table-cell">Nome</th>
                <th class="table-cell">Tipo</th>
                <th class="table-cell">CNPJ/CPF</th>
                <th class="table-cell">Inscrição Estadual</th>
                <th class="table-cell">Ações</th>
            </tr>
        </thead>
        <tbody id="productList">
            @foreach ($pessoas as $linha)
                <tr class="table-row">
                    <td class="table-cell">{{ $linha->nome }}</td>
                    <td class="table-cell">{{ $linha->tipo }}</td>
                    
                    @if ($linha->tipo == 1) <!-- Pessoa Física -->
                        <td class="table-cell">{{ $linha->cpf }}</td>
                        <td class="table-cell">{{ $linha->rg }}</td>
                    @elseif ($linha->tipo == 2) <!-- Pessoa Jurídica -->
                        <td class="table-cell">{{ $linha->cnpj }}</td>
                        <td class="table-cell">{{ $linha->inscricao_estadual }}</td>
                    @endif
    
                    <td class="table-cell icons-container">
                        <a href="{{ route('pessoas.edit', $linha->id) }}">
                            <img class="icons" src="{{ asset('img/edit.png') }}" alt="Editar">
                        </a>                       
                        <a href="{{ route('pessoas.show', $linha->id) }}">
                            <img class="icons" src="{{ asset('img/documento.png') }}" alt="Detalhes">
                        </a>                        
                        <form action="{{ route('pessoas.destroy', $linha) }}" method="POST" class="delete-button" onsubmit="return confirm('Tem certeza que deseja excluir este Cliente?');">
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