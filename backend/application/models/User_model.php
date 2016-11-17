<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_model extends CI_Model {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * 
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function checkLogin($email, $password) {
		$result = array();
		$this->db->select('user.user_id, user_roles.role_name');
		$this->db->where ( 'email', $email );
		$this->db->where ( 'password', md5 ( $password ) );
		$this->db->join('user_roles','user.userRole = user_roles.role_id');
		//$this->db->where ( 'userRole', $roleId);
		$query = $this->db->get ( 'user' );
		$rowcount = $query->num_rows ();
		if ($rowcount == 1) {
			$ret = $query->row ();
			$result['status'] = true;
			$result['id'] = $ret->user_id;
			$result['userRole'] = $ret->role_name;
		} else {
			$result['msg'] = 'User not found';
			$result['status'] = FALSE;
		}
		return $result;
	}
	function saveUser($user, $isAdmin = FALSE) {
		date_default_timezone_set("America/New_York");
		
		$data = array (
				'email' => $user ['email'],
				'firstName' => $user ['firstName'],
				'lastName' => $user ['lastName'],
				'emailVarificationStatus' => 'pending',
				'securityQuestion' =>'question',
				'securityAnswer' =>'Answer',
				'lastLogin' => date("Y-m-d h:i:sa"),
				'lastModifiedDate' =>date("Y-m-d h:i:sa"),
				'password' => md5 ( $user ['password'] ),
		);
		if($isAdmin){
			$data['userRole'] = $this->getUserRoleId("admin");
		}else{
			$data['userRole'] = $this->getUserRoleId("normal");
		}
		$this->db->insert ( 'user', $data );
		$user_id = $this->db->insert_id ();
		return $user_id;
	}
	function getUserById($email_id) {
		$this->db->select('user.user_id, user.firstname, user.lastname, user.email, user_roles.role_name');
		$this->db->where ( 'email', $email_id );
		$this->db->join('user_roles','user.userRole = user_roles.role_id');
		$query = $this->db->get ( 'user' );
		$rowcount = $query->num_rows ();
		if ($rowcount > 0) {
			$return = $query->row ();
			//$return->status = true;
		} else {
			$return = new stdClass();
			//$return->status = false;
		}
		return $return;
	}
	function update_user($email, $data){
		if($this->getUserById($email)->status){
			
			if(isset($data['user_role'])){
				$data['userRole'] = $this->getUserRoleId($data['user_role']);
				unset($data['user_role']);
			}
			$this->db->where('email', $email);
			$this->db->update('user', $data);
			$result['status'] = TRUE;
			$result['msg'] = 'User profile updated';
		}else{
			$result['status'] = FALSE;
			$result['msg']='User not found';
		}		
		return $result;
	}
	public function delete_user($email){
		if($this->getUserById($email)->status){
			$this->db->where('email', $email);
			$this->db->delete('user');
			$result['status'] = TRUE;
			$result['msg'] = 'User removed';
		}else{
			$result['status'] = FALSE;
			$result['msg']='User not found';
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
	public function getUsers(){
		$query = $this->db->get ('user');
		$user = array();
		
		foreach($query->result() as $row){
			$user[] = $row;
		}
		return $user;
	}

}