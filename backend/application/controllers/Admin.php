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
			$data['admin_user'] = $this->session->user;
			$this->load->view('userhome',$data);
		}else{
			redirect('/admin/index');
		}
	
	}
	
	public function addproduct(){
		if(isset($this->session->user)){
			$post= $this->input->post();
			
			if(!empty($post)){
				
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				
				$upload = $this->upload_data("imageFile", $config);
				$product = array();
				$product['product_name'] = $post['product_name'];
				$product['price'] = $post['price'];
				$product['is_active'] = $post['isActive'];
				$product['desc'] = serialize(array('material'=> $post['material'], 'color'=> $post['color'],'type' =>$post['type'], 'brand' => $post['brand'],'gender' => $post['gender'],'size' => $post['size'], 'details' => $post['desc']));
				$product['rating'] =0;
				$product['rating_count'] =0;
				$product['productImage'] = $upload['productImage'];
				$result = $this->Product_model->createProduct($product);
				if($result['status']){
					$result['msg'] = 'Product successfully added.';
					$this->load->view('addProduct', array('result'=> $result, 'admin_user' => $this->session->user));
				}else{
					$this->load->view('addProduct', array('result'=> $result, 'admin_user' => $this->session->user));
				}
			}
			$this->load->view('addProduct', array('admin_user' => $this->session->user));
			
		}else{
			redirect('/admin/index');
		}
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
	
	
	public function manageproduct(){
		if(isset($this->session->user)){
			$post = $this->input->post();
			if(!empty($post)){
				if(!empty($post['update'])){
					if(isset($post['isActive']) && $post['isActive']=='on'){
						$data['isActive'] =1;
					}else{
						$data['isActive'] =0;
					}
					$result = $this->Admin_model->update_product($post['id'], $data);
					$products = $this->Product_model->get_products();
					$this->load->view('manageProduct', array('products'=>$products, 'result' => $result, 'admin_user' => $this->session->user));
				}else if(!empty($post['delete'])){
					$result = $this->Admin_model->delete_product($post['id']);
					$products = $this->Product_model->get_products();
					$this->load->view('manageProduct', array('products'=>$products, 'result' => $result, 'admin_user' => $this->session->user));
				}
			}
			$products = $this->Product_model->get_products();
			$this->load->view('manageProduct', array('products'=>$products, 'admin_user' => $this->session->user));
		}else{
			redirect('/admin/index');
		}
		
	}
	
	public function manageOrder(){
		if(isset($this->session->user)){
			$post = $this->input->post();
			if(!empty($post['update'])){
				$data = array('orderStatus' => $post['order_status'], 'quantity' => $post['quantity']);
				$result = $this->Admin_model->order_update($post['id'], $data);
			}else if(!empty($post['delete'])){
				$result = $this->Admin_model->delete_order($post['id']);
			}
			$orders = $this->Admin_model->getOrders();
			$data = array('orders'=> $orders);
			$status = array('New','Received', 'Processing', 'Pending', 'Shipped', 'Delivered');
			$data['order_Status'] = $status;
			$data['admin_user'] = $this->session->user;
			$this->load->view('manageorder',$data);
		}else{
			redirect('/admin/index');
		}
	}
	
	public function manageuser(){
		if(isset($this->session->user)){
			$post = $this->input->post();
			
			if(!empty($post['Update'])){
				
				if($post['user_status'] == 'admin'){
					$post['user_status'] = 2;
				}else{
					$post['user_status'] = 1;
				}
				$data = array('userRole' => $post['user_status']);
				$result = $this->Admin_model->user_update( $data, $post['id']);
			}else if(!empty($post['delete'])){
				$result = $this->Admin_model->user_delete($post['id']);
			}
			$users = $this->Admin_model->getusers();
			$data = array('users'=> $users);
			$data['result'] = $result;
			$data['admin_user'] = $this->session->user;
			$data['user_role'] = array('admin','normal');
			$this->load->view('manageuser',$data);
		}else{
			redirect('/admin/index');
		}
	}
	
	public function logout(){
		unset($this->session->user);
		redirect('/admin/index');
	}
}
