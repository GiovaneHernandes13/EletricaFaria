<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cest;
use App\Models\Ncm;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('product.produtos', ['produtos' => $produtos]);
    }

    public function create()
    {
        $cests = Cest::all();
        $ncms = Ncm::all();
        
        return view('product.produto_create', compact('cests', 'ncms'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco_custo' => 'required|numeric',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'id_cest' => 'nullable|exists:cests,id_cest', 
            'id_ncm' => 'nullable|exists:NCM,id_ncm', 
        ]);
    
        Produto::create($validatedData);
    
        return redirect()->route('produto.index')->with('message', 'Produto salvo com sucesso!');
    
    }
    
    public function show(int $id)
    {
        $produto = Produto::findOrFail($id);
        return view('product.produto_show', ['produto' => $produto]);
    }

    public function edit(Produto $produto)
    {
        $cests = Cest::all();
        $ncms = Ncm::all();

        return view('product.produto_edit', compact('produto', 'cests', 'ncms'));
    }

    public function update(Request $request, Produto $produto)
    {
        $validatedData = $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco_custo' => 'required|numeric',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'id_cest' => 'nullable|exists:cests,id_cest',
            'id_ncm' => 'nullable|exists:NCM,id_ncm',
        ]);
    
        $produto->update($validatedData);
    
        return redirect()->route('produto.index')->with('message', 'Produto atualizado com sucesso!');
    }
    
    
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return route('produtos.index');
    }
}
