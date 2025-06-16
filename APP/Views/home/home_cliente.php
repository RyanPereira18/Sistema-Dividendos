<?php
// CORREÇÃO: Substitui o include antigo pelo padrão
require_once 'verifica_login.php';

// Esta verificação garante que apenas clientes permaneçam na página
if ($_SESSION['perfil'] != 'cliente') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Cliente</title>
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
            <h2 class="text-center mb-3">Área do Cliente</h2>
            <p class="text-center mb-4 text-muted">Consulte os produtos disponíveis e seu histórico de consumo.</p>

            <div class="d-grid gap-3">
                <a href="produtos_list.php" class="btn btn-outline-primary">🛒 Ver Produtos</a>
                <a href="consumo_list.php" class="btn btn-outline-success">📑 Ver Meu Consumo</a>
            </div>

            <div class="text-center mt-4">
                <a href="logout.php" class="btn btn-outline-danger">🚪 Sair</a>
            </div>
        </div>
    </div>
</body>
</html>