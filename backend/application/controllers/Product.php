<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Product_model' );
		$this->load->helper(array('form', 'url'));
		$this->load->database ();
		$this->load->library('ecom');
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
		
		$upload = $this->upload_data("imageFile", $config);
		
		if($upload['status']){
			$userData['productImage'] = $upload['productImage'];
		}else{
			$error[] = $upload['error'];
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
	public function upload_data($fieldName, $config)
	{
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$return = array();
		if($this->upload->do_upload($fieldName))
		{
			$data = array('upload_data' => $this->upload->data());
			$return['productImage'] = $data['upload_data']['file_name'];
			$return['status'] = TRUE;
		}else{
			$return['status']= FALSE;
			$return['error'] = $this->upload->display_errors();
		}
		return $return;
	}
	public function getProducts(){
		$product = $this->Product_model->get_products();
		echo json_encode($product);
		exit;
	}
	public function getProductDetails(){
		echo json_encode($this->Product_model->get_products());
		exit;
	}
	public function ratemyproduct(){
		$userData = $this->input->post ();
		$required_fields = array( 'product_id', 'rating');
		$error = array();
		$result = array();
		foreach ($required_fields as $field){
			if(!array_key_exists($field, $userData)){
				$error['missing_field'][] = $field;
			}
		}
		if(empty($error)){
			if($this->Product_model->rateProduct($userData['product_id'], $userData['rating'])){
				$result['status'] = true;
			}else{
				$result['status'] = false;
			}
			
		}else{
			$error['status'] = false;
			$result = $error;
		}
		echo json_encode($result);exit;
	}
}
