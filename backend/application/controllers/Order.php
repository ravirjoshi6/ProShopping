<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Order extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Order_model' );
		$this->load->model('User_model');
		$this->load->model('Product_model');	
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
		$post = $this->input->post();
		if(empty($post)){
			$post = json_decode(file_get_contents('php://input'),true);
		}
		$error =array();
		$result = array();
		$required_fields = array('product_id', 'user_id', 'quantity', 'price');
		$order_details = array();
		foreach ($required_fields as $field){
			if(!array_key_exists($field, $post)){
				$error['missing_field'][] = $field;
			}
		}
		
		if(empty($error)){

			$result['status'] = true;
			$order_details['product_id'] = $post['product_id'];
			$order_details['user_id'] = $post['user_id'];
			$order_details['quantity'] = $post['quantity'];
			$order_details['price'] = $post['price'];
			if(isset($post['addressID'])){
				$order_details['addressID'] = $post['addressID'];
			}else{
				$address_data = array ('user_id' => $post['user_id'], 
								'address_1' => $post['address_1'],
								'address_2' => $post['address_2'],
								'city' => $post['city'], 
								'state' => $post['state'], 
								'zipcode' => $post['zipcode'],
								'is_default' => 0, 
								'last_modified_date' => date ( "Y-m-d h:i:sa" ));
				$order_details['addressID'] = $this->User_model->add_address($address_data);
			}
			if(isset($post['paymentID'])){
				$order_details['paymentID'] = $post['paymentID'];
			}else{
				$payment_data = array('card_number' => $post['card_number'],
						'cvv' => $post['cvv'],
						'payment_status' => 'paid',
						'is_default' => 0,
						'last_modified_date' => date ( "Y-m-d h:i:sa" ));
				$order_details['paymentID'] = $this->Product_model->add_payment($payment_data);
			}
			$order_details['orderStatus'] = 'Received';
			$order_details['orderDate'] = date ( "Y-m-d h:i:sa" );
			$order_details['lastModifiedDate'] = date ( "Y-m-d h:i:sa" );
			$order_details['isCustomOrder'] = 0;
			$order_details['customorderId'] = NULL;
			$result['order_id'] = $this->Order_model->place_order($order_details);
			$result['status'] = true;
		}else{
			$error['status'] = false;
			$result = $error;

		}
		echo json_encode ( $result );
		exit ();
	}
	public function update() {
		
		echo json_encode ( $result );
		exit ();
	}
	public function delete() {
		
		echo json_encode ( $result );
	}
	public function getOrderStauts(){
		
	}
	
	public function getOrders(){
		
	}
	
	public function getOrderDetails(){
		
	}

	
}
