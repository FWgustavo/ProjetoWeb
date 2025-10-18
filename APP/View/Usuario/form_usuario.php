<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica - Cadastro de Usuário</title>
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

        .content-area {
            padding: 30px;
            max-width: 900px;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #2d3748;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 14px 32px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #4a5568;
        }

        .btn-secondary:hover {
            background: #cbd5e0;
        }

        .error-messages {
            background: #fed7d7;
            color: #c53030;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #c53030;
        }

        .info-box {
            background: #bee3f8;
            color: #2c5282;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #3182ce;
        }

        .password-hint {
            font-size: 13px;
            color: #718096;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php include VIEWS . '/Includes/menu.php' ?>

    <div class="main-content">
        <div class="top-bar">
            <h1>Cadastro de Usuário</h1>
        </div>

        <div class="content-area">
            <div class="form-container">
                <div class="form-header">
                    <h2><?= isset($model->Id) && $model->Id ? 'Editar Usuário' : 'Novo Usuário' ?></h2>
                </div>

                <?php if(!empty($model->getErrors())): ?>
                    <div class="error-messages">
                        <?= $model->getErrors() ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($model->Id) && $model->Id): ?>
                    <div class="info-box">
                        💡 <strong>Dica:</strong> Deixe o campo senha em branco se não desejar alterá-la.
                    </div>
                <?php endif; ?>

                <form method="post" action="/usuario/cadastro">
                    <input type="hidden" name="id" value="<?= $model->Id ?? '' ?>">

                    <div class="form-group">
                        <label for="nome">Nome Completo: *</label>
                        <input 
                            type="text" 
                            name="nome" 
                            id="nome" 
                            value="<?= htmlspecialchars($model->Nome ?? '') ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email: *</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="<?= htmlspecialchars($model->Email ?? '') ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha: <?= isset($model->Id) && $model->Id ? '' : '*' ?></label>
                        <input 
                            type="password" 
                            name="senha" 
                            id="senha"
                            <?= isset($model->Id) && $model->Id ? '' : 'required' ?>
                        >
                        <div class="password-hint">
                            <?php if(isset($model->Id) && $model->Id): ?>
                                Deixe em branco para manter a senha atual
                            <?php else: ?>
                                Mínimo de 3 caracteres
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">💾 Salvar</button>
                        <a href="/usuario" class="btn btn-secondary">❌ Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>