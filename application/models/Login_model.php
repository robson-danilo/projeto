<?php
class Login_model extends CI_Model
{
	public function buscar_usuario($dados=null){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('login', $dados['login_usuario']);
		$this->db->where('senha', $dados['senha_usuario']);
		$dados = $this->db->get();
		$dados = $dados->row_array();
		$verificar = (is_array($dados) ? count($dados) : 0);
		if ($verificar > 0){
			return $dados ;
		}else {
			return false;
		}
	}

	public function buscar_dados($id){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('id', $id);
		$dados = $this->db->get();
		return $dados->row_array();
	}
	public function cadastrar_cliente($dados=null){
		$this->db->set('nome', $dados['nome']);
		$this->db->set('sexo', $dados['sexo']);
		$this->db->set('data_nasc', $dados['nascimento']);
		$this->db->set('telefone', $dados['celular']);
		$this->db->set('login', $dados['login']);
		$this->db->set('senha', $dados['senha']);
		$this->db->set('email', $dados['email']);
		$this->db->set('cep', $dados['cep']);
		$this->db->set('logadrouro', $dados['logadrouro']);
		$this->db->set('numero', $dados['numero']);
		$this->db->set('complemento', $dados['complemento']);
		$this->db->set('bairro', $dados['bairro']);
		$this->db->set('municipio', $dados['municipio']);
		$this->db->set('estado', $dados['uf']);
		return $this->db->insert('usuario');
	}

	public function perfil_profissional($id = null){
		$this->db->select('*');
		$this->db->where('id_usuario', $id);
		$this->db->from('perfil_profissional');
		$dados = $this->db->get();
		return $dados->row_array();
	}

	public function editar_dados($dados=null){
		$this->db->set('nome', $dados['nome']);
		$this->db->set('sexo', $dados['sexo']);
		$this->db->set('data_nasc', $dados['nascimento']);
		$this->db->set('telefone', $dados['celular']);
		$this->db->set('login', $dados['login']);
		$this->db->set('senha', $dados['senha']);
		$this->db->set('email', $dados['email']);
		$this->db->set('cep', $dados['cep']);
		$this->db->set('logadrouro', $dados['logadrouro']);
		$this->db->set('numero', $dados['numero']);
		$this->db->set('complemento', $dados['complemento']);
		$this->db->set('bairro', $dados['bairro']);
		$this->db->set('municipio', $dados['municipio']);
		$this->db->set('estado', $dados['uf']);
		$this->db->where('id' , $this->session->userdata('id'));
		return $this->db->update('usuario');

	}

	public function editar_dados_perfil_profissional($dados=null){
		$this->db->set('especialidade', $dados['especialidade']);
		$this->db->set('experiencia', $dados['experiencia']);
		$this->db->where('id_usuario' , $this->session->userdata('id'));
		return $this->db->update('perfil_profissional');
	}

	public function adicionar_dados_perfil_profissional($dados=null){
		$this->db->set('especialidade', $dados['especialidade']);
		$this->db->set('experiencia', $dados['experiencia']);
		$this->db->set('id_usuario', $this->session->userdata('id'));
		return $this->db->insert('perfil_profissional');
	}
	
	
}