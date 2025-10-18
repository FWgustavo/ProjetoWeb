<?php

namespace App\Model;

use App\DAO\ProdutoDAO;
use Exception;

final class Produto extends Model
{
    public ?int $Id = null;
    private ?string $_nome = null;
    private ?float $_valor = 0.0;
    private ?int $_quantidade = 0;
    private ?int $_quantidadeMin = 0;

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
        if (!empty($value) && strlen($value) < 2)
            throw new Exception("Nome deve ter no mínimo 2 caracteres.");
        
        $this->_nome = $value;
    }

    public function getNome(): ?string
    {
        return $this->_nome;
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

    public function setQuantidade($value): void
    {
        $qtd = intval($value);
        if ($qtd < 0)
            throw new Exception("Quantidade não pode ser negativa.");
        
        $this->_quantidade = $qtd;
    }

    public function getQuantidade(): ?int
    {
        return $this->_quantidade ?? 0;
    }

    public function setQuantidadeMin($value): void
    {
        $qtd = intval($value);
        if ($qtd < 0)
            throw new Exception("Quantidade mínima não pode ser negativa.");
        
        $this->_quantidadeMin = $qtd;
    }

    public function getQuantidadeMin(): ?int
    {
        return $this->_quantidadeMin ?? 0;
    }

    function save(): Produto
    {
        return new ProdutoDAO()->save($this);
    }

    function getById(int $id): ?Produto
    {
        return new ProdutoDAO()->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = new ProdutoDAO()->select();
        return $this->rows;
    }

    function delete(int $id): bool
    {
        return new ProdutoDAO()->delete($id);
    }
}