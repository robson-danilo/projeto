<?php 

$id_usuario = $this->session->userdata('id');
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

    function ajaxlistar(){
      $('#divListar').html('');                     
      $('#divListar').append('<i class="fa fa-spinner fa-spin"></i>Carregando dados...');
      $.ajax({
        url: "<?php echo site_url()?>/welcome/AjaxListarSolicitacoes",
        dataType: 'json',
        type: 'get',
        data: {},
        cache: false,
        success: function(data){
          console.log(data);
          var event_data = '';
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

            event_data += '<p style="max-width: 34ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="Sexo: '+value.sexo+'"><i class="fa fa-briefcase"></i>Sexo: '+value.sexo+'</p>';
            event_data += '</div>';

            event_data += '<div class="right col-xs-5 text-center">';
            event_data += '<img src="<?php echo base_url()."imagens/centro.jpeg";?>" alt="" class="img-circle img-responsive">';
            event_data += '</div>';

            event_data += '</div>';
            event_data += '<div class="col-xs-12 bottom text-center">';           
            event_data += '<div class="col-xs-12 col-sm-6 emphasis" style="float:right">';

            event_data += '<button title="Conversa Funcionário" onclick="definir('+value.id+')" type="button" class="btn btn-primary btn-xs">';
            event_data += '<i class="fa fa-user"></i> Conversar';
            event_data += '</button>';
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



    function definir(id){
      id = id;
      event_data ='';
      event_data += '<input type="hidden" id="id_enviado" value="'+id+'">';
      $("#confirmar_id").html('');
      $("#confirmar_id").append(event_data);
      chat();
      $('#chat').modal('show');
      setInterval(chat,3000);
    }

    function chat(){
      var meu_id = <?php echo $id_usuario ?>;
      outro_id = $('#id_enviado').val();
      $.ajax({
        url: "<?php echo site_url()?>/welcome/AjaxListarConversa",
        dataType: 'json',
        type: 'get',
        data: {outro_id:outro_id,meu_id:meu_id},
        cache: false,
        success: function(data){
          event_data ='';
          $.each(data, function(index, value){
            if (value.id_enviou == meu_id){
              event_data +='<p style="text-align:right;">'+value.conversa+'</p>'; 
            }else{
              event_data +='<p style="text-align:left;">'+value.conversa+'</p>'; 
            }
          });

          $("#listar_conversas").html('');
          $("#listar_conversas").append(event_data);
          //setInterval(chat,3000);
          //clearInterval(interval1);
          //setInterval("chat()",3000);
        },
        error: function(d){

        }
      });
      
    }

    function enviar_mensagem(){
      var id_enviado = $('#id_enviado').val();
      var id_enviou = <?php echo $id_usuario ?>;
      var mensagem = $('#mensagem_enviar').val();
      $.ajax({
        url: "<?php echo site_url()?>/welcome/AjaxEnviarConversa",
        dataType: 'json',
        type: 'get',
        data: {id_enviado:id_enviado,id_enviou:id_enviou,mensagem:mensagem},
        cache: false,
        success: function(data){
          console.log(data);
          chat();
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
      <a href="#" class="site_title"><i class="fa fa-smile-o"></i> <span>SOLIDARIO</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic text-center">
       <img src="<?php echo base_url()?>/logos/<?php echo $this->session->userdata('foto');?>" height="60" class="img-circle profile_img">
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
        <li><a href="<?php echo site_url('welcome/editarperfilprofissional'); ?>"><i class="fa fa-registered"></i> Perfil Profissional</a>
          <li><a href="<?php echo site_url('welcome/ChatPro');?>"><i class="fa fa-registered"></i>Chat Solicitações</a>
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
    <p><h4>Chat Profissional</h4></p>
  </div>

</div>
<div class="clearfix"></div>

<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
   <div class="x_content">
    <div class="row">
      <div class="form-group">
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
</div>
</div>
<div id="inserir_imagem_modal_logo" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editando Imagem</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8 text-center">
            <div id="image_demo_logo" style="width:350px; margin-top:30px"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer"><br><br>
        <div class="col-md-10" style="padding-top:30px;">
          <button class="btn btn-success crop_image_logo">Cortar e Enviar</button>
        </div>
        <div class="col-md-2" style="padding-top:30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>  
      </div>
    </div>
  </div>
</div>
<div id="confirmar_id"></div>


<!-- Modal chat -->
<div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Bate-Papo</h3>
        <div id="erro_cadastramento"></div>
        <div id="alerta_verificar"></div>
      </div>
      <div id="usuario" class="modal-body">
        <div id="listar_conversas"></div> 
      </div>
      <div class="modal-footer">
        <div class="col-lg-12">
          <div class="input-group">
            <input type="text" name="mensagem_enviar" onfocus="this.value='';" id="mensagem_enviar" placeholder="Digite sua mensagem" class="form-control" />
            <span class="input-group-btn">
              <input type="button" class="btn btn-success" onclick="enviar_mensagem()" value="enviar"></span>
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
