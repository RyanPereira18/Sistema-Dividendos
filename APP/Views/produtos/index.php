<?php
// app/Views/produtos/index.php
require_once '../app/Views/templates/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Lista de Produtos</h2>
    <?php if ($_SESSION['perfil'] === 'adm'): ?>
        <a href="<?= BASE_URL ?>/produto/create" class="btn btn-success">Novo Produto</a>
    <?php endif; ?>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço (R$)</th>
            <?php if ($_SESSION['perfil'] === 'adm'): ?>
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
            <?php if ($_SESSION['perfil'] === 'adm'): ?>
            <td class="text-center">
                <a href="<?= BASE_URL ?>/produto/edit/<?= $produto['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                <a href="<?= BASE_URL ?>/produto/destroy/<?= $produto['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once '../app/Views/templates/footer.php';
?>