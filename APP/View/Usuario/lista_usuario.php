<?php include VIEWS . '/Includes/menu.php'; ?>
<div class="content">
    <div class="panel">
        <h1>Lista de Usuários</h1>
        <?= $model->getErrors() ?>
        <a href="/usuario/cadastro" class="btn-main">Novo Usuário</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($model->rows as $usuario): ?>
                <tr>
                    <td><?= $usuario->id ?></td>
                    <td><a href="/usuario/cadastro?id=<?= $usuario->id ?>"><?= $usuario->nome ?></a></td>
                    <td><?= $usuario->email ?></td>
                    <td><?= $usuario->senha ?></td>
                    <td>
                        <a href="/usuario/delete?id=<?= $usuario->id ?>" class="btn-main">Remover</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
