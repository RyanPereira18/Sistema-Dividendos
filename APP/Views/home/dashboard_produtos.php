<?php
// app/Views/home/dashboard_produtos.php
require_once '../app/Views/templates/header.php';
?>
<div class="container-fluid">
    <h2 class="mb-4">Dashboard de Produtos</h2>

    <div class="row">
        <!-- Gráfico Mais Consumidos -->
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Top 5 Produtos Mais Consumidos</h3>
                </div>
                <div class="card-body">
                    <canvas id="topProdutosChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Gráfico Menos Consumidos -->
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Top 5 Produtos Menos Consumidos</h3>
                </div>
                <div class="card-body">
                    <canvas id="leastProdutosChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráfico Tendência de Faturamento -->
        <div class="col-md-7">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Tendência de Faturamento Diário</h3>
                </div>
                <div class="card-body">
                    <div id="revenueTrendContainer">
                        <canvas id="revenueTrendChart"></canvas>
                    </div>
                    <div id="revenueTrendMessage" class="text-center p-4" style="display: none;">
                        <p class="text-muted">Para visualizar este gráfico, a coluna <code>data_consumo</code> é necessária na tabela <code>consumo</code>.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gráfico Produtos por Preço -->
        <div class="col-md-5">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Produtos por Preço (Menor ao Maior)</h3>
                </div>
                <div class="card-body">
                    <canvas id="productsByPriceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once '../app/Views/templates/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
    };

    const createBarChart = (canvasId, data, label, color) => {
        const labels = data.map(item => item.nome);
        const values = data.map(item => item.total_consumido || 0);
        new Chart(document.getElementById(canvasId).getContext('2d'), {
            type: 'bar',
            data: { labels, datasets: [{ label, data: values, backgroundColor: color }] },
            options: chartOptions
        });
    };

    const createLineChart = (canvasId, labels, values, label, color) => {
        new Chart(document.getElementById(canvasId).getContext('2d'), {
            type: 'line',
            data: { labels, datasets: [{ label, data: values, borderColor: color, backgroundColor: color.replace('1)', '0.2)'), fill: true, tension: 0.1 }] },
            options: chartOptions
        });
    };

    fetch('<?= BASE_URL ?>/home/getTopConsumedProductsData')
        .then(response => response.json())
        .then(data => createBarChart('topProdutosChart', data, 'Qtd. Consumida', 'rgba(40, 167, 69, 0.7)'));

    fetch('<?= BASE_URL ?>/home/getLeastConsumedProductsData')
        .then(response => response.json())
        .then(data => createBarChart('leastProdutosChart', data, 'Qtd. Consumida', 'rgba(255, 193, 7, 0.7)'));

    fetch('<?= BASE_URL ?>/home/getProductsSortedByPriceData')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.nome);
            const values = data.map(item => item.preco);
            createLineChart('productsByPriceChart', labels, values, 'Preço (R$)', 'rgba(220, 53, 69, 1)');
        });

    // Gráfico de Tendência (com verificação)
    fetch('<?= BASE_URL ?>/home/getRevenueTrendData')
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById('revenueTrendContainer').style.display = 'none';
                document.getElementById('revenueTrendMessage').style.display = 'block';
            } else {
                const labels = data.map(item => new Date(item.dia).toLocaleDateString('pt-BR', { timeZone: 'UTC' }));
                const values = data.map(item => item.faturamento_diario);
                createLineChart('revenueTrendChart', labels, values, 'Faturamento (R$)', 'rgba(23, 162, 184, 1)');
            }
        });
});
</script>
