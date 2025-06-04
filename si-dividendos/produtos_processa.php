<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $id = $_POST['id'] ?? '';

    if ($id) {
        $stmt = $conexao->prepare("UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        $stmt = $conexao->prepare("INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco);
        $stmt->execute();
    }

    header("Location: produtos_list.php");
    exit();
}

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: produtos_list.php");
    exit();
}
?>
