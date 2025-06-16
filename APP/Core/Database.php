<?php
// app/Core/Database.php

class Database {
    private static $instance = null;
    private $pdo;

    /**
     * O construtor é privado para impedir a criação de novas instâncias
     * fora da própria classe.
     */
    private function __construct() {
        try {
            // Usa as constantes definidas em config.php para a conexão
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            
            // Configura o PDO para lançar exceções em caso de erro
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Define o modo de busca padrão para array associativo
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Em caso de falha na conexão, encerra a aplicação
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * O método estático que controla o acesso à instância.
     * Na primeira chamada, cria a instância. Nas chamadas subsequentes,
     * retorna a instância já existente.
     *
     * @return PDO A instância do objeto PDO.
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}