@extends('layout.index')

@section('conteudo')
    <h1>Detalhes da Pessoa</h1>

    {{-- Verifique se a variável $pessoa está presente --}}
    @if(isset($pessoa))
        <h2>Informações Pessoais</h2>
        <ul>
            <li><strong>Nome:</strong> {{ $pessoa->nome }}</li>
            <li><strong>Email:</strong> {{ $pessoa->email }}</li>
            <li><strong>Telefone:</strong> {{ $pessoa->telefone }}</li>
            <!-- Exibe mais informações conforme o tipo -->
            @if ($pessoa->tipo == 1) <!-- Pessoa Física -->
                <li><strong>CPF:</strong> {{ $pessoa->cpf }}</li>
                <li><strong>RG:</strong> {{ $pessoa->rg }}</li>
            @elseif ($pessoa->tipo == 2) <!-- Pessoa Jurídica -->
                <li><strong>CNPJ:</strong> {{ $pessoa->cnpj }}</li>
                <li><strong>Inscrição Estadual:</strong> {{ $pessoa->inscricao_estadual }}</li>
            @endif
        </ul>

        <h2>Endereço</h2>
        @if ($pessoa->endereco)
            <ul>
                <li><strong>Logradouro:</strong> {{ $pessoa->endereco->logradouro }}</li>
                <li><strong>Número:</strong> {{ $pessoa->endereco->numero }}</li>
                <li><strong>Complemento:</strong> {{ $pessoa->endereco->complemento }}</li>
                <li><strong>Bairro:</strong> {{ $pessoa->endereco->bairro }}</li>
                <li><strong>CEP:</strong> {{ $pessoa->endereco->cep }}</li>
                <li><strong>Cidade:</strong> {{ $pessoa->endereco->cidade->nome ?? 'F' }}</li>
            </ul>
        @else
            <p>Endereço não disponível.</p>
        @endif
    @else
        <p>Dados da pessoa não encontrados.</p>
    @endif
@endsection
