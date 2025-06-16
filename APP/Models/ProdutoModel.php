<?php
class ProdutoModel {
    private $conexao;

    public function __construct(PDO $pdo) {
        $this->conexao = $pdo;
    }

    /**
     * Busca todos os produtos no banco de dados.
     * @return array
     */
    public function getAll() {
        $stmt = $this->conexao->query("SELECT * FROM produtos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>