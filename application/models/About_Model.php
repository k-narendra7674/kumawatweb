<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_Model extends CI_Model {

	
	function create($data)
	{
		return $this->db->insert('about', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('about');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('about', array('id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('about');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('about', $data, array('id' => $id));
	}


}

/* End of file About_Model.php */
/* Location: ./application/models/About_Model.php */