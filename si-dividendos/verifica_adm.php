<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'adm') {
    header('Location: index.php');
    exit();
}
?>
