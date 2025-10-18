<?php

namespace App\Model;

use App\DAO\PacienteDAO;
use Exception;

final class Paciente extends Model
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

    public ?string $CPF
    {
        set
        {
            if(!empty($value) && strlen($value) < 11)
                throw new Exception("CPF deve ter 11 caracteres.");

            $this->CPF = $value;
        }

        get => $this->CPF ?? null;
    }

    public ?string $Telefone
    {
        get => $this->Telefone ?? null;
    }

    public ?string $Endereco
    {
        get => $this->Endereco ?? null;
    }

    public ?string $Data_Nascimento
    {
        get => $this->Data_Nascimento ?? null;
    }

    function save() : Paciente
    {
        return new PacienteDAO()->save($this);
    }

    function getById(int $id) : ?Paciente
    {
        return new PacienteDAO()->selectById($id);
    }

    function getAllRows() : array
    {
        $this->rows = new PacienteDAO()->select();
        return $this->rows;
    }

    function delete(int $id) : bool
    {
        return new PacienteDAO()->delete($id);
    }
}