<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


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

	public function profile()
	{
		$this->load->view('admin/profile');
	}

	

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/dashboard/Dashboard.php */