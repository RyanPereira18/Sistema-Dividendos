<?php
// app/Models/Cliente.php

class Cliente {
    private $db;
    private $table = 'clientes'; // Define o nome da tabela para facilitar a manutenção

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Retorna todos os clientes, ordenados por nome.
     */
    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY nome ASC");
        return $stmt->fetchAll();
    }

    /**
     * Busca um cliente específico pelo seu ID.
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Salva um novo cliente no banco de dados.
     */
    public function save($data) {
        $sql = "INSERT INTO {$this->table} (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome']]);
    }

    /**
     * Atualiza os dados de um cliente existente.
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET nome = :nome WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $data['nome'], 'id' => $id]);
    }

    /**
     * Exclui um cliente do banco de dados.
     */
    public function delete($id) {
        // A cláusula ON DELETE CASCADE no SQL garante a integridade dos dados de consumo
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}