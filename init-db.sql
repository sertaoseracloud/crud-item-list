-- Cria o banco de dados com codificação UTF-8
CREATE DATABASE IF NOT EXISTS my_database
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Usa o banco de dados criado
USE my_database;

-- Cria a tabela com a codificação correta
CREATE TABLE IF NOT EXISTS tortas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT DEFAULT 0
);

-- Insere os dados com caracteres especiais
INSERT INTO tortas (nome, preco, quantidade) VALUES
('Torta de Limão', 15.00, 10),
('Torta de Chocolate', 25.00, 5),
('Torta Premium de Frutas', 30.00, 8);
