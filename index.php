<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Início</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>

<nav>
    <a href="cadastro_usuario.php">Cadastrar Usuário</a> |
    <a href="cadastro_paciente.php">Cadastrar Paciente</a> |
    <a href="cadastro_medico.php">Cadastrar Médico</a> |
    <a href="cadastro_produto.php">Cadastrar Produto</a> |
    <a href="cadastro_servico.php">Cadastrar Serviço</a> |
    <a href="logout.php">Sair</a>
</nav>
</body>
</html>
