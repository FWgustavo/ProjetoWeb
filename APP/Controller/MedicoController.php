<?php

namespace App\Controller;

use App\Model\Medico;
use Exception;

final class MedicoController extends Controller
{
    public static function index() : void
    {
        parent::isProtected();

        $model = new Medico();

        try {
            $model->getAllRows();
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os médicos:");
            $model->setError($e->getMessage());
        }

        parent::render('Medico/lista_medico.php', $model);
    }

    public static function cadastro() : void
    {
        parent::isProtected();

        $model = new Medico();

        try {
            if(parent::isPost()) {
                // Capturar dados do POST
                $model->Id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
                $model->Nome = $_POST['nome'] ?? '';
                $model->CRM = $_POST['crm'] ?? '';
                $model->Especialidade = $_POST['especialidade'] ?? '';
                $model->Telefone = $_POST['telefone'] ?? '';
                $model->Email = $_POST['email'] ?? '';
                
                // Salvar
                $model->save();

                // Redirecionar para lista
                parent::redirect("/medico");
                exit; // Importante para garantir que não continua executando
            } else {
                // Se for GET e tiver ID, buscar registro para edição
                if(isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    $modelBuscado = $model->getById($id);
                    
                    if($modelBuscado !== null) {
                        $model = $modelBuscado;
                    } else {
                        $model->setError("Médico não encontrado!");
                    }
                }
            }
        } catch(Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Medico/form_medico.php', $model);
    }

    public static function delete() : void
    {
        parent::isProtected();

        $model = new Medico();

        try {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int)$_GET['id'];
                $model->delete($id);
                parent::redirect("/medico");
                exit;
            } else {
                $model->setError("ID não fornecido para exclusão!");
            }
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o médico:");
            $model->setError($e->getMessage());
            
            // Buscar lista novamente para exibir com erro
            try {
                $model->getAllRows();
            } catch(Exception $e2) {
                $model->setError("Erro ao buscar lista: " . $e2->getMessage());
            }
        }

        parent::render('Medico/lista_medico.php', $model);
    }
}