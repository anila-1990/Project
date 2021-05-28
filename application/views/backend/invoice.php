
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice </h2>
                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                                          <i class="fa fa-globe"></i> Invoice
                                          <small class="pull-right">Date: <?php echo date('d/m/Y');?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                     
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                          	<thead>
                            <tr>
                                <th style="width: 5%;">Sl.no</th>
                               
                                <th style="width: 20%;">Item Name</th>
                                 <th>Qunatity</th>
                                <th>Unit Price</th>
                                <th>Tax</th>
                                <th>Total</th>
                              </tr>
                            </thead><tbody>
                            	<?php  //echo '<pre>';print_r($result);exit;
                            foreach($result as $row){
            $i=1; ?>
                 <tr><td><?php echo $i;?></td>
                 <td><?php echo $row['name']; ?></td>
                 <td><?php echo $row['quantity'];?></td>
                 <td><?php echo $row['unit_price'];?></td>
                 <td><?php echo $row['tax'];?></td><td><?php echo $row['payable_amount'];?></td></tr>
             <?php    
             }
              $i++; ?>
                           
              
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                        
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal(Excluding Tax):</th>
                                  <td id="subtotal_without_tax"><?php echo $pricelist['total_without_tax'];?></td>
                                </tr>
                                <tr>
                                  <th>Subtotal(Including Tax):</th>
                                  <td id="subtotal_with_tax"><?php echo $pricelist['total_with_tax']; ?></td>
                                </tr>
                                <tr>
                                  <th>Discount:  </th>
                                  <td><?php echo $price['discount']; ?></td>
                                </tr>
                                <tr id="total_amount">
                                	 <th style="width:50%">Grand Total:</th>
                                  <td id="total"><?php echo $price['total']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                         
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       