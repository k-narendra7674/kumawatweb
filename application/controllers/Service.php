<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('service_model');
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('project/service_view');
		$this->load->view('admin/footer');
	}

	public function addService()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Header', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->service_model->create($ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Data added Successfully...!');
				}else{
					$data = array('result' => 'error', 'message' => 'failed to data added');
				}
			}echo json_encode($data);
		}
		else
		{
			echo 'No direct script access allowed';
		}
	}

	public function fetchService()
	{
		$data = $this->service_model->getAll();
		echo json_encode($data);
	}

	public function delService()
	{
		if ($this->input->is_ajax_request()) {
			$del_id = $this->input->post('del_id');
			$post = $this->service_model->single_id($del_id);

			if ($this->service_model->delete($del_id)) {
				$data = array('result' => 'success', 'message' => 'data delete Successfully...!');
			}else{
				$data = array('result' => 'error', 'message' => 'failed to delete data...!');
			}
			echo json_encode($data);
		}
		else
		{
			echo 'No direct script access allowed';
		}
	}

	public function editService()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->get('edit_id');

			if($post = $this->service_model->single_id($edit_id)){
				$data = array('result' => 'success', 'post' => $post);
			}else{
				$data = array('result' => 'error', 'message' => 'failed to fetch Data...!');
			}
			echo json_encode($data);
		}else{
			echo 'No direct script access allowed';
		}
	}

	public function updateService()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('content', 'Content', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			}
			else
			{
				$id = $this->input->post('edit_id');
				$ajax_data['name'] = $this->input->post('name');
				$ajax_data['content'] = $this->input->post('content');

				if ($this->service_model->update($id, $ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Data Updated Successfully...!');
				}else{
					$data = array('result' => 'error', 'message' => 'failed to data updation...!');
				}
			}
			echo json_encode($data);
		}
		else
		{
			echo "No direct script access allowed";
		}
	}
	
}


/* End of file Service.php */
/* Location: ./application/controllers/Service.php */