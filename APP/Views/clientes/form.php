<?php
// app/Views/clientes/form.php
require_once '../app/Views/templates/header.php';
$isEdit = isset($data['cliente']);
?>
<h2 class="mb-4"><?= $isEdit ? 'Editar Cliente' : 'Novo Cliente' ?></h2>

<form action="<?= $isEdit ? BASE_URL . '/cliente/update/' . $data['cliente']['id'] : BASE_URL . '/cliente/store' ?>" method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= $isEdit ? htmlspecialchars($data['cliente']['nome']) : '' ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?= BASE_URL ?>/cliente" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once '../app/Views/templates/footer.php';
?>