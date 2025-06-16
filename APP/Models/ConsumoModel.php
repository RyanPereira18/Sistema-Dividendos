<?php
class ConsumoModel {
    private $conexao;

    public function __construct(PDO $pdo) {
        $this->conexao = $pdo;
    }

    /**
     * Busca todos os registros de consumo (visão do Administrador).
     * @return array
     */
    public function getAllForAdmin() {
        $sql = "
            SELECT consumo.id, clientes.nome AS cliente, produtos.nome AS produto,
                   consumo.quantidade, produtos.preco,
                   (consumo.quantidade * produtos.preco) AS total
            FROM consumo
            JOIN clientes ON consumo.id_cliente = clientes.id
            JOIN produtos ON consumo.id_produto = produtos.id
            ORDER BY consumo.id DESC
        ";
        $stmt = $this->conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca os registros de consumo de um cliente específico.
     * @param int $idCliente O ID do cliente logado.
     * @return array
     */
    public function getAllForCliente($idCliente) {
        $sql = "
            SELECT consumo.id, clientes.nome AS cliente, produtos.nome AS produto,
                   consumo.quantidade, produtos.preco,
                   (consumo.quantidade * produtos.preco) AS total
            FROM consumo
            JOIN clientes ON consumo.id_cliente = clientes.id
            JOIN produtos ON consumo.id_produto = produtos.id
            WHERE clientes.id = :id_cliente
            ORDER BY consumo.id DESC
        ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>