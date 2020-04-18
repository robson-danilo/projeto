<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');//Carrega o helper de url(link)
		$this->load->helper('form');//Carrega o helper de formul�rio
		$this->load->helper('array');//Carrega o helper array
		$this->load->library('session');//Carrega a biblioteca de sess�o
		$this->load->library('table');// Carrega a bibioteca de tabela
		$this->load->library('form_validation');//Carrega a biblioteca de valida��o de formul�rio
		$this->load->model('login_model');//Carrega o model
		
		
		//Limpa o cache, não permitindo ao usuário visualizar nenhuma página logo depois de ter feito logout do sistema
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}


	public function index()
	{
		session_destroy();
		$this->load->view('loginViews');
	}

	public function encaminhando_imagem_cortada(){
		if(isset($_POST["image"]))
		{


			$tipo = substr($_POST["tipo"], -3);
			if ($this->session->userdata('foto') == '0'){
				$nomeImagem = md5(date('H:i:s',time())).'.'.$tipo;
				$new = 1;

			}else {
				$nomeImagem = $this->session->userdata('foto');
				$new = 0;
			}
			$this->session->set_userdata('logo', $nomeImagem);


			$usuario_id = $this->session->userdata('id');

			$data = $_POST["image"];

			$image_array_1 = explode(";", $data);

			$image_array_2 = explode(",", $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$dir = 'logos/';
			
			$imageName = $dir.$nomeImagem;

			file_put_contents($imageName, $data);

			$dados['id'] = $usuario_id;
			$dados['nome'] = $nomeImagem;
			$dados['logo'] = $logo;

			if ($new != 1){
				$resultado = $this->login_model->editar_imagem_logo($dados);
			}else {
				$resultado = $this->login_model->adicionar_imagem_logo($dados);
			}
			

			if($resultado!=true)
			{
				$this->session->set_flashdata('atualizacao_negativo','Nao foi possivel atualizar a logo!');
			}
			else
			{
				$this->session->set_flashdata('atualizacao_positivo','Atualizacao da logo realizada com sucesso!');
			}

			echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
		}	
	}

	public function login(){
		$dados_login = array('login_usuario' => $this->input->post('login_usuario'),
			'senha_usuario' => $this->input->post('senha_usuario'));
		//print_r($dados);
		$dados['dados'] = $this->login_model->buscar_usuario($dados_login);
		if ($dados['dados'] == false){
			$this->session->set_flashdata('atualizacao_negativo','Login ou senha incorretos!');
			$this->load->view('loginViews');
		}else {
			$this->session->set_flashdata('atualizacao_negativo','');
			$this->session->set_userdata( 'id' ,  $dados['dados']['id']);
			$this->session->set_userdata( 'login' ,  $dados['dados']['login']);
			$this->session->set_userdata( 'tipo_usuario_id' ,  $dados['dados']['tipo_usuario_id']);
			$this->session->set_userdata( 'nome' ,  $dados['dados']['nome']);
			//print_r($dados);
			if ($dados['dados']['tipo_usuario_id'] == 1){

				$dados['dados_pro'] = $this->login_model->perfil_profissional($dados['dados']['id']);

				if (empty($dados['dados_pro'])){
					$dados['dados_pro'] = 0;
					$this->session->set_userdata('foto', '0');
				}else {
					$this->session->set_userdata('foto', $dados['dados_pro']['foto']);
				}
				$this->load->view('adm/admViews', $dados);
			}else {
				$this->load->view('paciente/pacienteViews', $dados);
			}
		}
	}

	public function CadastrarCliente(){
		$this->load->view('cadastro_cliente');
	}

	public function validarCadastro(){
		$dados = array('nome' =>$this->input->post('cliente_nome'),
			'sexo' =>$this->input->post('cliente_sexo'),
			'nascimento' =>$this->input->post('cliente_nascimento'),
			'celular' =>$this->input->post('cliente_celular'),
			'login' =>$this->input->post('cliente_login'),
			'senha' =>$this->input->post('cliente_senha'),
			'email' =>$this->input->post('cliente_email'),
			'cep' =>$this->input->post('cliente_cep'),
			'logadrouro' =>$this->input->post('cliente_logadrouro'),
			'numero' =>$this->input->post('cliente_numero'),
			'complemento' =>$this->input->post('cliente_complemento'),
			'bairro' =>$this->input->post('cliente_bairro'),
			'municipio' =>$this->input->post('cliente_municipio'),
			'uf' =>$this->input->post('cliente_uf')
		);

		$validarlogin = $this->login_model->validar_login($dados);

		if ($validarlogin == true){
			$this->session->set_flashdata('atualizacao_negativo','Login já cadastrado, tente outro');
		}else {
			$verificar = $this->login_model->cadastrar_cliente($dados);
			if($verificar!=true)
			{
				$this->session->set_flashdata('atualizacao_negativo','Nao foi possivel cadastrar os dados!');
			}
			else
			{
				$this->session->set_flashdata('atualizacao_positivo','Cadastramento dos dados realizada com sucesso!');
			}

			$this->load->view('cadastro_cliente');
		}

		redirect('/welcome/CadastrarCliente');	
	}

	public function editarperfil(){
		if (!empty($this->input->post('cliente_nome'))){
			$dados = array('nome' =>$this->input->post('cliente_nome'),
				'sexo' =>$this->input->post('cliente_sexo'),
				'nascimento' =>$this->input->post('cliente_nascimento'),
				'celular' =>$this->input->post('cliente_celular'),
				'login' =>$this->input->post('cliente_login'),
				'senha' =>$this->input->post('cliente_senha'),
				'email' =>$this->input->post('cliente_email'),
				'cep' =>$this->input->post('cliente_cep'),
				'logadrouro' =>$this->input->post('cliente_logadrouro'),
				'numero' =>$this->input->post('cliente_numero'),
				'complemento' =>$this->input->post('cliente_complemento'),
				'bairro' =>$this->input->post('cliente_bairro'),
				'municipio' =>$this->input->post('cliente_municipio'),
				'uf' =>$this->input->post('cliente_uf')
			);

			$verificar = $this->login_model->editar_dados($dados);

			if($verificar!=true)
			{
				$this->session->set_flashdata('atualizacao_negativo','Nao foi possivel atualizar os dados!');
			}
			else
			{
				$this->session->set_flashdata('atualizacao_positivo','Atualizacao dos dados realizada com sucesso!');
			}
		}
		$dados['dados'] = $this->login_model->buscar_dados($this->session->userdata('id'));
		//print_r($dados);
		if ($dados['dados']['tipo_usuario_id'] == 1){
			$this->load->view('adm/editar_dados_profissional', $dados);
		}else {
			$this->load->view('paciente/editar_dados_paciente', $dados);
		}

	}

	public function editarperfilprofissional(){

		if (!empty($this->input->post('especialidade')) && $this->input->post('novo_perfil_pro') == 'F'){//Editando perfil profissional
			$dados = array('especialidade' =>$this->input->post('especialidade'),
				'experiencia' =>$this->input->post('experiencia'));

			$verificar = $this->login_model->editar_dados_perfil_profissional($dados);

			if($verificar!=true)
			{
				$this->session->set_flashdata('atualizacao_negativo','Nao foi possivel atualizar os dados!');
			}
			else
			{
				$this->session->set_flashdata('atualizacao_positivo','Atualizacao dos dados realizada com sucesso!');
			}
		}else if(!empty($this->input->post('especialidade')) && $this->input->post('novo_perfil_pro') == 'T') {//Adiciona novo perfil profissional
			$dados = array('especialidade' =>$this->input->post('especialidade'),
				'experiencia' =>$this->input->post('experiencia'));

			$verificar = $this->login_model->adicionar_dados_perfil_profissional($dados);

			if($verificar!=true)
			{
				$this->session->set_flashdata('atualizacao_negativo','Nao foi possivel adicionarr os dados!');
			}
			else
			{
				$this->session->set_flashdata('atualizacao_positivo','Dados adicionar com sucesso!');
			}
		}
		
		$dados['dados'] = $this->login_model->buscar_dados($this->session->userdata('id'));
		$dados['dados_pro'] = $this->login_model->perfil_profissional($dados['dados']['id']);

		if (empty($dados['dados_pro'])){
			$dados['dados_pro'] = 0;
		}
				//print_r($dados['dados_pro']);exit;
		$this->load->view('adm/admViews', $dados);
	}

	public function listarProfissionaisEspecialidade(){
		$this->load->view('paciente/listar_pro');
	}


	public function AjaxListarProfissional(){
		$dados = $this->login_model->buscar_dados_profissional($this->input->get('nome'));
		$especialidade = $this->input->get('especialidade');
		foreach ($dados as $key => $value) {
			$retorno[] = $this->login_model->perfil_profissional_especialidade($value['id'], $especialidade);
		}
		//print_r($retorno);exit;
		foreach ($retorno as $key => $value) {
			foreach ($dados as $key2 => $value2) {
				if ($value['id_usuario'] == $value2['id']){
					foreach ($value2 as $key3 => $value3) {
						$retorno[$key][$key3] = $value3;
					}
				}
			}
		}
		$dados = array_filter($retorno);
		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
		
	}

	public function AjaxListarConversa(){
		$dados = array('outro_id' =>$this->input->get('outro_id'),
			'meu_id' =>$this->input->get('meu_id'));
		$dados['dados'] = $this->login_model->buscar_conversa($dados);

		if($this->input->get('id_doc')){
			$dados['imagem'] = $this->login_model->buscar_imagem($this->input->get('id_doc'));
		}

		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
	}

	public function AjaxEnviarConversa(){
		$dados = array('id_enviado' =>$this->input->get('id_enviado'),
			'id_enviou' =>$this->input->get('id_enviou'),
			'mensagem' =>$this->input->get('mensagem'));
		$dados = $this->login_model->enviar_conversa($dados);
		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
	}

	public function ChatPro(){
		$this->load->view('adm/chat_solicitacoes');

	}

	public function AjaxListarSolicitacoes(){
		$ids = $this->login_model->listarpacientes($this->session->userdata('id'));
		//print_r($dados);exit;
		foreach ($ids as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$dados[] = $value2;
			}
		}
		$dados_pacientes = $this->login_model->buscardadospaciente($dados);
		//print_r($dados_pacientes);exit;

		echo json_encode($dados_pacientes,JSON_UNESCAPED_UNICODE);
	}
}
