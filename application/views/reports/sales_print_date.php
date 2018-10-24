  <?php echo $this->lang->line('lbl_salesreport_datewise_salesreporton');?>
<?php 
  $this->load->view('layout/header');
?>
<?php foreach ($orderdetails as $value)?>

 <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <!---Top Section End-->
      <div class="row">
        <div class="col-md-12 left-padding-col8">
            <div class="box box-default">
              <div class="box-body">
                <div class="row">
                 
                  <div class="col-md-8">
                  </div>
                </div>
              </div>

              <table border="2px solid red">
                <tr>
                  <td><img src="<?php echo base_url();?>assets/logo/invoice_logo.jpg" height="80" width="100"></td>
                  <td style="padding-left: 200px"><h4>
                   <!--  Sales Report on  -->:
                      <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_salesreport');?>
                    <?php echo date('d-m-Y');?></h4></td>
                </tr>               
                
                <tr>
                  <td><strong>
                   <!--  goBilling -->
                      <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_gobilling');?>
                  </strong></td>    
                  <td style="padding-left: 80px;"></td>

                </tr>
                <tr>
                  <td><?php echo $country->street; ?>,<?php echo $country->city; ?></td>    
                  <td style="padding-left: 80px;"></td>   
                </tr>
                <tr>
                  <td><?php echo $country->state; ?></td>    
                  <td style="padding-left: 80px;"></td>   
                </tr>
                <tr>
                  <td><?php echo $country->country_name; ?>,<?php echo $country->zip_code; ?></td>
                  <td style="padding-left: 80px;"></td>
                </tr>

              </table>
              <br>

              <div class="box-body">
             
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                        <tr class="tbl_header_color dynamicRows" style="background-color:green;">
                          <th class="text-center">
                           <!--  Order No -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_ordersno');?>
                          </th>
                          <th class="text-center">
                          <!--   Customer -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_customer');?>
                          </th>
                          <th class="text-center">
                            <!-- Quantity -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_quantity');?>
                          </th>
                          <th class="text-center">
                           <!--  Sales Value -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_salesvalue');?>
                          </th>
                          <th class="text-center">
                           <!--  Cost Value -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_costvalue');?>
                          </th>
                          <th class="text-center">
                           <!--  Tax -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_tax');?>
                          </th>
                          <th class="text-center">
                            <!-- Profit -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_profit');?>
                          </th>
                          <th class="text-center">
                           <!--  Profit Margin(%) -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_profitmargin');?>
                          </th>
                         

                        </tr>
                        <?php 
                          $qty_total=0;
                          $sub_total=0;
                          $Retail_value=0;
                          $profit=0;
                          foreach ($orderdetails as $value) {
                            $qty_total=$qty_total + $value->qty; 
                            $sub_total=$sub_total + $value->sales_volume;
                            $Retail_value=$Retail_value + $value->cost_volume;
                            $profit=$Retail_value - $sub_total + $value->profit;
                          ?>
                        <tr>
                                <td class="text-center"><?php echo $value->reference_no;?></a></td>
                                <td class="text-center"><?php echo $value->name;?></a></td>
                                <td class="text-center"><?php echo $value->qty;?></td>
                                <td class="text-center"><?php echo $value->sales_volume;?></td>
                                <td class="text-center"><?php echo $value->cost_volume;?></td>
                                <td class="text-center"><?php echo $value->tax;?></td>
                                <td class="text-center"><?php echo $value->profit;?></td>
                                <td class="text-center"><?php echo $value->main;?></td>
              
                        </tr>
                        <?php } ?>

                        <?php foreach ($orderdetails as $value)?>

                        <tr class="tableInfos">
                          <td colspan="7" align="right">
                            <!-- Total Quantity -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_totalquantity');?>
                          </td><td align="right"><?php echo $qty_total;?></td>
                        </tr>
                        <tr class="tableInfos">
                          <td colspan="7" align="right">
                           <!--  Sales value -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_salesvalue');?>
                          </td><td align="right"><?php echo $sub_total;?></td>
                        </tr>
                       
                        <tr class="tableInfos">
                          <td colspan="7" align="right"><strong><b>
                           <!--  Cost value -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_costvalue');?>
                          </b></strong></td>
                          <td class="text-right"><strong><?php echo $Retail_value?></strong></td>
                        </tr> 

                        <tr class="tableInfos">
                          <td colspan="7" align="right"><strong><b>
                            <!-- Profit -->
                              <?php echo $this->lang->line('lbl_salesreport_pdf_datewise_profit');?>
                          </b></strong></td>
                          <td class="text-right"><strong><?php echo $profit?></strong></td>
                        </tr> 
                      </tbody>
                      </table>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <!--Modal start-->
        
        <!--Modal end -->
   
    </div>
  </section>
<!-- Modal Dialog -->

    
    <!-- /.content -->
  </div>


