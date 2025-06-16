<?php
// app/Views/produtos/form.php
require_once '../app/Views/templates/header.php';
$isEdit = isset($data['produto']);
?>
<h2 class="mb-4"><?= $isEdit ? 'Editar Produto' : 'Novo Produto' ?></h2>

<form action="<?= $isEdit ? BASE_URL . '/produto/update/' . $data['produto']['id'] : BASE_URL . '/produto/store' ?>" method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do Produto</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= $isEdit ? htmlspecialchars($data['produto']['nome']) : '' ?>" required>
    </div>
    <div class="mb-3">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" step="0.01" name="preco" id="preco" class="form-control" value="<?= $isEdit ? htmlspecialchars($data['produto']['preco']) : '' ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?= BASE_URL ?>/produto" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once '../app/Views/templates/footer.php';
?>