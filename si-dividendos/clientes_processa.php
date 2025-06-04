<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        // Atualizar cliente
        $stmt = $conexao->prepare("UPDATE clientes SET nome = :nome WHERE id = :id");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // Inserir novo cliente
        $stmt = $conexao->prepare("INSERT INTO clientes (nome) VALUES (:nome)");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
    }

    header("Location: clientes_list.php");
    exit();
}

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    if ($id) {
        $stmt = $conexao->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    header("Location: clientes_list.php");
    exit();
}
?>
