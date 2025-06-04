<?php
require_once 'verifica_login.php';
require_once 'conexaoBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT);
    $produto_id = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($cliente_id && $produto_id && $quantidade) {
        if (!empty($id)) {
            // Atualização
            $sql = "UPDATE consumo SET id_cliente = :cliente_id, id_produto = :produto_id, quantidade = :quantidade WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            // Inserção
            $sql = "INSERT INTO consumo (id_cliente, id_produto, quantidade) VALUES (:cliente_id, :produto_id, :quantidade)";
            $stmt = $conexao->prepare($sql);
        }

        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->execute();
    }

    header("Location: consumo_list.php");
    exit();
}

if (isset($_GET['excluir'])) {
    $id = filter_input(INPUT_GET, 'excluir', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $conexao->prepare("DELETE FROM consumo WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    header("Location: consumo_list.php");
    exit();
}
?>
