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
                $model->Id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
                $model->Nome = $_POST['nome'] ?? '';
                $model->CPF = $_POST['cpf'] ?? '';
                $model->Telefone = $_POST['telefone'] ?? '';
                $model->Endereco = $_POST['endereco'] ?? '';
                $model->Data_Nascimento = $_POST['data_nascimento'] ?? '';
                
                $model->save();

                parent::redirect("/paciente");
                exit;
            } else {
                if(isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    $modelBuscado = $model->getById($id);
                    
                    if($modelBuscado !== null) {
                        $model = $modelBuscado;
                    } else {
                        $model->setError("Paciente não encontrado!");
                    }
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
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int)$_GET['id'];
                $model->delete($id);
                parent::redirect("/paciente");
                exit;
            } else {
                $model->setError("ID não fornecido para exclusão!");
            }
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o paciente:");
            $model->setError($e->getMessage());
            
            try {
                $model->getAllRows();
            } catch(Exception $e2) {
                $model->setError("Erro ao buscar lista: " . $e2->getMessage());
            }
        }

        parent::render('Paciente/lista_paciente.php', $model);
    }
}