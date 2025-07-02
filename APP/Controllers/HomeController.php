<?php
// app/Controllers/HomeController.php

require_once '../app/Models/Cliente.php';
require_once '../app/Models/Produto.php';
require_once '../app/Models/Consumo.php';

class HomeController extends Controller {

    public function index() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        if ($_SESSION['perfil'] === 'adm') {
            $this->view('home/adm');
        } else {
            $this->view('home/cliente');
        }
    }

    private function checkAdminAuth() {
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Acesso negado.']);
            exit();
        }
    }

    public function clientesDashboard() {
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
        $this->view('home/dashboard_clientes');
    }

    public function produtosDashboard() {
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
        $this->view('home/dashboard_produtos');
    }

    // --- ENDPOINTS PARA OS GRÁFICOS ---

    public function getTotalClientesData() {
        $this->checkAdminAuth();
        $clienteModel = new Cliente();
        header('Content-Type: application/json');
        echo json_encode(['total_clientes' => $clienteModel->countAllClients()]);
        exit();
    }

    public function getTopConsumedProductsData() {
        $this->checkAdminAuth();
        $produtoModel = new Produto();
        header('Content-Type: application/json');
        echo json_encode($produtoModel->getTopConsumedProducts());
        exit();
    }

    public function getLeastConsumedProductsData() {
        $this->checkAdminAuth();
        $produtoModel = new Produto();
        header('Content-Type: application/json');
        echo json_encode($produtoModel->getLeastConsumedProducts());
        exit();
    }

    public function getRevenueTrendData() {
        $this->checkAdminAuth();
        $consumoModel = new Consumo();
        header('Content-Type: application/json');
        echo json_encode($consumoModel->getRevenueTrend());
        exit();
    }

    public function getProductsSortedByPriceData() {
        $this->checkAdminAuth();
        $produtoModel = new Produto();
        header('Content-Type: application/json');
        echo json_encode($produtoModel->getProductsSortedByPrice());
        exit();
    }

    public function getClientsByConsumptionQuantityData() {
        $this->checkAdminAuth();
        $clienteModel = new Cliente();
        header('Content-Type: application/json');
        echo json_encode($clienteModel->getClientsByConsumptionQuantity());
        exit();
    }
}
