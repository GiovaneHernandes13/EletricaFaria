@extends('layout.index')

@section('conteudo')
    <h2>CREATE O.S.</h2>

    <form action="{{ route('OrdemServicos.SalvarOrdem') }}" method="POST">
        @csrf
        <div class="grupo">
            <label for="nome_ordem">Nome da O.S.:</label>
            <input type="text" name="nome_ordem" id="nome_ordem" class="form-control" required>
        </div>

        <div class="container_os">
            <div class="grupo">
                <label for="id_pessoa">Cliente:</label>
                <select name="id_pessoa" id="id_pessoa" class="form-control" required>
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grupo">
                <label for="id_funcionario">Funcionário:</label>
                <select name="id_funcionario" id="id_funcionario" class="form-control" required>
                    <option value="">Selecione um funcionário</option>
                    @foreach ($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id_funcionario }}">{{ $funcionario->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="data_abertura">Data de Abertura:</label>
                <input type="date" name="data_abertura" id="data_abertura" class="form-control" required>
            </div>
        </div>

        <h4>Mão de Obra</h4>
        <div class="container-servicos">
            <div class="form-group">
                <label for="quantidade_servico">Quantidade:</label>
                <input type="number" name="quantidade_servico" id="quantidade_servico" class="input_qtd" required>
            </div>
            <div class="grupo">
                <label for="descricao_servico">Descrição do Serviço:</label>
                <textarea name="descricao_servico" id="descricao_servico" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco_unitario_servico">Preço Unitário:</label>
                <input type="number" name="preco_unitario_servico" id="preco_unitario_servico" class="input_uni" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="total_servico">Total:</label>
                <input type="number" name="total_servico" id="total_servico" class="input_total" step="0.01" readonly>
            </div>
        </div>

        <div id="itens_ordem">
            <h3>Itens da Ordem de Serviço</h3>

            <button type="button" id="add-item" class="BotaoAddNewIten">Add New Item</button>

            <div class="item_ordem">
                <div class="produto">
                    <label for="id_produto">Produto:</label>
                    <select name="id_produto[]" class="form-control produto-select" required>
                        <option value="">Selecione um produto</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id_produto }}" data-preco="{{ $produto->preco }}">
                                {{ $produto->nome_produto }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="qtd">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" name="quantidade[]" class="input_qtd" required>
                </div>
                <div class="uni">
                    <label for="preco_unitario">Preço Unitário:</label>
                    <input type="number" name="preco_unitario[]" class="input_uni" step="0.01" readonly required>
                </div>
                <div class="total">
                    <label for="total_item">Total:</label>
                    <input type="number" name="total_item[]" class="input_total" step="0.01" readonly>
                </div>
                <button type="button" class="remove-item btn btn-danger">Remover Item</button>
            </div>
        </div>

        <!-- Total Geral -->
        <div class="form-group">
            <label for="total_geral">Total Geral:</label>
            <input type="number" id="total_geral" class="form-control" name="total_geral" step="0.01" readonly>
        </div>

        <div class="form-group">
            <label for="id_status">Status:</label>
            <select name="id_status" id="id_status" class="form-control" required>
                <option value="">Selecione um status</option>
                @foreach ($status as $st)
                    <option value="{{ $st->id_status }}">{{ $st->descricao_status }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_fechamento">Data de Fechamento:</label>
            <input type="date" name="data_fechamento" id="data_fechamento" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Criar O.S.</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.getElementById('add-item').addEventListener('click', function () {
                let itemTemplate = `
                    <div class="item_ordem">
                        <div class="produto">
                            <label for="id_produto">Produto:</label>
                            <select name="id_produto[]" class="form-control produto-select" required>
                                <option value="">Selecione um produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id_produto }}" data-preco="{{ $produto->preco }}">
                                        {{ $produto->nome_produto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="qtd">
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" name="quantidade[]" class="input_qtd" required>
                        </div>
                        <div class="uni">
                            <label for="preco_unitario">Preço Unitário:</label>
                            <input type="number" name="preco_unitario[]" class="input_uni" step="0.01" readonly required>
                        </div>
                        <div class="total">
                            <label for="total_item">Total:</label>
                            <input type="number" name="total_item[]" class="input_total" step="0.01" readonly>
                        </div>
                        <button type="button" class="remove-item btn btn-danger">Remover Item</button>
                    </div>`;
    
                // Adiciona o novo item à lista
                const container = document.getElementById('itens_ordem');
                container.insertAdjacentHTML('beforeend', itemTemplate);
            });
    
            // Função para remover um item
            document.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('remove-item')) {
                    event.target.closest('.item_ordem').remove();
                    calcularTotalGeral(); // Atualiza o total geral após remover um item
                }
            });
    
            // Atualiza o preço unitário e o total ao selecionar um produto
            document.addEventListener('change', function (event) {
                if (event.target && event.target.classList.contains('produto-select')) {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    const precoUnitario = selectedOption.getAttribute('data-preco');
                    const parentItem = event.target.closest('.item_ordem');
                    parentItem.querySelector('.input_uni').value = precoUnitario || 0;
                    calcularTotal(parentItem); // Atualiza o total quando o produto é alterado
                }
            });
    
            // Atualiza o total quando a quantidade é alterada
            document.addEventListener('input', function (event) {
                if (event.target && event.target.classList.contains('input_qtd')) {
                    const parentItem = event.target.closest('.item_ordem');
                    calcularTotal(parentItem);
                }
            });
    
            // Função para calcular o total do item
            function calcularTotal(item) {
                const quantidade = parseFloat(item.querySelector('.input_qtd').value) || 0;
                const precoUnitario = parseFloat(item.querySelector('.input_uni').value) || 0;
                const total = quantidade * precoUnitario;
                item.querySelector('.input_total').value = total.toFixed(2);
                calcularTotalGeral();
            }

            // Função para calcular o total geral de todos os itens
            function calcularTotalGeral() {
                let totalGeral = 0;
                document.querySelectorAll('.input_total').forEach(function (inputTotal) {
                    totalGeral += parseFloat(inputTotal.value) || 0;
                });
                document.getElementById('total_geral').value = totalGeral.toFixed(2);
            }
        });
    </script>
@endsection
