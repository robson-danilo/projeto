<?php 
//$retorno = 0;
?>
<html lang="pt">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bem Vindo</title>

  <!-- Bootstrap -->
  <link href="/template/2.0/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="/template/2.0/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="/template/2.0/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="/template/2.0/vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="/template/2.0/build/css/custom.min.css" rel="stylesheet">



</head>

<body class="login">
  <div class="login_wrapper">
    <div class="animate form login_form"> 
      <section class="login_content">
        <?php 
        echo validation_errors('<p><font color="#FF0000">','</p>');
        if($this->session->flashdata('atualizacao_positivo'))
        {
          echo '<p><font color="#228B22">'.$this->session->flashdata('atualizacao_positivo').'</font></p>';
        }
        if($this->session->flashdata('atualizacao_negativo'))
        {
          echo '<p><font color="#FF0000">'.$this->session->flashdata('atualizacao_negativo').'</font></p>';
        }
        ?>
        <form accept-charset="UTF-8" action="<?php echo site_url('welcome/login');?>" id="new_session" method="post">
          <div><br>
            <input type="text" class="form-control" placeholder="Login" required="" id="login_usuario" name="login_usuario"/>
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Senha" required="" id="senha_usuario" name="senha_usuario"/>
          </div>
          <div class="separator"></div>
          <input type="submit" name="Commit" value="Acessar" class="btn btn-default submit">
          <a class="btn btn-success" href="<?php echo site_url("welcome/CadastrarCliente");?>">Cadastrar</a>
          
          <div>
            <h1><i class="fa fa-smile-o"></i> Solidario</h1>
            <p>Desenvolvido por Robson Danilo Peres Coelho</a></p>
          </div>
        </form>
      </section>
    </div>
  </div>
</body>
</html>
