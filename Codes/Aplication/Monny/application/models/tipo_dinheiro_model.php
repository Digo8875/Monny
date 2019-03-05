<?php

class Tipo_dinheiro_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $nome;
	private $sigla;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inserir(){
		return $this->db->insert('tipo_dinheiro', $this);
	}

	public function get_tipo_dinheiro($id){
		$query =  $this->db->query("
				SELECT * 
					FROM tipo_dinheiro 
				WHERE AND Id = ".$this->db->escape($id)."");

		return $query->row_array();
	}

	public function get_tipo_dinheiros(){

        $query = $this->db->query("
					SELECT * 
					FROM tipo_dinheiro ");

		return $query->result_array();
    }

    public function set_tipo_dinheiro($data)
		{
			if(empty($data['Id']))
				$this->db->insert('tipo_dinheiro',$data);
			else
			{
				$this->db->where('Id', $data['Id']);
				$this->db->update('tipo_dinheiro', $data);
			}
			return true;
		}

}
?>