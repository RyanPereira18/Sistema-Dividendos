<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'conexaoBD.php';

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha_hash'])) {
        $_SESSION['usuario'] = $user['usuario'];
        session_write_close();
        header("Location: home_adm.php");
        exit();
    } else {
        header("Location: login.php?erro=usuario_ou_senha");
        exit();
    }
} else {
    header("Location: login.php?erro=vazio");
    exit();
}
?>
