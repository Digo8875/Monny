<?php
class Carteira extends CI_Controller{

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

		$this->load->model('Carteira_model');

		$this->load->model('Usuario_model');
		$this->data['list_usuarios_ativos'] = $this->Usuario_model->get_usuarios_ativos();
		$this->load->model('Usuario_atual_model');
		$this->data['usuario_atual_db'] = $this->Usuario_atual_model->get_usuario_atual(1);
		$this->data['usuario_atual'] = $this->Usuario_model->get_usuario($this->data['usuario_atual_db']['Usuario_id']);

		$this->data['list_carteiras'] = $this->Carteira_model->get_carteiras($this->data['usuario_atual']['Id']);

	}

	public function index(){

		$this->lista_carteiras();
	}

	public function lista_carteiras($page = 'Lista Carteiras'){

        $this->data['title'] = ucfirst($page);

        $this->load->model('Carteira_model', '', TRUE);
        $this->data['lista_carteiras'] = $this->Carteira_model->get_carteiras($this->data['usuario_atual']['Id']);


        $this->load->view('templates/header', $this->data);
        $this->load->view('carteira/carteira', $this->data);
        $this->load->view('templates/footer', $this->data);
	}

	public function create(){

		$this->data['title'] = 'Nova Carteira';
		$this->data['obj'] = $this->Carteira_model->get_carteira(0, $this->data['usuario_atual']['Id']);
		$this->load->view('templates/header', $this->data);
		$this->load->view('carteira/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function edit($id){
		$this->data['title'] = 'Editar Carteira';
		$this->data['obj'] = $this->Carteira_model->get_carteira($id, $this->data['usuario_atual']['Id']);
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('carteira/create_edit', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function detalhes($id){	
		$this->data['title'] = 'Detalhes da Carteira';
		$this->data['obj'] = $this->Carteira_model->get_carteira($id, $this->data['usuario_atual']['Id']);
		$this->data['carteira_usuario'] = $this->Usuario_model->get_usuario($this->data['obj']['Usuario_id']);
		$this->data['carteira_mestre'] = $this->Carteira_model->get_carteira($this->data['obj']['Carteira_mestre_id'], $this->data['usuario_atual']['Id']);

		$this->load->view('templates/header', $this->data);
		$this->load->view('carteira/detalhes', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function deletar($id){
		$this->Carteira_model->delete_carteira($id);

		redirect('carteira/index');
	}

	public function valida_carteira($dataToSave){
		return true;
	}

	public function formCreateEdit(){

		$this->data['title'] = 'Criar/Atualizar Carteira';

		if($this->input->post('carteira_mestre_select_id') == 0){
			$dataToSave = array(
			'Id' => $this->input->post('id'),
			'Ativo' => $this->input->post('ativo'),
			'Nome' => $this->input->post('nome'),
			'Descricao' => $this->input->post('descricao'),
			'Usuario_id' => $this->input->post('usuario_id'),
			'Carteira_mestre_id' => NULL
		);
		}
		else{
			$dataToSave = array(
				'Id' => $this->input->post('id'),
				'Ativo' => $this->input->post('ativo'),
				'Nome' => $this->input->post('nome'),
				'Descricao' => $this->input->post('descricao'),
				'Usuario_id' => $this->input->post('usuario_id'),
				'Carteira_mestre_id' => $this->input->post('carteira_mestre_select_id')
			);
		}

		if(empty($dataToSave['Ativo']))
				$dataToSave['Ativo'] = 0;

		if(!empty($this->input->post()))
		{
			$val = $this->valida_carteira($dataToSave);

		 	if($val == 1)
		 	{ 
		 		$resultado = $this->Carteira_model->set_carteira($dataToSave);

		 		if($resultado == 1)
		 			redirect('carteira/index');
		 	}
		}
		else
			redirect('carteira/index');
	}

}
?>