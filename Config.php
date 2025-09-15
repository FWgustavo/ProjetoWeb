<?php
define('BASE_DIR', dirname(__FILE__, 2));

define('Views', BASE_DIR . '/App/View/');

$_ENV['db']['host'] = 'localhost:3306';
$_ENV['db']['user'] = 'root';
$_ENV['db']['pass'] = 'etecjau';
$_ENV['db']['name'] = 'Terceirods';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>