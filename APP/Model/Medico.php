<?php

namespace App\Model;

use App\DAO\MedicoDAO;
use Exception;

final class Medico extends Model
{
    public ?int $Id = null;
    public ?string $Nome = null;
    public ?string $CRM = null;
    public ?string $Especialidade = null;
    public ?string $Telefone = null;
    public ?string $Email = null;

    public function validate(): void
    {
        if (strlen($this->Nome) < 3)
            throw new Exception("O nome deve ter no mínimo 3 caracteres.");

        if (strlen($this->CRM) < 3)
            throw new Exception("O CRM deve ter no mínimo 3 caracteres.");

        if (strlen($this->Especialidade) < 3)
            throw new Exception("A especialidade deve ter no mínimo 3 caracteres.");

        if (strlen($this->Telefone) < 3)
            throw new Exception("O telefone deve ter no mínimo 3 caracteres.");
    }

    public function save(): Medico
    {
        $this->validate();
        return (new MedicoDAO())->save($this);
    }

    public function getById(int $id): ?Medico
    {
        return (new MedicoDAO())->selectById($id);
    }

    public function getAllRows(): array
    {
        $this->rows = (new MedicoDAO())->select();
        return $this->rows;
    }

    public function delete(int $id): bool
    {
        return (new MedicoDAO())->delete($id);
    }
}
