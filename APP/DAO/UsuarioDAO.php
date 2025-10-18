<?php

namespace App\DAO;

use App\Model\Usuario;

final class UsuarioDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Usuario $model) : Usuario
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Usuario $model) : Usuario
    {
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, sha1(?))";
        
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Email);
        $stmt->bindValue(3, $model->Senha);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        
        return $model;
    }

    public function update(Usuario $model) : Usuario
    {
        if(!empty($model->Senha)) {
            $sql = "UPDATE usuario SET nome=?, email=?, senha=sha1(?) WHERE id=?";
            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model->Email);
            $stmt->bindValue(3, $model->Senha);
            $stmt->bindValue(4, $model->Id);
        } else {
            $sql = "UPDATE usuario SET nome=?, email=? WHERE id=?";
            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model->Email);
            $stmt->bindValue(3, $model->Id);
        }
        
        $stmt->execute();
        
        return $model;
    }

    public function selectById(int $id) : ?Usuario
    {
        $sql = "SELECT id, nome, email, '' as senha FROM usuario WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("App\Model\Usuario");
    }

    public function select() : array
    {
        $sql = "SELECT id, nome, email, '' as senha FROM usuario ORDER BY nome";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\Usuario");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM usuario WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}