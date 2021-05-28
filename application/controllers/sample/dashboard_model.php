<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }
	
	function clear_cache()
	{
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}
	
	############################################### anila  ##########################################
	public function editprofilelist($upload_data =NULL){
		$name = $this->input->post('name');
		$facebook_page = $this->input->post('facebook_page');
		$website = $this->input->post('website');
		$description = $this->input->post('description');
		$email = $this->input->post('email');
		$founded_date = $this->input->post('founded_date');
		$twitter = $this->input->post('twitter_page');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$paypal_id = $this->input->post('paypal_id');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$city=$this->input->post('city');
		$image=$upload_data['main_file'];
		$thumb=$upload_data['thumb'];
		$id = $this->input->post('id');
		if ( $image  != NULL) {
			$data_img = array('image'=>$image,'logo_thumb'=>$thumb );
				
				
			$this->db->update('office_settings',$data_img  );
		
		}
			
			$data = array('name'=>$name,'system_name'=>$name, 'system_title'=>$name,'address'=>$address, 'phone'=>$phone ,'email'=>$email,'website'=>$website,
					'facebook_page'=>$facebook_page,'description'=>$description,'twitter_page'=>$twitter,
					'founded_date'=>date('Y-m-d', strtotime($founded_date)), 'paypal_id' => $paypal_id ,
						  'country'=>$country,'state'=>$state,'city'=>$city);
			
			if($this->db->update('office_settings', $data)){
				return true;
			}else {
				return 	false;
			}
	}
	

	public function getAllCountry(){
		
		$query = $this->db->query("select id, name as country_name from countries order by name ");
		$detail =  $query->result_array();
		return $detail;
		
	}
	public  function getAllState_by_country_id( $country_id){
		
		$query = $this->db->query("select id, name as state_name from states where country_id='$country_id' order by name ");
		$detail =  $query->result_array();
		return $detail;
		
	}
	public function  getAllCity_by_state_id( $state_id ){
		$query = $this->db->query("select id, name as city_name from cities where  state_id='$state_id' order by name ");
		$detail =  $query->result_array();
		return $detail;
		
	} 
	
	##################################### end anila ##############################################
	
	
	##############################  Surya  #################################################3
				  
	public function listAcademicYear()
					{
		              $query = $this->db->query("select * from academic_year");
		              $detail =  $query->result_array();
		              //echo '<pre>'; print_r($detail); exit;
		              return $detail;
		
	                 }
	
	
	public function editAcademic( $id )
	               {
	                 //	echo $id ;  exit;
		             //echo '<pre>';print_r($_POST); exit;
			         $start = $this->input->post('start');
				     $end = $this->input->post('end');
					 $status = $this->input->post('status');
			         $data = array('academic_year_start'=>date('y-m-d',strtotime($start)) ,'academic_year_end'=>date('y-m-d',strtotime($end)),'status'=>$status);
			         //echo '<pre>'; print_r($detail); exit;
			
			         if($this->db->update('academic_year', $data, array('id' => $id)))
					 {
				       return true;
			          }
					  else 
					  {
				       return 	false;
			           }
			
	                 }
	
	
	
	public function getAcademicYearDetail($id)
	{
		           $query=$this->db->query("select * from academic_year where id='$id'");
		
			       $detail=$query->result_array();
			       //echo '<pre>'; print_r($detail); exit;
			       return $detail;
			
	}
	#################################  Surya End #####################################
	
} // class

