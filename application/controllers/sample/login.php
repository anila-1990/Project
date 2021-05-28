<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

/*	
 *	@author : Aauthsoft
 *	date	: 1 August, 2014
 *  Version : 1.0
 *	Aauthsoft School & College Management System
 *	http://aauthsoft.com/
 */
 
 
class Login extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
		$this->load->model('Global_model','modglo');
		
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }
	
    //Default function, redirects to logged in user area
    public function index()
    {
		$this->modglo->checkUserSession();
			if( $_POST["username"] != NULL and $_POST["password"] != NULL){
					$email 		= $_POST["username"];
					$password 	= $_POST["password"];
					$response['submitted_data'] = $_POST;		
					$login_status = $this->modglo->checkLogin();
					//Validating login
					//$login_status = $this->validate_login( $email ,  $password );
					$response['login_status'] = $login_status;
					if ($login_status == true) {
						 redirect(base_url() . 'dashboard', 'refresh');
					//	$response['redirect_url'] = '';
					}else{ 
												$data['error'] = 1;
					}
			}
		
       
			
		 $this->load->view('backend/login_soft', $data);
        
    }
    
	
	
	//Ajax login function 
	function ajax_login()
	{
		$response = array();
		
		//Recieving post input of email, password from ajax request
		$email 		= $_POST["email"];
		$password 	= $_POST["password"];
		$response['submitted_data'] = $_POST;		
		
		//Validating login
		$login_status = $this->validate_login( $email ,  $password );
		$response['login_status'] = $login_status;
		if ($login_status == 'success') {
			$response['redirect_url'] = '';
		}
		
		//Replying ajax request with validation response
		echo json_encode($response);
	}
    
    //Validating login from ajax request
    function validate_login($email	=	'' , $password	 =  '')
    {
		
		 $credential	=	array(	'email' => $email , 'password' => $password );
		 $this->modglo->check_login( $credential);
		 
		 // Checking login credential for admin
        $query = $this->db->get_where('admin' , $credential);
		//print_r($query->num_rows());exit;
        if ($query->num_rows() > 0) {
            $row = $query->row();
			  $this->session->set_userdata('admin_login', '1');
			  $this->session->set_userdata('admin_id', $row->admin_id);
			  $this->session->set_userdata('name', $row->name);
			  $this->session->set_userdata('login_type', 'admin');
			  return 'success';
		}
		 
		 // Checking login credential for teacher
        $query = $this->db->get_where('teacher' , $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			  $this->session->set_userdata('teacher_login', '1');
			  $this->session->set_userdata('teacher_id', $row->teacher_id);
			  $this->session->set_userdata('name', $row->name);
			  $this->session->set_userdata('login_type', 'teacher');
			  return 'success';
		}
		 
		 // Checking login credential for student
        $query = $this->db->get_where('student' , $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			  $this->session->set_userdata('student_login', '1');
			  $this->session->set_userdata('student_id', $row->student_id);
			  $this->session->set_userdata('name', $row->name);
			  $this->session->set_userdata('login_type', 'student');
			  return 'success';
		}
		 
		 // Checking login credential for parent
        $query = $this->db->get_where('parent' , $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			  $this->session->set_userdata('parent_login', '1');
			  $this->session->set_userdata('parent_id', $row->parent_id);
			  $this->session->set_userdata('name', $row->name);
			  $this->session->set_userdata('login_type', 'parent');
			  return 'success';
		}
		
		return 'invalid';
    }
    
    /***DEFAULT NOR FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    

	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
	function reset_password()
	{
		$account_type = $this->input->post('account_type');
		if ($account_type == "") {
			redirect(base_url(), 'refresh');
		}
		$email  = $this->input->post('email');
		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
		if ($result == true) {
			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));
		} else if ($result == false) {
			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
		}
		
		redirect(base_url(), 'refresh');		
	}
    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() , 'refresh');
    }
	
	###########################################################################3
	public function update_acc_year(){
		
		if($_POST){
   	       $add_course = $this->modglo->add_update_acc_year( );
   	       if($add_course){
   	       	$page_data['success_msg'] =1;
   	       
   	       }
   	       else {
   	       	$page_data['error_msg'] =1;
   	       }
   		}
	 	   $page_data['page_name']  = 'add_acc_year';
	 	  
       	   $page_data['page_title'] = get_phrase('add_acc_year');
       	   $page_data['level_plugin_style'] = 0;
       	   $page_data['theme_style'] = 1;
       	   $page_data['table_list'] =0;
       	   $page_data['dashboard_js'] = 0;
       	   if($add_course){
       	   	$page_data['message']=1;
       	   }
		
		  $this->load->view('backend/header', $page_data);
		  $this->load->view('backend/settings/add_acc_year', $page_data);
		  $this->load->view('backend/footer', $page_data); 
		}
		
	public function add_next_acc_year(){
				if($_POST){
					
   	       $add_course = $this->modglo->add_next_update_acc_year();
		  
   	       if($add_course){
			   redirect( base_url().'dashboard');
   	       	$page_data['success_msg'] =1;
   	       
   	       }
   	       else {
   	       	$page_data['error_msg'] =1;
   	       }
   		}
	 	   $page_data['page_name']  = 'add_acc_year';
	 	  
       	   $page_data['page_title'] = get_phrase('add_next_acc_year');
       	   $page_data['level_plugin_style'] = 0;
       	   $page_data['theme_style'] = 1;
       	   $page_data['table_list'] =0;
       	   $page_data['dashboard_js'] = 0;
       	   if($add_course){
       	   	$page_data['message']=1;
       	   }
		$query = $this->db->query("SELECT * FROM academic_year where ( CURDATE() between  academic_year_start and  academic_year_end ) and status='1'   ");
					$detail =  $query->result_array();	
					
			 $page_data['act_acc_year'] = $detail[0]; 		
		  $this->load->view('backend/header', $page_data);
		  $this->load->view('backend/settings/add_next_acc_year', $page_data);
		  $this->load->view('backend/footer', $page_data); 
		}
    
	public function add_acc_year(){
				if($_POST){
					
   	       $add_course = $this->modglo->add_next_update_acc_year();
		  
   	       if($add_course){
			   redirect( base_url().'dashboard');
   	       	$page_data['success_msg'] =1;
   	       
   	       }
   	       else {
   	       	$page_data['error_msg'] =1;
   	       }
   		}
	 	   $page_data['page_name']  = 'add_acc_year';
	 	  
       	   $page_data['page_title'] = get_phrase('add_next_acc_year');
       	   $page_data['level_plugin_style'] = 0;
       	   $page_data['theme_style'] = 1;
       	   $page_data['table_list'] =0;
       	   $page_data['dashboard_js'] = 0;
       	   if($add_course){
       	   	$page_data['message']=1;
       	   }
		$query = $this->db->query("SELECT * FROM academic_year where ( CURDATE() between  academic_year_start and  academic_year_end ) and status='1'   ");
					$detail =  $query->result_array();	
					
			 $page_data['act_acc_year'] = $detail[0]; 		
		  $this->load->view('backend/header', $page_data);
		  $this->load->view('backend/settings/add_next_acc_year', $page_data);
		  $this->load->view('backend/footer', $page_data); 
		}
	
}
