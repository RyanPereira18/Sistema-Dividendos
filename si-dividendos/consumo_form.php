<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

$cliente_id = '';
$produto_id = '';
$quantidade = '';
$id = '';

// carregar listas de clientes e produtos (com PDO)
$clientesStmt = $conexao->query("SELECT * FROM clientes");
$clientes = $clientesStmt->fetchAll(PDO::FETCH_ASSOC);

$produtosStmt = $conexao->query("SELECT * FROM produtos");
$produtos = $produtosStmt->fetchAll(PDO::FETCH_ASSOC);

// carregar dados se for edição
if (isset($_GET['id'])) {
    $stmt = $conexao->prepare("SELECT * FROM consumo WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $consumo = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($consumo) {
        $cliente_id = $consumo['id_cliente'];
        $produto_id = $consumo['id_produto'];
        $quantidade = $consumo['quantidade'];
        $id = $consumo['id'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Consumo</title>
</head>
<body>
<?php include 'header.php'; ?>

<h2><?= $id ? "Editar Consumo" : "Novo Consumo"; ?></h2>
<form action="consumo_processa.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <label>Cliente:</label>
    <select name="cliente_id" required>
        <option value="">Selecione</option>
        <?php foreach ($clientes as $cli): ?>
            <option value="<?= $cli['id'] ?>" <?= $cli['id'] == $cliente_id ? 'selected' : '' ?>><?= htmlspecialchars($cli['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Produto:</label>
    <select name="produto_id" required>
        <option value="">Selecione</option>
        <?php foreach ($produtos as $prod): ?>
            <option value="<?= $prod['id'] ?>" <?= $prod['id'] == $produto_id ? 'selected' : '' ?>><?= htmlspecialchars($prod['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Quantidade:</label>
    <input type="number" name="quantidade" min="1" required value="<?= htmlspecialchars($quantidade) ?>"><br><br>

    <button type="submit">Salvar</button>
</form>

<a href="consumo_list.php">Voltar à lista</a>

<?php include 'footer.php'; ?>
</body>
</html>
