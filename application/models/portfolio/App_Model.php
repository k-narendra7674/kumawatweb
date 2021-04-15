<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_Model extends CI_Model {

	
	function create($data)
	{
		return $this->db->insert('app', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('app');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('app', array('app_id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('app');
		$this->db->where('app_id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('app', $data, array('app_id' => $id));
	}

}

/* End of file App_Model.php */
/* Location: ./application/models/portfolio/App_Model.php */