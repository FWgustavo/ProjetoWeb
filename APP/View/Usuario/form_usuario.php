<?php include VIEWS . '/Includes/menu.php'; ?>
<div class="content">
    <div class="panel">
        <h1>Cadastro de Usuário</h1>
        <?= $model->getErrors() ?>
        <form action="/usuario/cadastro" method="post">
            <input type="hidden" name="id" value="<?= $model->Id ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?= $model->Nome ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= $model->Email ?>" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" value="<?= $model->Senha ?>" required>
            </div>
            <button type="submit" class="btn-main">Salvar</button>
        </form>
    </div>
</div>
