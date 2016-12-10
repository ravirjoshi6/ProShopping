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
			$this->db->select('user.user_id, user.firstname, user.lastname');
			$this->db->limit(8, 1);
			$this->db->order_by('lastModifiedDate','DESC');
			foreach ( $this->db->get('user')->result () as $row ) {
				$result[]= array('user_id' => $row->user_id, 'firstname' =>$row->firstname, 'lastname'=> $row->lastname);
			}
			return $result;
		}
		public function get_products(){
			$result = array();
			$this->db->select('product.product_id, product.product_name, price, desc, productImage');
			$this->db->limit(5, 1);
			$this->db->order_by('lastModifiedDate','DESC');
			foreach ( $this->db->get('product')->result () as $row ) {
				$result[]= array('id' => $row->product_id, 'name' =>$row->product_name, 'price'=> $row->price, 'desc' => unserialize($row->desc)->details, 'productImage' => $row->productImage);
			}
			
			return $result;
		}
	}