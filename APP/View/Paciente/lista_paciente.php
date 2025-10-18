<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica - Lista de Pacientes</title>
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

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            color: #4a5568;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: #f7fafc;
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
            margin-left: 15px;
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
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-cpf {
            background: #e6fffa;
            color: #047857;
        }
    </style>
</head>
<body>
    <?php include VIEWS . '/Includes/menu.php' ?>

    <div class="main-content">
        <div class="top-bar">
            <h1>Lista de Pacientes</h1>
        </div>

        <div class="content-area">
            <div class="header-actions">
                <h2>Gerenciar Pacientes</h2>
                <a href="/paciente/cadastro" class="btn-primary">➕ Novo Paciente</a>
            </div>

            <?php if(!empty($model->getErrors())): ?>
                <div class="error-messages">
                    <?= $model->getErrors() ?>
                </div>
            <?php endif; ?>

            <div class="table-container">
                <?php if(count($model->rows) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Data Nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($model->rows as $paciente): ?>
                            <tr>
                                <td><?= $paciente->Id ?></td>
                                <td>
                                    <a href="/paciente/cadastro?id=<?= $paciente->Id ?>" class="action-link">
                                        <?= htmlspecialchars($paciente->Nome) ?>
                                    </a>
                                </td>
                                <td>
                                    <?php if(!empty($paciente->CPF)): ?>
                                        <span class="badge badge-cpf"><?= htmlspecialchars($paciente->CPF) ?></span>
                                    <?php else: ?>
                                        <span style="color: #cbd5e0;">Não informado</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($paciente->Telefone ?? '-') ?></td>
                                <td>
                                    <?php 
                                    if(!empty($paciente->Data_Nascimento)) {
                                        echo date('d/m/Y', strtotime($paciente->Data_Nascimento));
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="/paciente/cadastro?id=<?= $paciente->Id ?>" class="action-link">✏️ Editar</a>
                                    <a href="/paciente/delete?id=<?= $paciente->Id ?>" 
                                       class="btn-delete"
                                       onclick="return confirm('Deseja realmente excluir este paciente?')">
                                        🗑️ Remover
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">🏥</div>
                        <h3>Nenhum paciente cadastrado</h3>
                        <p>Comece adicionando um novo paciente ao sistema</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>