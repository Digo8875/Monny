<?php
class Categoria extends CI_Controller{

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

		$this->load->model('Categoria_model');

		$this->load->model('Usuario_model');
		$this->data['list_usuarios_ativos'] = $this->Usuario_model->get_usuarios_ativos();
		$this->load->model('Usuario_atual_model');
		$this->data['usuario_atual_db'] = $this->Usuario_atual_model->get_usuario_atual(1);
		$this->data['usuario_atual'] = $this->Usuario_model->get_usuario($this->data['usuario_atual_db']['Usuario_id']);

	}

	public function index(){

		$this->lista_categorias();
	}

	public function lista_categorias($page = 'Lista Categorias'){

        $this->data['title'] = ucfirst($page);

        $this->load->model('Categoria_model', '', TRUE);
        $this->data['lista_categorias'] = $this->Categoria_model->get_categorias();


        $this->load->view('templates/header', $this->data);
        $this->load->view('categoria/categoria', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

	public function create(){

		$this->data['title'] = 'Nova Categoria';
		$this->data['obj'] = $this->Categoria_model->get_categoria(0);

		$this->load->view('templates/header', $this->data);
		$this->load->view('categoria/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function edit($id){
		$this->data['title'] = 'Editar categoria';
		$this->data['obj'] = $this->Categoria_model->get_categoria($id);
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('categoria/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function detalhes($id){	
		$this->data['title'] = 'Detalhes da categoria';
		$this->data['obj'] = $this->Categoria_model->get_categoria($id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('categoria/detalhes', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function deletar($id){
		$this->Categoria_model->delete_categoria($id);

		redirect('categoria/index');
	}

	public function valida_categoria($dataToSave){
		return true;
	}

	public function formCreateEdit(){

		$this->data['title'] = 'Criar/Atualizar Categoria';

		$dataToSave = array(
			'Id' => $this->input->post('id'),
			'Ativo' => $this->input->post('ativo'),
			'Nome' => $this->input->post('nome')
		);

		if(empty($dataToSave['Ativo']))
				$dataToSave['Ativo'] = 0;

		if(!empty($this->input->post()))
		{
			$val = $this->valida_categoria($dataToSave);

		 	if($val == 1)
		 	{ 
		 		$resultado = $this->Categoria_model->set_categoria($dataToSave);

		 		if($resultado == 1)
		 			redirect('categoria/index');
		 	}
		}
		else
			redirect('categoria/index');
	}

}
?>