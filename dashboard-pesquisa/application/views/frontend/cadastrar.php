<head>
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Cadastrar Usuário</h4>
            </div>
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible "><button class="close" data-dismiss="alert">x</button>', '</div>');?>
            <?php echo form_open('admin/usuarios/novoUsuario'); ?>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                          <div class="form-group">
                              <label id="novousuario">Nome do usuário</label>
                              <input name="novousuario" id="novousuario" type="text" class="form-control" placeholder="Informe o nome">
                          </div>
                          </div>
                        </div>
                      </td>
                      <td>
                      <div class="form-group">
                          <label id="novasenha">Senha</label>
                          <input name="novasenha" id="novasenha" type="password" class="form-control" placeholder="Senha">
                      </div>
                      <td class="align-middle text-center text-sm">
                      <div class="form-group">
                          <label id="confirsenha">Confirmar Senha</label>
                          <input name="confirsenha" id="confirsenha" type="password" class="form-control" placeholder="Confirmar senha">
                      </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <div class="form-group"></br></br>
                          <button type="submit" name="salvar" id="botao" value="salvar" class="btn btn-success btn">Salvar</button>
                          <?php
                            echo form_close();
                          ?>
                      </div>
                      </td>
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Usuários</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Excluir</th>
                    </tr>
                  </thead>
                      <?php foreach ($usuarios as $user) : ?>
                    <tr>
                      <td><?= $user->login ?></td>
                      <td><a href="<?php echo base_url('admin/usuarios/excluir/'.$user->id) ?>">Excluir</a></td>
                    </tr>
                      <?php endforeach ?>
                </table>
                </div>
              </div>
          </body>
      </html>