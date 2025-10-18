<?php

namespace App\Model;

use App\DAO\PacienteDAO;
use Exception;

final class Paciente extends Model
{
    public ?int $Id = null;
    public ?string $Nome = null;
    public ?string $Cpf = null;
    public ?string $Telefone = null;
    public ?string $Endereco = null;
    public ?string $Data_Nascimento = null;

    public function validate(): void
    {
        if (strlen($this->Nome) < 3)
            throw new Exception("O nome deve ter no mínimo 3 caracteres.");
    }

    public function save(): Paciente
    {
        $this->validate();
        return (new PacienteDAO())->save($this);
    }

    public function getById(int $id): ?Paciente
    {
        return (new PacienteDAO())->selectById($id);
    }

    public function getAllRows(): array
    {
        $this->rows = (new PacienteDAO())->select();
        return $this->rows;
    }

    public function delete(int $id): bool
    {
        return (new PacienteDAO())->delete($id);
    }
}
