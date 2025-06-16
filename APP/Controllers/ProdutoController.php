<?php
// app/Controllers/ProdutoController.php

require_once '../app/Models/Produto.php';

class ProdutoController extends Controller {

    private $produtoModel;

    public function __construct() {
        $this->produtoModel = new Produto();
        // Garante que o usuário esteja logado para acessar qualquer método
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
            // Se não for admin, redireciona para a home (ou exibe um erro)
            header('Location: ' . BASE_URL . '/home');
            exit();
        }
    }

    // Exibe a lista de produtos (público para usuários logados)
    public function index() {
        $produtos = $this->produtoModel->findAll();
        $this->view('produtos/index', ['produtos' => $produtos]);
    }

    // Exibe o formulário de criação (só admin)
    public function create() {
        $this->checkAdminAuth();
        $this->view('produtos/form');
    }

    // Armazena um novo produto (só admin)
    public function store() {
        $this->checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['nome' => $_POST['nome'], 'preco' => $_POST['preco']];
            $this->produtoModel->save($data);
            header('Location: ' . BASE_URL . '/produto');
            exit();
        }
    }

    // Exibe o formulário de edição (só admin)
    public function edit($id) {
        $this->checkAdminAuth();
        $produto = $this->produtoModel->findById($id);
        if ($produto) {
            $this->view('produtos/form', ['produto' => $produto]);
        } else {
            header('Location: ' . BASE_URL . '/produto');
            exit();
        }
    }

    // Atualiza um produto (só admin)
    public function update($id) {
        $this->checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['nome' => $_POST['nome'], 'preco' => $_POST['preco']];
            $this->produtoModel->update($id, $data);
            header('Location: ' . BASE_URL . '/produto');
            exit();
        }
    }

    // Exclui um produto (só admin)
    public function destroy($id) {
        $this->checkAdminAuth();
        $this->produtoModel->delete($id);
        header('Location: ' . BASE_URL . '/produto');
        exit();
    }
}