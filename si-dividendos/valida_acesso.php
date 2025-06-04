<?php
session_start();

if(!isset($_SESSION['perfil'])){
    header("Location: index.php");
    exit;
}
?>
