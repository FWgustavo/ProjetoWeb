<?php

use App\Controller\{
    InicialController,
    LoginController,
    UsuarioController,
    MedicoController,
    PacienteController,
    ProdutoController,
    ServicoController
};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/':
        InicialController::index();
    break;

    /**
     * Rotas para Login
     */
    case '/login':
        LoginController::index();
    break;

    case '/logout':
        LoginController::logout();
    break;

    /**
     * Rotas para Usuários
     */
    case '/usuario':
        UsuarioController::index();
    break;

    case '/usuario/cadastro':
        UsuarioController::cadastro();
    break;

    case '/usuario/delete':
        UsuarioController::delete();
    break;

    /**
     * Rotas para Médicos
     */
    case '/medico':
        MedicoController::index();
    break;

    case '/medico/cadastro':
        MedicoController::cadastro();
    break;

    case '/medico/delete':
        MedicoController::delete();
    break;

    /**
     * Rotas para Pacientes
     */
    case '/paciente':
        PacienteController::index();
    break;

    case '/paciente/cadastro':
        PacienteController::cadastro();
    break;

    case '/paciente/delete':
        PacienteController::delete();
    break;

    /**
     * Rotas para Produtos
     */
    case '/produto':
        ProdutoController::index();
    break;

    case '/produto/cadastro':
        ProdutoController::cadastro();
    break;

    case '/produto/delete':
        ProdutoController::delete();
    break;

    /**
     * Rotas para Serviços
     */
    case '/servico':
        ServicoController::index();
    break;

    case '/servico/cadastro':
        ServicoController::cadastro();
    break;

    case '/servico/delete':
        ServicoController::delete();
    break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "Página não encontrada";
    break;
}