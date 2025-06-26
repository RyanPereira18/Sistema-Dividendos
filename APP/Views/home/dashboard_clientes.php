<?php
// app/Views/home/dashboard_clientes.php
require_once '../app/Views/templates/header.php'; // Inclui o cabeçalho
?>

<div class="container mt-4">
    <h2 class="mb-4">Dashboard de Clientes</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total de Clientes Cadastrados</h5>
                    <p class="card-text fs-1 fw-bold" id="totalClientesCount">Carregando...</p>
                </div>
            </div>
        </div>
        </div>
</div>

<?php
require_once '../app/Views/templates/footer.php'; // Inclui o rodapé
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Faz a requisição AJAX para a URL que retorna o total de clientes
        fetch('<?= BASE_URL ?>/home/getTotalClientesData')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na rede ou no servidor: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('Erro do servidor:', data.error);
                    document.getElementById('totalClientesCount').textContent = 'Erro';
                    alert('Erro ao carregar dados: ' + data.error);
                    return;
                }
                // Atualiza o texto do cartão com o total de clientes
                document.getElementById('totalClientesCount').textContent = data.total_clientes;
            })
            .catch(error => {
                console.error('Houve um problema com a operação fetch:', error);
                document.getElementById('totalClientesCount').textContent = 'Erro';
            });
    });
</script>