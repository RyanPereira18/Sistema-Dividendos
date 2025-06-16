<?php
// app/Views/auth/login.php
// Este arquivo não inclui header/footer para ter uma página de login limpa.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <form action="<?= BASE_URL ?>/auth/authenticate" method="post" class="p-4 bg-white shadow rounded w-50 mx-auto">
            <h2 class="mb-4 text-center">Login</h2>
            <?php
            // Opcional: para exibir mensagens de erro
            if (isset($_SESSION['error_message'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <input type="text" name="usuario" placeholder="Usuário" class="form-control mb-3" required>
            <input type="password" name="senha" placeholder="Senha" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary w-100">Entrar no Sistema</button>
        </form>
    </div>
</body>
</html>