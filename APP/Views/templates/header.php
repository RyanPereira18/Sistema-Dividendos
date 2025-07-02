<?php
// app/Views/templates/header.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Dividendos</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-danger btn-sm" href="<?= BASE_URL ?>/auth/logout">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= BASE_URL ?>/home" class="brand-link">
            <span class="brand-text font-weight-light">Bar Dividendos</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Usuário: <?= htmlspecialchars($_SESSION['usuario']) ?></a>
                    <span class="badge badge-info"><?= htmlspecialchars($_SESSION['perfil']) ?></span>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/home" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <?php if ($_SESSION['perfil'] === 'adm'): ?>
                        <li class="nav-header">ADMINISTRAÇÃO</li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/cliente" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/produto" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>Produtos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/consumo" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Consumo</p>
                            </a>
                        </li>
                        <li class="nav-header">DASHBOARDS</li>
                        <li class="nav-item">
                           <a href="<?= BASE_URL ?>/home/clientesDashboard" class="nav-link">
                               <i class="nav-icon fas fa-chart-pie"></i>
                               <p>Dash. Clientes</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?= BASE_URL ?>/home/produtosDashboard" class="nav-link">
                               <i class="nav-icon fas fa-chart-line"></i>
                               <p>Dash. Produtos</p>
                           </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-header">CLIENTE</li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/produto" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>Ver Produtos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/consumo" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>Meu Consumo</p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            </div>
        </aside>

    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">