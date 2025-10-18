<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica - Lista de Serviços</title>
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
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .service-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .service-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .service-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .service-price {
            font-size: 24px;
            font-weight: 700;
            color: #48bb78;
        }

        .service-description {
            color: #718096;
            line-height: 1.6;
            margin-bottom: 20px;
            min-height: 60px;
        }

        .service-actions {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .action-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .action-link:hover {
            color: #764ba2;
        }

        .btn-delete {
            color: #e53e3e;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .btn-delete:hover {
            color: #c53030;
        }

        .error-messages {
            background: #fed7d7;
            color: #c53030;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #c53030;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #718096;
            background: white;
            border-radius: 15px;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .service-icon {
            font-size: 36px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include VIEWS . '/Includes/menu.php' ?>

    <div class="main-content">
        <div class="top-bar">
            <h1>Lista de Serviços</h1>
        </div>

        <div class="content-area">
            <div class="header-actions">
                <h2>Gerenciar Serviços da Clínica</h2>
                <a href="/servico/cadastro" class="btn-primary">➕ Novo Serviço</a>
            </div>

            <?php if(!empty($model->getErrors())): ?>
                <div class="error-messages">
                    <?= $model->getErrors() ?>
                </div>
            <?php endif; ?>

            <?php if(count($model->rows) > 0): ?>
                <div class="services-grid">
                    <?php foreach($model->rows as $servico): ?>
                        <div class="service-card">
                            <div class="service-icon">🩺</div>
                            <div class="service-header">
                                <div>
                                    <div class="service-title">
                                        <?= htmlspecialchars($servico->Nome) ?>
                                    </div>
                                </div>
                                <div class="service-price">
                                    R$ <?= number_format($servico->Valor, 2, ',', '.') ?>
                                </div>
                            </div>
                            
                            <div class="service-description">
                                <?php if(!empty($servico->Descricao)): ?>
                                    <?= htmlspecialchars($servico->Descricao) ?>
                                <?php else: ?>
                                    <em style="color: #cbd5e0;">Sem descrição</em>
                                <?php endif; ?>
                            </div>

                            <div class="service-actions">
                                <a href="/servico/cadastro?id=<?= $servico->Id ?>" class="action-link">
                                    ✏️ Editar
                                </a>
                                <a href="/servico/delete?id=<?= $servico->Id ?>" 
                                   class="btn-delete"
                                   onclick="return confirm('Deseja realmente excluir este serviço?')">
                                    🗑️ Remover
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">🩺</div>
                    <h3>Nenhum serviço cadastrado</h3>
                    <p>Comece adicionando os serviços oferecidos pela clínica</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>