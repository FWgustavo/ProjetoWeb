<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Paciente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { font-family: 'Montserrat', Arial, sans-serif; margin:0; background:#ecf0f1; display:flex; min-height:100vh; }
.content { margin-left:60px; padding:40px; width:100%; transition:margin-left 0.3s; }
.sidebar.expanded ~ .content {margin-left:180px;}
.panel { background:white; padding:30px; border-radius:16px; box-shadow:0 4px 12px rgba(0,0,0,0.1); max-width:700px; margin:auto; }
.panel h1 { font-size:28px; color:#2c3e50; margin-bottom:20px; text-align:center; }
.btn-main { background:#2980b9; border:none; color:white; font-weight:600; border-radius:8px; padding:10px 20px; margin-top:10px; cursor:pointer; width:100%; }
.btn-main:hover {background:#1c5980;}
</style>
</head>
<body>
<?php include VIEWS . '/Includes/menu.php'; ?>
<div class="content">
    <div class="panel">
        <h1>Cadastro de Paciente</h1>
        <form action="/paciente/cadastro" method="post">
            <input type="hidden" name="id" value="<?= $model->id ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?= $model->nome ?>" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf" id="cpf" value="<?= $model->cpf ?>">
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="telefone" value="<?= $model->telefone ?>">
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="endereco" value="<?= $model->endereco ?>">
            </div>
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="<?= $model->data_nascimento ?>">
            </div>
            <button type="submit" class="btn-main">Salvar</button>
        </form>
    </div>
</div>
</body>
</html>
