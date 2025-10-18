<?php

namespace App\Controller;

use App\Model\Paciente;
use Exception;

final class PacienteController extends Controller
{
    public static function index() : void
    {
        parent::isProtected();

        $model = new Paciente();

        try {
            $model->getAllRows();
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os pacientes:");
            $model->setError($e->getMessage());
        }

        parent::render('Paciente/lista_paciente.php', $model);
    }

    public static function cadastro() : void
    {
        parent::isProtected();

        $model = new Paciente();

        try {
            if(parent::isPost()) {
                $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                $model->Nome = $_POST['nome'];
                $model->CPF = $_POST['cpf'];
                $model->Telefone = $_POST['telefone'];
                $model->Endereco = $_POST['endereco'];
                $model->Data_Nascimento = $_POST['data_nascimento'];
                $model->save();

                parent::redirect("/paciente");
            } else {
                if(isset($_GET['id'])) {
                    $model = $model->getById((int) $_GET['id']);
                }
            }
        } catch(Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Paciente/form_paciente.php', $model);
    }

    public static function delete() : void
    {
        parent::isProtected();

        $model = new Paciente();

        try {
            $model->delete((int) $_GET['id']);
            parent::redirect("/paciente");
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o paciente:");
            $model->setError($e->getMessage());
        }

        parent::render('Paciente/lista_paciente.php', $model);
    }
}