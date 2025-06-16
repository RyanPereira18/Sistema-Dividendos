<?php
// app/Views/home/adm.php
require_once '../app/Views/templates/header.php';
?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card p-5 text-center shadow-sm">
        <h2>Área Administrativa</h2>
        <p class="text-muted">Gerencie clientes, produtos e consumos.</p>
        <div class="d-grid gap-3 mt-3">
            <a href="<?= BASE_URL ?>/cliente" class="btn btn-outline-primary">Gerenciar Clientes</a>
            <a href="<?= BASE_URL ?>/produto" class="btn btn-outline-success">Gerenciar Produtos</a>
            <a href="<?= BASE_URL ?>/consumo" class="btn btn-outline-warning">Gerenciar Consumos</a>
        </div>
    </div>
</div>
<?php
require_once '../app/Views/templates/footer.php';
?>