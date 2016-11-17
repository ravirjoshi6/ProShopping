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
		define("ENCRYPTION_KEY", "itsSecret!");
		
	}
	public function index() {
		//$this->load->view ( 'welcome_message' );
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
				$this->load->library('email');
				$this->email->set_header('Content-type', 'text/html; charset=UTF-8');
				$this->email->set_header('MIME-VErsion', '1.0');
				$this->email->set_header('Content-type', 'text/html; charset=UTF-8');
				$this->email->from('no-reply@proshopping.com', 'ecom proshop');
				$this->email->to($userData['email']);
				$this->email->bcc('nrupen92@gmail.com');
				$this->email->subject('Wel come to Proshop');
				$encrypt_email = $this->encrypt($userData['email'], ENCRYPTION_KEY);
				$msg = '<html>Hi '.$userData['firstName']. '<br> Please use below link to verify your email : http://capstone.devview.info/user/verifyUser?email='.$encrypt_email.'  </body></htmml>';
				$this->email->message($msg);
				$this->email->send();
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
		exit;
	}
	
	public function getUserDetails(){
		$post = $this->input->post();
		$result = array();
		if(!isset($post['email'])){
			$result['msg'] = 'User email not found';
		}else{
			$result = $this->User_model->getUserDetails($post['email']);
		}
		echo json_encode($result);
		exit;
	}
	
	public function changePassword(){
		$post = $this->input->post();
		$result = array();
		$error = array();
		if(!isset($post['email'])){
			$error[] = 'email';
		}
		if(!isset($post['password'])){
			$error[]  = 'password';
		}
		if(empty($error)){
			$result = $this->User_model->changePassword($post['email'], $post['password']);
		}else{
			$result['status'] = false;
			$result['missing_fields'] = $error;
			$result['msg'] = 'Missing or invalid data.';
		}
		echo json_encode($result);exit;
	}
	
	public function forgotPassword(){
		$post = $this->input->`post();
		$result = array();
		$error = array();
		if(!isset($post['email'])){
			$error[] = 'email';
		}
		if(empty($error)){
			$user = $this->User_model->getUserById($post['email']);
			if(!empty($user)){
				$this->load->library('email');
				$this->email->set_header('Content-type', 'text/html; charset=UTF-8');
				$this->email->set_header('MIME-VErsion', '1.0');
				$this->email->set_header('Content-type', 'text/html; charset=UTF-8');
				$this->email->from('no-reply@proshopping.com', 'ecom proshop');
				$this->email->to($post['email']);
				$this->email->bcc('nrupen92@gmail.com');
				$this->email->subject('User request to Retrive password');
				$new_password = $this->randomPassword();
				$this->User_model->changePassword($user->email, $new_password);
				$msg = '<html>Hi '.$user->firstname. '<br> Please use below password to login.<br> password :'.$new_password. '</body></htmml>';
				$this->email->message($msg);
				$this->email->send();
				$result['status'] = TRUE;
				$result['msg'] = 'Email sent for instruction.';
			}else{
				$result['status'] = FALSE;
				$result['msg'] = 'User not found';
			}
		}else{
			$result['status'] = false;
			$result['missing_fields'] = $error;
			$result['msg'] = 'Missing or invalid data.';
		}
		echo json_encode($result);exit;
	}
	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	public function verifyUser(){
		$get = $this->input->get();
		$email = $this->decrypt($get['email'], ENCRYPTION_KEY);
		$result = $this->User_model->user_verification($email);
		if($result['status']){
			echo 'User email varified. Please login to system';
		}else{
			echo 'User not found. Please contact to support';
		}
		
	}
	
	function encrypt($pure_string, $encryption_key) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
		return $encrypted_string;
	}
	
	function decrypt($encrypted_string, $encryption_key) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
		return $decrypted_string;
	}
}
