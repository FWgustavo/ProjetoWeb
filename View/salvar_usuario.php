<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmarSenha'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    // Validação simples
    if ($senha !== $confirmarSenha) {
        echo "<script>alert('As senhas não conferem!');history.back();</script>";
        exit;
    }

    // Salvar em arquivo (substitua por banco de dados se quiser)
    $linha = "$nome|$email|$senha|$nascimento|$genero|$telefone\n";
    file_put_contents('usuarios.txt', $linha, FILE_APPEND);

    // Redireciona para a lista de usuários
    header('Location: lista_login.php');
    exit;
} else {
    header('Location: cadastro_usuario.php');
    exit;
}