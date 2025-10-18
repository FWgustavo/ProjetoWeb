-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS TerceiroDS;
USE TerceiroDS;

-- ==============================
-- Tabela de Usuários (login do sistema)
-- ==============================
CREATE TABLE IF NOT EXISTS Usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

-- ==============================
-- Tabela de Pacientes
-- ==============================
CREATE TABLE IF NOT EXISTS Paciente (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  cpf VARCHAR(14) UNIQUE,
  telefone VARCHAR(20),
  endereco VARCHAR(150),
  data_nascimento DATE
);

-- ==============================
-- Tabela de Médicos
-- ==============================
CREATE TABLE IF NOT EXISTS Medico (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  crm VARCHAR(20) UNIQUE NOT NULL,
  especialidade VARCHAR(100),
  telefone VARCHAR(20),
  email VARCHAR(100)
);

-- ==============================
-- Tabela de Produtos
-- ==============================
CREATE TABLE IF NOT EXISTS Produto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL UNIQUE,
  valor DECIMAL(10,2) NOT NULL,
  quantidade INT DEFAULT 0,
  quantidadeMin INT DEFAULT 0
);

-- ==============================
-- Tabela de Serviços
-- ==============================
CREATE TABLE IF NOT EXISTS Servico (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  valor DECIMAL(10,2)
);
