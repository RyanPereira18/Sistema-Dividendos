<?php
// app/Models/Consumo.php

class Consumo {
    private $db;
    private $table = 'consumo'; // Define o nome da tabela

    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Busca todos os registros de consumo com detalhes do cliente e produto.
     * Ideal para a visão do Administrador.
     */
    public function findAllForAdmin() {
        // Esta query une as três tabelas para obter um relatório completo
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

    /**
     * Busca os registros de consumo de um cliente específico pelo seu ID.
     * Ideal para a visão do Cliente.
     */
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
    
    /**
     * Busca um registro de consumo único pelo seu ID.
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Salva um novo registro de consumo.
     */
    public function save($data) {
        $sql = "INSERT INTO {$this->table} (id_cliente, id_produto, quantidade) VALUES (:id_cliente, :id_produto, :quantidade)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id_cliente' => $data['id_cliente'],
            'id_produto' => $data['id_produto'],
            'quantidade' => $data['quantidade']
        ]);
    }
    
    /**
     * Atualiza um registro de consumo existente.
     */
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

    /**
     * Exclui um registro de consumo.
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}