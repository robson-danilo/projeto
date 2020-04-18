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

	public function editar_imagem_logo($dados=null){
		$this->foto = $dados['nome'];
		return $this->db->update('perfil_profissional', $this, array('id' => $dados['id']));
	}

	public function adicionar_imagem_logo($dados=null){
		$this->db->set('foto', $dados['nome']);
		$this->db->set('id_usuario', $dados['id']);
		return $this->db->insert('perfil_profissional');
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

	public function validar_login($dados=null){
		$this->db->select('*');
		$this->db->where('login', $dados['login']);
		$this->db->from('usuario');
		$dados = $this->db->get();
		$dados = $dados->row_array();
		$verificar = (is_array($dados) ? count($dados) : 0);
		if ($verificar > 0){
			return true;
		}else {
			return false;
		}

	}

	public function buscar_dados_profissional($dados=null){
		$this->db->select('id, nome');
		$this->db->like('nome', $dados);
		$this->db->where('tipo_usuario_id', 1);
		$this->db->from('usuario');
		$dados = $this->db->get();
		return $dados->result_array();
	}

	public function perfil_profissional_especialidade($id = null, $especialidade=null){
		$this->db->select('*');
		$this->db->where('id_usuario', $id);
		$this->db->like('especialidade', $especialidade);
		$this->db->from('perfil_profissional');
		$dados = $this->db->get();
		return $dados->row_array();
	}

	public function buscar_conversa($dados=null){
		$this->db->select('*');
		$this->db->from('conversas');
		$this->db->where('id_enviou', $dados['outro_id']);
		$this->db->where('id_recebeu', $dados['meu_id']);
		$this->db->or_where('id_recebeu', $dados['outro_id']);
		$this->db->where('id_enviou', $dados['meu_id']);
		$this->db->order_by('data_e_hora', 'desc');
		$this->db->limit('7');
		$dados =  $this->db->get();
		return $dados->result_array();
	}

	public function enviar_conversa($dados=null){
		$this->db->set('id_enviou', $dados['id_enviou']);
		$this->db->set('id_recebeu', $dados['id_enviado']);
		$this->db->set('conversa', $dados['mensagem']);
		return $this->db->insert('conversas');
	}

	public function listarpacientes($id=null){
		$this->db->select('DISTINCT(id_enviou)');
		$this->db->from('conversas');
		$this->db->where('id_recebeu', $id);
		$dados = $this->db->get();
		return $dados->result_array();
	}

	public function buscardadospaciente($dados=null){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where_in('id', $dados);
		$this->db->where('tipo_usuario_id', '2');
		$dados = $this->db->get();
		return $dados->result_array();
	}

	public function buscar_imagem($id=null){
		$this->db->select('foto');
		$this->db->from('perfil_profissional');
		$this->db->where('id_usuario', $id);
		$dados = $this->db->get();
		return $dados->row_array();
	}
	
}