 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users</h3>
              </div>

            
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Users</h2>
               
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                   

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">Sl.No</th>
                         
                          <th style="width: 20%">First Name</th>
                          <th style="width: 20%">Email(Username)</th>
                          <th style="width: 20%">Is_admin</th>
                         
                          <th>Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $count =1; 
                      foreach ($result as $key) {
                        ?>
                        <tr>
                          <td><?php echo $count++;?></td>
                         
                           <td>
                           <?php echo $key['first_name'];?>
                          </td>
                           <td>
                           <?php echo $key['email'];?>
                          </td>
                          <?php if($key['is_admin'] == 1){ ?>
                          <td>
                            <button type="button" class="btn btn-info btn-xs">Admin</button>
                          </td>
                          <?php } else {?>
                           <td>
                            <button type="button" class="btn btn-primary btn-xs">User</button>
                          </td>
                          <?php } ?>
                          <td>
                          <?php if($key['status'] == 1 ){ ?>
                            <button type="button" class="btn btn-success btn-xs">Active</button>
                          <?php } else { ?>
                          
                            <button type="button" class="btn btn-danger btn-xs">Inactive</button>
                          
                          <?php } ?>
                          </td>
                          <td>
                            <a href="<?php echo base_url().'index.php/users/user_view_profile/'.$key['user_id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="<?php echo base_url().'index.php/users/user_update_data/'.$key['user_id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a href="<?php echo base_url().'index.php/users/user_delete_data/'.$key['user_id'] ?>" class="btn btn-danger btn-xs" onClick="return doconfirm();"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
                       <?php } ?>
                       
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<script>
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>