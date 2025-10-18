<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistemas Clinica - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(120deg, #337ab7, #5bc0de, #337ab7, #5bc0de);
            background-size: 400% 400%;
            animation: gradientMoveSoft 16s ease-in-out infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: auto;
        }

        @keyframes gradientMoveSoft {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .rain {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .drop {
            position: absolute;
            width: 2px;
            height: 18px;
            background: linear-gradient(180deg, #fff 0%, #5bc0de 100%);
            opacity: 0.18;
            border-radius: 1px;
            animation: rainDropSoft 2.5s linear infinite;
        }

        @keyframes rainDropSoft {
            0% { transform: translateY(-30px) scaleY(0.7); opacity: 0.05;}
            10% { opacity: 0.18;}
            90% { opacity: 0.18;}
            100% { transform: translateY(100vh) scaleY(1.1); opacity: 0;}
        }

        .login-panel {
            box-shadow: 0 8px 32px rgba(51,122,183,0.18), 0 1.5px 8px #5bc0de33;
            border-radius: 32px;
            background: rgba(255,255,255,0.97);
            max-width: 420px;
            width: 100%;
            z-index: 1;
            backdrop-filter: blur(2px);
            padding: 0;
        }

        .login-header {
            background: linear-gradient(90deg, #337ab7 60%, #5bc0de 100%);
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            border-top-left-radius: 32px;
            border-top-right-radius: 32px;
            padding: 44px 0 28px 0;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px #337ab733;
        }

        .login-body {
            padding: 38px 34px 28px 34px;
        }

        .login-body label {
            color: #337ab7;
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 6px;
            display: block;
        }

        .login-body input[type="text"],
        .login-body input[type="email"],
        .login-body input[type="password"] {
            border-radius: 12px;
            border: 1.5px solid #bcdffb;
            font-size: 16px;
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 18px;
            background: #f7fbff;
            box-shadow: 0 1px 4px #337ab71a;
            transition: box-shadow 0.2s, border-color 0.2s;
        }

        .login-body input:focus {
            border-color: #5bc0de;
            box-shadow: 0 0 12px #5bc0de99;
            background: #fff;
            outline: none;
        }

        .login-body button {
            width: 100%;
            background: linear-gradient(90deg, #337ab7 70%, #5bc0de 100%);
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            padding: 12px 0;
            box-shadow: 0 2px 8px #337ab733;
            color: #fff;
            cursor: pointer;
        }

        .login-body button:hover {
            background: linear-gradient(90deg, #286090 70%, #31b0d5 100%);
        }

        .login-footer {
            text-align: center;
            color: #337ab7;
            font-size: 14px;
            margin-top: 18px;
            margin-bottom: 8px;
        }

        .btn-cadastro {
            display:inline-block;
            padding:10px 28px;
            background:#337ab7;
            color:#fff;
            font-weight:600;
            border-radius:24px;
            text-decoration:none;
            box-shadow:0 2px 8px #337ab733;
            transition:background 0.2s;
            margin-top: 12px;
            font-size: 16px;
        }

        .btn-cadastro:hover {
            background: #286090;
        }

        @media (max-width: 600px) {
            .login-panel { border-radius: 16px; }
            .login-header { font-size: 22px; padding: 22px 0 14px 0; }
            .login-body { padding: 20px 10px 18px 10px; }
        }
    </style>
</head>

<body>
    <div class="rain" id="rain"></div>

    <div class="login-panel">
        <div class="login-header">
            Clinica
        </div>

        <div class="login-body">
            <form method="post" action="/login" autocomplete="off">
                <?= $erro ?>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= $model->Email ?>" placeholder="Digite seu e-mail" required autofocus>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="lembrar" name="lembrar">
                    <label class="form-check-label" for="lembrar">Lembrar meu usuário</label>
                </div>

                <button type="submit">Entrar</button>
            </form>

            <div style="text-align: center;">
                <a href="/usuario/cadastro" class="btn-cadastro">Não tem cadastro? Cadastre-se</a>
            </div>
        </div>

        <div class="login-footer">
            &copy; 2025 Marcio's Company
        </div>
    </div>

    <script>
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
