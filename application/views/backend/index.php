 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Products</h3>
              </div>

          
            </div>
            
            <div class="clearfix"></div>
            <section class="content" style="height: auto;">
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Products</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal" method="post" action="<?php echo base_url().'backend/add_student/'?>" enctype="multipart/form-data">
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th style="width: 15%">Item Name</th>
                          <th style="width:15%">Quantity</th>
                          <th style="width: 15%">Unit Price</th>
                          <th>Tax(in %)</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#</td>
                          <td>
                            <div class="col-sm-12" >
                                <input type="text" class="form-control" name="name" id="name" required>
                    
                            </div>
                          </td>
                          <td>
                            <div class="col-sm-6" >
                                <input type="text" class="form-control" name="quantity" id="quantity" required>
                    
                            </div>
                          </td>
                          <td class="project_progress">
                            <div class="col-sm-6" >
                                <input type="text" class="form-control" name="unit_price" id="unit_price" required>
                    
                            </div>
                           
                          </td>
                          <td>
                            <select class="form-control" name="tax" id="tax">
                          <option   value="">select...</option>
                         
                            <option value="0">0%</option>
                             <option value="1">1%</option>
                              <option value="5">5%</option>
                               <option value="10">10%</option>
                           
                    </select>
                          </td>
                           <td class="project_progress">
                            <div class="col-sm-6" >
                                <input type="text" class="form-control" name="total" id="total" disabled>
                    
                            </div>
                           
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs" onclick="addData();"><i class="fa fa-plus"></i> Add </a>
                           
                           
                          </td>
                        </tr>
                       
                      </tbody>
                    </table>
                    <br>
                     </form>
                    <!-- end project list -->
                </div>
            </div>
        </div>
    </div>



                   
                 
          <div class="">
           

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel" id="table_data">
               </div>
           </div>
       </div>
  
                    </section>
                  </div>
                </div>
              </div>
            </div>
         
        </div>
        </div>
</div>
</section>
        <!-- /page content -->

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
    $(document).ready(function() {
             $("#generate_invoice").hide();
            jQuery("#tax" ).change(function() {
              var name =  jQuery('#name').val();
          var quantity =  jQuery('#quantity').val();  
         var unit_price =  jQuery('#unit_price').val(); 
         var tax = jQuery('#tax').val();
         
      // AJAX request
      $.ajax({
        type: "POST",
           dataType:'json',
            url: '<?=base_url()?>/index.php/backend/gettotalprice',
           
           // data:"quantity="+quantity+"&unit_price="+unit_price+"&tax="+tax, 
            data: {quantity: quantity,unit_price: unit_price,tax:tax,name:name}, 
       
        success: function(data){
       
        
       $("#total").val(data.json.total);
          // Add options
       
        }
     });
    });
          });
   
    </script>
    
    <script type="text/javascript">
    function addData(){
       var name =  $('#name').val();
          var quantity =  $('#quantity').val();  
         var unit_price =  $('#unit_price').val(); 
         var tax = $('#tax').val();
         //alert(name);
      // AJAX request
      $.ajax({
        url:'<?=base_url()?>/index.php/backend/addproductdata',
        method: 'post',
      data: {quantity: quantity,unit_price: unit_price,tax:tax,name:name}, 
       
        success: function(response){
          //alert(response);
       $("#table_data").html(response);
       //$("#generate_invoice").show();
          // Add options
         
        }
     });
    }
   
    </script>

    <script type="text/javascript">
    function addDiscount(){
       var amount =  $('#discount_value').val();
          var type =  $('#discount').val();  
         
         //alert(name);
      // AJAX request
      $.ajax({
        url:'<?=base_url()?>/index.php/backend/addDiscount',
        method: 'post',
      data: {amount: amount,type: type}, 
       
        success: function(response){
          //alert(response);
       $("#total_amount").html(response);
       //$("#generate_invoice").show();
          // Add options
         
        }
     });
    }
   
    </script>