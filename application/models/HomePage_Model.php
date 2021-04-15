<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomePage_Model extends CI_Model {

	function getMobile()
	{
		 $query = $this->db->get('mobiles');
		 return $query->result();
	}

	function getAbout()
	{
		 $query = $this->db->get('about');
		 return $query->result();
	}

	function getService()
	{
		 $query = $this->db->get('service');
		 return $query->result();
	}

	public function getApp()
	{
		$query = $this->db->get('app');
		return $query->result();
	}

	public function getCard()
	{
		$query = $this->db->get('card');
		return $query->result();
	}

	public function getWeb()
	{
		$query = $this->db->get('web');
		return $query->result();
	}

	public function getTeam()
	{
		$query = $this->db->get('teams');
		return $query->result();
	}
}

/* End of file HomePage_Model.php */
/* Location: ./application/models/HomePage_Model.php */