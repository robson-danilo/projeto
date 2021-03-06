<?php 
$estadosBrasileiros = array(
	array("sigla" => "AC", "nome" => "Acre"),
	array("sigla" => "AL", "nome" => "Alagoas"),
	array("sigla" => "AM", "nome" => "Amazonas"),
	array("sigla" => "AP", "nome" => "Amapá"),
	array("sigla" => "BA", "nome" => "Bahia"),
	array("sigla" => "CE", "nome" => "Ceará"),
	array("sigla" => "DF", "nome" => "Distrito Federal"),
	array("sigla" => "ES", "nome" => "Espírito Santo"),
	array("sigla" => "GO", "nome" => "Goiás"),
	array("sigla" => "MA", "nome" => "Maranhão"),
	array("sigla" => "MT", "nome" => "Mato Grosso"),
	array("sigla" => "MS", "nome" => "Mato Grosso do Sul"),
	array("sigla" => "MG", "nome" => "Minas Gerais"),
	array("sigla" => "PA", "nome" => "Pará"),
	array("sigla" => "PB", "nome" => "Paraíba"),
	array("sigla" => "PR", "nome" => "Paraná"),
	array("sigla" => "PE", "nome" => "Pernambuco"),
	array("sigla" => "PI", "nome" => "Piauí"),
	array("sigla" => "RJ", "nome" => "Rio de Janeiro"),
	array("sigla" => "RN", "nome" => "Rio Grande do Norte"),
	array("sigla" => "RO", "nome" => "Rondônia"),
	array("sigla" => "RS", "nome" => "Rio Grande do Sul"),
	array("sigla" => "RR", "nome" => "Roraima"),
	array("sigla" => "SC", "nome" => "Santa Catarina"),
	array("sigla" => "SE", "nome" => "Sergipe"),
	array("sigla" => "SP", "nome" => "São Paulo"),
	array("sigla" => "TO", "nome" => "Tocantins")
); 	

$login = $this->session->userdata('login');
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
      $image_crop_logo = $('#image_demo_logo').croppie({
        enableExif: true,
        viewport: {
          width:200,
          height:200,
              type:'circle' //circle
            },
            boundary:{
              width:300,
              height:300
            }
          });

      $('#foto').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
          $image_crop_logo.croppie('bind', {
            url: event.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
        $('#inserir_imagem_modal_logo').modal('show');
      });

      $('.crop_image_logo').click(function(event){
        var tipo = $('#foto').val();
        $image_crop_logo.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
          $.ajax({
            url:"<?php echo site_url();?>/welcome/encaminhando_imagem_cortada",
            type: "POST",
            data:{"image": response, tipo},
            success:function(data)
            {
              $('#inserir_imagem_modal_logo').modal('hide');
              $('#mensagemimg').html('');                     
              $('#mensagemimg').append('<i class="fa fa-spinner fa-spin"></i>Upload imagem...');
              setTimeout(function () { 
                $('#mensagemimg').html('');  
                window.location.reload();
              }, 3 * 1000);
            }
          });
        })
      });

    });

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
    <p><h4>Perfil Profissional</h4></p>
  </div>

</div>
<div class="clearfix"></div>

<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
   <div class="x_content">
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

    <form accept-charset="UTF-8" action="<?php echo site_url('welcome/editarperfilprofissional');?>" class="form-horizontal" id="novo_cliente" name="novo_cliente" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" value="✓" type="hidden"><input name="authenticity_token" value="AGOjy8iO1GzXyyzhf/qGziOJSD+aDxsh/b6bA+REhV0=" type="hidden"></div>
      <div id="mensagemimg"></div>
      <?php if ($dados_pro == 0) { ?><!-- Adicionar novo perfil -->
      <div class="col-lg-12">
        <input type="hidden" name="novo_perfil_pro" id="novo_perfil_pro" value="T">
        <label class="control-label"><label>Foto</label></label><br>
        <input class="form-control" id="foto" name="foto" type="file" accept=".gif,.jpg,.png"><br>
      </div> 
      <div class="col-lg-12">
        <label class="control-label"><label>Especialidade</label></label>
        <select required class="form-control" id="especialidade" name="especialidade">
          <option value="">Selecione...</option>
          <option value="DP">Depêndencia Quimica</option>
          <option value="DE">Dependência Emocional</option>
        </select>
      </div> 
      <div class="col-lg-12"><br>
        <label class="control-label"><label>Experiência</label></label><br>
        <textarea class="form-control" style="resize: none" id="experiencia" name="experiencia" rows="6" cols="50"></textarea><br>
        <input class="btn btn-success" name="commit" value="Salvar" type="submit" >
      </div> 

      <?php }else { ?> <!-- Editar perfil -->
      <div class="col-lg-12">
        <input type="hidden" name="novo_perfil_pro" id="novo_perfil_pro" value="F">
        <label class="control-label"><label>Foto</label></label><br>
        <img alt="<?php echo $this->session->userdata('foto') ?>" id="foto_salva" class="img-circle" width="304" height="236" src="<?php echo base_url()?>/logos/<?php echo $this->session->userdata('foto');?>">
        <input class="form-control" id="foto" name="foto" type="file" accept=".gif,.jpg,.png"><br>
      </div> 
      <div class="col-lg-12">
        <label class="control-label"><label>Especialidade</label></label>
        <select required class="form-control" id="especialidade" name="especialidade"> 
          <?php if ($dados_pro['especialidade'] == 'DP'){ ?>
            <option selected value="DP">Depêndencia Quimica</option>
            <option value="DE">Dependência Emocional</option>
          <?php }else { ?>
            <option value="DP">Dependência Quimica</option>
            <option selected value="DE">Depêndencia Emocional</option>
          <?php } ?>
        </select>
      </div> 
      <div class="col-lg-12"><br>
        <label class="control-label"><label>Experiência</label></label><br>
        <textarea class="form-control" style="resize: none" name="experiencia" id="experiencia" rows="6" cols="50"><?php echo $dados_pro['experiencia']; ?></textarea><br>
        <input class="btn btn-success" name="commit" value="Salvar" type="submit" >
      </div>
    <?php } ?> 
  </form>
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
