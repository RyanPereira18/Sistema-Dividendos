<?php
// app/Views/clientes/index.php
require_once '../app/Views/templates/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Lista de Clientes</h2>
    <a href="<?= BASE_URL ?>/cliente/create" class="btn btn-success">Novo Cliente</a>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td><?= htmlspecialchars($cliente['id']) ?></td>
            <td><?= htmlspecialchars($cliente['nome']) ?></td>
            <td class="text-center">
                <a href="<?= BASE_URL ?>/cliente/edit/<?= $cliente['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                <a href="<?= BASE_URL ?>/cliente/destroy/<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once '../app/Views/templates/footer.php';
?>