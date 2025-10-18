<?php

namespace App\Model;

use App\DAO\ServicoDAO;
use Exception;

final class Servico extends Model
{
    public ?int $Id = null;
    public ?string $Nome = null;
    public ?string $Descricao = null;
    public ?float $Valor = null;

    public function validate(): void
    {
        if (strlen($this->Nome) < 2)
            throw new Exception("O nome do serviço deve ter no mínimo 2 caracteres.");
    }

    public function save(): Servico
    {
        $this->validate();
        return (new ServicoDAO())->save($this);
    }

    public function getById(int $id): ?Servico
    {
        return (new ServicoDAO())->selectById($id);
    }

    public function getAllRows(): array
    {
        $this->rows = (new ServicoDAO())->select();
        return $this->rows;
    }

    public function delete(int $id): bool
    {
        return (new ServicoDAO())->delete($id);
    }
}
