CREATE DATABASE financeiro_db;
USE financeiro_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tipo ENUM('receita','despesa'),
    valor DECIMAL(10,2),
    descricao VARCHAR(255),
    data DATE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
);