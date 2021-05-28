<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public $data = array();

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
         $this->load->library('form_validation');
        $this->load->model('Backend_model');
        $this->load->database();
		$this->load->model('Backend_model','backmodal');
		
     
    }




	public function index($message=NULL)
    {
    	
        // $data = array('login'=>1);
         $data['login'] =1;
         $data['home_page'] =1;
         $data['error'] = 0;
             $data['message'] =0;
          if($message){
             $data['message'] =1;
          }
		 $this->load->view('backend/header',$data);
		
		$this->load->view('backend/login_form');
		
        
    }
    public function dashboard()
    {
    	
        // $data = array('login'=>1);
         $data['login'] =1;
         $data['home_page'] =1;
         $this->backmodal->checkUserSession();
          $data['user_id'] = $this->session->userdata('user_id');
         $session = $this->session->userdata();
//echo '<pre>';print_r($data['user_id']);exit;
         $data['user_detail'] =$this->backmodal->get_user_details_by_session($data['user_id']);
        
          //$data['result'] =$this->backmodal->get_all_category_data_list(); 
         //echo '<pre>';print_r($data['user_detail']);exit;
		 $this->load->view('backend/header',$data);
		$this->load->view('backend/sidebar',$data);
		$this->load->view('backend/index',$data);
		$this->load->view('backend/footer');
		
        
    }

    public function login()
    {
    	
        // $data = array('login'=>1);
         $data['login'] =1;
         $data['home_page'] =0;
        //$this->backmodal->checkUserSession();
         if($_POST){

			if( $_POST["username"] != NULL and $_POST["password"] != NULL){
					$username 		= $_POST["username"];
					$password 		= $_POST["password"];
							
					$login_status = $this->backmodal->checkLogin();
					//Validating login
					//echo '<pre>';print_r($login_status);exit;
					//$login_status = $this->validate_login( $email ,  $password );
					
					if ($login_status == 1) {
						 redirect(base_url() . 'backend/dashboard', 'refresh');
					//	$response['redirect_url'] = '';
					}else{ 
												$data['error'] = 1;
					}
			}
		
       }
			
		 $this->load->view('backend/login_form', $data);
		
		
        
    }

    public function create_account()
    {
		
       if($_POST){
      
       	
            $this->form_validation->set_rules('username', 'Name', 'required');
            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

          

            if($this->form_validation->run() == true){
                $insert = $this->backmodal->user_register();
            //echo '<pre>';print_r($insert);exit;
                if($insert){
                    $this->session->set_userdata('success_msg', 'Your registration is successfull. Please login to your account.');
                    redirect('backend/index', 'refresh');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        
		
		//$this->load->view('backend/login' );
		
        
    }
	public function logout(){
       
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect('backend/index/');
    }
    
    /*
     * Existing email check during validation
     */
    public function email_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('email'=>$str);
        $checkEmail = $this->backmodal->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }




public function post_ajax_sign_up_check(){
//echo '<pre>';print_r("success");exit;
    $term = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $count = count($password);
     //alert($term);
$this->db->select('*')->from('user')->where(array('email'=>$term,'is_admin'=>1))->limit(1, 0);
        $query = $this->db->get();      
        $result = $query->result_array();
 

   if(empty($result))
    {
        $data['response'] = 'true'; //If username exists set true
       
         
    }
    else
    {
        $data['response'] = 'false'; //Set false if user not valid
         

       
            
           $data['json'] = array('email' => $term,
                    'error' => "This email already exists");
    }

    echo json_encode($data);
}
public function pdf(){
    $user = $this->session->userdata('user_id');
    $this->load->helper('pdf_helper');
    $data['report'] = $this->backmodal->getallproducts_for_pdf($user);
    $this->load->view('backend/pdf',$data);

}
public function generate_invoice(){
     $data['login'] =1;
         $data['home_page'] =1;
         $this->backmodal->checkUserSession();
          $data['user_id'] = $this->session->userdata('user_id');
         $session = $this->session->userdata();
//echo '<pre>';print_r($data['user_id']);exit;
         $data['user_detail'] =$this->backmodal->get_user_details_by_session($data['user_id']);
        
          $data['pricelist'] =$this->backmodal->getproducts_price($data['user_id']); 
          $data['price'] =$this->backmodal->getdiscount($data['user_id']); 
          $data['result'] =  $this->backmodal->getallproducts($data['user_id']);
        //echo '<pre>';print_r($data['price']);exit;
         $this->load->view('backend/header',$data);
        $this->load->view('backend/sidebar',$data);
        $this->load->view('backend/invoice',$data);
        $this->load->view('backend/footer');

}
public  function gettotalprice(){

     $quantity = $_REQUEST['quantity'];

     $price = $_REQUEST['unit_price'];
     $tax =  $_REQUEST['tax'];

        $total =$quantity * $price;
        $sum = ($total * $tax)/100;
        $grandtotal = $total + $sum;

         $data['json'] = array('total' => $grandtotal);
    
    echo json_encode($data);
  

}


public  function addDiscount(){
$amount = $_REQUEST['amount'];
$type = $_REQUEST['discount'];

$user = $this->session->userdata('user_id');
   
        $pricelist = $this->backmodal->getproducts_price($user);
if($type= 1){
    $total = ($pricelist['total_with_tax'] * $amount) / 100;
    $sum = $pricelist['total_with_tax'] - $total;
} if($type=2) {

    $sum = $pricelist['total_with_tax'] - $amount;
    $total = $amount;
}
        $datas ='';
        $datas .=' <th><b>Grand Total: </b></th>
                                  <td id="grand_total">'.$sum.'</td>';
                                  $insert = $this->backmodal->adddiscount_product($user,$total,$sum);
                                  echo $datas;
                  
              }

public  function addproductdata(){
$quantity = $_REQUEST['quantity'];
$name = $_REQUEST['name'];
$tax =  $_REQUEST['tax'];
$unit_price =  $_REQUEST['unit_price'];
$user = $this->session->userdata('user_id');
    
    $insert =$this->backmodal->addproduct($name,$quantity,$tax,$unit_price,$user);
    if($insert){
        $result =  $this->backmodal->getallproducts($user);

        $datas ='';
        $datas .=' <div class="x_panel">
                  <div class="x_title">
                    <h2>Products </h2>
               
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                                          </i> Products List                                          
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                      
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 5%;">Sl.no</th>
                               
                                <th style="width: 20%;">Item Name</th>
                                 <th>Qunatity</th>
                                <th>Unit Price</th>
                                <th>Tax</th>
                                <th>Total</th>
                              </tr>
                            </thead><tbody>';
                            foreach($result as $row){
            $i=1;
                 $datas .='<tr><td>'.$i.'</td>
                 <td>'.$row['name'].'</td>
                 <td>'.$row['quantity'].'</td>
                 <td>'.$row['unit_price'].'</td><td>'.$row['tax'].'</td><td>'.$row['payable_amount'].'</td></tr>';
                 $i++;
             }
                           
                        $datas .='  </table> <div class="row">
                         <div class="col-xs-6"></div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                         
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>';
                                $user = $this->session->userdata('user_id');
              $pricelist = $this->backmodal->getproducts_price($user);

             $datas .='
                                <tr>
                                  <th style="width:50%">Subtotal(Excluding Tax):</th>
                                  <td id="subtotal_without_tax">'.$pricelist['total_without_tax'].'</td>
                                </tr>
                                <tr>
                                  <th>Subtotal(Including Tax)</th>
                                  <td id="subtotal_with_tax">'.$pricelist['total_with_tax'].'</td>
                                </tr>
                                <tr>
                                  <th>Discount: <select name="discount" id="discount"><option selected value="select">Select</option><option value="1">Percentage</option><option value="2">Amount</option></select>  </th>
                                  <td><input type="text" class="col-xs-4" name="discount_value" id="discount_value" ><a href="#" class="btn btn-primary btn-xs" onclick="addDiscount();">Apply </a></td>
                                </tr>
                                <tr id="total_amount"></tr>
                                 
                                
                             
                    ';
                            $datas .='  </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                        
                          <div class="row no-print">
                        <div class="col-xs-12">
                          
                          <a href="generate_invoice" class="btn btn-primary btn-xs" ><button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate Invoice</button></a>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>';
        
        
            


        echo $datas ;

    }
}


}

