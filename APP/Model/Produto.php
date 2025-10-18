<?php

namespace App\Model;

use App\DAO\ProdutoDAO;
use Exception;

final class Produto extends Model
{
    public ?int $Id = null;

    public ?string $Nome
    {
        set
        {
            if(strlen($value) < 2)
                throw new Exception("Nome deve ter no mínimo 2 caracteres.");

            $this->Nome = $value;
        }

        get => $this->Nome ?? null;
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

    public ?int $Quantidade
    {
        set
        {
            if($value < 0)
                throw new Exception("Quantidade não pode ser negativa.");

            $this->Quantidade = $value;
        }

        get => $this->Quantidade ?? 0;
    }

    public ?int $QuantidadeMin
    {
        set
        {
            if($value < 0)
                throw new Exception("Quantidade mínima não pode ser negativa.");

            $this->QuantidadeMin = $value;
        }

        get => $this->QuantidadeMin ?? 0;
    }

    function save() : Produto
    {
        return new ProdutoDAO()->save($this);
    }

    function getById(int $id) : ?Produto
    {
        return new ProdutoDAO()->selectById($id);
    }

    function getAllRows() : array
    {
        $this->rows = new ProdutoDAO()->select();
        return $this->rows;
    }

    function delete(int $id) : bool
    {
        return new ProdutoDAO()->delete($id);
    }
}