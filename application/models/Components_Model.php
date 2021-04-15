<?php <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_Model extends CI_Model {

	public function create($data)
	{
		return $this->db->insert('mobiles', $data);
	}

}

/* End of file Components_Model.php */
/* Location: ./application/models/Components_Model.php */