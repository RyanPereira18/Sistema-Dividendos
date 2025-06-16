<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">🛍️ Lista de Produtos</h2>
            <?php if ($perfil == 'adm'): ?>
                <a href="produtos_form.php" class="btn btn-success">➕ Novo Produto</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço (R$)</th>
                        <?php if ($perfil == 'adm'): ?>
                            <th class="text-center">Ações</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= htmlspecialchars($produto['id']) ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            <?php if ($perfil == 'adm'): ?>
                            <td class="text-center">
                                <a href="produtos_form.php?id=<?= $produto['id'] ?>" class="btn btn-sm btn-outline-primary">✏️ Editar</a>
                                <a href="APP/Controllers/ProdutoController.php?excluir=<?= $produto['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">🗑️ Excluir</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
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