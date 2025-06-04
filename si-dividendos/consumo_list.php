<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

$perfil = $_SESSION['perfil'];
$id_usuario = $_SESSION['id'];

try {
    if ($perfil == 'cliente') {
        // Se for cliente, mostra apenas seus consumos
        $stmt = $conexao->prepare("
            SELECT consumo.id, clientes.nome AS cliente, produtos.nome AS produto, 
                   consumo.quantidade, produtos.preco, 
                   (consumo.quantidade * produtos.preco) AS total
            FROM consumo
            JOIN clientes ON consumo.cliente_id = clientes.id
            JOIN produtos ON consumo.produto_id = produtos.id
            WHERE clientes.id = :id
        ");
        $stmt->bindParam(':id', $id_usuario);
        $stmt->execute();
    } else {
        // Se for admin, mostra todos os consumos
        $stmt = $conexao->query("
            SELECT consumo.id, clientes.nome AS cliente, produtos.nome AS produto, 
                   consumo.quantidade, produtos.preco, 
                   (consumo.quantidade * produtos.preco) AS total
            FROM consumo
            JOIN clientes ON consumo.cliente_id = clientes.id
            JOIN produtos ON consumo.produto_id = produtos.id
        ");
    }
    $consumos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar consumos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Consumos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            min-height: 100vh;
        }
        .container {
            margin-top: 60px;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">📑 Lista de Consumos</h2>
            
            <?php if ($perfil == 'adm'): ?>
                <a href="consumo_form.php" class="btn btn-success">➕ Novo Consumo</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-warning">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço (R$)</th>
                        <th>Total (R$)</th>
                        <?php if ($perfil == 'adm'): ?>
                            <th class="text-center">Ações</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consumos as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['id']) ?></td>
                        <td><?= htmlspecialchars($c['cliente']) ?></td>
                        <td><?= htmlspecialchars($c['produto']) ?></td>
                        <td><?= htmlspecialchars($c['quantidade']) ?></td>
                        <td><?= number_format($c['preco'], 2, ',', '.') ?></td>
                        <td><?= number_format($c['total'], 2, ',', '.') ?></td>
                        
                        <?php if ($perfil == 'adm'): ?>
                        <td class="text-center">
                            <a href="consumo_form.php?id=<?= htmlspecialchars($c['id']) ?>" class="btn btn-sm btn-outline-primary">
                                ✏️ Editar
                            </a>
                            <a href="consumo_processa.php?excluir=<?= htmlspecialchars($c['id']) ?>" 
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Tem certeza que deseja excluir?')">
                               🗑️ Excluir
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <a href="<?= ($perfil == 'adm') ? 'home_adm.php' : 'home_cliente.php' ?>" class="btn btn-outline-secondary">
                ⬅️ Voltar
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
