<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card_Model extends CI_Model {

	
	function create($data)
	{
		return $this->db->insert('card', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('card');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('card', array('card_id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('card');
		$this->db->where('card_id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('card', $data, array('card_id' => $id));
	}

}

/* End of file card_Model.php */
/* Location: ./cardlication/models/portfolio/card_Model.php */