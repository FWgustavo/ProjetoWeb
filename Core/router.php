<?php
use App\Controller\LoginController; 
use App\Controller\CadastrologinController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
   case'/':
    break;

    case'/login':
        LoginController::login();
        break;
    
    case'/logout':
        LoginController::logout();
        break;

    case'/cadastro':
        CadastrologinController::cad_login();
        break;

    default:
    echo "Página não encontrada.";
    break;
}