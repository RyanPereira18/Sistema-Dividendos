<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css"> </head>
<body>

<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">👥 Lista de Clientes</h2>
            <?php if ($perfil == 'adm'): ?>
                <a href="clientes_form.php" class="btn btn-success">➕ Novo Cliente</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <?php if ($perfil == 'adm'): ?>
                            <th class="text-center">Ações</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['id']) ?></td>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <?php if ($perfil == 'adm'): ?>
                            <td class="text-center">
                                <a href="clientes_form.php?id=<?= $cliente['id'] ?>" class="btn btn-sm btn-outline-primary">✏️ Editar</a>
                                <a href="APP/Controllers/ClienteController.php?excluir=<?= $cliente['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">🗑️ Excluir</a>
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