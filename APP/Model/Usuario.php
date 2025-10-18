<?php

namespace App\Model;

use App\DAO\UsuarioDAO;
use Exception;

final class Usuario extends Model
{
    public ?int $Id = null;

    // ======== Nome ========
    public ?string $Nome
    {
        set
        {
            if (strlen($value) < 3)
                throw new Exception("O nome deve ter no mínimo 3 caracteres.");

            $this->Nome = $value;
        }

        get => $this->Nome ?? null;
    }

    // ======== Email ========
    public ?string $Email
    {
        set
        {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                throw new Exception("Email inválido.");

            $this->Email = $value;
        }

        get => $this->Email ?? null;
    }

    // ======== Senha ========
    public ?string $Senha
    {
        set
        {
            if (strlen($value) < 4)
                throw new Exception("A senha deve ter no mínimo 4 caracteres.");

            $this->Senha = password_hash($value, PASSWORD_DEFAULT);
        }

        get => $this->Senha ?? null;
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
