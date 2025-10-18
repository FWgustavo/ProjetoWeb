<?php

namespace App\Model;

use App\DAO\PacienteDAO;
use Exception;

final class Paciente extends Model
{
    public ?int $Id = null;
    private ?string $_nome = null;
    private ?string $_cpf = null;
    private ?string $_telefone = null;
    private ?string $_endereco = null;
    private ?string $_data_nascimento = null;

    public function __set($name, $value)
    {
        $setter = 'set' . str_replace('_', '', $name);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        $getter = 'get' . str_replace('_', '', $name);
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

    public function setCPF(?string $value): void
    {
        if (!empty($value) && strlen($value) < 11)
            throw new Exception("CPF deve ter 11 caracteres.");
        
        $this->_cpf = $value;
    }

    public function getCPF(): ?string
    {
        return $this->_cpf;
    }

    public function setTelefone(?string $value): void
    {
        $this->_telefone = $value;
    }

    public function getTelefone(): ?string
    {
        return $this->_telefone;
    }

    public function setEndereco(?string $value): void
    {
        $this->_endereco = $value;
    }

    public function getEndereco(): ?string
    {
        return $this->_endereco;
    }

    public function setDataNascimento(?string $value): void
    {
        $this->_data_nascimento = $value;
    }

    public function getDataNascimento(): ?string
    {
        return $this->_data_nascimento;
    }

    function save(): Paciente
    {
        return new PacienteDAO()->save($this);
    }

    function getById(int $id): ?Paciente
    {
        return new PacienteDAO()->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = new PacienteDAO()->select();
        return $this->rows;
    }

    function delete(int $id): bool
    {
        return new PacienteDAO()->delete($id);
    }
}