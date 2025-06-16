<?php
session_start();
require_once 'conexaoBD.php';

// Valida e obtém os dados do formulário de forma segura
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = $_POST['senha'] ?? ''; // A senha não precisa de filtro para password_verify

if (empty($usuario) || empty($senha)) {
    header("Location: ../../index.php?erro=vazio");
    exit();
}

try {
    // Busca também o id_cliente, que é crucial para a área do cliente
    $sql = "SELECT id, usuario, senha_hash, tipo, id_cliente FROM usuarios WHERE usuario = :usuario";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($senha, $user['senha_hash'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['perfil'] = $user['tipo'];

        // Se for um cliente, guarda seu ID de cliente na sessão
        if ($user['tipo'] === 'cliente') {
            $_SESSION['id_cliente'] = $user['id_cliente'];
            header("Location: ../../home_cliente.php");
        } else {
            header("Location: ../../home_adm.php");
        }
        exit();

    } else {
        // Erro de autenticação (usuário ou senha inválidos)
        header("Location: ../../index.php?erro=usuario_ou_senha");
        exit();
    }

} catch (PDOException $e) {
    // Em caso de erro com o banco de dados
    die("Erro de autenticação: " . $e->getMessage());
}
?>