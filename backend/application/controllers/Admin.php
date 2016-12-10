<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'Order_model' );
		$this->load->model('Admin_model');
		$this->load->model('Product_model');
		
		$this->load->helper(array('form', 'url'));
		$this->load->database ();
		$this->load->library('ecom');
		$this->load->library('session');
		header ( 'Access-Control-Allow-Origin: *' );
		header ( "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept" );
		header ( 'Access-Control-Allow-Methods: GET, POST, PUT' );
		
	}

	public function index(){
		$post = $this->input->post();
		if(!empty($post)) {
			$user = array('email' => $post['email'], 'password' => $post['password']);
			$result = $this->Admin_model->check_login($user);
			if($result['status']){
				$this->session->user = $result;
				redirect('/admin/userhome');
			}else{
				$this->load->view('login',array('msg' =>'User not found. Try again'));
			}
		}else{
			$this->load->view('login', array());
		}
		//$this->load->view('login');
	}
	public function userhome(){

		if(isset($this->session->user)){
			
			//$this->load->view('userhome');
			$data= array();
			$data['user'] = $this->Admin_model->get_users();
			$data['products']=$this->Admin_model->get_products();
			$data['members']= $this->Admin_model->getUserCount()->total;
			$data['orders'] = $this->Admin_model->getpendingordercount()->total;
			$data['recent_orders'] = $this->Admin_model->getRecentOrders();
			$this->load->view('userhome',$data);
		}else{
			redirect('/admin/index');
		}
	
	}
	
	public function addproduct(){
		if(isset($this->session->user)){
			$this->load->view('addProduct');
			
		}else{
			redirect('/admin/index');
		}
	}
	public function manageproduct(){
		echo 123;exit;
	}
}
