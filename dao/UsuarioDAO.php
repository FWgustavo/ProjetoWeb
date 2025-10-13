<?php
require_once __DIR__ . '/../core/Conexao.php';
require_once __DIR__ . '/../model/Usuario.php';

class UsuarioDAO {
    private $con;

    public function __construct() {
        $this->con = Conexao::getInstance();
    }

    public function cadastrar(Usuario $usuario) {
        $sql = "INSERT INTO Usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':nome', $usuario->nome);
        $stmt->bindValue(':email', $usuario->email);
        $stmt->bindValue(':senha', password_hash($usuario->senha, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function login($email, $senha) {
        $sql = "SELECT * FROM Usuario WHERE email = :email";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($senha, $user['senha'])) {
            $usuario = new Usuario();
            $usuario->id = $user['id'];
            $usuario->nome = $user['nome'];
            $usuario->email = $user['email'];
            return $usuario;
        }
        return null;
    }
}
?>