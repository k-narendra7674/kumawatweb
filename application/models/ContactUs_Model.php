<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs_Model extends CI_Model {

	function create($data)
	{
		return $this->db->insert('contact_us', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('contact_us');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('contact_us', array('id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('contact_us');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('contact_us', $data, array('id' => $id));
	}

}

/* End of file Contact_Us_Model.php */
/* Location: ./application/models/Contact_Us_Model.php */