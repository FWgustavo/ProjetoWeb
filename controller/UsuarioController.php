<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioController {
    private $dao;

    public function __construct() {
        $this->dao = new UsuarioDAO();
    }

    public function cadastrar($nome, $email, $senha) {
        $usuario = new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = $senha;
        return $this->dao->cadastrar($usuario);
    }

    public function login($email, $senha) {
        return $this->dao->login($email, $senha);
    }
}
