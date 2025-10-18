<?php

namespace App\Controller;

use App\Model\Produto;
use Exception;

final class ProdutoController extends Controller
{
    public static function index(): void
    {
        parent::isProtected();

        $model = new Produto();
        try {
            $model->getAllRows();
        } catch (Exception $e) {
            $model->setError("Erro ao buscar produtos: " . $e->getMessage());
        }

        parent::render('Produto/lista_produto.php', $model);
    }

    public static function cadastro(): void
    {
        parent::isProtected();

        $model = new Produto();

        try {
            if (parent::isPost()) {
                $model->Id = $_POST['id'] ?? null;
                $model->Nome = $_POST['nome'];
                $model->Valor = $_POST['valor'];
                $model->Quantidade = $_POST['quantidade'];
                $model->QuantidadeMin = $_POST['quantidadeMin'];

                $model->save();
                parent::redirect("/produto");
            } else {
                if (isset($_GET['id']))
                    $model = $model->getById((int)$_GET['id']);
            }
        } catch (Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Produto/form_produto.php', $model);
    }

    public static function delete(): void
    {
        parent::isProtected();
        $model = new Produto();

        try {
            $model->delete((int)$_GET['id']);
            parent::redirect("/produto");
        } catch (Exception $e) {
            $model->setError("Erro ao excluir produto: " . $e->getMessage());
        }

        parent::render('Produto/lista_produto.php', $model);
    }
}
