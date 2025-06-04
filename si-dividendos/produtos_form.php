<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

$nome = '';
$preco = '';
$id = '';

if (isset($_GET['id'])) {
    $stmt = $conexao->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($produto) {
        $nome = $produto['nome'];
        $preco = $produto['preco'];
        $id = $produto['id'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
</head>
<body>
<?php include 'header.php'; ?>

<h2><?= $id ? "Editar Produto" : "Novo Produto"; ?></h2>
<form action="produtos_processa.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <label>Nome:</label>
    <input type="text" name="nome" required value="<?= htmlspecialchars($nome) ?>"><br><br>
    <label>Preço:</label>
    <input type="number" step="0.01" name="preco" required value="<?= htmlspecialchars($preco) ?>"><br><br>
    <button type="submit">Salvar</button>
</form>

<a href="produtos_list.php">Voltar à lista</a>

<?php include 'footer.php'; ?>
</body>
</html>
