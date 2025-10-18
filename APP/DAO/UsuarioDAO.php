<?php
namespace App\DAO;

use PDO;
use PDOException;

class UsuarioDAO
{
    private PDO $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function getAll(): array
    {
        $stmt = $this->conn->query("SELECT * FROM Usuario");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Usuario WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert(array $data)
    {
        $stmt = $this->conn->prepare("INSERT INTO Usuario (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->execute([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => password_hash($data['senha'], PASSWORD_DEFAULT)
        ]);
    }

    public function update(int $id, array $data)
    {
        $stmt = $this->conn->prepare("UPDATE Usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
        $stmt->execute([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => password_hash($data['senha'], PASSWORD_DEFAULT),
            'id' => $id
        ]);
    }

    public function delete(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM Usuario WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
