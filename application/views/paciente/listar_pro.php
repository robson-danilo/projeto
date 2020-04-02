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

    $(document).ready(function(){
      ajaxlistar();
    });


    document.addEventListener('keydown', function (event) {
      if (event.keyCode !== 13) return;
      ajaxlistar();
    });


    function ajaxlistar(){
      $('#divListar').html('');                     
      $('#divListar').append('<i class="fa fa-spinner fa-spin"></i>Carregando dados...');
      var especialidade = $('#especialidade').val();
      var nome = $('#nome').val();
      console.log(especialidade);

      $.ajax({
        url: "<?php echo site_url()?>/welcome/AjaxListarProfissional",
        dataType: 'json',
        type: 'get',
        data: {especialidade:especialidade,nome:nome},
        cache: false,
        success: function(data){
          var event_data = '';
          console.log(data);

          $.each(data, function(index, value){
            event_data += '<div class="col-md-4 col-sm-4 col-xs-12 contido profile_details">';
            event_data += '<div class="well profile_view">';
            event_data += '<div class="col-sm-12">';
            if (value.nome_funcionario == ''){
              event_data += '<h4 class="brief"><i>Sem nome</i></h4>';
            }else {
              event_data += '<h4 style="max-width: 34ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="'+value.nome+'" class="brief"><i>'+value.nome+'</i></h4>';
            }
            event_data += '<div class="left col-xs-7">';
            if (value.especialidade == 'DP'){
              event_data += '<p title="Especialidade: Depêndencia Quimica"><i class="fa fa-briefcase"></i>Especialidade: Depêndencia Quimica</p>';
            }else {
              event_data += '<p title="Especialidade: Depêndencia Emocional"><i class="fa fa-briefcase"></i>Especialidade: Depêndencia Emocional</p>';
            }
            event_data += '<p style="max-width: 34ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="Experiência: '+value.experiencia+'"><i class="fa fa-briefcase"></i>Experiência: '+value.experiencia+'</p>';
            event_data += '</div>';

            event_data += '<div class="right col-xs-5 text-center">';
            event_data += '<img src="<?php echo base_url()."logos/'+value.foto+'";?>" alt="" class="img-circle img-responsive">';
            event_data += '</div>';

            event_data += '</div>';
            event_data += '<div class="col-xs-12 bottom text-center">';           
            event_data += '<div class="col-xs-12 col-sm-6 emphasis" style="float:right">';

            event_data += '<a href=""><button title="Editar Funcionário" type="button" class="btn btn-primary btn-xs">';
            event_data += '<i class="fa fa-user"></i> Editar';
            event_data += '</button></a>';
            event_data += '</div>';
            event_data += '</div>';
            event_data += '</div>';
            event_data += '</div>';
          });

          $("#divListar").html('');
          $("#divListar").append(event_data);
          


        },
        error: function(d){

        }
      });
    }
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
    <p><h4>Perfil Profissional</h4></p>
  </div>

</div>
<div class="clearfix"></div>

<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
   <div class="x_content">

    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
         <div class="input-group" >
          <span class="input-group-addon" id="basic-addon3">Nome</span>
          <input type="text" id="nome" class="form-control" name="nome">
        </div>
      </div>    
      <div class="col-md-4">
       <div class="input-group" >
        <span class="input-group-addon" id="basic-addon3">Especialidade</span>
        <select class="form-control" id="especialidade" name="especialidade">
          <option selected="selected" disabled>Selecione...</option>
          <option value="DP">Depêndencia Quimica</option>
          <option value="DE">Dependência Emocional</option>              
        </select>
      </div>
    </div> 

    <div class="col-md-2">                          
      <button type="button" class="btn btn-default" onclick="ajaxlistar()">Pesquisar</button>
    </div>
  </div>
</div>
</div><br><br><br><br>
<div class="row">       
  <div id="divListar"></div>
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
  TESTANDO 123
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
</body>
</html>
