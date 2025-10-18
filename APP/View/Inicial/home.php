<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistemas Biblioteca - Tela Inicial</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Montserrat', Arial, sans-serif;
        margin:0;
        background:#ecf0f1;
        display:flex;
        min-height:100vh;
    }

    .content {
        margin-left:60px;
        padding:40px;
        width:100%;
        transition:margin-left 0.3s;
    }
    .sidebar.expanded ~ .content {margin-left:180px;}

    .panel {
        background:white;
        padding:30px;
        border-radius:16px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
        text-align:center;
    }

    .panel h1 {
        font-size:28px;
        color:#2c3e50;
        margin-bottom:20px;
    }

    .btn-main {
        background:#2980b9;
        border:none;
        color:white;
        font-weight:600;
        border-radius:8px;
        padding:10px 20px;
        margin:6px;
        transition:background 0.2s;
        text-decoration:none;
        display:inline-block;
    }
    .btn-main:hover {background:#1c5980;}
</style>
</head>
<body>

<?php include VIEWS . '/Includes/menu.php'; ?>

<div class="content">
    <div class="panel">
        <h1>Bem-vindo ao Sistema Biblioteca</h1>
        <p>Escolha uma opção no menu lateral ou abaixo:</p>
        <a href="/usuario" class="btn-main">Gerenciar Usuários</a>
        <a href="/medico" class="btn-main">Gerenciar Médicos</a>
        <a href="/paciente" class="btn-main">Gerenciar Pacientes</a>
        <a href="/produto" class="btn-main">Gerenciar Produtos</a>
        <a href="/servico" class="btn-main">Gerenciar Serviços</a>
    </div>
</div>

</body>
</html>
