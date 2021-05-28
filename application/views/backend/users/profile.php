 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>

            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Details</h2>
                
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php echo base_url().'uploads/users/'.$detail['image'];?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo ucfirst($user_detail['first_name']).' ' .ucfirst($user_detail['last_name']);?></h3>

                     

                      <a class="btn btn-success" href="<?php echo base_url().'index.php/users/user_update_data/'.$user_id ?>"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                      

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
   <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          
                          <address>
                                          <strong>Username</strong>
                                          <br><strong>Email</strong>
                                          <br><strong>Gender</strong>
                                          <br><strong>Created Date </strong>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        
                          <address>
                                          <strong>:<?php echo $detail['username'];?></strong>
                                          <br><strong>:<?php echo $detail['email'];?></strong>
                                          <br><strong>:<?php if($detail['gender'] ==1){ echo "Male"; } else { echo "Female"; } ?></strong>
                                          <br><strong>:<?php echo date("d-M-Y" ,strtotime($detail['create_date']));?></strong>
                                      </address>
                        </div>
                      
                      </div>
                 

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
