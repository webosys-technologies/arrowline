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
    <!-- <div id="notifications" class="row no-print">
      <div class="col-md-12">
          <div class="noti-alert pad no-print">
              <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  <ul>
                      <li>Successfully saved</li>
                  </ul>
              </div>
          </div>
      </div>
    </div> -->

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <!---Top Section Start-->
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10">
             <div class="top-bar-title">
              <!-- Payment -->
              <?php echo $this->lang->line('payment_header');?>
              </div>
            </div>
            <div class="col-md-2">
            </div>
          </div>
        </div>
      </div>
      <!---Top Section End-->
      <div class="row">
        <div class="col-md-8 col-sm-8 right-padding-col8">
            <div class="box box-default">
              <div class="box-body">
                <div class="row">

                  <div class="col-md-4 col-sm-4">
                    
                  </div>
                  <div class="col-md-8">
                    <div class="btn-group pull-right">
                      <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailReceipt">
                        <!-- Email -->
                        <?php echo $this->lang->line('btn_email');?>
                      </button>

                      <a target="_blank" href="<?php echo base_url();?>payment/payment_print/<?php echo $value->payment_id;?>" title="Print" class="btn btn-default btn-flat">
                      <!-- Print -->
                      <?php echo $this->lang->line('btn_print');?>
                      </a>
                         
                    </div>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <strong>
                      <!-- Billing & Accounting -->
                      <?php echo $this->lang->line('lbl_company_name');?>
                    </strong>
                    <h5 class=""><?php echo $country->street; ?>,<?php echo $country->city_name; ?></h5>
                    <h5 class=""><?php echo $country->state_name; ?></h5>
                    <h5 class=""><?php echo $country->country_name; ?>,<?php echo $country->zip_code; ?></h5>
                  </div>
                  <div class="col-md-4">
                    <strong>
                      <!-- Bill To -->
                      <?php echo $this->lang->line('lbl_bill_to');?>
                    </strong>
                    <h5><?php echo $value->name;?></h5>
                    <h5><?php echo $value->street;?> , <?php echo $value->cust_city;?></h5>
                    <h5><?php echo $value->cust_state;?>, <?php echo $value->country_name;?></h5>
                  </div>
                  <div class="col-md-4">
                    <div class="well well-lg label-success text-center"><strong>
                      <!-- Total Amount -->
                      <?php echo $this->lang->line('lbl_payment_receipt_totalamount');?>
                    <br/><?php echo $value->paid_amount;?></strong></div>
                  </div>
                 
                </div>
                <div class="row">
                  <div class="col-md-12">

                    <center>
                      <h1>
                      <!-- PAYMENT RECEIPT -->
                        <?php echo $this->lang->line('lbl_payment_receipt_totalamount');?>
                      </h1>
                    </center>
                  </div>
                  <div class="col-md-6">
                    
                    <h5>Payment Date : <?php echo $value->payment_date;?></h5>
                    <h5>Payment Type : <?php echo $value->payment_method;?></h5>
                    
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                        <tr class="tbl_header_color dynamicRows">
                          <!-- <th width="30%" class="text-center">Quotation No</th> -->
                          <th width="10%" class="text-center">
                            <!-- Invoice No -->
                            <?php echo $this->lang->line('lbl_payment_receipt_invoiceno');?>
                          </th>
                          <th width="10%" class="text-center">
                            <!-- Invoice Date -->
                            <?php echo $this->lang->line('lbl_payment_receipt_invoicedate');?>
                          </th>
                          <th width="10%" class="text-center">
                            <!-- Invoice Amount --> 
                            <?php echo $this->lang->line('lbl_payment_receipt_invoiceamount');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </th>
                          <th class="text-center" width="10%">
                            <!-- Paid Amount --> 
                            <?php echo $this->lang->line('lbl_payment_receipt_paidamount');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </th>
                        </tr>
                        <?php foreach ($payment as $value) {?>
                        <tr>
                          <!-- <td class="text-center"><?php echo $value->reference_no;?></td> -->
                          <td class="text-center"><?php echo $value->reference_no;?></td>
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

    <div class="col-md-4 left-padding-col4">        
    <div class="box box-default">
      <div class="box-header text-center">
        <strong>Payments</strong>
      </div>
      <?php if($value->paid_amount == 0){?>
      <div class="box-body">
        <h5 class="text-center">No payment found!</h5>
      </div>
      <?php 
      }else{
      ?>
      <table class="table table-bordered">
          <thead>
            <tr>
              <!--<th class="text-center">Payment No</th>-->
              <th>
                <!-- Invoice No -->
                <?php echo $this->lang->line('lbl_payment_receipt_invoiceno');?>
              </th>
              <th>
                <!-- Method -->
                <?php echo $this->lang->line('lbl_payment_receipt_paymentmethod');?>
              </th>
              <th>
                Amount 
                <?php echo $this->lang->line('amount');?>
                (<?php echo $this->session->userdata("currencySymbol");?>)
              </th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($pay)){?>
            <?php foreach ($pay as $pay1) {?>
            <tr>
              <td align="center"><?php echo $pay1->invoice_no;?></td>
              <td align="center"><?php echo $pay1->name;?></td>
              <td align="right"><?php echo $pay1->amount;?></td>
            </tr>
            <?php }} ?>
              <td colspan="2" align="right"><strong>Total (<?php echo $this->session->userdata("currencySymbol");?>)</stron></td><td align="right"><strong><?php echo $value->paid_amount;?></strong></td>
          </tbody>
        </table>
      <?php }?>
    </div>
    </div>      
    </div>
  </section>

  <!--Modal start-->
        <div id="emailReceipt" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <form id="" method="POST" action="<?php echo base_url();?>payment/payment_email">
            
            <div class="modal-content">
              <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>
                  <!-- Send payment information to client -->
                  <?php echo $this->lang->line('lbl_email_payment_title');?>
                </center></h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="email">
                    <!-- Send To -->
                    <?php echo $this->lang->line('lbl_email_sendto');?>
                    :</label>
                  <input type="email" value="<?php echo $value->email;?>" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                  <label for="subject">
                    <?php echo $this->lang->line('lbl_email_subject');?>:
                    </label>
                  <input type="text" class="form-control" name="subject" id="subject" value="Payment information for payment no#<?php echo $value->payment_no;?> and Invoice#<?php echo $value->reference_no;?>.">
                </div>
                <div class="form-groupa">
                  <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px">
                    <?php echo $this->lang->line('hi');?> <?php echo $value->name;?><br>

                    Thank you <i><?php echo $value->name;?></i> for purchase our product and payment<br>

                    <?php echo $this->lang->line('lbl_email_model_payment');?><br><br>

                    <b><?php echo $this->lang->line('lbl_cust_info');?></b><br>

                    <?php echo $value->name;?><br>
                    <?php echo $value->street;?><br>
                    <?php echo $value->cust_city;?><br>
                    <?php echo $value->cust_state;?><br>
                    <?php echo $value->zip_code;?><br><br>

                    <b>Payment Information</b><br>

                    Invoice No : <?php echo $value->reference_no;?><br>
                    Payment No : <?php echo $value->payment_no;?><br>
                    Payment Date : <?php echo $value->payment_date;?><br>
                    Payment Method : <?php echo $value->payment_method;?><br>
                    Total Amount : <?php echo $value->paid_amount;?> .rs<br>
                    <br>

                    <!-- Regards -->
                    <?php echo $this->lang->line('regards');?>
                    <br>
                    <!-- Vaksys Pvt. Ltd. -->
                    <?php echo $this->lang->line('lbl_company_name');?>
                  </textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('btn_modal_close');?></button>
                <button type="submit" class="btn btn-primary btn-sm"><?php echo $this->lang->line('btn_modal_send');?></button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <!--Modal end -->
  </div>
<?php 
  $this->load->view('layout/footer');
?>