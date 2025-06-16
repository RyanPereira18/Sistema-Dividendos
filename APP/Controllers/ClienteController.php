<?php
require_once '../helpers/verifica_login.php'; // Caminho corrigido
require_once '../../conexaoBD.php';           // Caminho corrigido

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Validação e Limpeza dos Dados (Segurança)
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (empty($nome)) {
            // Lógica para lidar com nome vazio, se necessário
            header("Location: ../../clientes_list.php?erro=nome_vazio");
            exit();
        }

        if ($id) {
            // Atualizar cliente
            $stmt = $conexao->prepare("UPDATE clientes SET nome = :nome WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            // Inserir novo cliente
            $stmt = $conexao->prepare("INSERT INTO clientes (nome) VALUES (:nome)");
        }
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();

    } elseif (isset($_GET['excluir'])) {
        // 2. Validação do ID para exclusão
        $id = filter_input(INPUT_GET, 'excluir', FILTER_VALIDATE_INT);

        if ($id) {
            $stmt = $conexao->prepare("DELETE FROM clientes WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    // 3. Tratamento de Erro
    die("Erro ao processar cliente: " . $e->getMessage());
}

// Redireciona de volta para a lista em caso de sucesso
header("Location: ../../clientes_list.php");
exit();
?>