<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_Model extends CI_Model {

		
	function create($data)
	{
		return $this->db->insert('teams', $data);
	}

	function getAll()
	{
		 $query = $this->db->get('teams');
		 return $query->result();
	}
	
	function delete($id)
	{
		return $this->db->delete('teams', array('id' => $id));
	}
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('teams');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}

	function update($id, $data)
	{
		return $this->db->update('teams', $data, array('id' => $id));
	}


}

/* End of file Team_Model.php */
/* Location: ./application/models/portfolio/Team_Model.php */