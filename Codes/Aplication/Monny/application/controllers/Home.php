<?php
class Home extends CI_Controller{

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

		$this->view();
	}

	public function view($page = 'home'){

		if ( ! file_exists(APPPATH.'views/home/'.$page.'.php'))
        {
                // Se não existir a pasta com a página: Página não encontrada
                show_404();
        }

        $this->data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $this->data);
        $this->load->view('home/'.$page, $this->data);
        $this->load->view('templates/footer', $this->data);
	}

}
?>