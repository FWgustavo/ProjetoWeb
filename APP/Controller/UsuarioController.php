<?php
namespace App\Controller;

use App\Model\UsuarioModel;
use Exception;

class UsuarioController extends Controller
{
    public static function index(): void
    {
        parent::isProtected();

        $model = new UsuarioModel();
        try {
            $model->getAllRows();
        } catch (Exception $e) {
            $model->setError("Erro ao buscar usuários: " . $e->getMessage());
        }

        parent::render('Usuario/lista_usuario.php', $model);
    }

    public static function cadastro(): void
    {
        parent::isProtected();

        $model = new UsuarioModel();
        try {
            if (parent::isPost()) {
                $model->Id = $_POST['id'] ?? null;
                $model->Nome = $_POST['nome'];
                $model->Email = $_POST['email'];
                $model->Senha = $_POST['senha'];

                $model->save();
                parent::redirect("/usuario");
            } else if (isset($_GET['id'])) {
                $model = $model->getById((int)$_GET['id']);
            }
        } catch (Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Usuario/form_usuario.php', $model);
    }

    public static function delete(): void
    {
        parent::isProtected();
        $model = new UsuarioModel();

        try {
            if (isset($_GET['id'])) {
                $model->delete((int)$_GET['id']);
            }
            parent::redirect("/usuario");
        } catch (Exception $e) {
            $model->setError("Erro ao excluir usuário: " . $e->getMessage());
            parent::render('Usuario/lista_usuario.php', $model);
        }
    }
}
