<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_Us extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('contactUs_model');
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('pages/contactUs_view');
		$this->load->view('admin/footer');

	}


	/* ------------------------------------------------------------------------------- */
	/*                                 insert Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function addMessage()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', ' Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('subject', 'content', 'required');
			$this->form_validation->set_rules('message', 'content', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			} else {
				

				$ajax_data = $this->input->post();
				if ($this->contactUs_model->create($ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Your message has been sent. Thank you!...!');
				}else{
					$data = array('result' => 'error', 'message' => 'Failed to Send Message ..!');
				}
			}
			echo json_encode($data);
		}
	}
		
	/* ------------------------------------------------------------------------------- */
	/*                                 Fetch Records                                   */
	/* ------------------------------------------------------------------------------- */

	public function fetchInfo()
	{
		$data = $this->contactUs_model->getAll();
		echo json_encode($data);
	}

}

/* End of file Contact_Us.php */
/* Location: ./application/controllers/pages/Contact_Us.php */