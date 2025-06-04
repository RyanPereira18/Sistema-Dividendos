<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

$perfil = $_SESSION['perfil'];

try {
    $stmt = $conexao->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar produtos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            min-height: 100vh;
        }
        .container {
            margin-top: 70px;
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">🛍️ Lista de Produtos</h2>
            
            <?php if ($perfil == 'adm'): ?>
                <a href="produtos_form.php" class="btn btn-success">
                    ➕ Novo Produto
                </a>
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
                                <a href="produtos_form.php?id=<?= htmlspecialchars($produto['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    ✏️ Editar
                                </a>
                                <a href="produtos_processa.php?excluir=<?= htmlspecialchars($produto['id']) ?>" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                   🗑️ Excluir
                                </a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="<?= ($perfil == 'adm') ? 'home_adm.php' : 'home_cliente.php' ?>" 
               class="btn btn-outline-secondary">
                ⬅️ Voltar
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
