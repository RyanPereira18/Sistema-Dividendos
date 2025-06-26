<?php
// app/Views/home/dashboard_produtos.php
require_once '../app/Views/templates/header.php'; // Inclui o cabeçalho
?>

<div class="container mt-4">
    <h2 class="mb-4">Dashboard de Produtos</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total de Produtos Cadastrados</h5>
                    <p class="card-text fs-1 fw-bold" id="totalProdutosCount">Carregando...</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Valor Total dos Produtos</h5>
                    <p class="card-text fs-1 fw-bold" id="totalValorProdutos">Carregando...</p>
                </div>
            </div>
        </div>
        <!-- Adicionar grafico ou outra tabela -->
    </div>
</div>

<?php
require_once '../app/Views/templates/footer.php'; // Inclui o rodapé
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Faz a requisição AJAX para a URL que retorna os dados dos produtos
        fetch('<?= BASE_URL ?>/home/getTotalProdutosData')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na rede ou no servidor: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('Erro do servidor:', data.error);
                    document.getElementById('totalProdutosCount').textContent = 'Erro';
                    document.getElementById('totalValorProdutos').textContent = 'Erro'; // Atualizado: para o novo cartão
                    alert('Erro ao carregar dados: ' + data.error);
                    return;
                }
                // Atualiza o texto do cartão com o total de produtos
                document.getElementById('totalProdutosCount').textContent = data.total_produtos;

                // NOVO: Atualiza o texto do cartão com o valor total dos produtos
                // Formata o valor como moeda brasileira (R$)
                const formattedValue = parseFloat(data.total_valor_produtos).toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
                document.getElementById('totalValorProdutos').textContent = formattedValue;
            })
            .catch(error => {
                console.error('Houve um problema com a operação fetch:', error);
                document.getElementById('totalProdutosCount').textContent = 'Erro';
                document.getElementById('totalValorProdutos').textContent = 'Erro'; // Atualizado: para o novo cartão
            });
    });
</script>
