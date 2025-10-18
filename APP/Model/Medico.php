<?php

namespace App\Model;

use App\DAO\MedicoDAO;
use Exception;

final class Medico extends Model
{
    public ?int $Id = null;

    public ?string $Nome
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("Nome deve ter no mínimo 3 caracteres.");

            $this->Nome = $value;
        }

        get => $this->Nome ?? null;
    }

    public ?string $CRM
    {
        set
        {
            if(empty($value))
                throw new Exception("CRM é obrigatório.");

            $this->CRM = $value;
        }

        get => $this->CRM ?? null;
    }

    public ?string $Especialidade
    {
        get => $this->Especialidade ?? null;
    }

    public ?string $Telefone
    {
        get => $this->Telefone ?? null;
    }

    public ?string $Email
    {
        set
        {
            if(!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL))
                throw new Exception("Email inválido.");

            $this->Email = $value;
        }

        get => $this->Email ?? null;
    }

    function save() : Medico
    {
        return new MedicoDAO()->save($this);
    }

    function getById(int $id) : ?Medico
    {
        return new MedicoDAO()->selectById($id);
    }

    function getAllRows() : array
    {
        $this->rows = new MedicoDAO()->select();
        return $this->rows;
    }

    function delete(int $id) : bool
    {
        return new MedicoDAO()->delete($id);
    }
}