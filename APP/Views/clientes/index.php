<?php
// app/Views/clientes/index.php
require_once '../app/Views/templates/header.php';
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Clientes</h3>
        <div class="card-tools">
            <a href="<?= BASE_URL ?>/cliente/create" class="btn btn-block btn-success btn-sm">
                <i class="fas fa-plus"></i> Novo Cliente
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Nome</th>
                    <th style="width: 150px" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente['id']) ?></td>
                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                    <td class="text-center">
                        <a href="<?= BASE_URL ?>/cliente/edit/<?= $cliente['id'] ?>" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="<?= BASE_URL ?>/cliente/destroy/<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once '../app/Views/templates/footer.php';
?>