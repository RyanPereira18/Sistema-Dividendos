<?php
// app/Models/Consumo.php

class Consumo {
    private $db;
    private $table = 'consumo';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findAllForAdmin() {
        $sql = "
            SELECT consumo.id, clientes.nome AS cliente, produtos.nome AS produto,
                   consumo.quantidade, produtos.preco,
                   (consumo.quantidade * produtos.preco) AS total
            FROM {$this->table}
            JOIN clientes ON consumo.id_cliente = clientes.id
            JOIN produtos ON consumo.id_produto = produtos.id
            ORDER BY consumo.id DESC
        ";
        return $this->db->query($sql)->fetchAll();
    }

    public function searchByClienteName($name) {
        $sql = "
            SELECT consumo.id, clientes.nome AS cliente, produtos.nome AS produto,
                   consumo.quantidade, produtos.preco,
                   (consumo.quantidade * produtos.preco) AS total
            FROM {$this->table}
            JOIN clientes ON consumo.id_cliente = clientes.id
            JOIN produtos ON consumo.id_produto = produtos.id
            WHERE clientes.nome LIKE :name
            ORDER BY consumo.id DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => '%' . $name . '%']);
        return $stmt->fetchAll();
    }

    public function findAllByClienteId($idCliente) {
        $sql = "
            SELECT consumo.id, produtos.nome AS produto,
                   consumo.quantidade, produtos.preco,
                   (consumo.quantidade * produtos.preco) AS total
            FROM {$this->table}
            JOIN produtos ON consumo.id_produto = produtos.id
            WHERE consumo.id_cliente = :id_cliente
            ORDER BY consumo.id DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_cliente' => $idCliente]);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function save($data) {
        $sql = "INSERT INTO {$this->table} (id_cliente, id_produto, quantidade) VALUES (:id_cliente, :id_produto, :quantidade)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id_cliente' => $data['id_cliente'],
            'id_produto' => $data['id_produto'],
            'quantidade' => $data['quantidade']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET id_cliente = :id_cliente, id_produto = :id_produto, quantidade = :quantidade WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id_cliente' => $data['id_cliente'],
            'id_produto' => $data['id_produto'],
            'quantidade' => $data['quantidade'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getRevenueTrend() {
        // Verifica se a coluna existe para evitar erros
        try {
            $this->db->query("SELECT data_consumo FROM consumo LIMIT 1");
        } catch (PDOException $e) {
            // Se a coluna não existir, retorna um array vazio.
            return [];
        }

        $sql = "
            SELECT DATE(c.data_consumo) AS dia, SUM(c.quantidade * p.preco) AS faturamento_diario
            FROM consumo c
            JOIN produtos p ON c.id_produto = p.id
            WHERE c.data_consumo IS NOT NULL
            GROUP BY DATE(c.data_consumo)
            ORDER BY dia ASC
        ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
