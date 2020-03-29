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
		$this->session->set_flashdata('atualizacao_positivo','');
		$this->session->set_flashdata('atualizacao_negativo','');
		$this->load->view('loginViews');
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
			//print_r($dados);
			if ($dados['dados']['tipo_usuario_id'] == 1){

				$dados['dados_pro'] = $this->login_model->perfil_profissional($dados['dados']['id']);

				if (empty($dados['dados_pro'])){
					$dados['dados_pro'] = 0;
				}
				//print_r($dados['dados_pro']);exit;
				$this->load->view('admViews', $dados);
			}else {
				$this->load->view('pacienteViews', $dados);
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
		$verificar = $this->login_model->cadastrar_cliente($dados);
		if($verificar!=true)
		{
			$this->session->set_flashdata('atualizacao_negativo','Nao foi possivel atualizar os dados!');
		}
		else
		{
			$this->session->set_flashdata('atualizacao_positivo','Atualizacao dos dados realizada com sucesso!');
		}

		$this->load->view('cadastro_cliente');
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
			$this->load->view('editar_dados_profissional', $dados);
		}else {
			$this->load->view('editar_dados_paciente', $dados);
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
		$this->load->view('admViews', $dados);
	}
}
