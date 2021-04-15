<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_Model extends CI_Model {

	
	function create($data)
	{
		return $this->db->insert('mobiles', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('mobiles');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('mobiles', array('id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('mobiles');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('mobiles', $data, array('id' => $id));
	}

}

/* End of file Components_Model.php */
/* Location: ./application/models/Components_Model.php */