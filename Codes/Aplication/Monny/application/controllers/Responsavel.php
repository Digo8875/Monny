<?php
class Responsavel extends CI_Controller{

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

		$this->load->model('Responsavel_model');
		$this->data['list_responsaveis'] = $this->Responsavel_model->get_responsaveis();

	}

	public function index(){

		$this->lista_responsaveis();
	}

	public function lista_responsaveis($page = 'Lista Responsaveis'){

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->model('Responsavel_model', '', TRUE);
        $this->data['lista_responsaveis'] = $this->Responsavel_model->get_responsaveis();


        $this->load->view('templates/header', $this->data);
        $this->load->view('responsavel/responsavel', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

	public function create(){

		$this->data['title'] = 'Novo Responsável';
		$this->data['obj'] = $this->Responsavel_model->get_responsavel(0);

		$this->load->view('templates/header', $this->data);
		$this->load->view('responsavel/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function edit($id){
		$this->data['title'] = 'Editar Responsável';
		$this->data['obj'] = $this->Responsavel_model->get_responsavel($id);
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('responsavel/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function detalhes($id){	
		$this->data['title'] = 'Detalhes do Responsável';
		$this->data['obj'] = $this->Responsavel_model->get_responsavel($id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('responsavel/detalhes', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function deletar($id){
		$this->Responsavel_model->delete_responsavel($id);

		redirect('responsavel/index');
	}

	public function valida_responsavel(){
		return true;
	}

	public function formCreateEdit(){

		$this->data['title'] = 'Criar/Atualizar Responsavel';

		$dataToSave = array(
			'Id' => $this->input->post('id'),
			'Ativo' => $this->input->post('ativo'),
			'Nome' => $this->input->post('nome'),
			'Descricao' => $this->input->post('descricao')
		);

		if(empty($dataToSave['Ativo']))
				$dataToSave['Ativo'] = 0;

		if(!empty($this->input->post()))
		{
			$val = $this->valida_responsavel($dataToSave);

		 	if($val == 1)
		 	{ 
		 		$resultado = $this->Responsavel_model->set_responsavel($dataToSave);

		 		if($resultado == 1)
		 			redirect('responsavel/index');
		 	}
		}
		else
			redirect('responsavel/index');
	}

}
?>