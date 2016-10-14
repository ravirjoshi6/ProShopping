<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	

	
	function checkLogin($email,$password){
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$query = $this->db->get('userdetails');
		$rowcount = $query->num_rows();

		if($rowcount == 1){
			$ret = $query->row();
			return $ret->userid;
		}else{
			return 'notfound';
		}
	}
	
	function saveUser($user){
		$data = array('email' => $user['email'],'firstName' => $user['firstName'], 'lastName' => $user['lastName'], 'contactNo' => $user['contactNo'], 'password' => md5($user['password'] ));
		$this->db->insert('userdetails', $data);
		$user_id = $this->db->insert_id();
		return $user_id;
	}
}