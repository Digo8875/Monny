<?php
class Tipo_dinheiro extends CI_Controller{

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

		$this->load->model('Usuario_model');
		$this->data['list_usuarios_ativos'] = $this->Usuario_model->get_usuarios_ativos();
		$this->load->model('Usuario_atual_model');
		$this->data['usuario_atual_db'] = $this->Usuario_atual_model->get_usuario_atual(1);
		$this->data['usuario_atual'] = $this->Usuario_model->get_usuario($this->data['usuario_atual_db']['Usuario_id']);

		$this->load->model('Tipo_dinheiro_model');
		$this->data['list_tipo_dinheiros'] = $this->Tipo_dinheiro_model->get_tipo_dinheiros();

	}

	public function index(){

		$this->lista_tipo_dinheiros();
	}

	public function lista_tipo_dinheiros($page = 'Lista de Moedas'){

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->model('Tipo_dinheiro_model', '', TRUE);
        $this->data['lista_tipo_dinheiros'] = $this->Tipo_dinheiro_model->get_tipo_dinheiros();


        $this->load->view('templates/header', $this->data);
        $this->load->view('tipo_dinheiro/tipo_dinheiro', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

	public function create(){

		$this->data['title'] = 'Nova Moeda';
		$this->data['obj'] = $this->Tipo_dinheiro_model->get_tipo_dinheiro(0);

		$this->load->view('templates/header', $this->data);
		$this->load->view('tipo_dinheiro/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function edit($id){
		$this->data['title'] = 'Editar Moeda';
		$this->data['obj'] = $this->Tipo_dinheiro_model->get_tipo_dinheiro($id);
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('tipo_dinheiro/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function detalhes($id){	
		$this->data['title'] = 'Detalhes da Moeda';
		$this->data['obj'] = $this->Tipo_dinheiro_model->get_tipo_dinheiro($id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('tipo_dinheiro/detalhes', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function deletar($id){
		$this->Tipo_dinheiro_model->delete_tipo_dinheiro($id);

		redirect('tipo_dinheiro/index');
	}

	public function valida_tipo_dinheiro(){
		return true;
	}

	public function formCreateEdit(){

		$this->data['title'] = 'Criar/Atualizar Moeda';

		$dataToSave = array(
			'Id' => $this->input->post('id'),
			'Ativo' => $this->input->post('ativo'),
			'Nome' => $this->input->post('nome'),
			'Sigla' => $this->input->post('sigla')
		);

		if(empty($dataToSave['Ativo']))
				$dataToSave['Ativo'] = 0;

		if(!empty($this->input->post()))
		{
			$val = $this->valida_tipo_dinheiro($dataToSave);

		 	if($val == 1)
		 	{ 
		 		$resultado = $this->Tipo_dinheiro_model->set_tipo_dinheiro($dataToSave);

		 		if($resultado == 1)
		 			redirect('tipo_dinheiro/index');
		 	}
		}
		else
			redirect('tipo_dinheiro/index');
	}

}
?>