<?php
// app/Views/templates/header.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Dividendos - MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>/home">Bar Dividendos</a>
        <?php if (isset($_SESSION['usuario'])): ?>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <?php if ($_SESSION['perfil'] === 'adm'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/cliente">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produto">Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/consumo">Consumo</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produto">Ver Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/consumo">Meu Consumo</a></li>
                <?php endif; ?>
            </ul>
            <a class="btn btn-outline-light" href="<?= BASE_URL ?>/auth/logout">Sair</a>
        </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container">