<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Serviços</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { font-family: 'Montserrat', Arial, sans-serif; margin:0; background:#ecf0f1; display:flex; min-height:100vh; }
.content { margin-left:60px; padding:40px; width:100%; transition:margin-left 0.3s; }
.sidebar.expanded ~ .content {margin-left:180px;}
.panel { background:white; padding:30px; border-radius:16px; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
.panel h1 { font-size:28px; color:#2c3e50; margin-bottom:20px; text-align:center; }
.btn-main { background:#2980b9; border:none; color:white; font-weight:600; border-radius:8px; padding:6px 12px; margin:2px; cursor:pointer; text-decoration:none; }
.btn-main:hover {background:#1c5980;}
table { width:100%; border-collapse:collapse; }
th { background:#2980b9; color:white; padding:8px; text-align:left; }
td { padding:8px; color:#2c3e50; }
tr:nth-child(even) { background:#f2f2f2; }
</style>
</head>
<body>
<?php include VIEWS . '/Includes/menu.php'; ?>
<div class="content">
    <div class="panel">
        <h1>Lista de Serviços</h1>
        <?= $model->getErrors() ?>
        <a href="/servico/cadastro" class="btn-main">Novo Serviço</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model->rows as $servico): ?>
                <tr>
                    <td><?= $servico->Id ?></td>
                    <td><a href="/servico/cadastro?id=<?= $servico->Id ?>"><?= $servico->Nome ?></a></td>
                    <td><?= $servico->Descricao ?></td>
                    <td><?= number_format($servico->Valor, 2, ',', '.') ?></td>
                    <td>
                        <a href="/servico/delete?id=<?= $servico->Id ?>" class="btn-main">Remover</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
