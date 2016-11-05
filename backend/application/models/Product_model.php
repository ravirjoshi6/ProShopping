<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Product_model extends CI_Model {
	
	function checkLogin($email, $password, $role= 'normal') {
		$result = array();
		$roleId= $this->getUserRoleId($role);
		$this->db->where ( 'email', $email );
		$this->db->where ( 'password', md5 ( $password ) );
		$this->db->where ( 'userRole', $roleId);
		$query = $this->db->get ( 'user' );
		$rowcount = $query->num_rows ();
		if ($rowcount == 1) {
			$ret = $query->row ();
			$result['status'] = true;
			$result['id'] = $ret->user_id;
		} else {
			$result['status'] = FALSE;
		}
		return $result;
	}
	function createProduct($user, $isAdmin = FALSE) {
		date_default_timezone_set("America/New_York");
		$result = array();
		if(!$this->get_product_by_name($user['product_name'])->status){
			$data = array (
					'product_name' => $user['product_name'],
					'price' => $user ['product_price'],
					'description' => $user ['product_desc'],
					'lastModifiedDate' =>date("Y-m-d h:i:sa"),
					'productImage' => '',
			);
			
			if($user['is_active']== 'true'){
				$data['isActive'] = TRUE;
			}else{
				$data['isActive'] = FALSE;
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
	public function delete_product($product_name){
		if($this->get_product_by_name($product_name)->status){
			$this->db->where('product_name', $product_name);
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
	
}