<?php
// app/Models/Usuario.php

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Busca um usuário pelo seu nome de usuário.
     *
     * @param string $usuario O nome de usuário a ser buscado.
     * @return mixed Retorna os dados do usuário como um array associativo ou false se não encontrado.
     */
    public function findByUsuario($usuario) {
        // A query seleciona todos os campos necessários para a sessão
        $stmt = $this->db->prepare("SELECT id, usuario, senha_hash, tipo, id_cliente FROM usuarios WHERE usuario = :usuario");
        $stmt->execute(['usuario' => $usuario]);
        return $stmt->fetch();
    }
}