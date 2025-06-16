<?php
// app/Models/Produto.php

class Produto {
    private $db;
    private $table = 'produtos'; // Define o nome da tabela

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Retorna todos os produtos, ordenados por nome.
     */
    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY nome ASC");
        return $stmt->fetchAll();
    }

    /**
     * Busca um produto específico pelo seu ID.
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Salva um novo produto no banco de dados.
     */
    public function save($data) {
        $sql = "INSERT INTO {$this->table} (nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome'], 'preco' => $data['preco']]);
    }

    /**
     * Atualiza os dados de um produto existente.
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET nome = :nome, preco = :preco WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome'], 'preco' => $data['preco'], 'id' => $id]);
    }

    /**
     * Exclui um produto do banco de dados.
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}