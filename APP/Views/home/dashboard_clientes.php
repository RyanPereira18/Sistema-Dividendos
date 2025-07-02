<?php
// app/Views/home/dashboard_clientes.php
require_once '../app/Views/templates/header.php';
?>
<div class="container-fluid">
    <h2 class="mb-4">Dashboard de Clientes</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="totalClientesCount">...</h3>
                    <p>Clientes Cadastrados</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
                <a href="<?= BASE_URL ?>/cliente" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Consumo por Cliente (Top 5 em Quantidade de Itens)</h3>
                </div>
                <div class="card-body">
                    <canvas id="clientConsumptionChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/templates/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('<?= BASE_URL ?>/home/getTotalClientesData')
        .then(response => response.json())
        .then(data => {
            document.getElementById('totalClientesCount').textContent = data.total_clientes || '0';
        });

    fetch('<?= BASE_URL ?>/home/getClientsByConsumptionQuantityData')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.nome);
            const values = data.map(item => item.total_itens);

            new Chart(document.getElementById('clientConsumptionChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            'rgba(0, 123, 255, 0.8)',
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(23, 162, 184, 0.8)'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed + ' itens';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
});
</script>
