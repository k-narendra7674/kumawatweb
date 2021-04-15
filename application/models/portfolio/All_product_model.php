<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class All_product_model extends CI_Model {

	public function getAll()
	{
		$sql =	"SELECT ap.* , a.img as app_id , c.img as card_id, w.img as web_id  
		FROM  all_product ap, app a, card c, web w 
		WHERE  ap.app_id = a.app_id  
		and ap.card_id = c.card_id
        and ap.web_id = w.web_id";

		$query = $this->db->query($sql);

		$queryq1 = 	$query->result() ; 
		$query = $this->db->get('all_product');

		return $queryq1;
	}


// SELECT all_product.product_id, app.app_img, card.card_img, web.web_img FROM all_product JOIN app ON all_product.app_id = app.app_id JOIN card ON all_product.card_id = card.card_id JOIN web ON all_product.web_id = web.web_id


	public function getAll_app()
	{
		$query = $this->db->get_where('app');
		return $query->result();
	}

	public function getAll_card()
	{
		$query = $this->db->get_where('card');
		return $query->result();
	}

	public function getAll_web()
	{
		$query = $this->db->get_where('web');
		return $query->result();
	}


	function create($data)
	{
		return $this->db->insert('all_product', $data);
	}

	
	
	function single_id($id){
		$this->db->select('*');
		$this->db->from('all_product');
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}

	}



}

/* End of file All_product_model.php */
/* Location: ./application/models/portfolio/All_product_model.php */