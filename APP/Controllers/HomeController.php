<?php
// app/Controllers/HomeController.php

class HomeController extends Controller {

    /**
     * Verifica se o usuário está logado e exibe a página inicial apropriada.
     */
    public function index() {
        // Se não houver sessão ativa, redireciona para a tela de login
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Carrega a view correspondente ao perfil do usuário
        if ($_SESSION['perfil'] === 'adm') {
            $this->view('home/adm');
        } else {
            $this->view('home/cliente');
        }
    }
}