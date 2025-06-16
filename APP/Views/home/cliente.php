<?php
// app/Views/home/cliente.php
require_once '../app/Views/templates/header.php';
?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-5 text-center shadow-sm">
        <h2>Área do Cliente</h2>
        <p class="text-muted">Consulte os produtos e seu histórico de consumo.</p>
        <div class="d-grid gap-3 mt-3">
            <a href="<?= BASE_URL ?>/produto" class="btn btn-outline-primary">Ver Produtos</a>
            <a href="<?= BASE_URL ?>/consumo" class="btn btn-outline-success">Meu Consumo</a>
        </div>
    </div>
</div>
<?php
require_once '../app/Views/templates/footer.php';
?>