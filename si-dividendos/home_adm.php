<?php
include('valida_acesso.php');
include 'header.php';

// Verifica se realmente é administrador
if ($_SESSION['perfil'] != 'adm') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área Administrativa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .btn {
            border-radius: 12px;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .card h2 {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="card p-5">
            <h2 class="text-center mb-3">Área Administrativa</h2>
            <p class="text-center mb-4 text-muted">Gerencie clientes, produtos e consumos de forma prática.</p>

            <div class="d-grid gap-3">
                <a href="clientes_list.php" class="btn btn-outline-primary">📋 Gerenciar Clientes</a>
                <a href="produtos_list.php" class="btn btn-outline-success">🛒 Gerenciar Produtos</a>
                <a href="consumo_list.php" class="btn btn-outline-warning">📑 Gerenciar Consumos</a>
            </div>

            <div class="text-center mt-4">
                <a href="logout.php" class="btn btn-outline-danger">🚪 Sair</a>
            </div>
        </div>
    </div>
</body>
</html>
