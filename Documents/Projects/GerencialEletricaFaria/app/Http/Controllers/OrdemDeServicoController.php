<?php

namespace App\Http\Controllers;

use App\Models\OrdemDeServico;
use App\Models\Funcionario;
use App\Models\Status;
use App\Models\Pessoa;
use App\Models\Produto;
use App\Models\ItensOrdem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use PDF;


class OrdemDeServicoController extends BaseController
{

    public function gerarPdf($id)
    {
        $ordem = OrdemDeServico::with('pessoa', 'funcionario', 'itens.produto', 'status')->findOrFail($id);

        $pdf = PDF::loadView('ordem_de_servico.show', compact('ordem'));

        return $pdf->download("ordem_servico_{$ordem->id_ordem_servico}.pdf");
    }

    public function listar()
    {
        $ordens = OrdemDeServico::all();
        return view('ordem_de_servico.index', ['ordens' => $ordens]);
    }

    public function create()
    {
        $funcionarios = Funcionario::all();
        $status = Status::all();
        $clientes = Pessoa::all();
        $produtos = Produto::all(); // Carregar todos os produtos para a seleção nos itens da ordem
    
        return view('ordem_de_servico.create', compact('funcionarios', 'status', 'clientes', 'produtos'));
    }

    public function SalvarOrdem(Request $request)
    {
        // Validação dos dados
        $request->validate([
            // Validações da Ordem de Serviço
            'id_funcionario' => 'required',
            'data_abertura' => 'required|date',
            'descricao_servico' => 'required|string',
            'quantidade_servico' => 'required|integer',
            'preco_unitario_servico' => 'required|numeric',
            'id_status' => 'required',
            'id_pessoa' => 'required',
            'nome_ordem' => 'required|string',
            
            // Validações dos Itens
            'id_produto.*' => 'required|exists:produtos,id_produto',
            'quantidade.*' => 'required|integer|min:1',
            'preco_unitario.*' => 'required|numeric|min:0',
        ]);

        // Calcula o total da mão de obra
        $totalMaoDeObra = $request->quantidade_servico * $request->preco_unitario_servico;

        // Cria a ordem de serviço
        $ordemDeServico = OrdemDeServico::create([
            'id_funcionario' => $request->id_funcionario,
            'data_abertura' => $request->data_abertura,
            'descricao_servico' => $request->descricao_servico,
            'quantidade_servico' => $request->quantidade_servico,
            'preco_unitario_servico' => $request->preco_unitario_servico,
            'total_servico' => 0,
            'id_status' => $request->id_status,
            'id_pessoa' => $request->id_pessoa,
            'nome_ordem' => $request->nome_ordem,
        ]);

        $total_servico = $totalMaoDeObra; // Inclui a mão de obra no total inicial

        $produtos = $request->input('id_produto');
        $quantidades = $request->input('quantidade'); 
        $precosUnitarios = $request->input('preco_unitario');
        
        foreach ($produtos as $index => $produtoId) {
            $quantidade = $quantidades[$index];
            $precoUnitario = $precosUnitarios[$index];
        
            $totalProduto = $quantidade * $precoUnitario;
            $total_servico += $totalProduto;
        
            ItensOrdem::create([
                'id_ordem_servico' => $ordemDeServico->id_ordem_servico,
                'id_produto' => $produtoId,
                'quantidade' => $quantidade,
                'preco_unitario' => $precoUnitario,
                'total_produto' => $totalProduto,
            ]);
        }
        
        // Atualiza o total da ordem de serviço com o total calculado (produtos + mão de obra)
        $ordemDeServico->update(['total_servico' => $total_servico]);
        
        return redirect()->route('OrdemServicos.index')->with('success', 'Ordem de Serviço criada com sucesso!');
    }
        

    
    public function show(int $id)
    {
        $ordem = OrdemDeServico::with('status', 'pessoa', 'funcionario')->findOrFail($id);
        $clientes = Pessoa::all();
        $funcionarios = Funcionario::all();
        $produtos = Produto::all();
        $status = Status::all();
    
        return view('ordem_de_servico.show', compact('ordem', 'clientes', 'funcionarios', 'produtos', 'status'));
    }
    

    public function edit(OrdemDeServico $ordem)
    {
        return view('ordem_de_servico.edit', compact('ordem'));
    }

    public function update(Request $request, OrdemDeServico $ordem)
    {
        $request->validate([
            'id_funcionario' => 'required',
            'data_abertura' => 'required|date',
            'descricao_servico' => 'required|string',
            'quantidade_servico' => 'required|integer',
            'preco_unitario_servico' => 'required|numeric',
            'id_status' => 'required',
            'id_pessoa' => 'required',
        ]);
    
        // Calcular o total_servico
        $total_servico = $request->quantidade_servico * $request->preco_unitario_servico;
    
        // Atualizar a ordem de serviço com o total recalculado
        $ordem->update(array_merge($request->all(), ['total_servico' => $total_servico]));
    
        return redirect()->route('OrdemServico.index')->with('success', 'Ordem de Serviço atualizada com sucesso.');
    }
    

    public function destroy(int $id)
    {
        $ordem = OrdemDeServico::findOrFail($id);
    
        // Excluir os itens relacionados à ordem de serviço
        $ordem->itens()->delete();
    
        // Agora pode excluir a ordem de serviço
        $ordem->delete();
    
        return redirect()->route('OrdemServicos.index')->with('success', 'Ordem de Serviço excluída com sucesso.');
    }
    

}

