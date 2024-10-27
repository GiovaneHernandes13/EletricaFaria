@extends('layout.index')
@section('conteudo')

    <ul>
        <li>
            <strong>ID:</strong> {{ $produto->id_produto }}
        </li>
        <li>
            <strong>NOME:</strong> {{ $produto->nome_produto }}
        </li>
        <li>
            <strong>DESCRIÇAO:</strong> {{ $produto->descricao }}
        </li>
        <li>
            <strong>PRECO DE CUSTO:</strong> {{ $produto->preco_custo }}
        </li>
        <li>
            <strong>PRECO:</strong> {{ $produto->preco }}
        </li>
        <li>
            <strong>NCM:</strong> {{ $produto->id_ncm }}
        </li>
    </ul>
@endsection
