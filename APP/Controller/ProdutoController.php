<?php

namespace App\Controller;

use App\Model\Produto;
use Exception;

final class ProdutoController extends Controller
{
    public static function index() : void
    {
        parent::isProtected();

        $model = new Produto();

        try {
            $model->getAllRows();
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os produtos:");
            $model->setError($e->getMessage());
        }

        parent::render('Produto/lista_produto.php', $model);
    }

    public static function cadastro() : void
    {
        parent::isProtected();

        $model = new Produto();

        try {
            if(parent::isPost()) {
                $model->Id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
                $model->Nome = $_POST['nome'] ?? '';
                $model->Valor = $_POST['valor'] ?? 0;
                $model->Quantidade = $_POST['quantidade'] ?? 0;
                $model->QuantidadeMin = $_POST['quantidadeMin'] ?? 0;
                
                $model->save();

                parent::redirect("/produto");
                exit;
            } else {
                if(isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = (int)$_GET['id'];
                    $modelBuscado = $model->getById($id);
                    
                    if($modelBuscado !== null) {
                        $model = $modelBuscado;
                    } else {
                        $model->setError("Produto não encontrado!");
                    }
                }
            }
        } catch(Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Produto/form_produto.php', $model);
    }

    public static function delete() : void
    {
        parent::isProtected();

        $model = new Produto();

        try {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = (int)$_GET['id'];
                $model->delete($id);
                parent::redirect("/produto");
                exit;
            } else {
                $model->setError("ID não fornecido para exclusão!");
            }
        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o produto:");
            $model->setError($e->getMessage());
            
            try {
                $model->getAllRows();
            } catch(Exception $e2) {
                $model->setError("Erro ao buscar lista: " . $e2->getMessage());
            }
        }

        parent::render('Produto/lista_produto.php', $model);
    }
}