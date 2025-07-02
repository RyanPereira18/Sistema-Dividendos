<?php
// app/Models/Cliente.php

class Cliente {
    private $db;
    private $table = 'clientes';

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
        $sql = "INSERT INTO {$this->table} (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET nome = :nome WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome'], 'id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function countAllClients() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $stmt->fetch()['total'];
    }

    public function getTopSpenderClients($limit = 5) {
        $sql = "
            SELECT cl.nome, SUM(c.quantidade * p.preco) AS total_gasto
            FROM consumo c
            JOIN clientes cl ON c.id_cliente = cl.id
            JOIN produtos p ON c.id_produto = p.id
            GROUP BY cl.nome
            ORDER BY total_gasto DESC
            LIMIT :limit
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getClientsByConsumptionQuantity($limit = 5) {
        $sql = "
            SELECT cl.nome, SUM(c.quantidade) AS total_itens
            FROM consumo c
            JOIN clientes cl ON c.id_cliente = cl.id
            GROUP BY cl.nome
            ORDER BY total_itens DESC
            LIMIT :limit
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
