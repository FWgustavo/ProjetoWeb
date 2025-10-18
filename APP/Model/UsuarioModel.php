<?php
namespace App\Model;

use App\DAO\UsuarioDAO;

class UsuarioModel
{
    public ?int $Id = null;
    public string $Nome = '';
    public string $Email = '';
    public string $Senha = '';
    public array $rows = [];
    private ?string $error = null;

    private UsuarioDAO $dao;

    public function __construct()
    {
        $this->dao = new UsuarioDAO();
    }

    public function getAllRows()
    {
        $this->rows = $this->dao->getAll();
    }

    public function getById(int $id)
    {
        $data = $this->dao->getById($id);
        if ($data) {
            $this->Id = $data->id;
            $this->Nome = $data->nome;
            $this->Email = $data->email;
            $this->Senha = $data->senha;
        }
        return $this;
    }

    public function save()
    {
        if ($this->Id) {
            $this->dao->update($this->Id, [
                'nome' => $this->Nome,
                'email' => $this->Email,
                'senha' => $this->Senha
            ]);
        } else {
            $this->dao->insert([
                'nome' => $this->Nome,
                'email' => $this->Email,
                'senha' => $this->Senha
            ]);
        }
    }

    public function delete(int $id)
    {
        $this->dao->delete($id);
    }

    public function setError(string $msg)
    {
        $this->error = $msg;
    }

    public function getErrors(): ?string
    {
        return $this->error;
    }
}
