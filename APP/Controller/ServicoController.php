<?php

namespace App\Controller;

use App\Model\Servico;
use Exception;

final class ServicoController extends Controller
{
    public static function index() : void
    {
        parent::isProtected();

        $model = new Servico();

        try {
            $model->getAllRows();
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os serviços:");
            $model->setError($e->getMessage());
        }

        parent::render('Servico/lista_servico.php', $model);
    }

    public static function cadastro() : void
    {
        parent::isProtected();

        $model = new Servico();

        try {
            if(parent::isPost()) {
                $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                $model->Nome = $_POST['nome'];
                $model->Descricao = $_POST['descricao'];
                $model->Valor = $_POST['valor'];
                $model->save();

                parent::redirect("/servico");
            } else {
                if(isset($_GET['id'])) {
                    $model = $model->getById((int) $_GET['id']);
                }
            }
        } catch(Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Servico/form_servico.php', $model);
    }

    public static function delete() : void
    {
        parent::isProtected();

        $model = new Servico();

        try {
            $model->delete((int) $_GET['id']);
            parent::redirect("/servico");
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o serviço:");
            $model->setError($e->getMessage());
        }

        parent::render('Servico/lista_servico.php', $model);
    }
}