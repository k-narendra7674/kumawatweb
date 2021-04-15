<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('portfolio/All_product_model', 'ap_model');
	}

	public function index()
	{
		$data['all_apps'] = $this->ap_model->getAll_app();
		$data['all_cards'] = $this->ap_model->getAll_card();
		$data['all_webs'] = $this->ap_model->getAll_web();

		$this->load->view('admin/header');
		$this->load->view('project/portfolio/all_product_view', $data);
		$this->load->view('admin/footer');
	}
	
	public function addProduct()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('name', 'Product Name', 'required');
			$this->form_validation->set_rules('app_id', 'App Id', 'required');
			$this->form_validation->set_rules('card_id', 'Card Id', 'required');
			$this->form_validation->set_rules('web_id', 'Web Id', 'required');

			if ($this->form_validation->run() ==  FALSE) {
				$data = array('result' => 'error', 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->ap_model->create($ajax_data)) {
					$data = array('result' => 'success', 'message' => 'Data Added Successfully...!');
				} else {
					$data = array('result' => 'error', 'message' => 'failed to data added ..!');
				}
			}
			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	public function fetchProduct()
	{
		$data = $this->ap_model->getAll();
		echo json_encode($data);
	}


}

/* End of file All_Product.php */
/* Location: ./application/controllers/portfolio/All_Product.php */