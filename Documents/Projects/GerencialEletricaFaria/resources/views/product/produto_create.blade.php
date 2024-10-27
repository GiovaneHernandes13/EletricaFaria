@extends('layout.index')
@section('conteudo')

    @if (session()->has('message'))
        {{ session()->get('message') }}
    @endif

    <form action="{{ route('produto.store') }}" method="POST">
        @csrf
        <input type="text" name="nome_produto" placeholder="Nome" required>
        <input type="text" name="descricao" placeholder="Descrição" required>
        <input type="number" step="0.01" name="preco_custo" placeholder="Preço de Custo" required>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <input type="number" name="estoque" placeholder="Estoque" required>
    
        <select name="id_cest">
            <option value="">Selecione o CEST</option>
            @foreach ($cests as $cest)
                <option value="{{ $cest->id_cest }}">{{ $cest->codigo_cest }} - {{ $cest->descricao_cest }}</option>
            @endforeach
        </select>
        
        <select name="id_ncm">
            <option value="">Selecione o NCM</option>
            @foreach ($ncms as $ncm)
                <option value="{{ $ncm->id_ncm }}">{{ $ncm->codigo_ncm }} - {{ $ncm->descricao_ncm }}</option>
            @endforeach
        </select>        
    
        <button type="submit">Salvar</button>
    </form>
    
@endsection

