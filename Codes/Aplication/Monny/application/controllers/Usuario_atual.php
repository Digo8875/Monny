<?php
class Usuario_atual extends CI_Controller{

	protected $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->helper('cookie');

		$this->load->model('Usuario_atual_model');

	}

	public function troca_usuario(){

		$data = $this->input->post('data');

		$usuario_atual_db = $this->Usuario_atual_model->get_usuario_atual(1);

		$dataToSave = array(
			'Id' => $usuario_atual_db['Id'],
			'Data_registro' => $usuario_atual_db['Data_registro'],
			'Ativo' => $usuario_atual_db['Ativo'],
			'Usuario_id' => $data['id_usuario_troca'],
		);

		$this->Usuario_atual_model->set_usuario_atual($dataToSave);

		return true;
	}
}
?>