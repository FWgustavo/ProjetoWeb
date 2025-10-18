<?php

namespace App\DAO;

use App\Model\Paciente;
use PDO;

final class PacienteDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Paciente $model): Paciente
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Paciente $model): Paciente
    {
        $sql = "INSERT INTO Paciente (nome, cpf, telefone, endereco, data_nascimento)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Cpf);
        $stmt->bindValue(3, $model->Telefone);
        $stmt->bindValue(4, $model->Endereco);
        $stmt->bindValue(5, $model->Data_Nascimento);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        return $model;
    }

    public function update(Paciente $model): Paciente
    {
        $sql = "UPDATE Paciente 
                   SET nome=?, cpf=?, telefone=?, endereco=?, data_nascimento=?
                 WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Cpf);
        $stmt->bindValue(3, $model->Telefone);
        $stmt->bindValue(4, $model->Endereco);
        $stmt->bindValue(5, $model->Data_Nascimento);
        $stmt->bindValue(6, $model->Id);
        $stmt->execute();

        return $model;
    }

    public function selectById(int $id): ?Paciente
    {
        $sql = "SELECT * FROM Paciente WHERE id=?";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject("App\Model\Paciente");
    }

    public function select(): array
    {
        $sql = "SELECT * FROM Paciente";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "App\Model\Paciente");
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM Paciente WHERE id=?";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
