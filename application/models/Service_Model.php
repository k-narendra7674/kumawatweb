<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_Model extends CI_Model {

	public function create($data)
		{
			return $this->db->insert('service', $data);
		}

	public function getAll()
	{
		$q = $this->db->get('service');
		return $q->result();
	}

	public function delete($id)
	{
		return $this->db->delete('service', array('id' => $id));
	}

	public function single_id($id)
	{
		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}
	}

	public function update($id, $data)
	{
		return $this->db->update('service', $data, array('id' => $id));
	}

}

/* End of file Service_Model.php */
/* Location: ./application/models/Service_Model.php */