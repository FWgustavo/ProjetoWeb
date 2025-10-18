<?php

namespace App\DAO;

use App\Model\Medico;

final class MedicoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Medico $model) : Medico
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Medico $model) : Medico
    {
        $sql = "INSERT INTO medico (nome, crm, especialidade, telefone, email) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->CRM);
        $stmt->bindValue(3, $model->Especialidade);
        $stmt->bindValue(4, $model->Telefone);
        $stmt->bindValue(5, $model->Email);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        
        return $model;
    }

    public function update(Medico $model) : Medico
    {
        $sql = "UPDATE medico 
                SET nome=?, crm=?, especialidade=?, telefone=?, email=? 
                WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->CRM);
        $stmt->bindValue(3, $model->Especialidade);
        $stmt->bindValue(4, $model->Telefone);
        $stmt->bindValue(5, $model->Email);
        $stmt->bindValue(6, $model->Id);
        $stmt->execute();
        
        return $model;
    }

    public function selectById(int $id) : ?Medico
    {
        $sql = "SELECT id as Id, nome as Nome, crm as CRM, especialidade as Especialidade, 
                       telefone as Telefone, email as Email FROM medico WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $result = $stmt->fetchObject("App\Model\Medico");
        return $result !== false ? $result : null;
    }

    public function select() : array
    {
        $sql = "SELECT id as Id, nome as Nome, crm as CRM, especialidade as Especialidade, 
                       telefone as Telefone, email as Email FROM medico ORDER BY nome";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Model\Medico");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM medico WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}