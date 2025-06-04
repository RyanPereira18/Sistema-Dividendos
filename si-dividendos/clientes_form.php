<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

$nome = '';
$id = '';

if (isset($_GET['id'])) {
    $stmt = $conexao->prepare("SELECT * FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($cliente) {
        $nome = $cliente['nome'];
        $id = $cliente['id'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Clientes</title>
</head>
<body>
<?php include 'header.php'; ?>

<h2><?= $id ? "Editar Cliente" : "Novo Cliente"; ?></h2>
<form action="clientes_processa.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <label>Nome:</label>
    <input type="text" name="nome" required value="<?= htmlspecialchars($nome) ?>"><br><br>
    <button type="submit">Salvar</button>
</form>

<a href="clientes_list.php">Voltar à lista</a>

<?php include 'footer.php'; ?>
</body>
</html>
