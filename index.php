<?php
include 'Config.php';
include 'autoload.php';
include 'Core/router.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Clínica Médica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="rain" id="rain"></div>
    <div class="login-panel">
        <div class="login-header">
            <div class="icon">
                <!-- Ícone de clínica médica (stethoscope) SVG -->
                <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                    <path d="M19 17a3 3 0 0 1-6 0v-2" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 3v7a5 5 0 0 0 10 0V3" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="19" cy="17" r="3" stroke="#fff" stroke-width="2"/>
                </svg>
            </div>
            Clínica Médica
        </div>
        <div class="login-body">
            <form method="post" action="processa_login.php" autocomplete="off">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required autofocus>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                <div class="forgot">
                    <a href="#">Esqueceu a senha?</a>
                </div>

                <button type="submit">Entrar</button>
            </form>
            <div style="text-align: center;">
                <a href="View/cadastro_usuario.php" class="btn-cadastro">
                    Não tem cadastro? Cadastre-se
                </a>
            </div>
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