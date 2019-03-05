<?php

class Usuario_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $nome;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inserir(){
		return $this->db->insert('usuario', $this);
	}

	public function get_usuario($id){
		$query =  $this->db->query("
				SELECT * 
					FROM usuario 
				WHERE Id = ".$this->db->escape($id)."");

		return $query->row_array();
	}

	public function get_usuarios(){
        //$query = $this->db->get('categoria');
        //return $query->result();

        $query = $this->db->query("
					SELECT * 
					FROM usuario ");

		return $query->result_array();
    }

    public function get_usuarios_ativos(){
        //$query = $this->db->get('categoria');
        //return $query->result();

        $query = $this->db->query("
					SELECT * 
					FROM usuario 
					WHERE Ativo = 1");

		return $query->result_array();
    }

    public function set_usuario($data)
	{
		if(empty($data['Id']))
			$this->db->insert('usuario',$data);
		else
		{
			$this->db->where('Id', $data['Id']);
			$this->db->update('usuario', $data);
		}
		return true;
	}

}
?>