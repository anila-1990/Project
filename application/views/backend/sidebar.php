 <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url().'backend/dashboard/';?>" class="site_title"><i class="fa fa-paw"></i> <span>Invoice Application</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
             
             <img src="<?php echo base_url().'uploads/users/default_user.jpg';?>" alt="..." class="img-circle profile_img">
             
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo ucfirst($user_detail['username']);?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                 
              
                      <li><a href="<?php echo base_url().'backend/dashboard/';?>">Dashboard</a></li>
                     
                                   </ul>
              </div>
           

            </div>
            <!-- /sidebar menu -->

           
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  
             <img src="<?php echo base_url().'uploads/users/default_user.jpg';?>" alt="..." >
            
                  <?php echo $user_detail['username'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                  
                  
                    <li><a href="<?php echo base_url().'index.php/backend/logout/';?>"> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
