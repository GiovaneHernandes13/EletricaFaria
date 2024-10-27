@extends('layout.index')
@section('conteudo')

    <h1>Atualizar</h1>
    @if (session()->has('message'))
        {{ session()->get('message')}}
    @endif
    <form action="{{ route('funcionarios.update', ['funcionario' => $funcionario->id_funcionario]) }}" method="POST">
        @csrf 
        @method('PUT')
        <div>
            <label for="">NOME</label>
            <input type="text" name="nome" value="{{ $funcionario->nome }}">
        </div>
        <div>
            <label for="">TEL</label>
            <input type="text" name="telefone" value="{{ $funcionario->telefone }}">
        </div>
        <div>
            <label for="">E-MAIL</label>
            <input type="text" name="email" value="{{ $funcionario->email }}">
        </div>
        <div>
            <label for="">CARGO</label>
            <input type="text" name="cargo" value="{{ $funcionario->cargo  }}">
        </div>
        <div>
            <label for="">SALARIO</label>
            <input type="text" name="salario" value="{{ $funcionario->salario }}">
        </div>
        <button type="submit">Salvar</button> 
    </form>
@endsection
