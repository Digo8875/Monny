<?php
class Subcategoria extends CI_Controller{

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

		$this->load->model('Subcategoria_model');

		$this->load->model('Usuario_model');
		$this->data['list_usuarios_ativos'] = $this->Usuario_model->get_usuarios_ativos();
		$this->load->model('Usuario_atual_model');
		$this->data['usuario_atual_db'] = $this->Usuario_atual_model->get_usuario_atual(1);
		$this->data['usuario_atual'] = $this->Usuario_model->get_usuario($this->data['usuario_atual_db']['Usuario_id']);

		$this->load->model('Categoria_model');
		$this->data['list_categorias'] = $this->Categoria_model->get_categorias();

	}

	public function index(){

		$this->lista_subcategorias();
	}

	public function lista_subcategorias($page = 'Lista Subcategorias'){

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->model('Subcategoria_model', '', TRUE);
        $this->data['lista_subcategorias'] = $this->Subcategoria_model->get_subcategorias();


        $this->load->view('templates/header', $this->data);
        $this->load->view('subcategoria/subcategoria', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

	public function create(){

		$this->data['title'] = 'Nova Subcategoria';
		$this->data['obj'] = $this->Subcategoria_model->get_subcategoria(0);

		$this->load->view('templates/header', $this->data);
		$this->load->view("subcategoria/create_edit", $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function edit($id){
		$this->data['title'] = 'Editar subcategoria';
		$this->data['obj'] = $this->Subcategoria_model->get_subcategoria($id);
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('subcategoria/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function detalhes($id){	
		$this->data['title'] = 'Detalhes da subcategoria';
		$this->data['obj'] = $this->Subcategoria_model->get_subcategoria($id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('subcategoria/detalhes', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function valida_subcategoria(){
		return true;
	}

	public function formCreateEdit(){

		$this->data['title'] = 'Criar/Atualizar Subcategoria';

		$dataToSave = array(
			'Id' => $this->input->post('id'),
			'Ativo' => $this->input->post('ativo'),
			'Nome' => $this->input->post('nome'),
			'Categoria_id' => $this->input->post('categoria_select_id')
		);

		if(empty($dataToSave['Ativo']))
				$dataToSave['Ativo'] = 0;

		if(!empty($this->input->post()))
		{
			$val = $this->valida_subcategoria($dataToSave);

		 	if($val == 1)
		 	{ 
		 		$resultado = $this->Subcategoria_model->set_subcategoria($dataToSave);

		 		if($resultado == 1)
		 			redirect('subcategoria/index');
		 	}
		}
		else
			redirect('subcategoria/index');
	}

}
?>