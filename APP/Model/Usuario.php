<?php

namespace App\Model;

use App\DAO\UsuarioDAO;
use Exception;

final class Usuario extends Model
{
    public ?int $Id = null;
    private ?string $_nome = null;
    private ?string $_email = null;
    private ?string $_senha = null;

    // ======== Nome ========
    public function setNome(?string $value): void
    {
        if (!empty($value) && strlen($value) < 3)
            throw new Exception("O nome deve ter no mínimo 3 caracteres.");
        
        $this->_nome = $value;
    }

    public function getNome(): ?string
    {
        return $this->_nome;
    }

    public function __set($name, $value)
    {
        if ($name === 'Nome') {
            $this->setNome($value);
        } elseif ($name === 'Email') {
            $this->setEmail($value);
        } elseif ($name === 'Senha') {
            $this->setSenha($value);
        } else {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if ($name === 'Nome') {
            return $this->getNome();
        } elseif ($name === 'Email') {
            return $this->getEmail();
        } elseif ($name === 'Senha') {
            return $this->getSenha();
        }
        return null;
    }

    // ======== Email ========
    public function setEmail(?string $value): void
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new Exception("Email inválido.");
        
        $this->_email = $value;
    }

    public function getEmail(): ?string
    {
        return $this->_email;
    }

    // ======== Senha ========
    public function setSenha(?string $value): void
    {
        if (empty($value)) {
            $this->_senha = null;
            return;
        }
        
        if (strlen($value) < 3)
            throw new Exception("A senha deve ter no mínimo 3 caracteres.");

        $this->_senha = $value;
    }

    public function getSenha(): ?string
    {
        return $this->_senha;
    }

    // ======== Métodos CRUD ========

    function save(): Usuario
    {
        return (new UsuarioDAO())->save($this);
    }

    function getById(int $id): ?Usuario
    {
        return (new UsuarioDAO())->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = (new UsuarioDAO())->select();
        return $this->rows;
    }

    function delete(int $id): bool
    {
        return (new UsuarioDAO())->delete($id);
    }
}