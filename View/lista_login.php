<?php
$usuarios = [];
$arquivo = 'usuarios.txt';
if (file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        list($nome, $email, $senha, $nascimento, $genero, $telefone) = explode('|', $linha);
        $usuarios[] = [
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="lista_login.css">
</head>
<body>
    <div class="rain" id="rain"></div>
    <div class="login-panel" style="max-width:700px;">
        <div class="login-header">
            <div class="icon">
                <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                    <path d="M19 17a3 3 0 0 1-6 0v-2" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 3v7a5 5 0 0 0 10 0V3" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="19" cy="17" r="3" stroke="#fff" stroke-width="2"/>
                </svg>
            </div>
            Lista de Usuários
        </div>
        <div class="login-body">
            <table class="user-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($usuarios) > 0): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= htmlspecialchars($usuario['telefone']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align:center;">Nenhum usuário cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="login-footer">
            &copy; 2025 Clínica Médica
        </div>
    </div>

    <script>
      // Chuva animada suave
      function createRainDrops(qtd) {
        const rain = document.getElementById('rain');
        for (let i = 0; i < qtd; i++) {
          const drop = document.createElement('div');
          drop.className = 'drop';
          drop.style.left = Math.random() * 100 + 'vw';
          drop.style.animationDelay = (Math.random() * 2.5) + 's';
          drop.style.animationDuration = (2 + Math.random() * 2.5) + 's';
          rain.appendChild(drop);
        }
      }
      createRainDrops(60);
    </script>
</body>
</html>
