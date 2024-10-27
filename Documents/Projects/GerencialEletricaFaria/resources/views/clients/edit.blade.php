@extends('layout.index')

@section('content')
<div class="container">
    <h1>Editar Pessoa</h1>
    <form action="{{ route('pessoas.update', $pessoa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos da Pessoa -->
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ old('nome', $pessoa->nome) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $pessoa->email) }}" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $pessoa->telefone) }}" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" class="form-control" required>
                <option value="1" {{ $pessoa->tipo == 1 ? 'selected' : '' }}>Pessoa Física</option>
                <option value="2" {{ $pessoa->tipo == 2 ? 'selected' : '' }}>Pessoa Jurídica</option>
            </select>
        </div>

        <!-- Campos específicos para Pessoa Física -->
        @if($pessoa->tipo == 1)
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" name="cpf" value="{{ old('cpf', $pessoa->cpf) }}" required>
        </div>
        <div class="form-group">
            <label for="rg">RG</label>
            <input type="text" class="form-control" name="rg" value="{{ old('rg', $pessoa->rg) }}" required>
        </div>
        @elseif($pessoa->tipo == 2)
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" name="cnpj" value="{{ old('cnpj', $pessoa->cnpj) }}" required>
        </div>
        <div class="form-group">
            <label for="razao_social">Razão Social</label>
            <input type="text" class="form-control" name="razao_social" value="{{ old('razao_social', $pessoa->razao_social) }}" required>
        </div>
        @endif

        <!-- Campos do Endereço -->
        <h3>Endereço</h3>
        <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control" name="logradouro" value="{{ old('logradouro', $endereco->logradouro) }}" required>
        </div>
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" class="form-control" name="numero" value="{{ old('numero', $endereco->numero) }}" required>
        </div>
        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" name="bairro" value="{{ old('bairro', $endereco->bairro) }}" required>
        </div>
        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" name="cep" value="{{ old('cep', $endereco->cep) }}" required>
        </div>
        <div class="form-group">
            <label for="id_cidade">Cidade</label>
            <select name="id_cidade" class="form-control" required>
                @foreach($cidades as $cidade)
                    <option value="{{ $cidade->id_cidade }}" {{ $endereco->id_cidade == $cidade->id_cidade ? 'selected' : '' }}>{{ $cidade->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
