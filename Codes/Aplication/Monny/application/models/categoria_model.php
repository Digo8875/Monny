<?php

class Categoria_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $nome;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inserir(){
		return $this->db->insert('categoria', $this);
	}

	public function get_categoria($id){
		$query =  $this->db->query("
				SELECT * 
					FROM categoria 
				WHERE Id = ".$this->db->escape($id)."");

		return $query->row_array();
	}

	public function get_categorias(){

        $query = $this->db->query("
					SELECT * 
					FROM categoria ");

		return $query->result_array();
    }

    public function set_categoria($data){
		if(empty($data['Id']))
			$this->db->insert('categoria',$data);
		else
		{
			$this->db->where('Id', $data['Id']);
			$this->db->update('categoria', $data);
		}
		return true;
	}

	public function delete_categoria($id){
		return $this->db->query("
			UPDATE categoria SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
	}

}
?>