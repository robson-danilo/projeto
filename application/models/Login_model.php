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
		$dados = (is_array($dados) ? count($dados) : 0);
		if ($dados > 0){
			return true;
		}else {
			return false;
		}
	}
	public function cadastrar_cliente($dados=null){
		$this->db->set('sexo', $dados['sexo']);
		$this->db->set('data_nasc', $dados['nascimento']);
		$this->db->set('telefone', $dados['celular']);
		$this->db->set('login', $dados['login']);
		$this->db->set('senha', $dados['senha']);
		$this->db->set('email', $dados['email']);
		$this->db->set('cep', $dados['cep']);
		$this->db->set('logadrouro', $dados['logadrouro']);
		$this->db->set('numero', $dados['numero']);
		$this->db->set('completo', $dados['complemento']);
		$this->db->set('bairro', $dados['bairro']);
		$this->db->set('municipio', $dados['municipio']);
		$this->db->set('estado', $dados['uf']);
		return $this->db->insert('usuario');
	}
	
	
}