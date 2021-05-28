<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }
	
	function clear_cache()
	{
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}
	public function check_accademic_year(){
		$acc_year_id =  $this->session->userdata('acc_year_id'); 
		$date = date('Y-m-d');
		$query = $this->db->query("SELECT * FROM academic_year where ( CURDATE() between  academic_year_start and  academic_year_end ) and status='1'   ");
						$detail =  $query->result_array();
					//	echo $this->db->last_query();
				//	echo '<pre>';	print_r($detail); exit;
				###########################

				###############################
				
					if(empty( $detail )){
						
						$query_next = $this->db->query("SELECT * FROM academic_year where ( CURDATE() between  academic_year_start and  academic_year_end ) and status='2'   ");
						$detail_next = $query_next->result_array();
						//print_r(	$detail_next ); exit;
						if(!empty( $detail_next)) {
							 $data = array('status' => 0		 );
					         $this->db->update('academic_year', $data, array('status' => 1 ));
							 
							 $data1 = array('status' => 1		 );
					         $this->db->update('academic_year', $data1, array('id' => $detail_next[0]['id'] ));
							  $session_data = array('acc_year_id'=> $detail_next[0]['id'] );
						      $this->session->set_userdata($session_data);
							 
							// $this->check_accademic_year();
							}else{
					    		redirect( base_url() . 'login/update_acc_year/', 'refresh');
							}
					}
					if($acc_year_id==NULL){
						 $session_data = array('acc_year_id'=> $detail[0]['id'] );
						 $this->session->set_userdata($session_data);
					}
					
						$all = $this->session->all_userdata(); 
					$query = $this->db->query("SELECT * FROM academic_year where ( CURDATE() between  academic_year_start and  academic_year_end ) and status='1'   ");
					$detail =  $query->result_array();	
					$start =time();
					$end = strtotime($detail[0]['academic_year_end']);
				    $days_between = ceil(abs($end - $start) / 86400);
					if($days_between < 30){
						$query_next = $this->db->query("SELECT * FROM academic_year where  status='2'   ");
						$detail_next = $query_next->result_array();
						if(empty($detail_next)){
								redirect( base_url() . 'login/add_next_acc_year/', 'refresh');
							}
					}
				//echo '<pre>'; print_r($all); exit;
						//$start_date = ; $end_date = ; 
	return true;
	
	}
	
		public function check_accademic_year_by_date($date=NULL){
		$acc_year_id =  $this->session->userdata('acc_year_id'); 
		$date_check = date('Y-m-d', strtotime($date));
		
		$query = $this->db->query("SELECT * FROM academic_year where id='$acc_year_id' and ('$date_check' between  academic_year_start and  academic_year_end  )  and status='1' ");
						$detail =  $query->result_array();
					//	echo $this->db->last_query();
				//	echo '<pre>';	print_r($detail); exit;
				if(!empty( $detail )){
					if(  strtotime(date('Y-m-d') )  >= strtotime($date) ){
							return true;
					}
						//echo '<pre>';	print_r($detail); exit;
				}else{
					return false;
					}
					
						//$start_date = ; $end_date = ; 
	
	
	}
	
		public function check_accademic_year_for_period_by_date($date=NULL){
		$acc_year_id =  $this->session->userdata('acc_year_id'); 
		$date_check = date('Y-m-d', strtotime($date));
		
		$query = $this->db->query("SELECT * FROM academic_year where id='$acc_year_id' and ('$date_check' between  academic_year_start and  academic_year_end  ) and status='1' ");
						$detail =  $query->result_array();
					//	echo $this->db->last_query();
				//	echo '<pre>';	print_r($detail); exit;
				if(!empty( $detail )){
							return true;
						//echo '<pre>';	print_r($detail); exit;
				}else{
					return false;
					}
					
						//$start_date = ; $end_date = ; 
	
	
	}
		public function check_holiday_by_date($date=NULL){
		//echo  ini_get('date.timezone'); 
	//	echo date('y-m-d h:i:s'); exit;
		$acc_year_id =  $this->session->userdata('acc_year_id'); 
	 	$date_check = date('Y-m-d', strtotime($date));
	 $date_week = date('l', strtotime($date));
		
		$query = $this->db->query("SELECT * FROM course_batch_holidays_yearly  where acc_year_id='$acc_year_id' and holiday_date='$date_check'  ");
						$detail =  $query->result_array();
						
						$query_week = $this->db->query("SELECT * FROM week_days  where day_name='$date_week' and status='0'  ");
						$detail_week =  $query_week->result_array();
					//	echo $this->db->last_query();
				//echo '<pre>';	print_r($detail); exit;
				if(!empty( $detail )){
				return array ('holiday_type'=>'holiday', 'detail' => $detail[0] ); 
						//echo '<pre>';	print_r($detail); exit;
				}else if(!empty( $detail_week )){
				return array ( 'holiday_type'=>'weekend', 'detail' => $detail_week[0] );
						//echo '<pre>';	print_r($detail); exit;
				}else{
					return false;
					}
					
						//$start_date = ; $end_date = ; 
	
	
	}
	public function check_login( $data){
		$email = $data['email'];
		 $password = $data['password']; 
		$this->load->library('encrypt');
		$encode_password = $this->encrypt->encode( $password );
		$this->db->select('id,username,password,user_type_id, user_type')->from('users')->where(array('username'=>$username,'status'=>1))->limit(1, 0);
		$query = $this->db->get();		
		$result = $query->result_array();
		//print_r( $result); exit;
		//echo strcmp($this->encrypt->decode($result[0]['password']),$password);exit;		
		
	//exit;
	}
	function session_create($detail){
		$user_type = $detail['user_type'];
		$profile_id = $detail['user_type_id'];
		
		switch ($user_type) {
			case 'A':
						$query = $this->db->query("select * from admin where admin_id='$profile_id' ");
						$profile_detail =  $query->result_array();
				 $session_data = array('user_id'=> $detail['id'],
			                      'username'=> $detail['username'] , 
								  'email' => $detail['email'] ,
								  'user_type'=> $detail['user_type'],
								  'name' => $profile_detail[0]['name'], 
								  'profile_id'=> $profile_id );
				break;
				case 'P':
						$query = $this->db->query("select * from parent where parent_id='$profile_id' ");
						$profile_detail =  $query->result_array();
				 $session_data = array('user_id'=> $detail['id'],
			                      'username'=> $detail['username'] , 
								  'email' => $detail['email'] ,
								  'user_type'=> $detail['user_type'],
								  'name' => $profile_detail[0]['name'], 
								  'profile_id'=> $profile_id );
				break;
				case 'S':
						$query = $this->db->query("select * from student where student_id='$profile_id' ");
						$profile_detail =  $query->result_array();
				 $session_data = array('user_id'=> $detail['id'],
			                      'username'=> $detail['username'] , 
								  'email' => $detail['email'] ,
								  'user_type'=> $detail['user_type'],
								  'name' => $profile_detail[0]['name'], 
								  'profile_id'=> $profile_id );
				break;
				case 'E':
						$query = $this->db->query("select e.*,  CONCAT(e.emp_fname,' ',e.emp_lname) as emp_name from employee e where e.id='$profile_id' ");
						$profile_detail =  $query->result_array();
				 $session_data = array('user_id'=> $detail['id'],
			                      'username'=> $detail['username'] , 
								  'email' => $detail['email'] ,
								  'user_type'=> $detail['user_type'],
								  'name' => $profile_detail[0]['emp_name'], 
								  'profile_id'=> $profile_id,
								  'profile_pic_thumb' =>  base_url().'uploads/employees/'.$profile_detail[0]['profile_pic_thumb'] );
				break;
				
		}
		
			$this->session->set_userdata($session_data);
			self::check_accademic_year();
			return true;	
	}
	public function checkLogin() {
		$this->load->library('encrypt');
		
		$username = trim($this->input->post('username') ); //exit;
		$password = $this->input->post('password');
		$encode_password = $this->encrypt->encode($password);
		
		
		$this->db->select('*')->from('users')->where(array('username'=>$username,'status'=>1))->limit(1, 0);
		$query = $this->db->get();		
		$result = $query->result_array();
		
		$this->db->select('*')->from('users')->where(array('email'=>$username,'status'=>1))->limit(1, 0);
		$query1 = $this->db->get();		
		$result1 = $query1->result_array();
		
		//echo strcmp($this->encrypt->decode($result[0]['password']),$password);exit;		
		if(strcmp($this->encrypt->decode($result[0]['password']),$password)==0) {
			
			$this->session_create( $result[0] );
			return true;
			
		}else if(strcmp($this->encrypt->decode($result1[0]['password']),$password)==0) {
				
				$this->session_create( $result1[0] );
				return true;
			
		}else{
			return false;	
		}
		
	}
	
	public function checkUserSessionData(){
		$all = $this->session->all_userdata();
		self::check_accademic_year(); 
			//	echo '<pre>'; print_r($all); exit;
	   $acc_year_id =  $this->session->userdata('acc_year_id'); 
	   $user_id  = $this->session->userdata('user_id');  
	   //$action = $this->router->fetch_method();
	 // echo '<pre>';  print_r($this->session->all_userdata()); exit;
	 
	  if( $user_id == NULL || $user_id == 0 ){
				redirect( base_url() . 'login/');
		 }else{
	         
			 if( $acc_year_id==NULL || $acc_year_id== 0){
					    redirect( base_url() . 'login/update_acc_year/', 'refresh');
					}
			 
			 }
		}		
	 public function checkUserSession(){
		 $user_id  = $this->session->userdata('user_id'); 
		 if( $user_id){
           			 redirect(base_url() . 'dashboard/index', 'refresh');
			 
		 }else{
			 //redirect('/site/index');
			 }
		}
		public function fileUploadAndThumbCreation($file_feild, $thumb_width, $thumb_height){
					$data = array();
				
					if ( ! $this->upload->do_upload($file_feild))
						{
							$error = array('error' => $this->upload->display_errors());
							$data['error_message'] = $error['error'];
							$data['upload_status'] = 0;
							return $data;
						}
					else
	    			{
						               $data = array('upload_data' => $this->upload->data());
									   	$file_path = $data['upload_data']['file_path'];
									    $row_name = $data['upload_data']['raw_name'];
										$file_ext = $data['upload_data']['file_ext'];
										$source_file = $file_path . $row_name . ''.$file_ext;
										$mainfile =  $row_name . '' . $file_ext;
										$thumb_file =  $row_name . '_thumb'.$file_ext;
										$config = array();
										$config['image_library'] = 'gd2';
										$config['source_image']	= $source_file;
										$config['create_thumb'] = TRUE;
										$config['maintain_ratio'] = TRUE;
										$config['width']	 = $thumb_width;
										$config['height']	= $thumb_height;
										
										$this->load->library('image_lib', $config); 
										$this->image_lib->initialize($config);
										$this->image_lib->resize();	
										if((file_exists($source_file))){
											  $data['upload_status'] = 1;
											  $data['main_file'] = $mainfile;
											  $data['thumb'] = $thumb_file;
											  return $data;
											}		
					}
		
		}
	
	public function add_next_update_acc_year(){
		 //echo '<pre>'; print_r( $_POST);
		$data = array('academic_year_start' => date('Y-m-d', strtotime( $_POST['start'] )), 
								  'academic_year_end' =>date('Y-m-d', strtotime(  $_POST['end'] )),
								  'status' =>  2  );
								// echo '<pre>';   print_r($data); exit;
					 $this->db->insert('academic_year', $data);
					 $id = $this->db->insert_id(); 	
					 return true;
		}	
}

