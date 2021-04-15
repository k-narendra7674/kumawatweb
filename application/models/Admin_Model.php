<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function create($formArray)
	{
		$this->db->insert('admin', $formArray);
	}

	public function getByUsername($username)
	{
		$this->db->where('username', $username);
		$admin = $this->db->get('admin');
		return $admin->row_array();
	}

}

/* End of file Admin_Model.php */
/* Location: ./application/models/Admin_Model.php */