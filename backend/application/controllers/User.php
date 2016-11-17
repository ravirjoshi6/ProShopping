<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'User_model' );
		$this->load->database ();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		header('Access-Control-Allow-Methods: GET, POST, PUT');
		
	}
	public function index() {
		$this->load->view ( 'welcome_message' );
	}
	public function create() {
		$userData = $this->input->post ();
		$error = array ();
		$result = array ();
		if (! isset ( $userData ['firstName'] )) {
			$error [] = 'firstname';
		}
		if (! isset ( $userData ['lastName'] )) {
			$error [] = 'lastName';
		}
		if (! isset ( $userData ['email'] )) {
			$error [] = 'email';
		}
		if (! isset ( $userData ['password'] )) {
			$error [] = 'password';
		}
		if (empty ( $error )) {
			if (! $this->User_model->getUserById ( $userData ['email'] )->status) {
				$result = $this->User_model->saveUser ( $userData );
			} else {
				$result ['msg'] = 'User Already Exists';
				$result ['status'] = false;
			}
		} else {
			$result ['error'] = $error;
		}
		echo json_encode ( $result );
		exit ();
	}
	public function login() {
		$userData = $this->input->post ();
		$error = array ();
		$result = array ();
		if (! isset ( $userData ['email'] )) {
			$error [] = 'email';
		}
		if (! isset ( $userData ['password'] )) {
			$error [] = 'password';
		}
		if (empty ( $error )) {
			$result = $this->User_model->checkLogin ( $userData ['email'], $userData ['password'] );
		} else {
			$result ['error'] = $error;
		}
		echo json_encode ( $result );
		exit ();
	}
	public function update(){
		$userData = $this->input->post ();
		$error = array ();
		$result = array ();
		$data = array();
		if (! isset ( $userData ['email'] )) {
			$error [] = 'email';
		}
		if ( isset ( $userData ['firstName'] )) {
			$data['firstname'] = $userData ['firstName'];
		}
		if (isset ( $userData ['lastName'] )) {
			$data ['lastname'] = $userData ['lastName'];
		}
		if (isset ( $userData ['password'] )) {
			$data ['password'] = $userData ['password'];
		}
		if (isset ( $userData ['security_question'] )) {
			$data ['security_question'] = $userData ['security_question'];
		}
		if (isset ( $userData ['security_answer'] )) {
			$data ['security_answer'] = $userData ['security_answer'];
		}if(isset($userData['user_role'])){
			$data ['user_role'] = $userData ['user_role'];
		}
		if(empty($error)){
			$result = $this->User_model->update_user($userData['email'], $data);
		}else{
			$result['status'] = false;
			$result['msg'] = 'User not found.';
		}
		echo json_encode($result);
		exit;
	}
	public function delete(){
		$userData = $this->input->post ();
		if(!empty($userData) && !empty($userData['email'])){
			$result = $this->User_model->delete_user($userData['email']);
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'User not found';
		}
		echo json_encode($result);
	}
	public function createAdmin(){
		$userData = $this->input->post ();
		$error = array ();
		$result = array ();
		if (! isset ( $userData ['firstName'] )) {
			$error [] = 'firstname';
		}
		if (! isset ( $userData ['lastName'] )) {
			$error [] = 'lastName';
		}
		if (! isset ( $userData ['email'] )) {
			$error [] = 'email';
		}
		if (! isset ( $userData ['password'] )) {
			$error [] = 'password';
		}
		if (empty ( $error )) {
			if (! $this->User_model->getUserById ( $userData ['email'] )->status) {
				$result = $this->User_model->saveUser ( $userData, TRUE );
			} else {
				$result ['msg'] = 'User Already Exists';
				$result ['status'] = false;
			}
		} else {
			$result ['error'] = $error;
		}
		echo json_encode ( $result );
		exit ();
	}
	public function getUsers(){
		$users= $this->User_model->getUsers();
		echo json_encode($users);
	}
	
	public function getUserById(){
		$post = $this->input->post();
		$result= array();
		$error = array();
		if(!isset($post['email'])){
			$error[] = 'id';
			$result['status'] = false;
			$result['error'] = $error;
		}
		else{
			$result['status'] = true;
			$result['data'] = $this->User_model->getUserById($post['email']);
		}
		
		echo json_encode($result);
	}
}
