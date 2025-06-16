<?php
// É uma boa prática garantir que a sessão já foi iniciada.
// A maioria das suas páginas já faz isso, mas adiciona uma camada de segurança.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Dividendos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bar Dividendos</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <?php?>
                <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'adm'): ?>
                    <li class="nav-item"><a class="nav-link" href="clientes_list.php">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="produtos_list.php">Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="consumo_list.php">Consumo</a></li>
                <?php else: ?>
                    <?php?>
                    <li class="nav-item"><a class="nav-link" href="produtos_list.php">Ver Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="consumo_list.php">Meu Consumo</a></li>
                <?php endif; ?>
            </ul>
            <a class="btn btn-outline-light" href="logout.php">Sair</a>
        </div>
    </div>
</nav>
<div class="container">