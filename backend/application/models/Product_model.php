<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Product_model extends CI_Model {
	
	function createProduct($product) {
		date_default_timezone_set("America/New_York");
		$result = array();
		if(!$this->get_product_by_name($product['product_name'])->status){
			$data = array (
					'product_name' => $product['product_name'],
					'price' => $product['product_price'],
					'desc' => $product['product_desc'],
					'lastModifiedDate' =>date("Y-m-d h:i:sa"),
					'productImage' => $product['productImage'],
			);
			
			if($product['is_active']== 'true' || $product['is_active']){
				$data['isActive'] = 1;
			}else{
				$data['isActive'] = 0;
			}
			$this->db->insert ( 'product', $data );
			$result['product_id'] = $this->db->insert_id ();
			$result['status'] = true;
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Product already exists.';
		}

		return $result;
	}
	function get_product_by_name($product_name) {
		$this->db->where ( 'product_name', $product_name);
		$query = $this->db->get ( 'product' );
		$rowcount = $query->num_rows ();
		if ($rowcount > 0) {
			$return = $query->row ();
			$return->status = true;
		} else {
			$return = new stdClass();
			$return->status = false;
		}
		return $return;
	}
	
	function get_product_by_id($product_id) {
		$this->db->where ( 'product_id', $product_id);
		$query = $this->db->get ( 'product' );
		$rowcount = $query->num_rows ();
		if ($rowcount > 0) {
			$return = $query->row ();
			$return->status = true;
		} else {
			$return = new stdClass();
			$return->status = false;
		}
		return $return;
	}
	
	
	function update_product($product_name = null, $data){
		$result = new stdClass();
		if($this->get_product_by_name($product_name)->status){
			$this->db->where ( 'product_name', $product_name);
			$this->db->update('product', $data);
			$result = $this->get_product_by_name($product_name);
			$result->status = TRUE;
		}else{
			$result->status = FALSE;
			$result->msg='Product not found';
		}		
		return $result;
	}
	public function delete_product($product_id){
		if($this->get_product_by_id($product_id)->status){
			$this->db->where('product_id', $product_id);
			$this->db->delete('product');
			$result['status'] = TRUE;
			$result['msg'] = 'Product removed';
		}else{
			$result['status'] = FALSE;
			$result['msg']='Product not found';
		}
		return $result;
	}
	public function getUserRoleId($roleName){
		if(!empty($roleName)){
			$this->db->where ( 'role_name', $roleName);
			$query = $this->db->get ( 'user_roles' );
			return $query->row()->role_id;
		}
	}
	
	public function add_payment($data){
		$this->db->insert('payment', $data);
		return $this->db->insert_id ();
	}
	
	public function get_products(){
		//$data = $this->db->get('products');
		$product = array ();
		$this->db->select('product.product_id, product.product_name, product.price, product.desc, product.isActive, product.productImage, product.rating');
		foreach ( $this->db->get('product')->result () as $row ) {
			if($row->isActive){
				$row->isActive = 'y';
			}else{
				$row->isActive = 'n';
			}
			$row->desc = unserialize($row->desc);
			$product [] = $row;
			
		}
		return $product;
	}
	
	function get_product_details($product_id) {
		$this->db->where ( 'product_id', $product_id);
		$query = $this->db->get ( 'product' );
		$rowcount = $query->num_rows ();
		if ($rowcount > 0) {
			$return = $query->row ();
			$return->status = true;
		} else {
			$return = new stdClass();
			$return->status = false;
		}
		return $return;
	}
	
	
	public function rateProduct($product_id, $rating){
		$this->db->select ( 'product.rating, product.rating_count' );
		$this->db->where ( 'product_id', $product_id );
		$query = $this->db->get ( 'product' );
		$return = $query->row ();
		$old_rating = $return->rating;
		$old_rating_count = $return->rating_count;
		$new_rating = ($old_rating+$rating)/($old_rating_count+1);
		$this->db->where ( 'product_id', $product_id);
		return $this->db->update('product', array('rating' => $new_rating));
	}
	
	
}