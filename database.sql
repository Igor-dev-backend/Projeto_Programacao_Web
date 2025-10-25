-- MenuExpress Database Setup
-- Execute este script no phpMyAdmin para criar o banco e tabela

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS menuexpress CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar o banco
USE menuexpress;

-- Criar tabela de pratos
CREATE TABLE IF NOT EXISTS pratos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir dados de exemplo (opcional)
INSERT INTO pratos (nome, descricao, preco, imagem) VALUES
('Pizza Margherita', 'Pizza clássica com molho de tomate, mussarela e manjericão fresco', 35.90, 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400'),
('Hambúrguer Artesanal', 'Hambúrguer de carne bovina, queijo cheddar, alface, tomate e molho especial', 28.50, 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400'),
('Salada Caesar', 'Alface romana, croutons, queijo parmesão e molho caesar caseiro', 22.00, 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=400'),
('Lasanha à Bolonhesa', 'Lasanha tradicional com molho bolonhesa, queijo mussarela e parmesão', 42.90, 'https://images.unsplash.com/photo-1574894709920-11b28e7367e3?w=400'),
('Salmão Grelhado', 'Filé de salmão grelhado com legumes e arroz integral', 48.00, 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=400'),
('Tiramisu', 'Sobremesa italiana tradicional com café e mascarpone', 18.50, 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=400');

-- Verificar se os dados foram inseridos
SELECT * FROM pratos;
