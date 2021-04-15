<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function register()
	{
			// $this->form_validation->set_message('is_unique', 'email address already exists', 'please try another');
		// if ($this->input->post()) {

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/register');
		}
		else
		{
			$formArray = array();
			$formArray['username'] = $this->input->post('username');
			$formArray['email'] = $this->input->post('email');
			$formArray['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			$formArray['phone'] = $this->input->post('phone');
			$formArray['created_at'] = date('Y-m-d');
			$this->admin_model->create($formArray);

			print_r($formArray);
			

			$this->session->set_flashdata('msg', 'Your account has been successfully registered');
			redirect(base_url().'login');


		}
		
	}

	//	login authentication method

	public function authenticate()
	{
		$this->form_validation->set_rules('username', 'UserName', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			// Success
			$username = $this->input->post('username');
			$admin = $this->admin_model->getByUsername($username);

			if (!empty($admin)) {
				$password = $this->input->post('password');
				if (password_verify($password, $admin['password']) == true) {
					$adminArray['admin_id'] = $admin['id'];
					$adminArray['username'] = $admin['username'];
					$this->session->set_userdata('admin',$adminArray);
					redirect(base_url().'Admin-Dashboard');
				}else{
					$this->session->set_flashdata('msg', 'Either UserName or Password is incorrect. !');
					redirect(base_url().'login', 'refresh');
				}
			} else {
				$this->session->set_flashdata('msg', 'Either UserName or Password is incorrect. !');
				redirect(base_url().'login', 'refresh');
			} 
		}else{
			$this->load->view('admin/login');
			// Form Error
		}
	}

	// Logout method
	public function logout()
	{
		$this->session->unset_userdata('admin');
		redirect(base_url().'login');
	}


}


/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */