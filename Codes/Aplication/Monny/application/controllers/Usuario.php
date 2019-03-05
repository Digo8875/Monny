<?php
class Usuario extends CI_Controller{

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

	}

	public function index(){

		$this->lista_usuarios();
	}

	public function lista_usuarios($page = 'Lista Usuários'){

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->model('Usuario_model', '', TRUE);
        $this->data['lista_usuarios'] = $this->Usuario_model->get_usuarios();


        $this->load->view('templates/header', $this->data);
        $this->load->view('usuario/usuario', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

	public function create(){

		$this->data['title'] = 'Novo Usuario';
		$this->data['obj'] = $this->Usuario_model->get_usuario(0);

		$this->load->view('templates/header', $this->data);
		$this->load->view("usuario/create_edit", $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function valida_usuario(){
		return true;
	}

	public function formCreateEdit(){

		$this->data['title'] = 'Criar/Atualizar Usuário';

		$dataToSave = array(
			'Id' => $this->input->post('id'),
			'Ativo' => $this->input->post('ativo'),
			'Nome' => $this->input->post('nome')
		);

		if(empty($dataToSave['Ativo']))
				$dataToSave['Ativo'] = 0;

		if(!empty($this->input->post()))
		{
			$val = $this->valida_usuario($dataToSave);

		 	if($val == 1)
		 	{ 
		 		$resultado = $this->Usuario_model->set_usuario($dataToSave);

		 		if($resultado == 1)
		 			redirect('usuario/index');
		 	}
		}
		else
			redirect('usuario/index');
	}
}
?>