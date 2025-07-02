<?php
// app/Models/Produto.php

class Produto {
    private $db;
    private $table = 'produtos';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY nome ASC");
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function save($data) {
        $sql = "INSERT INTO {$this->table} (nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome'], 'preco' => $data['preco']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET nome = :nome, preco = :preco WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome'], 'preco' => $data['preco'], 'id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function countAllProducts() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $stmt->fetch()['total'];
    }

    public function getTotalValueOfAllProducts() {
        $stmt = $this->db->query("SELECT SUM(preco) as total_valor FROM {$this->table}");
        return $stmt->fetch()['total_valor'] ?? 0.00;
    }

    public function getTopConsumedProducts($limit = 5) {
        $sql = "
            SELECT p.nome, SUM(c.quantidade) AS total_consumido
            FROM consumo c
            JOIN produtos p ON c.id_produto = p.id
            GROUP BY p.nome
            ORDER BY total_consumido DESC
            LIMIT :limit
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLeastConsumedProducts($limit = 5) {
        $sql = "
            SELECT p.nome, COALESCE(SUM(c.quantidade), 0) AS total_consumido
            FROM produtos p
            LEFT JOIN consumo c ON p.id = c.id_produto
            GROUP BY p.id, p.nome
            ORDER BY total_consumido ASC, p.nome ASC
            LIMIT :limit
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductsSortedByPrice() {
        $stmt = $this->db->query("SELECT nome, preco FROM {$this->table} ORDER BY preco ASC");
        return $stmt->fetchAll();
    }
}