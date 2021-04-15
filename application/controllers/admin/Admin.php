<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin = $this->session->userdata('admin');
		if (empty($admin)) {
			$this->session->set_flashdata('msg', 'Your Session has been expired');
			redirect(base_url() . 'login');
		}else{
			$this->load->view('admin/dashboard');
		}
	}

	public function index()
	{
		$this->load->view('admin/dashboard');
	}

}





/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */