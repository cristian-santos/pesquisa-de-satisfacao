<!DOCTYPE html>
<html>
  <title>login</title>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-AU-compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="<?php echo base_url('assets/css/login.css') ?>" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<div class="tela tela-login">
  <div class="container">
    <div class="text-center">
      <img src="<?php echo base_url('assets/img/stark.png') ?>">
  </div>

      <?php echo validation_errors('<div class="alert alert-danger alert-dismissible"><button class="close" data-dismiss="alert">x</button>', '</div>');?>
      <?php echo form_open('admin/usuarios/login')?>

    <!-- login-->
  <div class="form-group" align="center">
      <input type="text" placeholder="Informe seu usuario" class="form-control" name="txt-user" maxlength="50"/>
  </div>
  
    <!-- senha-->
  <div class="form-group" align="center">
        <input type="password" placeholder="senha" class="form-control" name="txt-senha">
  </div>
  
    <!-- botão-->
  <div class="form-group">
    <div class="align-right">
      <input type="submit" value="Login" class="btn btn-primary"/>
    </div>
  </div>
    <?php 
        echo form_close();
    ?>
  </div>
</div>
</body>
</html>