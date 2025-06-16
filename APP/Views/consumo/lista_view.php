<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Consumo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📑 Relatório de Consumo</h2>
            <?php if ($perfil == 'adm'): ?>
                <a href="consumo_form.php" class="btn btn-success">➕ Novo Consumo</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-warning">
                    <tr>
                        <?php if ($perfil == 'adm'): ?><th>Cliente</th><?php endif; ?>
                        <th>Produto</th>
                        <th>Qtd.</th>
                        <th>Preço Unit. (R$)</th>
                        <th>Total (R$)</th>
                        <?php if ($perfil == 'adm'): ?><th class="text-center">Ações</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consumos as $consumo): ?>
                        <tr>
                            <?php if ($perfil == 'adm'): ?><td><?= htmlspecialchars($consumo['cliente']) ?></td><?php endif; ?>
                            <td><?= htmlspecialchars($consumo['produto']) ?></td>
                            <td><?= htmlspecialchars($consumo['quantidade']) ?></td>
                            <td><?= number_format($consumo['preco'], 2, ',', '.') ?></td>
                            <td><?= number_format($consumo['total'], 2, ',', '.') ?></td>
                            <?php if ($perfil == 'adm'): ?>
                            <td class="text-center">
                                <a href="consumo_form.php?id=<?= $consumo['id'] ?>" class="btn btn-sm btn-outline-primary">✏️ Editar</a>
                                <a href="APP/Controllers/ConsumoController.php?excluir=<?= $consumo['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">🗑️ Excluir</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="<?= ($perfil == 'adm') ? '4' : '3' ?>" class="text-end fw-bold">Total Geral:</td>
                        <td class="fw-bold">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
                        <?php if ($perfil == 'adm'): ?><td></td><?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-4">
            <a href="<?= ($perfil == 'adm') ? 'home_adm.php' : 'home_cliente.php' ?>" class="btn btn-outline-secondary">⬅️ Voltar</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>