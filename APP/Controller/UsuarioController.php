<?php

namespace App\Controller;

use App\Model\Usuario;
use Exception;

final class UsuarioController extends Controller
{
    public static function index() : void
    {
        parent::isProtected();

        $model = new Usuario();

        try {
            $model->getAllRows();
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os usuários:");
            $model->setError($e->getMessage());
        }

        parent::render('Usuario/lista_usuario.php', $model);
    }

    public static function cadastro() : void
    {
        parent::isProtected();

        $model = new Usuario();

        try {
            if(parent::isPost()) {
                $model->Id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
                $model->Nome = $_POST['nome'] ?? '';
                $model->Email = $_POST['email'] ?? '';
                
                // Só atribui senha se não estiver vazia
                $senha = $_POST['senha'] ?? '';
                if(!empty($senha)) {
                    $model->Senha = $senha;
                } elseif($model->Id === null) {
                    // Se for novo usuário, senha é obrigatória
                    throw new Exception("Senha é obrigatória para novos usuários!");
                }
                
                $model->save();

                parent::redirect("/usuario");
                exit;
            } else {
                if(isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    $modelBuscado = $model->getById($id);
                    
                    if($modelBuscado !== null) {
                        $model = $modelBuscado;
                    } else {
                        $model->setError("Usuário não encontrado!");
                    }
                }
            }
        } catch(Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Usuario/form_usuario.php', $model);
    }

    public static function delete() : void
    {
        parent::isProtected();

        $model = new Usuario();

        try {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int)$_GET['id'];
                $model->delete($id);
                parent::redirect("/usuario");
                exit;
            } else {
                $model->setError("ID não fornecido para exclusão!");
            }
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o usuário:");
            $model->setError($e->getMessage());
            
            try {
                $model->getAllRows();
            } catch(Exception $e2) {
                $model->setError("Erro ao buscar lista: " . $e2->getMessage());
            }
        }

        parent::render('Usuario/lista_usuario.php', $model);
    }
}