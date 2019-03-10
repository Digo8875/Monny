<?php

class Subcategoria_model extends CI_model{

	public $id;
	public $data_registro;
	public $ativo;
	public $nome;
	private $categoria_id;

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inserir(){
		return $this->db->insert('sub_categoria', $this);
	}

	public function get_subcategoria($id){
		$query =  $this->db->query("
				SELECT sc.Id AS Id, sc.Nome AS Nome, sc.Data_registro AS Data_registro, sc.Ativo AS Ativo, 
					c.Nome AS Nome_categoria, c.Id AS Id_categoria 
					FROM sub_categoria sc 
					INNER JOIN categoria c 
					WHERE sc.Categoria_id = c.Id AND sc.Id = ".$this->db->escape($id)."");

		return $query->row_array();
	}

	public function get_subcategorias(){

        $query = $this->db->query("
					SELECT sc.Id AS Id, sc.Nome AS Nome, sc.Data_registro AS Data_registro, sc.Ativo AS Ativo, 
					c.Nome AS Nome_categoria, c.Id AS Id_categoria 
					FROM sub_categoria sc 
					INNER JOIN categoria c 
					WHERE sc.Categoria_id = c.Id");

		return $query->result_array();
    }

    public function set_subcategoria($data)
	{
		if(empty($data['Id']))
			$this->db->insert('sub_categoria',$data);
		else
		{
			$this->db->where('Id', $data['Id']);
			$this->db->update('sub_categoria', $data);
		}
		return true;
	}

	public function delete_subcategoria($id){
		return $this->db->query("
			UPDATE sub_categoria SET Ativo = 0 WHERE Id = ".$this->db->escape($id)."");
	}

}
?>