<?php

namespace App\Model;

use App\DAO\ServicoDAO;
use Exception;

final class Servico extends Model
{
    public ?int $Id = null;
    private ?string $_nome = null;
    private ?string $_descricao = null;
    private ?float $_valor = 0.0;

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

    public function setDescricao(?string $value): void
    {
        $this->_descricao = $value;
    }

    public function getDescricao(): ?string
    {
        return $this->_descricao;
    }

    public function setValor($value): void
    {
        $valor = floatval($value);
        if ($valor < 0)
            throw new Exception("Valor não pode ser negativo.");
        
        $this->_valor = $valor;
    }

    public function getValor(): ?float
    {
        return $this->_valor ?? 0.0;
    }

    function save(): Servico
    {
        return new ServicoDAO()->save($this);
    }

    function getById(int $id): ?Servico
    {
        return new ServicoDAO()->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = new ServicoDAO()->select();
        return $this->rows;
    }

    function delete(int $id): bool
    {
        return new ServicoDAO()->delete($id);
    }
}