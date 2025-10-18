<?php

namespace App\Model;

use App\DAO\ProdutoDAO;
use Exception;

final class Produto extends Model
{
    public ?int $Id = null;
    public ?string $Nome = null;
    public ?float $Valor = null;
    public ?int $Quantidade = 0;
    public ?int $QuantidadeMin = 0;

    public function validate(): void
    {
        if (strlen($this->Nome) < 2)
            throw new Exception("O nome do produto deve ter no mínimo 2 caracteres.");
    }

    public function save(): Produto
    {
        $this->validate();
        return (new ProdutoDAO())->save($this);
    }

    public function getById(int $id): ?Produto
    {
        return (new ProdutoDAO())->selectById($id);
    }

    public function getAllRows(): array
    {
        $this->rows = (new ProdutoDAO())->select();
        return $this->rows;
    }

    public function delete(int $id): bool
    {
        return (new ProdutoDAO())->delete($id);
    }
}
