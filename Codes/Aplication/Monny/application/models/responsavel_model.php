<?php

class Responsavel_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $nome;
	private $descricao;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inserir(){
		return $this->db->insert('responsavel', $this);
	}

	public function get_responsavel($id){
		$query =  $this->db->query("
				SELECT * 
					FROM responsavel 
				WHERE Id = ".$this->db->escape($id)."");

		return $query->row_array();
	}

	public function get_responsaveis(){

        $query = $this->db->query("
					SELECT * 
					FROM responsavel ");

		return $query->result_array();
    }

    public function set_responsavel($data)
	{
		if(empty($data['Id']))
			$this->db->insert('responsavel',$data);
		else
		{
			$this->db->where('Id', $data['Id']);
			$this->db->update('responsavel', $data);
		}
		return true;
	}

	public function delete_responsavel($id){
		return $this->db->query("
			UPDATE responsavel SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
	}

}
?>