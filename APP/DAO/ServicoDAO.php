<?php

namespace App\DAO;

use App\Model\Servico;

final class ServicoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Servico $model) : Servico
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Servico $model) : Servico
    {
        $sql = "INSERT INTO servico (nome, descricao, valor) 
                VALUES (?, ?, ?)";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Descricao);
        $stmt->bindValue(3, $model->Valor);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        
        return $model;
    }

    public function update(Servico $model) : Servico
    {
        $sql = "UPDATE servico 
                SET nome=?, descricao=?, valor=? 
                WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Descricao);
        $stmt->bindValue(3, $model->Valor);
        $stmt->bindValue(4, $model->Id);
        $stmt->execute();
        
        return $model;
    }

    public function selectById(int $id) : ?Servico
    {
        $sql = "SELECT * FROM servico WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("App\Model\Servico");
    }

    public function select() : array
    {
        $sql = "SELECT * FROM servico ORDER BY nome";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\Servico");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM servico WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}