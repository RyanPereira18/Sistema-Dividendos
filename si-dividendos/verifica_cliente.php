<?php
session_start();

if (!isset($_SESSION['acesso_cliente']) || $_SESSION['acesso_cliente'] !== true) {
    header('Location: index.php');
    exit();
}
?>
