<?php

use App\Controller\{
    InicialController,
    LoginController,
    UsuarioController,
    PacienteController,
    MedicoController,
    ProdutoController,
    ServicoController
};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    /**
     * ROTA INICIAL
     */
    case '/':
        InicialController::index();
    break;


    /**
     * ROTAS DE LOGIN
     */
    case '/login':
        LoginController::index();
    break;

    case '/logout':
        LoginController::logout();
    break;

    /**
     * ROTAS DE PACIENTE
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
     * ROTAS DE MÉDICO
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
     * ROTAS DE PRODUTO
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
     * ROTAS DE SERVIÇO
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

    /**
     * ROTAS DE USUÁRIO
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
     * ROTA PADRÃO (404)
     */
    default:
        http_response_code(404);
        echo "<h1>Página não encontrada</h1>";
    break;
}
