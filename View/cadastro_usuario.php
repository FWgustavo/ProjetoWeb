<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="cadastro.css">
  </head>
  <body>
    <div class="spacer-top"></div>
    <div class="rain" id="rain"></div>
    <div class="panel panel-default panel-cadastro">
      <div class="panel-heading">
        <i class="fa fa-user-plus"></i> Cadastro de Usuário
      </div>
      <div class="panel-body">
        <form class="form-horizontal" autocomplete="off" method="post" action="salvar_usuario.php" enctype="multipart/form-data">
          <!-- Avatar -->
          <div class="form-section text-center">
            <div class="avatar-preview" id="avatarPreview">
              <img src="https://ui-avatars.com/api/?name=Usuário&background=5bc0de&color=fff&size=100" alt="Avatar" id="avatarImg">
            </div>
            <button type="button" id="btnUploadAvatar" class="btn btn-gradient">
              <i class="fa fa-image"></i> Escolher Imagem
            </button>
            <input type="file" id="avatarInput" accept="image/*" style="display:none;">
            <div class="help-block">Foto de perfil (opcional)</div>
          </div>
          <!-- Dados pessoais -->
          <div class="form-section">
            <div class="form-group">
              <label class="col-sm-3 control-label" for="nome">Nome</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-user"></i>
                <input id="nome" name="nome" type="text" placeholder="Insira seu nome" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="email">Email</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-envelope"></i>
                <input id="email" name="email" type="email" placeholder="Insira seu email" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="senha">Senha</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-lock"></i>
                <input id="senha" name="senha" type="password" placeholder="Insira sua senha" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="confirmarSenha">Confirmar Senha</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-lock"></i>
                <input id="confirmarSenha" name="confirmarSenha" type="password" placeholder="Confirme sua senha" class="form-control input-md" required>
              </div>
            </div>
          </div>
          <!-- Informações adicionais -->
          <div class="form-section">
            <div class="form-group">
              <label class="col-sm-3 control-label" for="nascimento">Nascimento</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-calendar"></i>
                <input id="nascimento" name="nascimento" type="date" class="form-control input-md">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="genero">Gênero</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-venus-mars"></i>
                <select id="genero" name="genero" class="form-control input-md">
                  <option value="">Selecione</option>
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                  <option value="outro">Outro</option>
                  <option value="nao_informar">Prefiro não informar</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="telefone">Telefone</label>
              <div class="col-sm-9 icon-input">
                <i class="fa fa-phone"></i>
                <input id="telefone" name="telefone" type="tel" placeholder="(99) 99999-9999" class="form-control input-md">
              </div>
            </div>
          </div>
          <!-- Botão -->
          <div class="form-group">
            <div class="col-sm-12 text-center">
              <button id="btnConfirmar" name="btnConfirmar" class="btn btn-primary" style="max-width: 220px;">
                <i class="fa fa-check"></i> Confirmar
              </button>
            </div>
          </div>
          <div class="text-center">
            <a href="../index.php">
              Já possui cadastro? Entrar
            </a>
          </div>
        </form>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="cadastro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>