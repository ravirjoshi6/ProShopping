<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class Admin_model extends CI_Model {
		public function check_login($data){
			$result = array ();
			$this->db->select ( 'user.user_id, user_roles.role_name, user.firstname, user.lastname, user.email' );
			$this->db->where ( 'email', $data['email'] );
			$this->db->where ( 'password', md5 ( $data['password'] ) );
			$this->db->where ( 'emailVarificationStatus', 'verified' );
			$this->db->where ( 'userRole', 2 );
			$this->db->join ( 'user_roles', 'user.userRole = user_roles.role_id' );
			// $this->db->where ( 'userRole', $roleId);
			$query = $this->db->get ( 'user' );
			$rowcount = $query->num_rows ();
			if ($rowcount == 1) {
				$ret = $query->row ();
				$result ['status'] = true;
				$result ['id'] = $ret->user_id;
				$result ['userRole'] = $ret->role_name;
				$result['firstName'] = $ret->firstname;
				$result['lastName'] = $ret->lastname;
				$result['email'] = $ret->email;
					
			} else {
				$result ['msg'] = 'User not found';
				$result ['status'] = FALSE;
			}
			return $result;
		}
		public function get_users(){
			$result = array();
			$this->db->select('user.user_id, user.firstname, user.lastname, user.lastModifiedDate');
			$this->db->limit(8, 1);
			$this->db->order_by('lastModifiedDate','DESC');
			foreach ( $this->db->get('user')->result () as $row ) {
				$result[]= array('user_id' => $row->user_id, 'firstname' =>$row->firstname, 'lastname'=> $row->lastname, 'time' =>$this->date_diff($row->lastModifiedDate));
			}
			return $result;
		}
		public function get_products(){
			$result = array();
			$this->db->select('product.product_id, product.product_name, product.price, product.desc, product.productImage, product.lastModifiedDate');
			$this->db->limit(5, 1);
			$this->db->order_by('lastModifiedDate','DESC');
			foreach ( $this->db->get('product')->result () as $row ) {
				$result[]= array('id' => $row->product_id, 'name' =>$row->product_name, 'price'=> $row->price, 'desc' => unserialize($row->desc)->details, 'productImage' => $row->productImage, 'time' =>$this->date_diff($row->lastModifiedDate));
			}
			return $result;
		}
		
		public function date_diff($date){
			$to=date_create($date);
			$from=date_create(date('Y-m-d'));
			$diff=date_diff($to,$from);
			return $diff->format('%a days');
		}
		
		public function getUserCount(){
			$this->db->select('count(*) as total');
			$this->db->where('user_roles.role_name', 'normal'); 
			$this->db->join ( 'user_roles', 'user.userRole = user_roles.role_id' );
			$query= $this->db->get('user');
			return $query->result()[0];
		}
		public function getpendingordercount(){
			$this->db->select('count(*) as total');
			$this->db->where('order.orderStatus !=', 'finished');
			$query= $this->db->get('order');
			return $query->result()[0];
		}
		public function getRecentOrders(){
			$result = array();
			$this->db->select('order.order_id , product.product_name , order.orderStatus ');
			$this->db->join ( 'product', 'product.product_id = order.product_id' );
			$this->db->limit(7, 1);
			$this->db->order_by('order.lastModifiedDate','DESC');
			foreach ( $this->db->get('order')->result () as $row ) {
				$result[]= array('order_id' => $row->order_id, 'product_name' =>$row->product_name, 'orderStatus'=> $row->orderStatus);
			}
			return $result;
		}
		
		function update_product($product_id = null, $data){
			$result = new stdClass();
			if($this->get_product_by_ide($product_id)->status){
				$this->db->where ( 'product_id', $product_id);
				$this->db->update('product', $data);
				$result = $this->get_product_by_ide($product_id);
				$result->status = TRUE;
			}else{
				$result->status = FALSE;
				$result->msg='Product not found';
			}
			return $result;
		}
		
		function get_product_by_ide($id) {
			$this->db->where ( 'product_id', $id);
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
		
		public function delete_product($product_id){
			$result = new stdClass();
			if($this->get_product_by_ide($product_id)->status){
				$this->db->where('product_id', $product_id);
				$this->db->delete('product');
				$result->status = TRUE;
				$result->msg = 'Product removed';
			}else{
				$result->status = FALSE;
				$result->msg='Product not found';
			}
			return $result;
		}
		
		public function getOrders(){
			$this->db->select('order.id, order.quantity, order.price, order.orderStatus, order.orderDate, product.name');
			$this->db->join('product', 'product.product_id = order.product_id');
			$this->db->order_by('order.lastModifiedDate','DESC');
			$this->db->get('order');
		}
	}