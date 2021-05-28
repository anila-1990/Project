<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Backend_model extends CI_Model {

	

	function __construct()

    {

        parent::__construct();

    }

	

	function clear_cache()

	{

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

        $this->output->set_header('Pragma: no-cache');

	}

	

	
	 public function checkUserSession(){

		 $user_id  = $this->session->userdata('user_id'); 

		 if( empty($user_id)){

           			 redirect('backend/index');

			 

		 }else{

			

			 }

		}

	public function user_register(){

 //echo '<pre>';print_r($userdata);exit;

		$username 	= 	$this->input->post('username');

		$email 		= 	$this->input->post('email');

		$password 	= 	$this->input->post('password');

		

		$now = date('Y-m-d H:i:s');

		$session_data = array('username'=> $username, 

								  'email' => $email,

								  'is_admin'=> 1,

								  'status' => 1,

								  'password' => $password,

								  'create_date' =>$now

								  );

		

		$this->db->insert('user', $session_data);

		$id = $this->db->insert_id();

		

		if($id){

			return $id;

		}

	}

	


    public function get_user_details_by_session($id){

    

    	$query = $this->db->query("select * from user where user.user_id='".$id."' ");

    	$result = $query->result_array();

    	return $result[0];

    }




public function checkLogin() {

		//$this->load->library('encrypt');

		

		$username = trim($this->input->post('username') ); //exit;

		$password = $this->input->post('password');

		//$encode_password = $this->encrypt->encode($password);

		

		

		$this->db->select('*')->from('user')->where(array('username'=>$username,'status'=>1,'is_admin'=> 1))->limit(1, 0);

		$query = $this->db->get();		

		$result = $query->result_array();

		$decode = $result[0]['password'];

		

		//echo strcmp($this->encrypt->decode($result[0]['password']),$password);exit;		

		if(strcmp( $decode , $password) == 0) {

			

			$session_data = array('username'=> $result[0]['username'], 

								  'email' => $result[0]['email'],

								  'is_admin'=> 1,

								  'status' => 1,

								  'password' => $result[0]['password'],

								  'user_id' => $result[0]['user_id']

								  );

		$this->session->set_userdata($session_data);

			return true;

		
		}else{
			

			return false;	

		}

		

	}

	

	public function addproduct($name,$quantity,$tax,$unit_price,$user){

  $total_without_tax =$quantity * $unit_price;
        $sum = ($total_without_tax * $tax)/100;
        $total_with_tax = $total_without_tax + $sum;


		$data = array('user_id'=>$user,

									'name'=> $name, 

								  'quantity' => $quantity,

								 'unit_price'=>$unit_price,'tax'=>$sum,'total_without_tax'=>$total_without_tax,'total_with_tax'=>$total_with_tax,

								  'payable_amount'=>$total_with_tax

								  );

		

		$this->db->insert('invoice', $data);

		$id = $this->db->insert_id();

		

		if($id){

			return $id;

		} 
	}

public function adddiscount_product($user,$discount,$total){

 
		$data = array('user_id'=>$user,

									'discount'=> $discount, 

								  'total' => $total

								  );

		

		$this->db->insert('orders', $data);

		$id = $this->db->insert_id();

		

		if($id){

			return $id;

		} 
	}

	public function getallproducts($id){

    	

    $date = date('Y-m-d');
    	$query = $this->db->query("select * from invoice where invoice.user_id='".$id."' ");

    	$result = $query->result_array();

    	return $result;

    }
    public function getallproducts_for_pdf($id){

    	

    $date = date('Y-m-d');
    	$query = $this->db->query("select * from invoice where invoice.user_id='".$id."' ");

    	$result = $query->result_array();

    	return $result;

    }
    public function getproducts_price($id){

    	

    $date = date('Y-m-d');
    	$query = $this->db->query("select SUM(invoice.total_without_tax) as total_without_tax,SUM(invoice.total_with_tax) as total_with_tax from invoice where invoice.user_id='".$id."' group by invoice.user_id ");

    	$result = $query->result_array();

    	return $result[0];

    }
public function getdiscount($id){

    	

    $date = date('Y-m-d');
    	$query = $this->db->query("select * from orders where orders.user_id='".$id."' ");

    	$result = $query->result_array();

    	return $result[0];

    }






}



