<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <form action="password_verify.php" method="post" class="p-4 bg-white shadow rounded w-50 mx-auto">
            <h2 class="mb-4 text-center">Login</h2>

            <?php
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 'senha') {
                    echo '<div class="alert alert-danger">Senha incorreta!</div>';
                } elseif ($_GET['erro'] == 'usuario') {
                    echo '<div class="alert alert-danger">Usuário não encontrado!</div>';
                } elseif ($_GET['erro'] == 'vazio') {
                    echo '<div class="alert alert-warning">Preencha todos os campos!</div>';
                }
            }
            ?>

            <input type="text" name="usuario" placeholder="Usuário" class="form-control mb-3" required>
            <input type="password" name="senha" placeholder="Senha" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary w-100">Entrar no Sistema</button>
        </form>
    </div>
</body>
</html>