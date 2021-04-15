<<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Component extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('components_model', 'comp_model');
	}

	public function index()
	{
		$this->load->view('project/component');	
	}

}

/* End of file Component.php */
/* Location: ./application/controllers/Component.php */