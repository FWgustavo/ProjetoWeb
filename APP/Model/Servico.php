<?php

namespace App\Model;

use App\DAO\ServicoDAO;
use Exception;

final class Servico extends Model
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

    public ?string $Descricao
    {
        get => $this->Descricao ?? null;
    }

    public ?float $Valor
    {
        set
        {
            if($value < 0)
                throw new Exception("Valor não pode ser negativo.");

            $this->Valor = $value;
        }

        get => $this->Valor ?? 0.0;
    }

    function save() : Servico
    {
        return new ServicoDAO()->save($this);
    }

    function getById(int $id) : ?Servico
    {
        return new ServicoDAO()->selectById($id);
    }

    function getAllRows() : array
    {
        $this->rows = new ServicoDAO()->select();
        return $this->rows;
    }

    function delete(int $id) : bool
    {
        return new ServicoDAO()->delete($id);
    }
}