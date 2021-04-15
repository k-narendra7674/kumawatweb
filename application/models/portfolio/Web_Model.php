<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_Model extends CI_Model {

	
	function create($data)
	{
		return $this->db->insert('web', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('web');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('web', array('web_id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('web');
		$this->db->where('web_id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('web', $data, array('web_id' => $id));
	}

}

/* End of file web_Model.php */
/* Location: ./weblication/models/portfolio/web_Model.php */