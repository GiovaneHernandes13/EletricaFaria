@extends('layout.index')

@section('conteudo')
<h1>Cadastrar Cliente</h1>
<form action="{{ route('pessoas.store') }}" method="POST">
    @csrf

    <label for="tipo">Tipo:</label>
    <div class="input-group">
        <select id="tipo" name="tipo" required onchange="toggleFields()">
            <option value="1">Pessoa Física</option>
            <option value="2">Pessoa Jurídica</option>
        </select>
    </div>
    
    <!-- Campos para Pessoa Física -->
    <div id="nome-group" class="input-group">
        <label for="nome">Nome:</label>
        <div class="input-icon">
            <i class="fas fa-user"></i>
            <input type="text" id="nome" name="nome" required placeholder="Digite o nome">
        </div>
    </div>
    <div id="cpf-group" class="input-group">
        <label for="cpf">CPF:</label>
        <div class="input-icon">
            <i class="fas fa-id-card"></i>
            <input type="text" id="cpf" name="cpf" required placeholder="Digite o CPF">
        </div>
    </div>

    <div id="rg-group" class="input-group">
        <label for="rg">RG:</label>
        <div class="input-icon">
            <i class="fas fa-id-card"></i>
            <input type="text" id="rg" name="rg" required placeholder="Digite o RG">
        </div>
    </div>

    <div id="data-nascimento-group" class="input-group">
        <label for="data_nascimento">Data de Nascimento:</label>
        <div class="input-icon">
            <i class="fas fa-calendar"></i>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
        </div>
    </div>

    <div id="apelido-group" class="input-group">
        <label for="apelido">Apelido:</label>
        <div class="input-icon">
            <i class="fas fa-user"></i>
            <input type="text" id="apelido" name="apelido" placeholder="Digite o apelido">
        </div>
    </div>

    <!-- Campos para Pessoa Jurídica -->
    <div id="cnpj-group" class="input-group" style="display:none;">
        <label for="cnpj">CNPJ:</label>
        <div class="input-icon">
            <i class="fas fa-building"></i>
            <input type="text" id="cnpj" class="cnpj" name="cnpj" placeholder="00.000.000/0000-00" maxlength="18" oninput="mascaraCNPJ(this)" onblur="removeMask(this)">
        </div>
    </div>

    <div id="inscricao-estadual-group" class="input-group" style="display:none;">
        <label for="inscricao_estadual">Inscrição Estadual:</label>
        <div class="input-icon">
            <i class="fas fa-file-alt"></i>
            <input type="text" id="inscricao_estadual" name="inscricao_estadual" placeholder="Digite a Inscrição Estadual">
        </div>
    </div>

    <div id="razao-social-group" class="input-group" style="display:none;">
        <label for="razao_social">Razão Social:</label>
        <div class="input-icon">
            <i class="fas fa-building"></i>
            <input type="text" id="razao_social" name="razao_social" placeholder="Digite a Razão Social">
        </div>
    </div>

    <div id="fantasia-group" class="input-group" style="display:none;">
        <label for="fantasia">Nome Fantasia:</label>
        <div class="input-icon">
            <i class="fas fa-building"></i>
            <input type="text" id="fantasia" name="fantasia" placeholder="Digite o Nome Fantasia">
        </div>
    </div>

    <div id="data-fundacao-group" class="input-group" style="display:none;">
        <label for="data_fundacao">Data de Fundação:</label>
        <div class="input-icon">
            <i class="fas fa-calendar"></i>
            <input type="date" id="data_fundacao" name="data_fundacao">
        </div>
    </div>


    <!-- Campos comuns -->
    <label for="email">Email:</label>
    <div class="input-icon">
        <i class="fas fa-envelope"></i>
        <input type="email" id="email" name="email" required placeholder="Digite o email">
    </div>

    <div class="input-group">
        <label for="telefone">Telefone:</label>
        <div class="input-icon">
            <i class="fas fa-phone"></i>
            <input type="text" id="telefone" name="telefone" required placeholder="Digite o telefone">
        </div>
    </div>

    <!-- Campos de endereço -->
    <h3>Endereço</h3>
    <div class="input-group">
        <label for="logradouro">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" required placeholder="Digite o logradouro">
    </div>

    <div class="input-group">
        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" required placeholder="Digite o número">
    </div>

    <div class="input-group">
        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento" placeholder="Digite o complemento">
    </div>

    <div class="input-group">
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" required placeholder="Digite o bairro">
    </div>

    <div class="input-group">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" required placeholder="Digite o CEP">
    </div>

    <div class="input-group">
        <label for="id_estado">Estado:</label>
        <select id="id_estado" name="id_estado" required onchange="carregarCidades()">
            <option value="">Selecione um estado</option>
            @foreach($estados as $estado)
                <option value="{{ $estado->id_estado }}">{{ $estado->nome_estado }}</option>
            @endforeach
        </select>
    </div>

    <div class="input-group">
        <label for="id_cidade">Cidade:</label>
        <select id="id_cidade" name="id_cidade" required>
            <option value="">Selecione uma cidade</option>
            @foreach($cidades as $cidade)
                <option value="{{ $cidade->id_cidade }}">
                    {{ $cidade->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<script>
function toggleFields() {
    console.log("Função toggleFields chamada"); // Adicione esta linha para depuração
    var tipo = document.getElementById("tipo").value;

    // Campos de Pessoa Física
    var cpfGroup = document.getElementById("cpf-group");
    var rgGroup = document.getElementById("rg-group");
    var apelidoGroup = document.getElementById("apelido-group");
    var dataNascimentoGroup = document.getElementById("data-nascimento-group");
    var nomeGroup = document.getElementById("nome-group"); // Adicionei a referência ao grupo do nome

    // Campos de Pessoa Jurídica
    var cnpjGroup = document.getElementById("cnpj-group");
    var inscricaoEstadualGroup = document.getElementById("inscricao-estadual-group");
    var razaoSocialGroup = document.getElementById("razao-social-group");
    var fantasiaGroup = document.getElementById("fantasia-group");
    var dataFundacaoGroup = document.getElementById("data-fundacao-group");

    if (tipo == "1") {
        // Mostrar campos de Pessoa Física
        cpfGroup.style.display = "block";
        rgGroup.style.display = "block";
        apelidoGroup.style.display = "block";
        dataNascimentoGroup.style.display = "block";
        nomeGroup.style.display = "block"; // Exibe o campo Nome

        // Esconder campos de Pessoa Jurídica
        cnpjGroup.style.display = "none";
        inscricaoEstadualGroup.style.display = "none";
        razaoSocialGroup.style.display = "none";
        fantasiaGroup.style.display = "none";
        dataFundacaoGroup.style.display = "none";
    } else if (tipo == "2") {
        // Mostrar campos de Pessoa Jurídica
        cnpjGroup.style.display = "block";
        inscricaoEstadualGroup.style.display = "block";
        razaoSocialGroup.style.display = "block";
        fantasiaGroup.style.display = "block";
        dataFundacaoGroup.style.display = "block";
        
        nomeGroup.style.display = "none"; // Esconde o campo Nome

        // Esconder campos de Pessoa Física
        cpfGroup.style.display = "none";
        rgGroup.style.display = "none";
        apelidoGroup.style.display = "none";
        dataNascimentoGroup.style.display = "none";
    }
}




    function carregarCidades() {
    var id_estado = document.getElementById("id_estado").value;
    var cidadeSelect = document.getElementById("id_cidade");

    cidadeSelect.innerHTML = '<option value="">Selecione uma cidade</option>';

        if (id_estado) {
            fetch(`/cidades/${id_estado}`)
                .then(response => response.json())
                .then(cidades => {
                    cidades.forEach(cidade => {
                        var option = document.createElement('option');
                        option.value = cidade.id_cidade;
                        option.text = cidade.nome_cidade;
                        cidadeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar cidades:', error));
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleFields(); // Ajusta a visibilidade dos campos no carregamento
    });

</script>
@endsection
