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
		$this->load->view('loginViews');
	}

	public function login(){
		$dados = array('login_usuario' => $this->input->post('login_usuario'),
			'senha_usuario' => $this->input->post('senha_usuario'));
		//print_r($dados);
		$verificar = $this->login_model->buscar_usuario($dados);
		if ($verificar != true){
			$retorno['retorno'] = 'Login ou senha incorretos!';
			//print_r($retorno);
			$this->load->view('loginViews', $retorno);
		}else {
			echo "login sucesso!";
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
		$retorno = $this->login_model->cadastrar_cliente($dados);
		if ($retorno == true){
			echo "sucesso";
		}else {
			echo "falha";
		}
		
	}
}
