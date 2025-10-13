-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS terceirods;
USE terceirods;

-- Tabela Usuário
CREATE TABLE IF NOT EXISTS Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Tabela Paciente
CREATE TABLE IF NOT EXISTS Paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    data_nascimento DATE,
    cpf VARCHAR(14) UNIQUE,
    telefone VARCHAR(20)
);

-- Tabela Médico
CREATE TABLE IF NOT EXISTS Medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    crm VARCHAR(20) UNIQUE,
    especialidade VARCHAR(50)
);

-- Tabela Produto
CREATE TABLE IF NOT EXISTS Produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0
);

-- Tabela Serviço
CREATE TABLE IF NOT EXISTS Servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL
);

insert into Usuario(nome,email,senha) values('Gustavo', 'gu@gmail.com',sha1('123'));