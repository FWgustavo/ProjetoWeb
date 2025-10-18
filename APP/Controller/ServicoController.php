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
                $model->Id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
                $model->Nome = $_POST['nome'] ?? '';
                $model->Descricao = $_POST['descricao'] ?? '';
                $model->Valor = $_POST['valor'] ?? 0;
                
                $model->save();

                parent::redirect("/servico");
                exit;
            } else {
                if(isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    $modelBuscado = $model->getById($id);
                    
                    if($modelBuscado !== null) {
                        $model = $modelBuscado;
                    } else {
                        $model->setError("Serviço não encontrado!");
                    }
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
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int)$_GET['id'];
                $model->delete($id);
                parent::redirect("/servico");
                exit;
            } else {
                $model->setError("ID não fornecido para exclusão!");
            }
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o serviço:");
            $model->setError($e->getMessage());
            
            try {
                $model->getAllRows();
            } catch(Exception $e2) {
                $model->setError("Erro ao buscar lista: " . $e2->getMessage());
            }
        }

        parent::render('Servico/lista_servico.php', $model);
    }
}