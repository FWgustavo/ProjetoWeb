<?php
namespace App\DAO;
use PDO;

abstract class DAO
{
    protected static $conexao = null;

    public function __construct()
    {
        if (self::$conexao == null) {
            $dsn = "mysql:host=" . $_ENV['db']['host'] . ";dbname=" . $_ENV['db']['database'] . ";charset=utf8mb4";
            
            try {
                self::$conexao = new PDO(
                    $dsn,
                    $_ENV['db']['user'],
                    $_ENV['db']['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_PERSISTENT => false,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
                    ]
                );
            } catch (\PDOException $e) {
                throw new \Exception("Erro de conexão com o banco: " . $e->getMessage());
            }
        }
    }
    
    // Método público para acessar a conexão (para testes)
    public static function getConexao() : ?PDO
    {
        return self::$conexao;
    }
}