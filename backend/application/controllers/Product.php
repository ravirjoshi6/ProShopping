<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Product_model' );
		$this->load->helper(array('form', 'url'));
		$this->load->database ();
		$this->load->library('ecom');
		$this->load->library ( "JWT" );
		header ( 'Access-Control-Allow-Origin: *' );
		header ( "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept" );
		header ( 'Access-Control-Allow-Methods: GET, POST, PUT' );
		define ( "ENCRYPTION_KEY", "itsSecret!" );
		define ( 'CONSUMER_KEY', 'itsSecret@234!key' );
		define ( 'CONSUMER_SECRET', 'thatsOnlysecret#$%' );
		define ( 'CONSUMER_TTL', 86400 );
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
		if (! isset ( $userData ['auth_token'] )) {
			$error [] = 'auth_token ';
		}
		if (empty ( $error )) {
			$auth_result = $this->authenticateUser ( $userData ['auth_token'] );
			if ($auth_result->status) {
				$userData['product_desc'] =  serialize(json_decode($userData ['product_desc']));
				$result = $this->Product_model->createProduct ( $userData );
			}else{
				$result ['status'] = FALSE;
				$result ['msg'] = 'Invalid Auth Token';
			}
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
			$data ['desc'] = serialize(json_decode($userData ['product_desc']));
		}
		if (isset ( $userData ['is_active'] ) && $userData ['is_active'] == "true") {
			$data ['isActive'] = TRUE;
		} else {
			$data ['isActive'] = FALSE;
		}
		if (isset ( $userData ['auth_token'] )) {
			$data ['auth_token'] =$userData ['auth_token'];
		}
		if (empty ( $error )) {
			$auth_result = $this->authenticateUser ( $data ['auth_token'] );
			if ($auth_result->status) {
				unset($data['auth_token']);
				$result = $this->Product_model->update_product ( $userData ['product_name'], $data );
			}else{
				$result ['status'] = FALSE;
				$result ['msg'] = 'Invalid Auth Token';
			}
		} else {
			$result ['status'] = false;
			$result ['msg'] = 'User not found.';
		}
		echo json_encode ( $result );
		exit ();
	}
	public function delete() {
		$userData = $this->input->post ();
		if (! empty ( $userData ) && ! empty ( $userData ['product_id'] ) && !empty($userData['auth_token'])) {
			$auth_result = $this->authenticateUser ( $userData ['auth_token'] );
			if ($auth_result->status) {
				$result = $this->Product_model->delete_product ( $userData ['product_id'] );
			}else{
				$result ['status'] = FALSE;
				$result ['msg'] = 'Invalid Auth Token';
			}
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
		if(empty($product)){
			$result ['status'] = false;
			$result ['msg'] = 'No products found';
		}
		else{
			$result ['status'] = true;
			$result['products'] = $product;
		}
		echo json_encode($result);
		exit;
	}
	public function getProductDetails(){
		$post = $this->input->post();
		if (! isset ( $post ['id'] )) {
			$error [] = 'ID';
		}
		if(empty($error)){
			$product = $this->Product_model->get_product_details($post ['id']);
			$result ['status'] = true;
			$result['products'] = $product;
		}else{
			$result ['status'] = false;
			$result ['msg'] = 'Product not found';
		}
		echo json_encode($result);
		exit;
	}
	public function ratemyproduct(){
		$userData = $this->input->post ();
		$required_fields = array( 'product_id', 'rating', 'auth_token');
		$error = array();
		$result = array();
		foreach ($required_fields as $field){
			if(!array_key_exists($field, $userData)){
				$error['missing_field'][] = $field;
			}
		}
		if(empty($error)){
			$auth_result = $this->authenticateUser ( $userData ['auth_token'] );
			if ($auth_result->status) {
				if($this->Product_model->rateProduct($userData['product_id'], $userData['rating'])){
					$result['status'] = true;
				}else{
					$result['status'] = false;
				}
			}else{
				$result ['status'] = FALSE;
				$result ['msg'] = 'Invalid token';
			}
		}else{
			$error['status'] = false;
			$result = $error;
		}
		echo json_encode($result);exit;
	}
	public function authenticateUser($auth_token) {
		try {
			$user = $this->jwt->decode ( $auth_token, CONSUMER_SECRET );
			$result = $user;
			$result->status = TRUE;
		} catch ( Exception $e ) {
			$result = new stdClass ();
			$result->status = FALSE;
			$result->msg = 'Invalid Token';
		}
		return $result;
	}
	public function serialize(){
		$data = $this->input->post();
		print_r(serialize(json_decode($data['data'])));
	//	print_r(unserialize($data['data']));
		exit;
	}
}
