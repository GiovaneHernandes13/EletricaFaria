@extends('layout.index')

@section('conteudo')
    <ul>
        <li>
            <strong>Nome:</strong> {{ $funcionarios->nome }}
        </li>
        <li>
            <strong>CPF:</strong> {{ $funcionarios->cpf }}
        </li>
        <li>
            <strong>RG:</strong> {{ $funcionarios->rg }}
        </li>
        <li>
            <strong>Telefone:</strong> {{ $funcionarios->telefone }}
        </li>
        <li>
            <strong>Email:</strong> {{ $funcionarios->email }}
        </li>
        <li>
            <strong>Data de Contratação:</strong> {{ $funcionarios->data_contratacao }}
        </li>
        <li>
            <strong>Cargo:</strong> {{ $funcionarios->cargo }}
        </li>
        <li>
            <strong>Salário:</strong> {{ $funcionarios->salario }}
        </li>
    </ul>
@endsection
