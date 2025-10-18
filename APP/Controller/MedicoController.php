<?php

namespace App\Controller;

use App\Model\Medico;
use Exception;

final class MedicoController extends Controller
{
    public static function index(): void
    {
        parent::isProtected();

        $model = new Medico();

        try {
            $model->getAllRows();
        } catch (Exception $e) {
            $model->setError("Erro ao buscar médicos: " . $e->getMessage());
        }

        parent::render('Medico/lista_medico.php', $model);
    }

    public static function cadastro(): void
    {
        parent::isProtected();

        $model = new Medico();

        try {
            if (parent::isPost()) {
                $model->Id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
                $model->Nome = $_POST['nome'];
                $model->CRM = $_POST['crm'];
                $model->Especialidade = $_POST['especialidade'];
                $model->Telefone = $_POST['telefone'];
                $model->Email = $_POST['email'];

                $model->save();
                parent::redirect("/medico");
            } else {
                if (isset($_GET['id'])) {
                    $model = $model->getById((int) $_GET['id']);
                }
            }
        } catch (Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Medico/form_medico.php', $model);
    }

    public static function delete(): void
    {
        parent::isProtected();

        $model = new Medico();

        try {
            $model->delete((int) $_GET['id']);
            parent::redirect("/medico");
        } catch (Exception $e) {
            $model->setError("Erro ao excluir médico: " . $e->getMessage());
        }

        parent::render('Medico/lista_medico.php', $model);
    }
}
