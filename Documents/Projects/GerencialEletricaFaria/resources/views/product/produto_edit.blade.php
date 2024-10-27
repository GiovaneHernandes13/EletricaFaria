@extends('layout.index')
@section('conteudo')

    <h1>Atualizar</h1>
    @if (session()->has('message'))
        {{ session()->get('message')}}
    @endif
    <form action="{{ route('produto.update', ['produto' => $produto->id_produto]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="">NOME</label>
            <input class="inputprod" type="text" name="nome_produto" value="{{ $produto->nome_produto }}">
        </div>
        <div>
            <label for="">DESCRIÇÃO</label>
            <input class="inputprod2" type="text" name="descricao" value="{{ $produto->descricao }}">
        </div>
        <div>
            <label for="">PREÇO DE CUSTO</label>
            <input class="inputprod" type="text" name="preco_custo" value="{{ $produto->preco_custo }}">
        </div>
        <div>
            <label for="">PREÇO DE VENDA</label>
            <input class="inputprod" type="text" name="preco" value="{{ $produto->preco }}">
        </div>
        <div>
            <label for="">ESTOQUE</label>
            <input class="inputprod" type="text" name="estoque" value="{{ $produto->estoque }}">
        </div>

        <label for="id_cest">CEST:</label>
        <select id="id_cest" name="id_cest" class="select2">
            <option value="">Selecione o CEST</option>
            @foreach ($cests as $cest)
                <option value="{{ $cest->id_cest }}" {{ $produto->id_cest == $cest->id_cest ? 'selected' : '' }}>
                    {{ $cest->codigo_cest }} - {{ $cest->descricao_cest }}
                </option>
            @endforeach
        </select>
        <label for="id_ncm">NCM:</label>
        <select id="id_ncm" name="id_ncm" class="select2">
            <option value="">Selecione o NCM</option>
            @foreach ($ncms as $ncm)
                <option value="{{ $ncm->id_ncm }}" {{ $produto->id_ncm == $ncm->id_ncm ? 'selected' : '' }}>
                    {{ $ncm->codigo_ncm }} - {{ $ncm->descricao_ncm }}
                </option>
            @endforeach
        </select>   
        <button type="submit">Salvar</button> 
    </form>
@endsection
