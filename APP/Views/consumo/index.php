<?php
// app/Views/consumo/index.php
require_once '../app/Views/templates/header.php';
$totalGeral = 0;
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Relatório de Consumo</h2>
    <?php if ($_SESSION['perfil'] === 'adm'): ?>
        <a href="<?= BASE_URL ?>/consumo/create" class="btn btn-success">Novo Consumo</a>
    <?php endif; ?>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <?php if ($_SESSION['perfil'] === 'adm'): ?><th>Cliente</th><?php endif; ?>
            <th>Produto</th>
            <th>Qtd.</th>
            <th>Preço Unit. (R$)</th>
            <th>Total (R$)</th>
            <?php if ($_SESSION['perfil'] === 'adm'): ?><th class="text-center">Ações</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($consumos as $consumo): ?>
        <?php $totalGeral += $consumo['total']; ?>
        <tr>
            <?php if ($_SESSION['perfil'] === 'adm'): ?><td><?= htmlspecialchars($consumo['cliente']) ?></td><?php endif; ?>
            <td><?= htmlspecialchars($consumo['produto']) ?></td>
            <td><?= htmlspecialchars($consumo['quantidade']) ?></td>
            <td><?= number_format($consumo['preco'], 2, ',', '.') ?></td>
            <td><?= number_format($consumo['total'], 2, ',', '.') ?></td>
            <?php if ($_SESSION['perfil'] === 'adm'): ?>
            <td class="text-center">
                <a href="<?= BASE_URL ?>/consumo/edit/<?= $consumo['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                <a href="<?= BASE_URL ?>/consumo/destroy/<?= $consumo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="<?= ($_SESSION['perfil'] === 'adm') ? '4' : '3' ?>" class="text-end fw-bold">Total Geral:</td>
            <td class="fw-bold">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
            <?php if ($_SESSION['perfil'] === 'adm'): ?><td></td><?php endif; ?>
        </tr>
    </tfoot>
</table>

<?php
require_once '../app/Views/templates/footer.php';
?>