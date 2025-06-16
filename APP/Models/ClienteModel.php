<?php
class ClienteModel {
    private $conexao;

    // A conexão com o banco é recebida pelo construtor
    public function __construct(PDO $pdo) {
        $this->conexao = $pdo;
    }

    /**
     * Busca todos os clientes no banco de dados.
     * @return array
     */
    public function getAll() {
        $stmt = $this->conexao->query("SELECT * FROM clientes ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>