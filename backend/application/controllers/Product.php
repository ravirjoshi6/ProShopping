<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Product_model' );
		$this->load->helper(array('form', 'url'));
		$this->load->database ();
		header ( 'Access-Control-Allow-Origin: *' );
		header ( "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept" );
		header ( 'Access-Control-Allow-Methods: GET, POST, PUT' );
	}
	public function index() {
		
		$this->load->view ( 'welcome_message', array('error' => ' ' ) );
	}
	public function create() {
		$userData = $this->input->post ();
		$error = array ();
		$result = array ();
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';

		$this->load->library('upload', $config);
		$this->upload->do_upload("imageFile");
		
		if($this->upload->do_upload())
		{
			$data = array('upload_data' => $this->upload->data());
			$userData['productImage'] = $data['upload_data']['file_name'];
		}else{
			$error[] = array('error' => $this->upload->display_errors());
		}
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
			$result = $this->Product_model->createProduct ( $userData );
		} else {
			$result ['status'] = FALSE;
			$result ['error'] = $error;
		}
		echo json_encode ( $result );
		exit ();
	}
	public function update() {
		$userData = $this->input->post ();
		$error = array ();
		$result = array ();
		$data = array ();
		if (! isset ( $userData ['product_name'] )) {
			$error [] = 'product_name';
		}
		if (isset ( $userData ['product_name'] )) {
			$data ['product_name'] = $userData ['product_name'];
		}
		if (isset ( $userData ['product_price'] )) {
			$data ['price'] = $userData ['product_price'];
		}
		if (isset ( $userData ['product_desc'] )) {
			$data ['description'] = $userData ['product_desc'];
		}
		if (isset ( $userData ['is_active'] ) && $userData ['is_active'] == "true") {
			$data ['isActive'] = TRUE;
		} else {
			$data ['isActive'] = FALSE;
		}
		
		if (empty ( $error )) {
			$result = $this->Product_model->update_product ( $userData ['product_name'], $data );
		} else {
			$result ['status'] = false;
			$result ['msg'] = 'User not found.';
		}
		echo json_encode ( $result );
		exit ();
	}
	public function delete() {
		$userData = $this->input->post ();
		if (! empty ( $userData ) && ! empty ( $userData ['product_name'] )) {
			$result = $this->Product_model->delete_product ( $userData ['product_name'] );
		} else {
			$result ['status'] = FALSE;
			$result ['msg'] = 'Product not found';
		}
		echo json_encode ( $result );
	}
	public function uploadImage() {
		$firstName = $_POST ["firstName"];
		$lastName = $_POST ["lastName"];
		$userId = $_POST ["userId"];
		
		$target_dir = "wp-content/uploads/2015/02"; // Here write our own target directory where we are keeping images of users
		
		if (! file_exists ( $target_dir )) {
			mkdir ( $target_dir, 0777, true );
		}
		
		$target_dir = $target_dir . "/" . basename ( $_FILES ["file"] ["name"] );
		
		if (move_uploaded_file ( $_FILES ["file"] ["tmp_name"], $target_dir )) {
			echo json_encode ( [ 
					"Message" => "The file " . basename ( $_FILES ["file"] ["name"] ) . " has been uploaded.",
					"Status" => "OK",
					"userId" => $_REQUEST ["userId"] 
			] );
		} else {
			
			echo json_encode ( [ 
					"Message" => "Sorry, there was an error uploading your file.",
					"Status" => "Error",
					"userId" => $_REQUEST ["userId"] 
			] );
		}
	}
}
