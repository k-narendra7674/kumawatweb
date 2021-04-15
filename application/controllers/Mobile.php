<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mobile_Model', 'mo_model');
	}

	public function index()
	{
		$this->load->view('admin/header');	
		$this->load->view('project/mobile_list');	
		$this->load->view('admin/footer');	
	}


	/* ------------------------------------------------------------------------------- */
	/*                                 insert Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function addMobile()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', ' Name', 'required');
			$this->form_validation->set_rules('content', 'content', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			} else {
				$config['upload_path'] = APPPATH . '../public/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '1000';
				// $config['max_width'] = '1024';
				// $config['max_height'] = '768';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('img')) {
					$data = array('result' => 'error', 'message' => $this->upload->display_errors());
				}else{
				$ajax_data = $this->input->post();
					$ajax_data['img'] = $this->upload->data('file_name');

				if ($this->mo_model->create($ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Data Added Successfully...!');
				}else{
					$data = array('result' => 'error', 'message' => 'failed to data added ..!');
				}
			}
		}
		echo json_encode($data);
	}
		else
		{
			echo 'No direct script access allowed';
		}
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 Fetch Records                                   */
	/* ------------------------------------------------------------------------------- */

	public function fetchMobile()
	{
		$data = $this->mo_model->getAll();
		echo json_encode($data);
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 Delete Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function delMobile()
	{
		if ($this->input->is_ajax_request()) {
			$del_id = $this->input->post('del_id');
			$post = $this->mo_model->single_id($del_id);
			unlink(APPPATH . '../public/uploads/'. $post->img);

			if ($this->mo_model->delete($del_id)) {
				$data = array('result' => 'success', 'message' => 'Data Delete Successfully...!');
			}else{
				$data = array('result' => 'error', 'message' => 'failed to delete data ...!');
			}
			echo json_encode($data);
		}
		else
		{
			echo 'No direct script access allowed';
		}

	}

	/* ------------------------------------------------------------------------------- */
	/*                                 edit Records                                    */
	/* ------------------------------------------------------------------------------- */

	public function editMobile()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->get('edit_id');

			if ($post = $this->mo_model->single_id($edit_id)) {
				$data = array('result' => 'success', 'post' => $post);
			}else{
				$data = array('result' => 'error', 'message' => 'failed fetch data...!');
			}
			echo json_encode($data);
		}
		else
		{
			echo 'No direct script access allowed';
		}
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 update Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function updateMobile()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', ' Name', 'required');
			$this->form_validation->set_rules('content', 'content', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			}
			else
			{
				if (isset($_FILES['editMobileImg'])) {
					$config['upload_path'] = APPPATH . '../public/uploads/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = '1000';
	   //              // $config['max_width']            = 1024;
	   //              // $config['max_height']           = 768;
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('editMobileImg')) {
						$data = array('result' => 'error', 'message' => $this->upload->display_errors());
					}
					else
					{
						$edit_id = $this->input->post('edit_id');
						if ($post = $this->mo_model->single_id($edit_id)) {
							unlink(APPPATH . '../public/uploads/'. $post->img);
							$ajax_data['img'] = $this->upload->data('file_name');
						}
					}
				}
				$id = $this->input->post('edit_id');
				$ajax_data['name'] = $this->input->post('name');
				$ajax_data['content'] = $this->input->post('content');
				

				if ($this->mo_model->update($id, $ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Data Updated Successfully...!');
				}else{
					$data = array('result' => 'error', 'message' => 'failed to data updation...!');
				}
			}echo json_encode($data);
		}
		else
		{
			echo "No direct script access allowed";
		}
	}

}

/* End of file Component.php */
/* Location: ./application/controllers/Component.php */