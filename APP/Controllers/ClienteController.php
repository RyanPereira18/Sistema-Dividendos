<?php
// app/Controllers/ClienteController.php

require_once '../app/Models/Cliente.php';

class ClienteController extends Controller {

    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
        // Garante que apenas administradores acessem este controlador
        $this->checkAdminAuth();
    }

    private function checkAdminAuth() {
        if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'adm') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }
    }

    // Exibe a lista de todos os clientes
    public function index() {
        $clientes = $this->clienteModel->findAll();
        $this->view('clientes/index', ['clientes' => $clientes]);
    }

    // Exibe o formulário para criar um novo cliente
    public function create() {
        $this->view('clientes/form');
    }

    // Armazena um novo cliente no banco de dados
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clienteModel->save(['nome' => $_POST['nome']]);
            header('Location: ' . BASE_URL . '/cliente');
            exit();
        }
    }

    // Exibe o formulário para editar um cliente existente
    public function edit($id) {
        $cliente = $this->clienteModel->findById($id);
        if ($cliente) {
            $this->view('clientes/form', ['cliente' => $cliente]);
        } else {
            // Redireciona se o cliente não for encontrado
            header('Location: ' . BASE_URL . '/cliente');
            exit();
        }
    }

    // Atualiza um cliente no banco de dados
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clienteModel->update($id, ['nome' => $_POST['nome']]);
            header('Location: ' . BASE_URL . '/cliente');
            exit();
        }
    }

    // Exclui um cliente do banco de dados
    public function destroy($id) {
        $this->clienteModel->delete($id);
        header('Location: ' . BASE_URL . '/cliente');
        exit();
    }
}