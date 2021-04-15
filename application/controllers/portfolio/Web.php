<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('portfolio/Web_Model');
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('project/portfolio/web_list');
		$this->load->view('admin/footer');
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 insert Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function addWeb()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Header', 'required');
		// 	// $this->form_validation->set_rules('content', 'Content', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			} else {
				$config['upload_path'] = APPPATH . '../public/uploads/webs/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '1000';
				// $config['max_width'] = '1024';
				// $config['max_height'] = '768';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('img')) {
					$data = array('result' => 'error', 'message' => $this->upload->display_errors());
				} else {
					$ajax_data = $this->input->post();
					$ajax_data['img'] = $this->upload->data('file_name');

					if ($this->Web_Model->create($ajax_data)) {
						$data = array('result' => 'success', 'message' => 'Data Added Successfully...!');
					} else {
						$data = array('result' => 'error', 'message' => 'failed to data added ..!');
					}
				}
			}
			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 Fetch Records                                   */
	/* ------------------------------------------------------------------------------- */

	public function fetchWeb()
	{
		$data = $this->Web_Model->getAll();
		echo json_encode($data);
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 Delete Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function delWeb()
	{
		if ($this->input->is_ajax_request()) {
			$del_id = $this->input->post('del_id');
			$post = $this->Web_Model->single_id($del_id);
			unlink(APPPATH . '../public/uploads/webs/' . $post->img);

			if ($this->Web_Model->delete($del_id)) {
				$data = array('result' => 'success', 'message' => 'Data Delete Successfully...!');
			} else {
				$data = array('result' => 'error', 'message' => 'failed to delete data ...!');
			}
			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 edit Records                                    */
	/* ------------------------------------------------------------------------------- */

	public function editWeb()
	{
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->get('edit_id');

			if ($post = $this->Web_Model->single_id($edit_id)) {
				$data = array('result' => 'success', 'post' => $post);
			} else {
				$data = array('result' => 'error', 'message' => 'failed fetch data...!');
			}
			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	/* ------------------------------------------------------------------------------- */
	/*                                 update Records                                  */
	/* ------------------------------------------------------------------------------- */

	public function updateWeb()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', ' Name', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			} else {
				if (isset($_FILES['edit_web_img'])) {
					$config['upload_path'] = APPPATH . '../public/uploads/webs/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = '1000';
					//              // $config['max_width']            = 1024;
					//              // $config['max_height']           = 768;
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('edit_web_img')) {
						$data = array('result' => 'error', 'message' => $this->upload->display_errors());
					} else {
						$edit_id = $this->input->post('edit_id');
						if ($post = $this->Web_Model->single_id($edit_id)) {
							unlink(APPPATH . '../public/uploads/webs/' . $post->img);
							$ajax_data['img'] = $this->upload->data('file_name');
						}
					}
				}
				$id = $this->input->post('edit_id');
				$ajax_data['name'] = $this->input->post('name');


				if ($this->Web_Model->update($id, $ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Data Updated Successfully...!');
				} else {
					$data = array('result' => 'error', 'message' => 'failed to data updation...!');
				}
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

}

/* End of file App.php */
/* Location: ./application/controllers/portfolio/App.php */