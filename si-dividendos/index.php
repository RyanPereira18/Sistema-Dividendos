<?php
session_start();

if(isset($_POST['perfil'])){
    $_SESSION['perfil'] = $_POST['perfil'];

    if($_SESSION['perfil'] == 'adm'){
        header("Location: home_adm.php");
    } elseif ($_SESSION['perfil'] == 'cliente'){
        header("Location: home_cliente.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Dividendos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center">
    <div class="container mt-5">
        <h1 class="mb-4">Bem-vindo ao Sistema de Dividendos</h1>
        <p class="mb-4">Escolha como deseja acessar o sistema:</p>

        <form method="POST">
            <button class="btn btn-primary btn-lg m-2" type="submit" name="perfil" value="cliente">Entrar como Cliente</button>
            <button class="btn btn-secondary btn-lg m-2" type="submit" name="perfil" value="adm">Entrar como Administrador</button>
        </form>
    </div>
</body>
</html>
