<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Api extends CI_Controller {
	
	
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Api_model' );
		$this->load->database ();
	}
	
	public function index() {
		$this->load->view ( 'welcome_message' );
	}
	
	public function createUser() {
		$userData = $this->input->post ();
		$error = array();
		$result = array();
		if(!isset($userData['firstName'])){
			$error [] = 'firstname';
		}
		if(!isset($userData['lastName'])){
			$error [] = 'lastName';
		}
		if(!isset($userData['email'])){
			$error [] = 'email';
		}
		if(!isset($userData['contactNo'])){
			$error [] = 'contactNo';
		}
		if(!isset($userData['password']) && !strcmp($userData['password'], $userData['confirm_password']) ){
			$error [] = 'password';
		}
		if(empty($error)){
			$result['id']=$this->Api_model->saveUser($userData);
		}else{
			$result['error'] = $error;
		}
		echo json_encode($result);
		exit;
		
	}
}
