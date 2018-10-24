<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }  
?>
<?php foreach ($payment as $value)?>

 <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!---Top Section End-->
      <div class="row">
        <div class="col-md-12 left-padding-col8">
            <div class="box box-default">
              <div class="box-body">
                <div class="row">
                  <!-- <div class="col-md-4">
                    <strong>Quotation Date : <?php echo $value->date;?></strong>
                    <br>
                    <strong>Location : <?php echo $value->location_name;?></strong>
                  </div> -->
                  <div class="col-md-8">
                  </div>
                </div>
              </div>

              <table border="">
                <tr>
                  <td><img src="<?php echo base_url();?>assets/logo/invoice_logo.jpg" height="80" width="100"></td>
                  <td style="padding-left: 300px"><h2>Payment</h2></td>
                </tr>               

                <tr>
                  <td><h2><b></b></h2></td>
                  <td style="padding-left: 300px;"> Payment Date : <?php echo $value->payment_date;?> </td>
                </tr>

                <tr>
                  <td></td>
                  <td style="padding-left: 300px;">Payment Type : <?php echo $value->payment_method;?> </td>
                </tr>

                <hr>

                <tr>
                  <td><strong>goBilling</strong></td>    
                  <td style="padding-left: 80px;"><strong>Bill TO</strong></td>
                </tr>

                <tr>
                  <td><?php echo $country->street; ?>,<?php echo $country->city_name; ?>,</td>    
                  <td style="padding-left: 80px;"><?php echo $value->name;?>,</td>   
                </tr>

                <tr>
                  <td><?php echo $country->state_name; ?>,</td>    
                  <td style="padding-left: 80px;"><?php echo $value->street;?> , <?php echo $value->cust_city;?>,</td>   
                </tr>

                <tr>
                  <td><?php echo $country->country_name; ?>,<?php echo $country->zip_code; ?>,</td>
                  <td style="padding-left: 80px;"><?php echo $value->cust_state;?> ,<?php echo $value->country_name;?>,</td>
                </tr>
                
              </table>
              <br>
              
              <h3><center>Payment Receipt</center></h3>
                
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                        <tr class="tbl_header_color dynamicRows">
                          <th class="text-center" style="padding:10px;">Invoice No</th>
                          <th class="text-center">Invoice Date</th>
                          <th class="text-center">Invoice Amount (<?php echo $this->session->userdata("currencySymbol");?>)</th>
                          <th class="text-center">Paid Amount (<?php echo $this->session->userdata("currencySymbol");?>)</th>
                        </tr>
                        <?php foreach ($payment as $value) {?>
                        <tr>
                          <td class="text-center" style="padding:10px;"><?php echo $value->reference_no;?></td>
                          <td class="text-center"><?php echo $value->invoice_date;?></td>
                          <td class="text-center"><?php echo $value->sales_amount;?></td>
                          <td class="text-center"><?php echo $value->paid_amount;?></td>
                        </tr>
                        <?php } ?>
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


