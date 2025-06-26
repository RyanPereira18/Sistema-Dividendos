<?php
// app/Controllers/HomeController.php

// Incluir os Models necessários para os dados do dashboard
require_once '../app/Models/Cliente.php';
require_once '../app/Models/Produto.php'; // Adicionado para o dashboard de produtos

class HomeController extends Controller {

    //Verifica se o usuário está logado e exibe a página inicial apropriada.
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

    //Retorna o número total de clientes em formato JSON para o dashboard.
    public function getTotalClientesData() {
        // Garante que apenas administradores acessem este dado (se for uma informação sensível)
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Acesso negado.']);
            exit();
        }

        $clienteModel = new Cliente();
        $totalClientes = $clienteModel->countAllClients(); // Chama o método do Model

        header('Content-Type: application/json'); // Define o cabeçalho para JSON
        echo json_encode(['total_clientes' => $totalClientes]); // Retorna o total como JSON
        exit(); // Encerra a execução
    }

    //Carrega a view do dashboard de clientes.
    public function clientesDashboard() {
        // Garante que apenas administradores acessem o dashboard
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
        $this->view('home/dashboard_clientes'); // Carrega a view do dashboard de clientes
    }

    //Retorna o número total de produtos e o valor total em formato JSON para o dashboard.
    public function getTotalProdutosData() {
        // Garante que apenas administradores acessem este dado
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Acesso negado.']);
            exit();
        }

        $produtoModel = new Produto();
        $totalProdutos = $produtoModel->countAllProducts(); // Total de produtos
        $totalValorProdutos = $produtoModel->getTotalValueOfAllProducts(); // NOVO: Valor total dos produtos

        header('Content-Type: application/json');
        echo json_encode([
            'total_produtos' => $totalProdutos,
            'total_valor_produtos' => $totalValorProdutos // Adicionado ao JSON
        ]);
        exit();
    }

    //Carrega a view do dashboard de produtos.
    public function produtosDashboard() {
        // Garante que apenas administradores acessem o dashboard
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
        $this->view('home/dashboard_produtos'); // Carrega a view do dashboard de produtos
    }
}
