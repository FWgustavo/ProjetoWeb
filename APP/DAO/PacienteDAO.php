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

    public function save(Paciente $model) : Paciente
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Paciente $model) : Paciente
    {
        $sql = "INSERT INTO paciente (nome, cpf, telefone, endereco, data_nascimento) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->CPF);
        $stmt->bindValue(3, $model->Telefone);
        $stmt->bindValue(4, $model->Endereco);
        $stmt->bindValue(5, $model->Data_Nascimento);
        $stmt->execute();

        $model->Id = self::$conexao->lastInsertId();
        
        return $model;
    }

    public function update(Paciente $model) : Paciente
    {
        $sql = "UPDATE paciente 
                SET nome=?, cpf=?, telefone=?, endereco=?, data_nascimento=? 
                WHERE id=?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->CPF);
        $stmt->bindValue(3, $model->Telefone);
        $stmt->bindValue(4, $model->Endereco);
        $stmt->bindValue(5, $model->Data_Nascimento);
        $stmt->bindValue(6, $model->Id);
        $stmt->execute();
        
        return $model;
    }

    public function selectById(int $id) : ?Paciente
    {
        $sql = "SELECT * FROM paciente WHERE id=?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $result = $stmt->fetchObject("App\\Model\\Paciente");
        return $result !== false ? $result : null;
    }

    public function select() : array
    {
        $sql = "SELECT * FROM paciente ORDER BY nome";

        $stmt = self::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Paciente");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM paciente WHERE id=?";

        $stmt = self::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}