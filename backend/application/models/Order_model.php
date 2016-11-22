<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Order_model extends CI_Model {
	public function place_order($data){
		$this->db->insert('order', $data);
		return $this->db->insert_id();
	}
	
}