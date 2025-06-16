<?php
require_once '../helpers/verifica_login.php';
require_once '../../conexaoBD.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Validação e Limpeza dos Dados
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (empty($nome) || $preco === false) {
            header("Location: ../../produtos_list.php?erro=dados_invalidos");
            exit();
        }

        if ($id) {
            // Atualizar produto
            $stmt = $conexao->prepare("UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            // Inserir novo produto
            $stmt = $conexao->prepare("INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)");
        }
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco);
        $stmt->execute();

    } elseif (isset($_GET['excluir'])) {
        // 2. Validação do ID para exclusão
        $id = filter_input(INPUT_GET, 'excluir', FILTER_VALIDATE_INT);

        if ($id) {
            $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    // 3. Tratamento de Erro
    die("Erro ao processar produto: " . $e->getMessage());
}

// Redireciona de volta para a lista em caso de sucesso
header("Location: ../../produtos_list.php");
exit();
?>