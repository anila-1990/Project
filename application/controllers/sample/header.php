<?php
	$sys_detail =	$this->db->get_where('office_settings' , array('id'=>'1'))->row();
	//echo '<pre>'; print_r($detail ); exit;
	$system_name	= $sys_detail->system_name ;
	$system_title	= $sys_detail->system_title ;
	$text_align	=	 $sys_detail->text_align ;
	$account_type 	=	$this->session->userdata('user_type');
	$query_course = $this->db->query("select c.*  from courses c order by c.id asc ");
	$course_list = $query_course->result_array();
	$course_bat_list = array();
	foreach($course_list  as $each){
		$course_id1 = $each['id']; 	
		$query_batch = $this->db->query("select * from course_batch cb where cb.course_id='$course_id1' order by cb.id asc ");
	$bat_list = 	$query_batch->result_array();
	$course_bat_list[]= array($each , 'batches' => $bat_list  ); 
	
	}
	//echo '<pre>';  print_r( $course_bat_list ); exit;
	

	?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><?php echo $page_title;?> | <?php echo $system_title;?> </title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <?php if( $level_plugin_style ==1) { ?>
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-ui-1.11.3.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
   
   
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   <?php } ?>
   <?php if($level_plugin_page_component==1){ ?>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/gritter/css/jquery.gritter.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/select2/select2_metro.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/clockface/css/clockface.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-multi-select/css/multi-select.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
   <?php } ?>
   
   
   <?php if( $theme_style ==1) { ?>
   <!-- BEGIN THEME STYLES --> 
   <link href="<?php echo base_url().'theme/assets/'; ?>css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/style.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/pages/profile.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="<?php echo base_url().'theme/assets/'; ?>css/custom.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'assets/css/font-icons/entypo/'; ?>css/entypo.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().'theme/assets/';?>css/pages/timeline.css" rel="stylesheet" type="text/css"/>
   
   <!-- END THEME STYLES -->
   <?php } ?>
    <?php if( $table_list=1){ ?>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'theme/assets/'; ?>plugins/select2/select2_metro.css" />
   <link rel="stylesheet" href="<?php echo base_url().'theme/assets/'; ?>plugins/data-tables/DT_bootstrap.css" />
   <?php } ?>
    <script src="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
   <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
   <script src="<?php echo base_url().'theme/assets/'; ?>plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().'theme/assets/'; ?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   
   <script>
 var   base_url = '<?php echo base_url(); ?>';
   </script>
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
   <!-- BEGIN HEADER -->   
   <div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
          <a class="navbar-brand" href="<?php echo base_url(); ?>">
         <!--<img src="<?php //echo base_url().'theme/assets/'; ?>img/logo.png" alt="logo" class="img-responsive" />-->
         <?php echo $system_title;?> 
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
         <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="<?php echo base_url().'theme/assets/'; ?>img/menu-toggler.png" alt="" />
         </a> 
         <!-- END RESPONSIVE MENU TOGGLER -->
         <!-- BEGIN TOP NAVIGATION MENU -->
         <ul class="nav navbar-nav pull-right">
            <!-- BEGIN NOTIFICATION DROPDOWN -->
            <li class="dropdown" id="header_notification_bar">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                  data-close-others="true">
               <i class="icon-warning-sign"></i>
               <span class="badge">6</span>
               </a>
               <ul class="dropdown-menu extended notification">
                  <li>
                     <p>You have 14 new notifications</p>
                  </li>
                  <li>
                     <ul class="dropdown-menu-list scroller" style="height: 250px;">
                        <li>  
                           <a href="#">
                           <span class="label label-sm label-icon label-success"><i class="icon-plus"></i></span>
                           New user registered. 
                           <span class="time">Just now</span>
                           </a>
                        </li>
                        <li>  
                           <a href="#">
                           <span class="label label-sm label-icon label-danger"><i class="icon-bolt"></i></span>
                           Server #12 overloaded. 
                           <span class="time">15 mins</span>
                           </a>
                        </li>
                      
                     </ul>
                  </li>
                  <li class="external">   
                     <a href="#">See all notifications <i class="m-icon-swapright"></i></a>
                  </li>
               </ul>
            </li>
            <!-- END NOTIFICATION DROPDOWN -->
            <!-- BEGIN INBOX DROPDOWN -->
            <li class="dropdown" id="header_inbox_bar">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                  data-close-others="true">
               <i class="icon-envelope"></i>
               <span class="badge">5</span>
               </a>
               <ul class="dropdown-menu extended inbox">
                  <li>
                     <p>You have 12 new messages</p>
                  </li>
                  <li>
                     <ul class="dropdown-menu-list scroller" style="height: 250px;">
                        <li>  
                           <a href="inbox.html?a=view">
                           <span class="photo"><img src="<?php echo $this->session->userdata('profile_pic_thumb');  ?>" alt=""/></span>
                           <span class="subject">
                           <span class="from">Lisa Wong</span>
                           <span class="time">Just Now</span>
                           </span>
                           <span class="message">
                           Vivamus sed auctor nibh congue nibh. auctor nibh
                           auctor nibh...
                           </span>  
                           </a>
                        </li>
                        
                     </ul>
                  </li>
                  <li class="external">   
                     <a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
                  </li>
               </ul>
            </li>
            <!-- END INBOX DROPDOWN -->
            <!-- BEGIN TODO DROPDOWN -->
            <li class="dropdown" id="header_task_bar">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <i class="icon-tasks"></i>
               <span class="badge">5</span>
               </a>
               <ul class="dropdown-menu extended tasks">
                  <li>
                     <p>You have 12 pending tasks</p>
                  </li>
                  <li>
                     <ul class="dropdown-menu-list scroller" style="height: 250px;">
                        <li>  
                           <a href="#">
                           <span class="task">
                           <span class="desc">New release v1.2</span>
                           <span class="percent">30%</span>
                           </span>
                           <span class="progress">
                           <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                           <span class="sr-only">40% Complete</span>
                           </span>
                           </span>
                           </a>
                        </li>
                       
                     </ul>
                  </li>
                  <li class="external">   
                     <a href="#">See all tasks <i class="m-icon-swapright"></i></a>
                  </li>
               </ul>
            </li>
            <!-- END TODO DROPDOWN -->
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <img alt="" src="<?php echo $this->session->userdata('profile_pic_thumb');  ?>" width="29" height="29"/>
               <span class="username"><?php ?></span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url().'dashboard/my_profile/' ?>"><i class="icon-user"></i> My Profile</a>
                  </li>
                 
                  <li><a href="inbox.html"><i class="icon-envelope"></i> My Inbox <span class="badge badge-danger">3</span></a>
                  </li>
                  <li><a href="#"><i class="icon-tasks"></i> My Tasks <span class="badge badge-success">7</span></a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a>
                  </li>
                  
                  <li><a href="<?php echo base_url().'login/logout' ?>"><i class="icon-key"></i> Log Out</a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <?php include 'sidebar.php';?>