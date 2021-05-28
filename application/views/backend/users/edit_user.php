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
                    <h2>Edit User</h2>
           
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php if($message ==1){ ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Your profile is successfully updated..</strong>
                  </div>
                  <?php } ?>
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url().'index.php/users/user_update_data/'.$user_id ?>" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="first_name" value="<?php echo $detail['first_name'];?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last_name" required="required" name="last_name" value="<?php echo $detail['last_name'];?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="username" value="<?php echo $detail['username'];?>" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" value="<?php echo $detail['email'];?>" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       
                      <p>
                        Male:
                        <input type="radio" class="flat" name="gender" id="genderM" value="1" <?php if($detail['gender']==1){ ?>checked="" <?php } ?> required /> Female:
                        <input type="radio" class="flat" name="gender" id="genderF" value="2" <?php if($detail['gender']==2){ ?>checked="" <?php } ?> />
                      </p>
                        </div>
                      </div>
                     
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        </label>
                     <img src="<?php echo base_url().'uploads/users/'.$detail['image']?>" width="80px" height="60px" alt=" " style="margin-left: 7px;" />
                     </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 akshara_backend55">
                       
                          <input type="file" id="event-name"  name="image" value="<?php echo $detail['image'];?>" class="form-control col-md-7 col-xs-12 akshara_backendsub" onchange="ValidateSize(this)">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
</div>
</div>

 <style type="text/css">
          .has-feedback-left44{
            width: 74%;
          }
           .akshara_backend55{
            border: 1px solid #0003;
padding: 2px 0 7px 2px;
margin-left: 10px;
width: 48%;
          }
          .akshara_backendsub{
            border: none;
          }
        </style>   




           
        
        <!-- /page content -->
           <script>
        function ValidateSize(file) {
        var FileSize = file.files[0].size; // in MB
        if (FileSize >1048576) {
            alert('Filesize must 1mb or below');
           // $(file).val(''); //for clearing with Jquery
        } else {

        }
    }
    </script>