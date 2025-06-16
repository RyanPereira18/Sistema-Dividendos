<?php
// app/Controllers/ConsumoController.php

require_once '../app/Models/Consumo.php';
require_once '../app/Models/Cliente.php';
require_once '../app/Models/Produto.php';

class ConsumoController extends Controller {

    private $consumoModel;

    public function __construct() {
        $this->consumoModel = new Consumo();
        $this->checkAuth();
    }
    
    private function checkAuth() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
    }
    
    private function checkAdminAuth() {
        if ($_SESSION['perfil'] !== 'adm') {
            header('Location: ' . BASE_URL . '/home');
            exit();
        }
    }

    // Exibe a lista de consumo (diferente para admin e cliente)
    public function index() {
        if ($_SESSION['perfil'] === 'adm') {
            $consumos = $this->consumoModel->findAllForAdmin();
        } else {
            $consumos = $this->consumoModel->findAllByClienteId($_SESSION['id_cliente']);
        }
        $this->view('consumo/index', ['consumos' => $consumos]);
    }

    // Exibe o formulário de criação (só admin)
    public function create() {
        $this->checkAdminAuth();
        $clienteModel = new Cliente();
        $produtoModel = new Produto();
        $data = [
            'clientes' => $clienteModel->findAll(),
            'produtos' => $produtoModel->findAll()
        ];
        $this->view('consumo/form', $data);
    }

    // Armazena um novo consumo (só admin)
    public function store() {
        $this->checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_cliente' => $_POST['id_cliente'],
                'id_produto' => $_POST['id_produto'],
                'quantidade' => $_POST['quantidade']
            ];
            $this->consumoModel->save($data);
            header('Location: ' . BASE_URL . '/consumo');
            exit();
        }
    }

    // Exibe o formulário de edição (só admin)
    public function edit($id) {
        $this->checkAdminAuth();
        $consumo = $this->consumoModel->findById($id);
        if ($consumo) {
            $clienteModel = new Cliente();
            $produtoModel = new Produto();
            $data = [
                'consumo' => $consumo,
                'clientes' => $clienteModel->findAll(),
                'produtos' => $produtoModel->findAll()
            ];
            $this->view('consumo/form', $data);
        } else {
            header('Location: ' . BASE_URL . '/consumo');
            exit();
        }
    }

    // Atualiza um consumo (só admin)
    public function update($id) {
        $this->checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_cliente' => $_POST['id_cliente'],
                'id_produto' => $_POST['id_produto'],
                'quantidade' => $_POST['quantidade']
            ];
            $this->consumoModel->update($id, $data);
            header('Location: ' . BASE_URL . '/consumo');
            exit();
        }
    }

    // Exclui um consumo (só admin)
    public function destroy($id) {
        $this->checkAdminAuth();
        $this->consumoModel->delete($id);
        header('Location: ' . BASE_URL . '/consumo');
        exit();
    }
}