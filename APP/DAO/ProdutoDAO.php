<?php

namespace App\DAO;

use App\Model\Produto;

final class ProdutoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Produto $model) : Produto
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Produto $model) : Produto
    {
        $sql = "INSERT INTO produto (nome, valor, quantidade, quantidadeMin) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Valor);
        $stmt->bindValue(3, $model->Quantidade);
        $stmt->bindValue(4, $model->QuantidadeMin);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        
        return $model;
    }

    public function update(Produto $model) : Produto
    {
        $sql = "UPDATE produto 
                SET nome=?, valor=?, quantidade=?, quantidadeMin=? 
                WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Valor);
        $stmt->bindValue(3, $model->Quantidade);
        $stmt->bindValue(4, $model->QuantidadeMin);
        $stmt->bindValue(5, $model->Id);
        $stmt->execute();
        
        return $model;
    }

    public function selectById(int $id) : ?Produto
    {
        $sql = "SELECT id as Id, nome as Nome, valor as Valor, quantidade as Quantidade, 
                       quantidadeMin as QuantidadeMin FROM produto WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $result = $stmt->fetchObject("App\Model\Produto");
        return $result !== false ? $result : null;
    }

    public function select() : array
    {
        $sql = "SELECT id as Id, nome as Nome, valor as Valor, quantidade as Quantidade, 
                       quantidadeMin as QuantidadeMin FROM produto ORDER BY nome";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Model\Produto");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM produto WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}