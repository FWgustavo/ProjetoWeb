<?php

namespace App\Model;

use App\DAO\MedicoDAO;
use Exception;

final class Medico extends Model
{
    public ?int $Id = null;
    private ?string $_nome = null;
    private ?string $_crm = null;
    private ?string $_especialidade = null;
    private ?string $_telefone = null;
    private ?string $_email = null;

    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        return $this->$name ?? null;
    }

    public function setNome(?string $value): void
    {
        if (!empty($value) && strlen($value) < 3)
            throw new Exception("Nome deve ter no mínimo 3 caracteres.");
        
        $this->_nome = $value;
    }

    public function getNome(): ?string
    {
        return $this->_nome;
    }

    public function setCRM(?string $value): void
    {
        if (empty($value))
            throw new Exception("CRM é obrigatório.");
        
        $this->_crm = $value;
    }

    public function getCRM(): ?string
    {
        return $this->_crm;
    }

    public function setEspecialidade(?string $value): void
    {
        $this->_especialidade = $value;
    }

    public function getEspecialidade(): ?string
    {
        return $this->_especialidade;
    }

    public function setTelefone(?string $value): void
    {
        $this->_telefone = $value;
    }

    public function getTelefone(): ?string
    {
        return $this->_telefone;
    }

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

    function save(): Medico
    {
        return new MedicoDAO()->save($this);
    }

    function getById(int $id): ?Medico
    {
        return new MedicoDAO()->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = new MedicoDAO()->select();
        return $this->rows;
    }

    function delete(int $id): bool
    {
        return new MedicoDAO()->delete($id);
    }
}