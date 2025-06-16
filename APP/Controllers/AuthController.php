<?php
// app/Controllers/AuthController.php

require_once '../app/Models/Usuario.php';

class AuthController extends Controller {

    /**
     * Exibe a página de login.
     */
    public function login() {
        $this->view('auth/login');
    }

    /**
     * Processa os dados do formulário de login.
     */
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        $usuarioModel = new Usuario();
        $user = $usuarioModel->findByUsuario($_POST['usuario']);

        // Verifica se o usuário existe e se a senha está correta
        if ($user && password_verify($_POST['senha'], $user['senha_hash'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['perfil'] = $user['tipo'];
            $_SESSION['id_cliente'] = $user['id_cliente'];
            
            header('Location: ' . BASE_URL . '/home');
            exit();
        } else {
            // Em caso de falha, redireciona de volta para o login com uma mensagem de erro (opcional)
            // session_start();
            // $_SESSION['error_message'] = "Usuário ou senha inválidos.";
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
    }

    /**
     * Destrói a sessão e faz o logout do usuário.
     */
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/auth/login');
        exit();
    }
}