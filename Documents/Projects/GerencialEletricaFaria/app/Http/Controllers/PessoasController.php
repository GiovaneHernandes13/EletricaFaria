<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Endereco;

class PessoasController extends Controller
{
    /**
     * Exibir lista de pessoas.
     */
    public function index()
    {
        $pessoas = Pessoa::all();
        return view('clients.index', compact('pessoas'));
    }

    public function create()
    {
        $estados = Estado::all(); // Supondo que você tenha uma model Estado
        $cidades = Cidade::all(); // Supondo que você tenha uma model Cidade
        return view('clients.create', compact('estados', 'cidades'));
    }
    
    public function getCidades($id_estado)
    {
        $cidades = Cidade::where('id_estado', $id_estado)->get();
        return response()->json($cidades);
    }
    

    public function store(Request $request)
    {
        // Log dos dados recebidos
        Log::info('Dados recebidos:', $request->all());
    
        // Validação do tipo de pessoa
        if ($request->input('tipo') == 1) {
            // Validação para Pessoa Física
            $validatedDataPessoa = $request->validate([
                'tipo' => 'required|integer|in:1,2',
                'cpf' => 'required|string|max:11|unique:pessoas,cpf',
                'rg' => 'required|string|max:20',
                'nome' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:pessoas,email',
                'telefone' => 'required|string|max:15',
                'data_nascimento' => 'required|date',
                'apelido' => 'nullable|string|max:255',
            ]);
        } elseif ($request->input('tipo') == 2) {
            // Validação para Pessoa Jurídica
            $validatedDataPessoa = $request->validate([
                'tipo' => 'required|integer|in:1,2',
                'cnpj' => 'required|string|max:14|unique:pessoas,cnpj',
                'inscricao_estadual' => 'required|string|max:20',
                'razao_social' => 'required|string|max:255',
                'fantasia' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255|unique:pessoas,email',
                'telefone' => 'required|string|max:15',
                'data_fundacao' => 'required|date',
            ]);
    
            Log::info('Dados validados para Pessoa Jurídica:', $validatedDataPessoa);
            $validatedDataPessoa['nome'] = $validatedDataPessoa['razao_social'];
        } else {
            return back()->withErrors(['tipo' => 'Tipo inválido']);
        }
      
    
        $validatedDataEndereco = $request->validate([
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:50',
            'bairro' => 'required|string|max:50',
            'cep' => 'required|string|max:8',
            'id_cidade' => 'required|exists:cidade,id_cidade',
        ]);
    
        $endereco = Endereco::create($validatedDataEndereco);
        $validatedDataPessoa['id_endereco'] = $endereco->id;

        // Criação da pessoa
        Pessoa::create($validatedDataPessoa);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa cadastrada com sucesso!');
}
    
    public function show($id)
    {
        $pessoa = Pessoa::with('endereco.cidade')->findOrFail($id);
        return view('clients.show', compact('pessoa'));
    }
    

    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $endereco = $pessoa->endereco; // Verifique se você tem o relacionamento definido
        $cidades = Cidade::all(); // Carregar cidades para o dropdown
    
        return view('clients.edit', compact('pessoa', 'endereco', 'cidades'));
    }
    
    public function update(Request $request, $id)
    {
        // Validação baseada no tipo de pessoa
        if ($request->input('tipo') == 1) {
            // Validação para Pessoa Física
            $validatedData = $request->validate([
                'tipo' => 'required|integer|in:1,2',
                'cpf' => 'required|string|max:11|unique:pessoas,cpf,' . $id,
                'rg' => 'required|string|max:20',
                'nome' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:pessoas,email,' . $id,
                'telefone' => 'required|string|max:15',
                'data_nascimento' => 'required|date',
                'id_endereco' => 'required|integer|exists:enderecos,id_endereco',
                'apelido' => 'nullable|string|max:255',
            ]);
        } elseif ($request->input('tipo') == 2) {
            // Validação para Pessoa Jurídica
            $validatedData = $request->validate([
                'tipo' => 'required|integer|in:1,2',
                'cnpj' => 'required|string|max:14|unique:pessoas,cnpj,' . $id,
                'inscricao_estadual' => 'required|string|max:20',
                'razao_social' => 'required|string|max:255',
                'fantasia' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255|unique:pessoas,email,' . $id,
                'telefone' => 'required|string|max:15',
                'data_fundacao' => 'required|date',
                'id_endereco' => 'required|integer|exists:enderecos,id_endereco',
            ]);
        } else {
            return back()->withErrors(['tipo' => 'Tipo inválido']);
        }
    
        // Encontra a pessoa no banco de dados
        $pessoa = Pessoa::findOrFail($id);
    
        // Atualiza os dados da pessoa
        $pessoa->update($validatedData);
    
        // Atualiza o endereço se necessário
        $endereco = Endereco::findOrFail($pessoa->id_endereco);
        $endereco->update($request->only(['logradouro', 'numero', 'bairro', 'cep', 'id_cidade']));
    
        // Redireciona com sucesso
        return redirect()->route('pessoas.index')->with('success', 'Pessoa atualizada com sucesso!');
    }
    
    

    /**
     * Remover uma pessoa específica.
     */
    public function destroy($id)
    {
        Pessoa::destroy($id);
        return redirect()->route('pessoas.index')->with('success', 'Cliente removido com sucesso!');
    }

}
