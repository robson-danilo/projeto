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
      //$('#funcionario_cpf').mask('000.000.000-00',{placeholder:'999.999.999-99'});
      $('#cliente_celular').mask('(99) 9999-9999',{placeholder:'(XX) XXXX-XXXX'}); 
      $('#cliente_cep').mask('99.999-999',{placeholder:'99.999-999'});


      var maskBehavior = function (val, e, field) {
        return val.replace(/\D/g, '').length == 11 ? '(00) 00000-0000' : '(00) 0000-00009';
      },
      maskInternal = function(val, e, field, options) {
        field.mask(maskBehavior.apply({}, arguments), options);
      },
      options = {onKeyPress: maskInternal};
      $('#celular').mask(maskBehavior, options);
    });


    function proximaAba(){
      $('#myTab li:last-child a').tab('show');
    }

    function voltarAba(){
      $('#myTab li:first-child a').tab('show');
    }

    function tirarmask() {
      //$('#funcionario_cpf').val($('#funcionario_cpf').val().replace('.', '').replace('.', '').replace('-', ''));
      //$('#telefone').val($('#telefone').val().replace('(', '').replace(')', '').replace(' ', '').replace('-', ''));
      $('#cliente_celular').val($('#cliente_celular').val().replace('(', '').replace(')', '').replace(' ', '').replace('-', ''));
      $('#cliente_cep').val($('#cliente_cep').val().replace('.', '').replace('-', ''));
          //$('#new_funcionario').submit();
        }

        function sem_acento(e,args)
        {   
            if (document.all){var evt=event.keyCode;} // caso seja IE
            else{var evt = e.charCode;} // do contrário deve ser Mozilla

            // criando a lista de teclas permitidas
            var valid_chars = '0123456789'; 
            var chr= String.fromCharCode(evt);  // pegando a tecla digitada
            if (valid_chars.indexOf(chr)>-1){return true;}
                return false; // do contrário nega
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
                    <li><a href="<?php echo site_url('welcome/CadastrarCliente');?>"><i class="fa fa-registered"></i>Chat Solicitações</a>   
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
        <p><h4>Editar Dados</h4></p>
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

        <form accept-charset="UTF-8" action="<?php echo site_url('welcome/editarperfil');?>" class="form-horizontal" id="novo_cliente" name="novo_cliente" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" value="✓" type="hidden"><input name="authenticity_token" value="AGOjy8iO1GzXyyzhf/qGziOJSD+aDxsh/b6bA+REhV0=" type="hidden"></div>
          <div class="col-lg-12">
            <div class="row">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#info-tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Dados cadastrais</a></li>
                <li><a href="#endereco-tab" data-toggle="tab"><span class="glyphicon glyphicon-home"></span> Endereço residencial</a></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active in" id="info-tab">  
                  <div class="form-group">    
                    <div class="col-lg-4">
                      <label class="control-label"><label for="funcionario_nome">Nome</label></label>
                      <input class="form-control" id="cliente_nome" name="cliente_nome" required size="30" value="<?php echo $dados['nome'] ?>" type="text">
                    </div>              
                    <div class="col-lg-4">
                      <label class="control-label"><label for="cliente_sexo">Sexo</label></label><br>
                      <?php  if ($dados['sexo'] == 'M'){ ?>
                        <input id="cliente_sexo" name="cliente_sexo" type="radio" value="M" checked>Masculino 
                        <input id="cliente_sexo" name="cliente_sexo" type="radio" value="F">Feminino 
                      <?php }else { ?>  
                        <input id="cliente_sexo" name="cliente_sexo" type="radio" value="M">Masculino 
                        <input id="cliente_sexo" name="cliente_sexo" type="radio" value="F" checked>Feminino 
                      <?php } ?>        
                    </div>  
                  </div>  
                  <div class="form-group">    
                    <div class="col-lg-4">
                      <label class="control-label"><label for="cliente_nascimento">Nascimento</label></label>
                      <input class="form-control" value="<?php echo $dados['data_nasc'] ?>" id="cliente_nascimento" name="cliente_nascimento" type="date">       
                    </div>
                    <div class="col-lg-4">
                      <div class="input-group">
                        <label class="control-label"><label for="cliente_celular">Celular</label></label>
                        <input required value="<?php echo $dados['telefone'] ?>" class="form-control" id="cliente_celular" name="cliente_celular" type="text" placeholder="(XX) XXXXX-XXXX"> 
                      </div>        
                    </div>  
                  </div>
                  <div class="col-lg-4">
                    <label class="control-label"><label>Login</label></label>
                    <input class="form-control" value="<?php echo $dados['login'] ?>" id="cliente_login" name="cliente_login" required size="30" type="text">
                  </div> 

                  <div class="col-lg-4">
                    <label class="control-label"><label>Senha</label></label>
                    <input type="password" class="form-control" value="<?php echo $dados['senha'] ?>" id="cliente_senha" name="cliente_senha" required size="30">
                  </div> 
                  <div class="form-group">   
                    <div class="col-lg-8">
                      <label class="control-label"><label for="cliente_email">Email</label></label>
                      <input required class="form-control" value="<?php echo $dados['email'] ?>" id="cliente_email" name="cliente_email" type="text" placeholder="exemplo@exemplo.com"> 
                    </div>  
                  </div>     
                  <div class="form-group"> 
                    <div class="col-lg-2">
                      <button class="btn btn-info" type="button" onclick="proximaAba()"><span class="glyphicon glyphicon-home"></span> Endereço residencial</button>
                    </div>      
                  </div>   
                </div> <!-- Fim tab info -->
                <div class="tab-pane" id="endereco-tab">
                  <div class="form-group">    
                    <div class="col-lg-2">
                      <label class="control-label"><label for="cliente_cep">CEP</label></label>
                      <input class="form-control" value="<?php echo $dados['cep'] ?>" id="cliente_cep" name="cliente_cep" type="text" size="30" onkeypress="return sem_acento(event);">  
                    </div>          
                  </div> 
                  <div class="form-group">      
                    <div class="col-lg-8">
                      <label class="control-label"><label for="cliente_logadrouro">Logradouro</label></label>
                      <input class="form-control" value="<?php echo $dados['logadrouro'] ?>" id="cliente_logadrouro" name="cliente_logadrouro" type="text" size="30"> 
                    </div>        
                  </div> 
                  <div class="form-group"> 
                    <div class="col-lg-2">
                      <label class="control-label"><label for="cliente_numero">Numero</label></label>
                      <input class="form-control" value="<?php echo $dados['numero'] ?>" id="cliente_numero" name="cliente_numero" size="30" type="text">     
                    </div>    
                    <div class="col-lg-6">
                      <label class="control-label"><label for="cliente_complemento">Complemento</label></label>
                      <input class="form-control" value="<?php echo $dados['complemento'] ?>" id="cliente_complemento" name="cliente_complemento" type="text" size="30"> 
                    </div>  
                  </div>
                  <div class="form-group">    
                    <div class="col-lg-3">
                      <label class="control-label"><label for="cliente_bairro">Bairro</label></label>
                      <input class="form-control" value="<?php echo $dados['bairro'] ?>" id="cliente_bairro" name="cliente_bairro" size="30" type="text">     
                    </div>  

                    <div class="col-lg-3">
                      <label class="control-label"><label for="cliente_municipio">Município</label></label>
                      <input class="form-control" value="<?php echo $dados['municipio'] ?>" id="cliente_municipio" name="cliente_municipio" type="text" size="30">  
                    </div>  

                    <div class="col-lg-2"> 
                      <label class="control-label"><label for="uf">UF</label></label>
                      <select required class="form-control" id="cliente_uf" name="cliente_uf">
                        <?php
                        foreach($estadosBrasileiros as $estados) { ?>
                          <?php if ($dados['estado'] == $estados['sigla']) { ?>
                            <option selected value='<?php echo $estados['sigla'];?>'><?php echo $estados['nome'];?></option>
                          <?php }else { ?>
                            <option value='<?php echo $estados['sigla'];?>'><?php echo $estados['nome'];?></option>
                          <?php } ?>
                        <?php } ?>  
                      </select>
                    </div>          
                  </div> 

                  <div class="form-group"> 
                    <div class="col-lg-2">
                      <button class="btn btn-info" type="button" onclick="voltarAba()"><span class="glyphicon glyphicon-user"></span> Dados cadastrais</button>
                    </div>      
                  </div>  

                </div><!-- fim tab endereco -->
              </div>
            </div>
          </div>  
          <div class="form-group"> 
            <div class="col-lg-1">
              <a href="javascript:history.back()" class="btn-danger btn">Cancelar</a>
            </div>    
            <div class="col-lg-2">
              <input class="btn btn-success" name="commit" value="Salvar" type="submit" onclick="tirarmask()" >
            </div>          
          </div>
        </form>



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
