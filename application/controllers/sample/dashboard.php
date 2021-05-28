<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');

/*	
 *	@author : Aauthsoft
 *	date	: 1 August, 2014
 *  Version : 1.0
 *	Aauthsoft School & College Management System
 *	http://aauthsoft.com/
 */

class Dashboard extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Global_model','modglo');
		$this->modglo->checkUserSessionData();
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Dashboard_model','moddash');
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
   
    
    /***ADMIN DASHBOARD***/
  public   function index()
    {
    // echo '<pre>';  print_r($this->session->all_userdata()); exit;
          $page_data['page_name']  = 'dashboard';
          $page_data['page_title'] = get_phrase('admin_dashboard');
          $page_data['level_plugin_style'] = 1;
          $page_data['theme_style'] = 1;
          $page_data['dashboard_js'] = 1;
          
		
          $this->load->view('backend/header', $page_data);
		  $this->load->view('backend/admin/dashboard', $page_data);
		  $this->load->view('backend/footer', $page_data);
    }
    
    
 public function  office_profile($param1 = '', $param2 = '', $param3 = ''){
	    if ($param1 == 'create') {
			echo '<pre>'; print_r( $_REQUEST ); exit;
         		$this->modcourse->add_update_course();
            redirect(base_url() . 'courses/all_courses/', 'refresh');
        }
        if ($param1 == 'do_update') {
                   $this->modcourse->add_update_course($param2); 
            redirect(base_url() . 'courses/all_courses/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] =$this->db->get_where('courses', array(        'id' => $param2      ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('courses');
            redirect(base_url() . 'courses/all_courses/', 'refresh');
        }
		$query = $this->db->query("select os.*,  a.language  from office_settings os  left join app_language a on a.id=os.app_language_id where os.id='1' ");
		$detail =  $query->result_array();
        $page_data['office_detail']    =$detail[0] ;
        $page_data['page_name']  = 'office_profile';
        $page_data['page_title'] = get_phrase('office_profile');
        $page_data['theme_style'] = 1;
        $page_data['level_plugin_style'] = 0;
        $page_data['dashboard_js'] = 0;
        $page_data['table_list'] = 0;
		
          $this->load->view('backend/header', $page_data);
		  $this->load->view('backend/settings/office_detail', $page_data);
		  $this->load->view('backend/footer', $page_data);
	}
    ##################### anila ############################################### 
  
   public function office_profile_edit(){
	   
	   $this->load->model('dashboard_model');
	 
		$config['upload_path'] = './uploads/school/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']    = '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
        
        if($_POST){
        	$upload_data =  $this->modglo->fileUploadAndThumbCreation($file_feild = 'image', $thumb_width='200', $thumb_height='170');
        	//echo '<pre>'; print_r($upload_data); exit;
        	$updated = $this->dashboard_model->editprofilelist($upload_data);
        	//echo '<pre>'; print_r($updated); exit;
        	if($updated) {
        		$page_data['success_msg'] =1;
        	}
        }
        
        $query = $this->db->query("select os.*,  a.language  from office_settings os  left join app_language a on a.id=os.app_language_id where os.id='1' ");
        $detail =  $query->result_array();
        $page_data['office_detail']    =$detail[0] ;
      // echo '<pre>'; print_r($detail);
       $country_id = $detail[0]['country'];
       $state_id = $detail[0]['state'];
       
        $page_data['all_country'] = $this->dashboard_model->getAllCountry();
        $page_data['all_state'] =  $this->dashboard_model->getAllState_by_country_id( $country_id);
        $page_data['all_city'] =   $this->dashboard_model->getAllCity_by_state_id( $state_id );
        
        //echo '<pre>'; print_r( $page_data['all_city']  ); exit;
       // echo '<pre>'; print_r( $page_data['all_state'] ); exit;
        $page_data['page_name']  = 'office_profile_detail';
        $page_data['page_title'] = get_phrase('office_profile_detail');
        $page_data['theme_style'] = 1;
        $page_data['level_plugin_style'] = 1;
        $page_data['dashboard_js'] = 1;
        $page_data['table_list'] = 0;
        $page_data['level_plugin_page_component'] = 1;
        
          $this->load->view('backend/header', $page_data);
		  $this->load->view('backend/settings/office_profile_edit', $page_data);
		  $this->load->view('backend/footer', $page_data);
	   
	  }
 
##################### end anila ####################################################
 

    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
       
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
       
        if ($param1 == 'do_update') {
			 
			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_title');
			 $this->db->where('type' , 'system_title');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('address');
			 $this->db->where('type' , 'address');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('phone');
			 $this->db->where('type' , 'phone');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('paypal_email');
			 $this->db->where('type' , 'paypal_email');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('currency');
			 $this->db->where('type' , 'currency');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_email');
			 $this->db->where('type' , 'system_email');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('buyer');
			 $this->db->where('type' , 'buyer');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('system_name');
			 $this->db->where('type' , 'system_name');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('purchase_code');
			 $this->db->where('type' , 'purchase_code');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('language');
			 $this->db->where('type' , 'language');
			 $this->db->update('settings' , $data);
			 
			 $data['description'] = $this->input->post('text_align');
			 $this->db->where('type' , 'text_align');
			 $this->db->update('settings' , $data);
			 
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
       // $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
   
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
       
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['level_plugin_style'] = 1;
        $page_data['theme_style'] = 1;
        $page_data['table_list'] =1;
        $page_data['dashboard_js'] = 1;
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
	################################################   Surya 
	public function manage_acc_year()
	{
 		
		
		$item= $this->moddash->listAcademicYear();
		$page_data['list1'] = $item;
		//echo '<pre>';  print_r($data['list1']);exit;
		$page_data['page_name']  = 'manage_acc_year';
        $page_data['page_title'] = get_phrase('manage_acc_year');
        $page_data['level_plugin_style'] = 0;
        $page_data['theme_style'] = 1;
        $page_data['table_list'] =1;
        $page_data['dashboard_js'] = 0;
		$this->load->view('backend/header' ,$page_data);
		$this->load->view('backend/settings/manage_acadamic',$page_data);
		$this->load->view('backend/footer' ,$page_data);
	
		
	}
	
	
	
	public function academic_year_edit( $id )
	
	{
		if($_POST) 
		{
		//echo '<pre>'; print_r($_REQUEST); exit;
		$item=$this->moddash->editAcademic($id);
		}
		
		
		 $result = $this->moddash->getAcademicYearDetail($id);
		 $page_data['detail'] =$result[0] ;
		//echo '<pre>'; print_r($page_data['list1']); exit;
		
		
	    $page_data['page_name']  = 'manage_acc_year';
        $page_data['page_title'] = get_phrase('form_year');
        $page_data['level_plugin_style'] = 1;
		$page_data['level_plugin_page_component'] = 1;
        $page_data['theme_style'] = 1;
        $page_data['table_list'] =1;
        $page_data['dashboard_js'] = 0;
		
		$this->load->view('backend/header' ,$page_data);
		$this->load->view('backend/settings/edit_academic',$page_data);
		$this->load->view('backend/footer' ,$page_data);
			
	}
	
#####################################################################	
	
	
public  function post_ajax_batches(){
	$course_id = $_REQUEST['course_id'];
	$batch_id = $_REQUEST['batch_id'];
	if($course_id ){
	$datas ='';
$datas .= ' <label class="control-label">'.get_phrase("batch").'</label>
			<select name="batch_id" id="batch_id" class="form-control" data-validate="required" data-message-required="'.get_phrase("value_required").'">
                              <option value="">'.get_phrase("select").'</option>';
                             
										$query_batch = $this->db->query("select * from course_batch cb where cb.course_id='$course_id' order by cb.id asc ");
	$bat_list = 	$query_batch->result_array();
										foreach($bat_list  as $row):
											
                                    		$datas  .='<option value="'.$row['id'].'">'. $row['batch_name'].' </option> ';
                                        
										endforeach;
								 
                         $datas  .= ' </select>	<script> jQuery("#batch_id" ).change(function() {
	   var batch_id =   jQuery("#batch_id").val();
			  jQuery.ajax({
					type: "POST",
					dataType:"html",
					url: "'.base_url().'dashboard/post_ajax_batches",
				   
					data: "batch_id="+batch_id,
					cache:false,
					success: 
					  function(data){
						 jQuery("#sec_div_id").html(data).fadeIn("fast"); 
					  }
					}); 
  });</script>'; 
						echo $datas ;
	}
	if($batch_id){
		$datas ='';
$datas .= ' <label class="control-label">'.get_phrase("sec_language").'</label>
			<select name="sec_id" id="sec_id" class="form-control" data-validate="required" data-message-required="'.get_phrase("value_required").'">
                              <option value="">'.get_phrase("select").'</option>';
                             
										$query_batch = $this->db->query("select cbs.id , s.name from course_batch_subjects cbs left join subjects s on s.subject_id=cbs.subject_id where cbs.batch_id='$batch_id' and cbs.type='2' order by cbs.id asc ");
	$bat_list = 	$query_batch->result_array();
										foreach($bat_list  as $row):
											
                                    		$datas  .='<option value="'.$row['id'].'">'. $row['name'].' </option> ';
                                        
										endforeach;
								 
                         $datas  .= ' </select>	';
						 echo $datas ;
	}
	
	
}

public  function post_ajax_batches_transfer(){
	$course_id = $_REQUEST['course_id'];
	$batch_id = $_REQUEST['batch_id'];
	if($course_id ){
	$datas ='';
$datas .= '  <label class=" col-md-4 control-label">'.get_phrase("batch").'</label>
  <div class="col-md-8">
			<select name="batch_id" id="batch_id1" class="form-control input-sm" data-validate="required" data-message-required="'.get_phrase("value_required").'">
                              <option value="">'.get_phrase("select").'</option>';
                             
										$query_batch = $this->db->query("select * from course_batch cb where cb.course_id='$course_id' order by cb.id asc ");
	$bat_list = 	$query_batch->result_array();
										foreach($bat_list  as $row):
											
                                    		$datas  .='<option value="'.$row['id'].'">'. $row['batch_name'].' </option> ';
                                        
										endforeach;
								 
                         $datas  .= ' </select></div>	<script> jQuery("#batch_id1" ).change(function() {
	  $( "#form1_acc" ).submit();
  });</script>'; 
						echo $datas ;
	}
	
	
	
}

public  function post_ajax_batches_transfer_ac(){
	$course_id = $_REQUEST['course_id'];
	$batch_id = $_REQUEST['batch_id'];
	if($course_id ){
	$datas ='';
$datas .= '  <label class=" col-md-4 control-label">'.get_phrase("batch").'</label>
  <div class="col-md-8">
			<select name="batch_id2" id="batch_id2" class="form-control input-sm" data-validate="required" data-message-required="'.get_phrase("value_required").'">
                              <option value="">'.get_phrase("select").'</option>';
                             
										$query_batch = $this->db->query("select * from course_batch cb where cb.course_id='$course_id' order by cb.id asc ");
	$bat_list = 	$query_batch->result_array();
										foreach($bat_list  as $row):
											
                                    		$datas  .='<option value="'.$row['id'].'">'. $row['batch_name'].' </option> ';
                                        
										endforeach;
								 
                         $datas  .= ' </select></div>	<script> jQuery("#batch_id2" ).change(function() {
	  $( "#form1_acc" ).submit();
  });</script>'; 
						echo $datas ;
	}
	
	
	
}

############################################ anila   ###############################################################

public  function post_ajax_states(){
	 $country_id = $_REQUEST['country_id'];
	 $state_id = $_REQUEST['state_id'];
	if($country_id ){
		
		$all_state =  $this->dashboard_model->getAllState_by_country_id( $country_id);
		$datas ='';
		$datas .= '<option value="">'.get_phrase("select").'</option>';
		  foreach( $all_state as $each){ 
		  	$datas .= '<option  value="'.$each["id"].'">'.$each["state_name"].'</option>';
		  	
		  }
		
		echo $datas ;
	}
	if($state_id){
			$all_city =  $this->dashboard_model->getAllCity_by_state_id( $state_id );
		$datas ='';
		$datas .= '<option value="">'.get_phrase("select").'</option>';
		  foreach( $all_city as $each){ 
		  	$datas .= '<option  value="'.$each["id"].'">'.$each["city_name"].'</option>';
		  	
		  }
		
		echo $datas ;
	}


}

public function get_book_name(){
	$term = $_REQUEST['term'];


	$this->db->select('book_id, book_title');
	$this->db->from('lb_books');
	$this->db->like('book_title', $term);
	$this->db->limit('10');
	$query = $this->db->get();

	if ($query->num_rows() > 0)
	{
		$data['response'] = 'true'; //If username exists set true
		$data['message'] = array();

		foreach ($query->result() as $row)
		{
			$data['message'][] = array('label' => $row->book_title.'-ID'.$row->book_id,
					'value' => $row->book_title,
					
					
			);
		}
	}
	else
	{
		$data['response'] = 'false'; //Set false if user not valid
	}

	echo json_encode($data);
}

public  function post_ajax_student_id(){
	$student_id = $_REQUEST['student_id'];
	$emp_id = $_REQUEST['emp_id'];
	
	if($student_id ){
		
		$student_details =	$this->library_model->getstudentdetails($student_id);
		$book_details =	$this->library_model->getstudent_book_details($student_id);
		$data['json'] = array('student'=>$student_details,'books'=>$book_details);
		//$data['json'] = ;
		 echo json_encode($data);exit;
		 
		
		
	}
	if($emp_id){
		$employee_details =	$this->library_model->getemployeedetails($emp_id);
		$book_details =	$this->library_model->getemp_book_details($emp_id);
		$data['json'] = array('employee'=>$employee_details,'books'=>$book_details);
		 echo json_encode($data);
	}


}

public  function post_ajax_student(){
	$student_id = $_REQUEST['student_id'];
	$emp_id = $_REQUEST['emp_id'];

	if($student_id ){
		$student_details =	$this->library_model->getstudentdetails($student_id);
		
		$datas ='';
		$datas .='<div class="row">
						
						<div class="col-md-12">
                              <div class="row">
                              <div class="col-md-2"> 
                           
                              <ul class="list-unstyled profile-nav">
                                 <li id="profile_image"><img src="" class="img-responsive" alt="" /> 

                                 </li>
                                 
                              </ul>
                           </div>
                                 <div class="col-md-10 profile-info">
                                
                        <form class="form-horizontal" role="form" id="form">
                        <div class="form-body">
                     		
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          
                                             <label class="control-label col-md-4">'.get_phrase('name').'</label>
                                             
                                                 <p class="form-control-static">:<span style="margin-left: 5px; font-weight: bold;" id="st_name"> '.$student_details["first_name"].' </span></p>
                                            
                                             
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                         
                                              <label class="control-label col-md-4">'.get_phrase('address').'</label>
                                            
                                                <p class="form-control-static">:  <span style="margin-left: 5px; font-weight: bold;" id="address"> '.$student_details["address"].' </span></p>
                                            
                                             
                                          </div>
                                       </div> 
                                       <div class="col-md-6">
                                          <div class="form-group">
                                         
                                             <label class="control-label col-md-4">'.get_phrase('phone').'</label>
                                             
                                               <p class="form-control-static">:  <span style="margin-left: 5px; font-weight: bold;" id="phone"> '.$student_details["phone"].'  </span></p>
                                            
                                             
                                          </div>
                                       </div> 
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          
                                             <label class="control-label col-md-4">'.get_phrase('email').'</label>
                                            
                                                <p class="form-control-static">:  <span style="margin-left: 5px; font-weight: bold;" id="email"> '.$student_details["email"].' </span></p>
                                           
                                             
                                          </div>
                                       </div> 
                                       <div class="col-md-6">
                                          <div class="form-group">
                                          
                                             <label class="control-label col-md-4">'.get_phrase('issued_book_copies').'</label>
                                             
                                                <p class="form-control-static">:  <span style="margin-left: 5px; font-weight: bold;" id="issue_book"> '.$student_details["count"].' </span></p>
                                             
                                             
                                          </div>
                                       </div>
                                                		</div>
                                       </form>

                                    
                                 </div>
                                
                              </div>
         
									              
                                    </div>
							</div>
                                                		<table class="table table-striped table-bordered table-advance table-hover" id="book_list">
                        <thead>
                           <tr>
                            
                              <th class="hidden-xs">'.get_phrase('book_name').'</th>
                               <th class="hidden-xs">'.get_phrase('book_copies').'</th>
                             <th class="hidden-xs">'.get_phrase('options').'</th>
                           </tr>
                        </thead>
                        <tbody>
							
						
                        
                                            ';
		
		$book_details =	$this->library_model->getstudent_book_details($student_id);
		
		foreach($book_details  as $row):
		$datas .='<tr><td>'.$row["book_title"].'</td>
				<td>'.$row["book_copies"].'</td><td><button class="btn red" type="button" href="javascript:;" id="btnDelete">'.get_phrase('delete').'</button>
						</td></tr>';
		
	endforeach;
	$datas .='</tbody></table> <script>$("#btnDelete").click(function(){
	 jQuery.ajax({
					type: "POST",
					dataType:"html",
					url: "'.base_url().'dashboard/update_status/'+student_id.'",
				   
					
					cache:false,
					success: 
					  function(data){
						
					  }
	});
	});</script>';
		

$datas .='<div class="row">
	<div class="col-md-12">
	<div class="row">
	<div class="portlet-body form">
	
	<form id="form3" class="form-horizontal"  method="post" enctype="multipart/form-data">
	<div class="form-body">
	<h3 class="form-section">'.get_phrase('issue_book').'</h3>
	                          
	                              <table class="mytable" >
	                              <tr> 
	                                 <td>
	                                 <label>'.get_phrase('book_name').'</label>
	                                </td>
	                                 <td>
	                                  <input type="text" name="book_id[]" class="form-control" id="tag"/>
	                               </td>
	                                <td>
	                               <button class="btn purple add_book" type="button" ><i class="icon-plus"/>'.get_phrase('add_book').'</i>
	                               
	                                 </td>
	                              </tr>';
	                              
	                        $datas .='</table><script>$(".add_book").click(function(){
            			        $(".mytable tr:last").after("<tr class="child"><td><label>'.get_phrase('book_name').'</label></td><td><input type="text" name="book_id[]" class="form-control" id="tag"/></td>
            			        		<td><button class="btn red" type="button" id="btnDelete">'.get_phrase('delete').'</button></td></tr>");
	                        });
            			       </script>';    
	
	                              
	                             
	                        $datas .='<div class="form-group">
	                              <label class="control-label col-md-3">'.get_phrase('book_issue_date').'</label>
	                              <div class="col-md-3">
	                               <div class="input-group input-medium date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
	                                    <input type="text" class="form-control" name="book_issue_date"  >
	                                    <span class="input-group-btn ">
	                                    <button class="btn default" type="button"><i class="icon-calendar"></i></button>
	                                    </span>
	                                 </div>
	                                
	                                 
	                              </div>
	                           </div>
	                          
	                           
	                           <div class="form-group">
	                              <label class="control-label col-md-3">'.get_phrase('approax_date').'</label>
	                              <div class="col-md-3">
	                               <div class="input-group input-medium date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
	                                    <input type="text" class="form-control" name="approx_date_date"  >
	                                    <span class="input-group-btn ">
	                                    <button class="btn default" type="button"><i class="icon-calendar"></i></button>
	                                    </span>
	                                 </div>
	                                
	                                 
	                              </div>
	                           </div>
	                          
	                           
	                          
	                           
	                          
	                           
	                       <div>
	                           <div class="col-md-offset-3 col-md-9">
	                              <button type="submit" class="btn green">'.get_phrase('issue_book').'</button>
	                              <button type="button" class="btn default">Cancel</button>                              
	                           </div>
	                       </div>
	                     </form>
	                     </div>
	                     </div>      
	                           </div>
	                           </div>';
		//$data['json'] = array('student'=>$student_details,'books'=>$book_details);
		//$data['json'] = ;
		echo $datas;
			


	}
	

}



############################# end anila #########################################

}
