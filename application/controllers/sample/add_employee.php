<div class="page-content">
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                     Widget settings form goes here
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue">Save changes</button>
                     <button type="button" class="btn default" data-dismiss="modal">Close</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
         <!-- BEGIN STYLE CUSTOMIZER -->
         <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler"></div>
            <div class="toggler-close"></div>
            <div class="theme-options">
               <div class="theme-option theme-colors clearfix">
                  <span>THEME COLOR</span>
                  <ul>
                     <li class="color-black current color-default" data-style="default"></li>
                     <li class="color-blue" data-style="blue"></li>
                     <li class="color-brown" data-style="brown"></li>
                     <li class="color-purple" data-style="purple"></li>
                     <li class="color-grey" data-style="grey"></li>
                     <li class="color-white color-light" data-style="light"></li>
                  </ul>
               </div>
               <div class="theme-option">
                  <span>Layout</span>
                  <select class="layout-option form-control input-small">
                     <option value="fluid" selected="selected">Fluid</option>
                     <option value="boxed">Boxed</option>
                  </select>
               </div>
               <div class="theme-option">
                  <span>Header</span>
                  <select class="header-option form-control input-small">
                     <option value="fixed" selected="selected">Fixed</option>
                     <option value="default">Default</option>
                  </select>
               </div>
               <div class="theme-option">
                  <span>Sidebar</span>
                  <select class="sidebar-option form-control input-small">
                     <option value="fixed">Fixed</option>
                     <option value="default" selected="selected">Default</option>
                  </select>
               </div>
               <div class="theme-option">
                  <span>Footer</span>
                  <select class="footer-option form-control input-small">
                     <option value="fixed">Fixed</option>
                     <option value="default" selected="selected">Default</option>
                  </select>
               </div>
            </div>
         </div>
         <!-- END BEGIN STYLE CUSTOMIZER -->            
         <!-- BEGIN PAGE HEADER-->   
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                <?php echo get_phrase('add_employee');?>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li class="btn-group">
                     <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                     <span>Actions</span> <i class="icon-angle-down"></i>
                     </button>
                     <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                     </ul>
                  </li>
                  <li>
                     <i class="icon-home"></i>
                     <a href="index.html">Home</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <li>
                     <a href="#"><?php echo get_phrase('employees');?></a>
                     <i class="icon-angle-right"></i>
                  </li>
                  <li><a href="#"><?php echo get_phrase('add_employee');?></a></li>
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN VALIDATION STATES-->
               <div class="portlet box purple">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-reorder"></i><?php echo get_phrase('add_employee');?></div>
                     <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                        <a href="javascript:;" class="reload"></a>
                        <a href="javascript:;" class="remove"></a>
                     </div>
                  </div>
                  <div class="portlet-body form">
                  
                  <?php if($success_msg ==1){?>
                  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Employee Detail has been Successfully added !.
</div>
                  <?php } ?>
                  
                     <!-- BEGIN FORM-->
                     <form action="<?php echo base_url().'employees/add_employee' ?>" id="form_sample_1" class="form-horizontal"  method="post" enctype="multipart/form-data">
                        <div class="form-body">
                           <div class="alert alert-danger display-hide">
                              <button class="close" data-dismiss="alert"></button>
                              You have some form errors. Please check below.
                           </div>
                           <div class="alert alert-success display-hide">
                              <button class="close" data-dismiss="alert"></button>
                              Your form validation is successful!
                           </div>
                           <div class="form-group">
                           <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('emp_no');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <input type="text" name="emp_no" data-required="1" value="<?php echo set_value('emp_no'); ?>" class="form-control"/>
                               <span style="color:#FF0000;">  <?php echo form_error('emp_no'); ?></span>
                              </div>
                              </div>
                              <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('emp_join_date');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <input type="text" name="emp_join_date"  data-required="1" class="form-control date-picker" value="<?php if(set_value('emp_join_date') ){ echo date ( 'm/d/Y', strtotime(set_value('emp_join_date'))); } ?>"/>
                                  <span style="color:#FF0000;">  <?php echo form_error('emp_join_date'); ?></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('emp_type');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <select class="form-control" name="emp_type">
                                    <option value=""><?php echo get_phrase('select');?></option>
                            <?php  $list_emp_type	=	$this->db->get('employee_type' )->result_array();
                                foreach( $list_emp_type as $row){?> 
                                
                            <option value="<?php echo $row['id']; ?>" <?php if(set_value('emp_type')== $row['id']){?>selected="selected"<?php } ?> ><?php echo $row['emp_type']; ?></option>
                            <?php } ?>
                                 </select>
                                  <span style="color:#FF0000;">  <?php echo form_error('emp_type'); ?></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('name');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <input name="name" type="text" class="form-control" value="<?php echo set_value('name'); ?>"/>
                                  <span style="color:#FF0000;">  <?php echo form_error('name'); ?></span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('birthday');?></label>
                              <div class="col-md-4">
                                 <input name="birthday" type="text" class="form-control date-picker" value="<?php if(set_value('birthday') ){ echo date ( 'm/d/Y', strtotime(set_value('birthday'))); } ?>"/>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('gender');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <select name="gender" class="form-control">
                                 <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('address');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <input name="address" type="text" class="form-control"/>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('phone');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <input name="phone" type="text" class="form-control"/>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('email');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <input name="email" type="text" class="form-control"/>
                              </div>
                           </div>
                             <div class="form-group">
                              <label class="control-label col-md-3"><?php echo get_phrase('marital_status');?><span class="required">*</span></label>
                              <div class="col-md-4">
                                 <select name="marital_status" class="form-control">
                                 <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('yes');?></option>
                              <option value="2"><?php echo get_phrase('no');?></option>
                          </select>
                              </div>
                           </div>
                         
                           <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-md-4">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
                                        <input name="emp_img" type="hidden" value="1" />
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                           
                        <div class="form-actions fluid">
                           <div class="col-md-offset-3 col-md-9">
                              <button type="submit" class="btn green"><?php echo get_phrase('add_employee');?></button>
                              <button type="button" class="btn default">Cancel</button>                              
                           </div>
                        </div>
                     </form>
                     <!-- END FORM-->
                  </div>
               </div>
               <!-- END VALIDATION STATES-->
            </div>
         </div>
         </div>
         <!-- END PAGE CONTENT--> 
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->