<?php

class Usuario_atual_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $usuario_id;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_usuario_atual($id){
		$query =  $this->db->query("
				SELECT * 
					FROM usuario_atual 
				WHERE Id = ".$this->db->escape($id)."");

		return $query->row_array();
	}

    public function set_usuario_atual($data)
	{
		if(empty($data['Id']))
			$this->db->insert('usuario_atual',$data);
		else
		{
			$this->db->where('Id', $data['Id']);
			$this->db->update('usuario_atual', $data);
		}
		return true;
	}

}
?>