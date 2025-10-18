<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica - Bem-vindo ao Sistema</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7fafc;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 70px;
            background: linear-gradient(180deg, #2d3748 0%, #1a202c 100%);
            color: white;
            transition: width 0.3s ease;
            position: fixed;
            height: 100vh;
            overflow: hidden;
            z-index: 1000;
        }

        .sidebar:hover {
            width: 250px;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h2 {
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar:hover .sidebar-header h2 {
            opacity: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            color: #e2e8f0;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .menu-item.active {
            background: rgba(102, 126, 234, 0.2);
            border-left: 4px solid #667eea;
        }

        .menu-icon {
            min-width: 30px;
            font-size: 20px;
        }

        .menu-text {
            margin-left: 15px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar:hover .menu-text {
            opacity: 1;
        }

        /* Main Content */
        .main-content {
            margin-left: 70px;
            flex: 1;
            transition: margin-left 0.3s ease;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h1 {
            font-size: 28px;
            color: #2d3748;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .content-area {
            padding: 30px;
        }

        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-section h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .welcome-section p {
            font-size: 18px;
            opacity: 0.9;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .action-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .action-card-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #667eea;
        }

        .action-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2d3748;
        }

        .action-card p {
            color: #718096;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php include VIEWS . '/Includes/menu.php' ?>

    <div class="main-content">
        <div class="top-bar">
            <h1>Bem-vindo ao Sistema Biblioteca</h1>
            <div class="user-info">
                <span>👤 Usuário</span>
            </div>
        </div>

        <div class="content-area">
            <div class="welcome-section">
                <h2>Sistema de Gerenciamento de Clínica</h2>
                <p>Escolha uma opção no menu lateral ou abaixo para começar</p>
            </div>

            <div class="quick-actions">
                <a href="/usuario" class="action-card">
                    <div class="action-card-icon">👥</div>
                    <h3>Gerenciar Usuários</h3>
                    <p>Cadastre e gerencie usuários do sistema</p>
                </a>

                <a href="/medico" class="action-card">
                    <div class="action-card-icon">👨‍⚕️</div>
                    <h3>Gerenciar Médicos</h3>
                    <p>Cadastre médicos e suas especialidades</p>
                </a>

                <a href="/paciente" class="action-card">
                    <div class="action-card-icon">🏥</div>
                    <h3>Gerenciar Pacientes</h3>
                    <p>Cadastre e acompanhe pacientes</p>
                </a>

                <a href="/produto" class="action-card">
                    <div class="action-card-icon">💊</div>
                    <h3>Gerenciar Produtos</h3>
                    <p>Controle estoque de medicamentos</p>
                </a>

                <a href="/servico" class="action-card">
                    <div class="action-card-icon">🩺</div>
                    <h3>Gerenciar Serviços</h3>
                    <p>Cadastre serviços oferecidos</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>