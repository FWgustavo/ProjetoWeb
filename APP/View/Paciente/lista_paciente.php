<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Pacientes</title>
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
        <h1>Lista de Pacientes</h1>
        <?= $model->getErrors() ?>
        <a href="/paciente/cadastro" class="btn-main">Novo Paciente</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model->rows as $paciente): ?>
                <tr>
                    <td><?= $paciente->Id ?></td>
                    <td><a href="/paciente/cadastro?id=<?= $paciente->Id ?>"><?= $paciente->Nome ?></a></td>
                    <td><?= $paciente->Cpf ?></td>
                    <td><?= $paciente->Telefone ?></td>
                    <td><?= $paciente->Endereco ?></td>
                    <td><?= $paciente->Data_Nascimento ?></td>
                    <td>
                        <a href="/paciente/delete?id=<?= $paciente->Id ?>" class="btn-main">Remover</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
