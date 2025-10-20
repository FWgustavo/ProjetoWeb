<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
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

        .login-container {
            box-shadow: 0 8px 32px rgba(51,122,183,0.18), 0 1.5px 8px #5bc0de33;
            border-radius: 32px;
            border: none;
            background: rgba(255,255,255,0.97);
            animation: fadeInPanelSoft 1.2s cubic-bezier(.68,-0.55,.27,1.55);
            max-width: 420px;
            width: 100%;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(2px);
            padding: 0;
            overflow: hidden;
        }

        @keyframes fadeInPanelSoft {
            from { opacity: 0; transform: scale(0.96) translateY(40px);}
            to { opacity: 1; transform: scale(1) translateY(0);}
        }

        .login-header {
            background: linear-gradient(90deg, #337ab7 60%, #5bc0de 100%);
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            padding: 44px 0 28px 0;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px #337ab733;
            position: relative;
            animation: fadeInTitleSoft 1.2s cubic-bezier(.68,-0.55,.27,1.55);
        }

        .login-header .icon {
            margin-bottom: 8px;
            animation: bounceIconSoft 2s infinite alternate;
        }

        @keyframes bounceIconSoft {
            0% { transform: translateY(0);}
            100% { transform: translateY(-8px);}
        }

        .login-header h1 {
            font-size: 28px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .login-header p {
            font-size: 14px;
            font-weight: 400;
            opacity: 0.95;
        }

        .login-body {
            padding: 38px 34px 28px 34px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            color: #337ab7;
            font-weight: 500;
            font-size: 18px;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: block;
        }

        .form-group input {
            border-radius: 12px;
            border: 1.5px solid #bcdffb;
            font-size: 17px;
            width: 100%;
            padding: 12px 14px;
            background: #f7fbff;
            box-shadow: 0 1px 4px #337ab71a;
            transition: box-shadow 0.2s, border-color 0.2s;
        }

        .form-group input:focus {
            border-color: #5bc0de;
            box-shadow: 0 0 12px #5bc0de99;
            background: #fff;
            outline: none;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
            accent-color: #337ab7;
        }

        .checkbox-group label {
            color: #337ab7;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(90deg, #337ab7 70%, #5bc0de 100%);
            border: none;
            border-radius: 12px;
            font-size: 20px;
            font-weight: 600;
            padding: 16px 0;
            box-shadow: 0 2px 8px #337ab733;
            transition: background 0.2s, transform 0.2s;
            letter-spacing: 0.5px;
            color: #fff;
            margin-bottom: 10px;
            cursor: pointer;
            animation: fadeInBtnSoft 1.4s cubic-bezier(.68,-0.55,.27,1.55);
        }

        @keyframes fadeInBtnSoft {
            from { opacity: 0; transform: scale(0.96);}
            to { opacity: 1; transform: scale(1);}
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #286090 70%, #31b0d5 100%);
            transform: scale(1.04);
        }

        .error-message {
            background: #fed7d7;
            color: #c53030;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #c53030;
        }

        .copyright {
            text-align: center;
            padding: 20px;
            color: #337ab7;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .login-container {
                padding: 0;
                border-radius: 16px;
            }
            .login-header {
                font-size: 22px;
                padding: 22px 0 14px 0;
            }
            .login-body {
                padding: 20px 10px 18px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="rain" id="rain"></div>
    
    <div class="login-container">
        <div class="login-header">
            <div class="icon">
                <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                    <path d="M19 17a3 3 0 0 1-6 0v-2" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 3v7a5 5 0 0 0 10 0V3" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="19" cy="17" r="3" stroke="#fff" stroke-width="2"/>
                </svg>
            </div>
            <h1>Clínica</h1>
            <p>Sistema de Gerenciamento</p>
        </div>

        <div class="login-body">
            <!-- Exemplo de mensagem de erro - remova os comentários para testar -->
            <!-- <div class="error-message">
                E-mail ou senha inválidos
            </div> -->

            <form method="post" action="/login">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Digite seu e-mail"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input 
                        type="password" 
                        name="senha" 
                        id="senha" 
                        placeholder="Digite sua senha"
                        required
                    >
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="lembrar" id="lembrar">
                    <label for="lembrar">Lembrar meu usuário</label>
                </div>

                <button type="submit" class="btn-login">Entrar</button>
            </form>
        </div>

        <div class="copyright">
            © 2025 Marcio's Company
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