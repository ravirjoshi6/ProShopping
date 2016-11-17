<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Product_model' );
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
		if (! isset ( $userData ['product_name'] )) {
			$error [] = 'product';
		}
		if (! isset ( $userData ['product_price'] )) {
			$error [] = 'price';
		}
		if (! isset ( $userData ['product_desc'] )) {
			$error [] = 'Product Description';
		}
		if (! isset ( $userData ['is_active'] )) {
			$error [] = 'Status ';
		}
		if (empty ( $error )) {
			$result= $this->Product_model->createProduct($userData);				
		} else {
			$result['status'] = FALSE;
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
		if (! isset ( $userData ['product_name'] )) {
			$error [] = 'product_name';
		}
		if ( isset ( $userData ['product_name'] )) {
			$data['product_name'] = $userData ['product_name'];
		}
		if (isset ( $userData ['product_price'] )) {
			$data ['price'] = $userData ['product_price'];
		}
		if (isset ( $userData ['product_desc'] )) {
			$data ['description'] = $userData ['product_desc'];
		}
		if (isset ( $userData ['is_active'] ) && $userData['is_active'] == "true") {
			$data ['isActive'] = TRUE;
		}else{
			$data ['isActive'] = FALSE;
		}
		
		if(empty($error)){
			$result = $this->Product_model->update_product($userData['product_name'], $data);
		}else{
			$result['status'] = false;
			$result['msg'] = 'User not found.';
		}
		echo json_encode($result);
		exit;
	}

	public function delete(){
		$userData = $this->input->post ();
		if(!empty($userData) && !empty($userData['product_name'])){
			$result = $this->Product_model->delete_product($userData['product_name']);
		}else{
			$result['status'] = FALSE;
			$result['msg'] = 'Product not found';
		}
		echo json_encode($result);
	}
	
	
	
	// user create functions
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
			$result ['id'] = $this->Api_model->checkLogin ( $userData ['email'], $userData ['password'] );
		} else {
			$result ['error'] = $error;
		}
		echo json_encode ( $result );
		exit ();
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
			if (! $this->Api_model->getUserById ( $userData ['email'] )->status) {
				$result = $this->Api_model->saveUser ( $userData, TRUE );
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
	
	
	
}
