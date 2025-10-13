<?php
session_start();
require_once __DIR__ . '/controller/UsuarioController.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $usuario = $controller->login($_POST['email'], $_POST['senha']);
    if ($usuario) {
        $_SESSION['usuario'] = $usuario->nome;
        header('Location: index.php');
        exit;
    } else {
        $erro = 'E-mail ou senha incorretos!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="E-mail" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Entrar</button>
</form>
<?php if ($erro) echo "<p>$erro</p>"; ?>
</body>
</html>
