-- BANCO DE DADOS: bar_dividendos

DROP DATABASE IF EXISTS bar_dividendos;
CREATE DATABASE bar_dividendos;
USE bar_dividendos;

-- Tabela de usuários com senha hash
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha_hash VARCHAR(255) NOT NULL
);

-- Tabela de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL
);

-- Tabela de consumo (registro de consumo de produtos por clientes)
CREATE TABLE consumo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_produto) REFERENCES produtos(id) ON DELETE CASCADE
);

-- Exemplo de inserção de usuário com senha hash (senha: admin123)
-- Esta senha foi gerada com password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO usuarios (usuario, senha_hash) VALUES (
    'admin',
    '$2y$10$Ssv3C7FNS2j3FLjZ3Dbl5O1uytbbR5NiEQar5KzQ2Czxn47ckrUhy'
);

UPDATE usuarios 
SET senha_hash = '$2y$10$JmOMu1Fc6EsGN8v3ylyoGujIhnjTStngg4suqouoPxofJusxLql1y' 
WHERE id = 1;

ALTER TABLE usuarios ADD tipo ENUM('adm', 'cliente') NOT NULL DEFAULT 'cliente';


-- ------------------------------------------------------------------
-- //--- CORREÇÃO ADICIONADA ---//
-- ------------------------------------------------------------------
-- Adiciona a coluna id_cliente na tabela de usuários para ligar um usuário a um cliente.
-- Isso é essencial para que o sistema saiba qual cliente corresponde a qual login.
-- A coluna permite valores NULOS, pois os administradores não possuem um registro de cliente.
-- A cláusula ON DELETE CASCADE garante que se um cliente for deletado, a referência aqui também será afetada.

ALTER TABLE usuarios
ADD COLUMN id_cliente INT NULL,
ADD FOREIGN KEY (id_cliente) REFERENCES clientes(id) ON DELETE CASCADE;