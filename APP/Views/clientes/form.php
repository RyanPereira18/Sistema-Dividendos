<?php
// app/Views/clientes/form.php
require_once '../app/Views/templates/header.php';
$isEdit = isset($data['cliente']);
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $isEdit ? 'Editar Cliente' : 'Novo Cliente' ?></h3>
    </div>
    <form action="<?= $isEdit ? BASE_URL . '/cliente/update/' . $data['cliente']['id'] : BASE_URL . '/cliente/store' ?>" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $isEdit ? htmlspecialchars($data['cliente']['nome']) : '' ?>" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar
            </button>
            <a href="<?= BASE_URL ?>/cliente" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php
require_once '../app/Views/templates/footer.php';
?>