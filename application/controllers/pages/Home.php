<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('HomePage_Model', 'home');
	}

	public function index()
	{
		$data['all_mobile'] = $this->home->getMobile();
		$data['all_about'] = $this->home->getAbout();
		$data['all_service'] = $this->home->getService();
		$data['all_apps'] = $this->home->getApp();
		$data['all_cards'] = $this->home->getCard();
		$data['all_webs'] = $this->home->getWeb();
		$data['all_teams'] = $this->home->getTeam();

		$this->load->view('pages/home_page', $data);
	}


}

/* End of file Home.php */
/* Location: ./application/controllers/project/Home.php */