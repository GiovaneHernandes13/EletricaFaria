@extends('layout.index')

@section('conteudo')
    <h1>Ordens de Serviço</h1>
    <a href="{{ route('OrdemServicos.create') }}">Criar Nova Ordem</a>

    <table class="table">
        <thead>
            <tr class="table-header">
                <th class="table-cell">ID</th>
                <th class="table-cell">Cliente</th>
                <th class="table-cell">Nome O.S</th>
                <th class="table-cell">Status</th>
                <th class="table-cell">Total</th>
                <th class="table-cell">Açoes</th>
            </tr>
        </thead>
        <tbody id="productList">
            @foreach ($ordens as $linha)
                <tr class="table-row">
                    <td class="table-cell">{{ $linha->id_ordem_servico }}</td>
                    <td class="table-cell">{{ $linha->pessoa->nome  }}</td>
                    <td class="table-cell">{{ $linha->nome_ordem }}</td>
                    <td class="table-cell">{{ $linha->status->descricao_status }}</td>
                    <td class="table-cell">{{ $linha->total_servico }}</td>
                    <th class="table-cell">
                        <img class="icons" src="{{ asset('img/pdf.png') }}" alt="">
                        <img class="icons" src="{{ asset('img/edit.png') }}" alt="Editar">
                        <a href="{{ route('OrdemServicos.show', $linha->id_ordem_servico) }}">
                            <img class="icons" src="{{ asset('img/documento.png') }}" alt="">
                        </a>
                        <form action="{{ route('OrdemServicos.destroy', $linha->id_ordem_servico) }}" method="POST" class="delete-button" onsubmit="return confirm('Tem certeza que deseja excluir este O.S.?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img class="icons" src="{{ asset('img/excluir.png') }}" alt="Excluir">
                            </button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
