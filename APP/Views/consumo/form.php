<?php
// app/Views/consumo/form.php
require_once '../app/Views/templates/header.php';
$isEdit = isset($data['consumo']);
?>
<h2 class="mb-4"><?= $isEdit ? 'Editar Consumo' : 'Novo Consumo' ?></h2>

<form action="<?= $isEdit ? BASE_URL . '/consumo/update/' . $data['consumo']['id'] : BASE_URL . '/consumo/store' ?>" method="post">
    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <select name="id_cliente" id="id_cliente" class="form-select" required>
            <option value="">Selecione um cliente</option>
            <?php foreach ($data['clientes'] as $cliente): ?>
                <option value="<?= $cliente['id'] ?>" <?= ($isEdit && $cliente['id'] == $data['consumo']['id_cliente']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cliente['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_produto" class="form-label">Produto</label>
        <select name="id_produto" id="id_produto" class="form-select" required>
            <option value="">Selecione um produto</option>
            <?php foreach ($data['produtos'] as $produto): ?>
                 <option value="<?= $produto['id'] ?>" <?= ($isEdit && $produto['id'] == $data['consumo']['id_produto']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($produto['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
     <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade</label>
        <input type="number" name="quantidade" id="quantidade" class="form-control" value="<?= $isEdit ? htmlspecialchars($data['consumo']['quantidade']) : '1' ?>" required min="1">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?= BASE_URL ?>/consumo" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once '../app/Views/templates/footer.php';
?>