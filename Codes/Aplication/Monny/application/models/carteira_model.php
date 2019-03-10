<?php

class Carteira_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $nome;
	public $descricao;
	public $usuario_id;
	public $carteira_mestre_id;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inserir(){
		return $this->db->insert('carteira', $this);
	}

	public function get_carteira($id, $usuario_id){
		$query =  $this->db->query("
				SELECT * 
					FROM carteira 
				WHERE Id = ".$this->db->escape($id)." AND Usuario_id = ".$this->db->escape($usuario_id)."");

		return $query->row_array();
	}

	public function get_carteiras($usuario_id){

		$query = $this->db->query("
					SELECT *
					FROM carteira 
					WHERE Usuario_id = ".$this->db->escape($usuario_id)."");

		return $query->result_array();
    }

    public function set_carteira($data){
		if(empty($data['Id']))
			$this->db->insert('carteira',$data);
		else
		{
			$this->db->where('Id', $data['Id']);
			$this->db->update('carteira', $data);
		}
		return true;
	}

	public function delete_carteira($id){
		return $this->db->query("
			UPDATE carteira SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
	}

}
?>