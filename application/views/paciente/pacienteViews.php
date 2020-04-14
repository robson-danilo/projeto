<?php 

?>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="<?php echo site_url('imagens/teste.jpg')?>"/>

  <title>Teste Template</title>

  <!-- Bootstrap -->
  <link href="/template/2.0/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="/template/2.0/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="/template/2.0/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="/template/2.0/build/css/custom.min.css" rel="stylesheet">
  <!-- Croppie -->
  <link href="/template/2.0/vendors/cropper/dist/croppie.css" rel="stylesheet">



  <!-- jQuery -->
  <script src="/template/2.0/vendors/jquery/dist/jquery.js"></script> 
  <script type="text/javascript" src="<?php echo base_url('js/jquery.mask.js');?>"></script>
  <!-- Bootstrap -->
  <script src="/template/2.0/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Croppie -->
  <script src="/template/2.0/vendors/cropper/dist/croppie.js"></script>

  <script type="text/javascript">


  </script>

</head>

<body class="nav-md">
 <div class="container body">
  <div class="main_container">
   <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
     <div class="navbar nav_title" style="border: 0;">
      <a href="#" class="site_title"><i class="fa fa-smile-o"></i> <span>Cadastro</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic text-center">
       <img src="<?php echo base_url()."logos/teste.jpg";?>" height="60" class="img-circle profile_img">
     </div>
     <div class="profile_info">             
       Usuario        
     </div>
     <div class="clearfix"></div>
   </div>

   <!-- sidebar menu -->
   <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
     <ul class="nav side-menu">            
      <li><a href="<?php echo site_url('welcome/editarperfil'); ?>"><i class="fa fa-registered"></i> Editar Perfil</a>
        <li><a href="<?php echo site_url('welcome/listarProfissionaisEspecialidade');?>"><i class="fa fa-registered"></i>Listar Profissionais</a>  
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
 <div class="nav_menu">
  <nav>
   <div class="nav toggle">
    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
  </div>

  <ul class="nav navbar-nav navbar-right">
    <li class="">
     <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <span class="fa fa-user"></span> <?php echo $this->session->userdata('login');?>
      <span class="fa fa-angle-down"></span>
    </a>
    <ul class="dropdown-menu dropdown-usermenu pull-right">
      <br>
      <li>
       <div class="text-center">
        <a>
         <i class="fa fa-male"></i>
         <strong><?php echo $this->session->userdata('nome');?></strong>                                  
       </a>
     </div>
   </li>                    
   <li class="divider"></li>                        

   <li><a href="<?php echo site_url('welcome/index'); ?>"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
 </ul>
</li>
</ul>
</nav>
</div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
 <div class="">
  <div class="page-title">
   <p><h1>Centro Solidario</h1></p>

   <div class="title_left">
    <p><h4></h4></p>
  </div>

</div>
<div class="clearfix"></div>

<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
   <div class="x_content">

    <div id="tudo">  

      <div class="profile_pic text-center">
        <img src="<?php echo base_url()?>imagens/centro.jpeg" height="300">
     </div>



   </div>



 </div>
</div>
</div>
</div>
</div>
</div>





<!-- /page content -->

<!-- footer content -->
<footer>
 <div class="pull-right">
  <h6><i class="fa fa-registered"></i> Desenvolvido por Robson Danilo Peres Coelho</h6>
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
</body>
</html>
