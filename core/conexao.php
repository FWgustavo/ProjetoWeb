<?php
require_once __DIR__ . '/../config.php';

class Conexao {
    private static $instance = null;

    public static function getInstance() {
        if (!self::$instance) {
            try {
                self::$instance = new PDO(
                    "mysql:host=".DB_HOST.";dbname=".DB_NAME,
                    DB_USER,
                    DB_PASS,
                    [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: ".$e->getMessage());
            }
        }
        return self::$instance;
    }
}
