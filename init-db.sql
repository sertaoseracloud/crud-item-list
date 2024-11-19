CREATE DATABASE IF NOT EXISTS my_database;

USE my_database;

CREATE TABLE IF NOT EXISTS tortas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT DEFAULT 0
);

INSERT INTO tortas (nome, preco, quantidade) VALUES
('Torta de Limão', 15.00, 10),
('Torta de Chocolate', 25.00, 5),
('Torta Premium de Frutas', 30.00, 8);
