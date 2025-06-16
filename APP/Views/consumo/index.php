<?php
// app/Views/consumo/index.php
require_once '../app/Views/templates/header.php';
$totalGeral = 0;
$isAdmin = $_SESSION['perfil'] === 'adm';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Relatório de Consumo</h2>
    <?php if ($isAdmin): ?>
        <a href="<?= BASE_URL ?>/consumo/create" class="btn btn-success">Novo Consumo</a>
    <?php endif; ?>
</div>

<?php // INÍCIO DA ALTERAÇÃO: Formulário de busca visível para todos ?>
<div class="card card-body mb-4 shadow-sm">
    <form action="<?= BASE_URL ?>/consumo" method="get" class="d-flex align-items-center">
        <?php
            // Muda o texto de ajuda dependendo do perfil do usuário
            $placeholder = $isAdmin ? 'Filtrar por nome do cliente...' : 'Digite seu nome para ver seu consumo...';
        ?>
        <input type="text" name="q" class="form-control me-2" placeholder="<?= $placeholder ?>" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <?php if (isset($_GET['q']) && !empty($_GET['q'])): ?>
            <a href="<?= BASE_URL ?>/consumo" class="btn btn-outline-secondary ms-2">Limpar Busca</a>
        <?php endif; ?>
    </form>
</div>
<?php // FIM DA ALTERAÇÃO ?>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Qtd.</th>
            <th>Preço Unit. (R$)</th>
            <th>Total (R$)</th>
            <?php if ($isAdmin): ?><th class="text-center">Ações</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $noResults = false;
        if (empty($consumos)) {
            $noResults = true;
            // Mensagens personalizadas para quando a lista está vazia
            if (!$isAdmin && empty($_GET['q'])) {
                $noResultsMessage = "Por favor, digite seu nome na busca acima para consultar seus gastos.";
            } else if (isset($_GET['q'])) {
                $noResultsMessage = "Nenhum registro encontrado para sua busca.";
            } else {
                $noResultsMessage = "Nenhum registro de consumo encontrado.";
            }
        }
        ?>
        <?php if ($noResults): ?>
            <tr>
                <td colspan="<?= $isAdmin ? '6' : '5' ?>" class="text-center p-4"><?= $noResultsMessage ?></td>
            </tr>
        <?php else: ?>
            <?php foreach ($consumos as $consumo): ?>
            <?php $totalGeral += $consumo['total']; ?>
            <tr>
                <td><?= htmlspecialchars($consumo['cliente']) ?></td>
                <td><?= htmlspecialchars($consumo['produto']) ?></td>
                <td><?= htmlspecialchars($consumo['quantidade']) ?></td>
                <td><?= number_format($consumo['preco'], 2, ',', '.') ?></td>
                <td><?= number_format($consumo['total'], 2, ',', '.') ?></td>
                <?php if ($isAdmin): ?>
                <td class="text-center">
                    <a href="<?= BASE_URL ?>/consumo/edit/<?= $consumo['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="<?= BASE_URL ?>/consumo/destroy/<?= $consumo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <?php if (!$noResults): // Só mostra o rodapé da tabela se houver resultados ?>
    <tfoot>
        <tr>
            <td colspan="<?= $isAdmin ? '5' : '4' ?>" class="text-end fw-bold">Total Geral:</td>
            <td class="fw-bold">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
            <?php if ($isAdmin): ?><td></td><?php endif; ?>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>

<?php
require_once '../app/Views/templates/footer.php';
?>
