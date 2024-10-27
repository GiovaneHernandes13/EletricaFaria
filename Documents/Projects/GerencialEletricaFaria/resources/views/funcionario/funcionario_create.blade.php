@extends('layout.index')

@section('conteudo')
    <form action="{{ route('funcionarios.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="">Nome</label>
            <input type="text" name="nome" placeholder="Nome" required>
        </div>
        <div>
            <label for="">CPF</label>
            <input type="text" name="cpf" placeholder="000.000.000-00" required>
        </div>
        <div>
            <label for="">RG</label>
            <input type="text" name="rg" placeholder="RG" required>
        </div>
        <div>
            <label for="">Telefone</label>
            <input type="text" name="telefone" placeholder="Telefone" required>
        </div>
        <div>
            <label for="">E-mail</label>
            <input type="email" name="email" placeholder="E-mail" required>
        </div>
        <div>
            <label for="">Data de Contratação</label>
            <input type="date" name="data_contratacao" placeholder="Data de Contratação" required>
        </div>
        <div>
            <label for="">Cargo</label>
            <input type="text" name="cargo" placeholder="Cargo" required>
        </div>
        <div>
            <label for="">salario</label>
            <input type="number" step="0.01" name="salario" placeholder="Salário" required>
        </div>
        <button type="submit">Salvar</button>
    </form>
@endsection
