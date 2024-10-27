@extends('layout.index')

@section('conteudo')

    <h1>Lista de Funcionários</h1>
    <a class="btn_add" href="{{ route('funcionarios.create') }}">ADD Funcionario</a>
    <table class="table">
        <thead>
            <tr class="table-header">
                <th class="table-cell">ID</th>
                <th class="table-cell">Nome</th>
                <th class="table-cell">Data Contratação</th>
                <th class="table-cell">Cargo</th>
                <th class="table-cell">Ações</th>
            </tr>
        </thead>
        <tbody id="productList">
            @foreach ($funcionarios as $funcionario)
                <tr class="table-row">
                    <td class="table-cell">{{ $funcionario->id_funcionario }}</td>
                    <td class="table-cell">{{ $funcionario->nome }}</td>
                    <td class="table-cell">{{ $funcionario->cargo }}</td>
                    <td class="table-cell">{{ $funcionario->data_contratacao }}</td>
                    <td class="table-cell icons-container">
                        <a href="{{ route('funcionarios.edit', $funcionario) }}">
                            <img class="icons" src="{{ asset('img/edit.png') }}" alt="Editar">
                        </a>
                        <a href="{{ route('funcionarios.show', $funcionario) }}">
                            <img class="icons" src="{{ asset('img/documento.png') }}" alt="">
                        </a>
                        <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" class="delete-button" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
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


