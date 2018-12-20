<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quotation
        <small>#<?php if(isset($quotation->reference_no)){echo $quotation->reference_no;}?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>Management/">Manage Lead</a></li>
        <li class="active">Order Details</li>
      </ol>

    </section>

   

    <!-- <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div> -->

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-2">
             <div class="top-bar-title">
              <b>Sales Order</b>
            </div>
            </div>
            <!-- <div class="col-md-2">
            
            </div> -->



            <div class="col-xs-10 btn-group pull-right">

                <?php if(!isset($invoice)){
                    ?>
                  <?php if(in_array("add_invoice",$user_session)){?>
<!--                    <a href="<?php echo base_url();?>Management/convert_invoice/<?php echo $quotation->order_id;?>" title="Convert to invoice" class="btn btn-primary btn-flat pull-right">
                       Generate Invoice 
                      <?php echo $this->lang->line('btn_generateinvoice');?>
                    </a>-->
                <?php }
                
                  } ?>


              <?php if(in_array("add_invoice",$user_session)){?>
                <a class="btn btn-warning btn-flat pull-right" href="<?php echo base_url()?>Management/add_form"><i class="fa fa-truck"></i> 
                  New Order
                </a>
              <?php } ?>
              
              <a href="#<?php echo''.$quotation->order_id.'';?>" data-toggle="modal" data-target="" class="btn btn-danger btn-flat delete-btn pull-right"><i class="fa fa-remove"></i>
                <!-- Delete -->
                <?php echo $this->lang->line('btn_delete');?>
              </a>  

              <button title="Email" type="button" class="btn btn-success btn-flat pull-right" data-toggle="modal" data-target="#emailReceipt"><i class="fa fa-envelope" aria-hidden="true"></i>
                <!-- Email -->
                <?php echo $this->lang->line('btn_email');?>
              </button>

              <a target="_blank" href="<?php echo base_url();?>Management/order_print/<?php echo $quotation->order_id;?>" title="Print" class="btn btn-info btn-flat pull-right"><i class="fa fa-print"></i>
                <!-- Print -->
                <?php echo $this->lang->line('btn_print');?>
              </a>

              <?php if($quotation->status == "draft"){ ?>
              <a href="<?php echo base_url();?>quotation/edit_data/<?php echo $quotation->order_id;?>" title="Edit" class="btn bg-orange btn-flat pull-right"><i class="fa fa-edit"></i>
                <!-- Edit -->
                <?php echo $this->lang->line('btn_edit');?>
              </a>
              <?php } ?>

              <!-- <a href="#" title="Print" class="btn bg-orange btn-flat pull-right" id="printBtn"><i class="fa fa-edit"></i>
                Print
              </a> -->
              

              <!-- <?php $due = $sales->total_amount - $sales->paid_amount;?>
                <?php 
                  if(isset($user_session)){
                    if(in_array("add_payment",$user_session)){?>
                      <?php if($due > 0){?>
                          <a href="<?php echo base_url();?>invoice/payment_details/<?php echo $sales->sales_id;?>/<?php echo $sales->invoice_id;?>" title="Print" class="btn bg-purple btn-flat delete-btn pull-right"><i class="fa fa-credit-card"></i>
                            <?php echo $this->lang->line('btn_pay_now');?>
                          </a>
              <?php }}} ?> -->

            </div>
        </div>
      </div>
    </section>


    <!-- Main content -->
    <section class="invoice orderPrint">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php if(isset($country->name)){echo $country->name;} ?>
            <?php $newDate = date("d-m-Y", strtotime($quotation->date)); ?>
            <small class="pull-right">Date: :<?php if(isset($newDate)){echo $newDate;}?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong><?php if(isset($country->name)){echo $country->name;} ?></strong><br>
            <?php if(isset($country->street)){echo $country->street;} ?><br>
            <?php if(isset($country->city_name)){echo $country->city_name;} ?> , <?php if(isset($country->state_name)){echo $country->state_name;} ?><br>
            <?php if(isset($country->country_name)){echo $country->country_name;} ?>, <?php if(isset($country->zip_code)){echo $country->zip_code;} ?><br>
            Phone: <?php if(isset($country->phone)){echo $country->phone;} ?><br>
            Email: <?php if(isset($country->email)){echo $country->email;} ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php if(isset($quotation->cust_name)){echo $quotation->cust_name;}?></strong><br>
            <?php if(isset($quotation->cust_street)){echo $quotation->cust_street;}?><br>
            <?php if(isset($quotation->cust_city)){echo $quotation->cust_city;}?> , <?php if(isset($quotation->cust_state)){echo $quotation->cust_state;}?><br>
            <?php if(isset($quotation->country_name)){echo $quotation->country_name;}?> , <?php if(isset($quotation->cust_zipcode)){echo $quotation->cust_zipcode;}?> <br>
            Phone: <?php if(isset($quotation->phone)){echo $quotation->phone;}?><br>
            Email: <?php if(isset($quotation->email)){echo $quotation->email;}?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php if(isset($quotation->reference_no)){echo $quotation->reference_no;}?></b><br>
          <br>
          <!-- <b>Order ID :</b> 4F3S8J<br> -->
          <?php $due = date('Y-m-d', strtotime($quotation->date. ' + '.$quotation->due_days.' days'));?>
          <b>Payment Due :</b> <?php echo date("d-m-Y", strtotime($due)); ?><br>
          <b>Payment Paymnet :</b> <?php if(isset($quotation->payment_method_name)){echo $quotation->payment_method_name;}?><br>
          <b>Location Name : </b> <?php if(isset($quotation->location_name)){echo $quotation->location_name;}?>
          <!-- <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th width="10%" class="text-center">
                <!-- Item Name -->
                <?php echo $this->lang->line('add_item_name');?>
              </th>
              <th width="30%" class="text-center">
                <!-- Description -->
                <?php echo $this->lang->line('lbl_add_quotation_desc');?>
              </th>
              <th width="10%" class="text-center">
                <!-- HSN/SAC Code -->
                <?php echo $this->lang->line('lbl_hsn_code');?>
              </th>
              <th width="10%" class="text-center">
               <!--  Quantity -->
                <?php echo $this->lang->line('lbl_add_quotation_quantity');?>
              </th>
              <th width="10%" class="text-center">
                <!-- Rate  -->
                 <?php echo $this->lang->line('lbl_add_quotation_rate');?>
                (<?php echo $this->session->userdata("currencySymbol");?>)
              </th>
              <th width="" class="text-center">
                <!-- Total Sales -->
                 <?php echo $this->lang->line('lbl_total_sales');?>
                (<?php echo $this->session->userdata("currencySymbol");?>)
              </th>
<!--              <th class="text-center" width="10%">
                 Discount 
                 <?php echo $this->lang->line('lbl_add_quotation_discount');?>(%)
              </th>
              <th width="" class="text-center">
                 Discount Value 
                <?php echo $this->lang->line('lbl_discount_value');?>
                (<?php echo $this->session->userdata("currencySymbol");?>)
              </th>-->
              <th width="" class="text-center">
                <!-- Taxable Value -->
                 <?php echo $this->lang->line('lbl_taxable_value');?>
                (<?php echo $this->session->userdata("currencySymbol");?>)
              </th>
              <th width="" class="text-center">
                <!-- SGST -->
                <?php echo $this->lang->line('lbl_sgst');?>
              </th>
              <th width="" class="text-center">
                <!-- CGST -->
                <?php echo $this->lang->line('lbl_cgst');?>
              </th>
              <th width="" class="text-center">
                <!-- IGST -->
                <?php echo $this->lang->line('lbl_igst');?>(%)
              </th>
              <th width="10%" class="text-center">
                <!-- Amount -->
                 <?php echo $this->lang->line('lbl_add_quotation_amount');?>(<?php echo $this->session->userdata("currencySymbol");?>)</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $qty_total=0;
                $sub_total=0;
                $total_price=0;
                $total_discount=0;
                $total_taxablevalue = 0;
                $total_sgst = 0;
                $total_cgst = 0;
                $total_igst = 0;
                foreach ($quotation_items as $value) 
                {

                  $net = $value->qty * $value->rate;
                  $dis = $net * $value->discount/100;
                  $taxable_value = $net - $dis;
                  $total_discount += $dis;
                  $total_price+= $net;

                  $total_taxablevalue += $taxable_value;

                  $sgst = 0;
                  $cgst = 0;
                  $igst = 0;

                  $sgst_percent ='';
                  $cgst_percent ='';
                  $igst_percent ='';


                  if($country->state_id == $s->state_id)
                  {
                    $sgst = $value->tax/2;
                    $cgst = $value->tax/2;  

                    $sgst_percent = $value->tax_value/2;
                    $cgst_percent = $value->tax_value/2;

                  }
                  else
                  {
                    $igst = $value->tax;  
                    $igst_percent = $value->tax_value;
                  }

                  $total_sgst += $sgst; 
                  $total_cgst += $cgst;
                  $total_igst += $igst;

                  $qty_total=$qty_total + $value->qty; 
                  $sub_total=$sub_total + $value->amount;

                ?>
              <tr>
                <td class="text-center"><?php if(isset($value->item_name)){echo $value->item_name;}?></td>
                <td class="text-center"><?php if(isset($value->item_description)){echo $value->item_description;}?></td>
                <td class="text-center"><?php if(isset($value->hsn_code)){echo $value->hsn_code;}?></td>
                <td class="text-center"><?php if(isset($value->qty)){echo $value->qty;}?></td>
                <td class="text-center"><?php if(isset($value->rate)){echo $value->rate;}?></td>
                <td class="text-center"><?php if(isset($net)){echo $net;}?></td>
<!--                <td class="text-center"><?php if(isset($value->discount)){echo $value->discount;}?></td>
                <td class="text-center"><?php if(isset($dis)){echo $dis;}?></td>-->
                <td class="text-center"><?php if(isset($taxable_value)){echo $taxable_value;}?></td>
                <td class="text-center"><?php if(isset($sgst)){echo $sgst.' ('.$sgst_percent.'%)';}?></td>
                <td class="text-center"><?php if(isset($cgst)){echo $cgst.' ('.$sgst_percent.'%)';}?></td>
                <td class="text-center"><?php if(isset($igst)){echo $igst.' ('.$igst_percent.'%)';}?></td>
                <td class="text-center"><?php if(isset($value->amount)){echo $value->amount;}?></td>
              </tr>
              <?php } ?>
              
              <tr>
                <td class="text-right" colspan="5"><b><?php echo $this->lang->line('lbl_quotation_total');?></b></td>
                <td class="text-center"><?php if(isset($total_price)){echo $total_price;}?></td>
<!--                <td class="text-center"></td>
                <td class="text-center"><?php if(isset($total_discount)){echo $total_discount;}?></td>-->
                <td class="text-center"><?php if(isset($total_taxablevalue)){echo $total_taxablevalue;}?></td>
                <td class="text-center"><?php if(isset($total_sgst)){echo $total_sgst;}?></td>
                <td class="text-center"><?php if(isset($total_cgst)){echo $total_cgst;}?></td>
                <td class="text-center"><?php if(isset($total_igst)){echo $total_igst;}?></td>
                <td class="text-center"><?php if(isset($value->total_amount)){echo $value->total_amount;}?></td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

          <!-- <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          

          <p class="lead">Amount Due Date : <?php echo date('d-m-Y', strtotime($quotation->date. ' + '.$quotation->due_days.' days'));?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal (<?php echo $this->session->userdata("currencySymbol");?>) :</th>
                <td>
                    <?php if(isset($total_price)){echo number_format((float)$total_price, 2, '.', '');}?>    
                </td>
              </tr>
              <tr>
                <th style="width:50%">Discount (<?php echo $this->session->userdata("currencySymbol");?>) :</th>
                <td>
                  <?php if(isset($total_discount)){echo number_format((float)$total_discount, 2, '.', '');}?>    
                </td>
              </tr>
              <tr>
                <th>Tax (<?php echo $this->session->userdata("currencySymbol");?>) :</th>
                <td>
                  <?php if(isset($quotation->total_tax)){echo number_format((float)$quotation->total_tax, 2, '.', '');}?>     
                </td>
              </tr>
              <tr>
                <th>Shipping (<?php echo $this->session->userdata("currencySymbol");?>) :</th>
                <td>
                    <?php if(isset($quotation->shipping_charges)){echo number_format((float)$quotation->shipping_charges, 2, '.', '');}?>  
                </td>
              </tr>
              <tr>
                <th>Grand Total (<?php echo $this->session->userdata("currencySymbol");?>) :</th>
                <td>
                  <?php if(isset($quotation->total_amount)){echo number_format((float)$quotation->total_amount, 2, '.', '');}?>  
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <!-- <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div> -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


<!-- Delete Quotation Model -->
<div class="example-modal">
  <div class="modal fade" id="<?php echo''.$quotation->order_id.'';?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <center><h4 class="modal-title">
            <!-- !!  Delete Quotation !! -->
            <?php echo $this->lang->line('lbl_quotation_delete_modal');?>
          </h4></center>
        </div>
        <div class="modal-body">
          <p><h4><b>
            <!-- Are you sure to delete this Record !!&hellip; -->
            <?php echo $this->lang->line('delete_modal');?>
          </b></h4></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_modal_close');?></button>
            <a href="<?php echo base_url();?>Order/delete/<?php echo $quotation->order_id; ?>" class="btn btn-danger" ><?php echo $this->lang->line('btn_modal_delete');?></a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- End Delete Quotation Model -->



<!-- Email Modal start-->
  <div id="emailReceipt" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form id="" method="POST" action="<?php echo base_url();?>quotation/payment_email" name="sendMail">
      
      <div class="modal-content">
        <div class="modal-header btn-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center>
            <!-- Send Quotation information to client -->
            <?php echo $this->lang->line('lbl_quotation_email_title');?>
          </center></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="email">
              <!-- Send To: -->
              <?php echo $this->lang->line('lbl_email_sendto');?> : 
            </label>
            <input type="email" value="<?php echo $quotation->email;?>" class="form-control" name="email" id="email">
            <span style="font-size:20px;"></span>
        <p id="z" style="color:#990000;"></p>
          </div>
          <div class="form-group">
            <label for="subject">
              <!-- Subject -->
              <?php echo $this->lang->line('lbl_email_subject');?>:
              </label>
            <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $this->lang->line('lbl_email_model_subject');?> #<?php echo $quotation->reference_no;?>.">
            <span style="font-size:20px;"></span>
        <p id="z" style="color:#990000;"></p>
          </div>
          <div class="form-groupa">
            <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px">
              <?php echo $this->lang->line('hi');?> <?php echo $quotation->cust_name;?><br>

              <p><?php echo $this->lang->line('lbl_email_model_lines1');?> #<?php echo $quotation->reference_no;?> <?php echo $this->lang->line('lbl_email_model_lines2');?> <?php echo $quotation->date?></p>

              <br>
              <p><b><?php echo $this->lang->line('lbl_email_model_payment');?> : </b></p>
              <!-- Your Payment Information below describe -->
               Your order amount is <?php if(isset($quotation->total_amount)){echo $quotation->total_amount;}?><br>

              <p><b><?php echo $this->lang->line('lbl_cust_info');?></b></p>
              
              <p><?php if(isset($quotation->cust_name)){echo $quotation->cust_name;}?></p>
              <p><?php if(isset($quotation->cust_street)){echo $quotation->cust_street;}?></p>
              <p><?php if(isset($quotation->cust_city)){echo $quotation->cust_city;}?> - <?php if(isset($quotation->cust_state)){echo $quotation->cust_state;}?></p>
              <p><?php if(isset($quotation->country_name)){echo $quotation->country_name;}?> - <?php if(isset($quotation->cust_zipcode)){echo $quotation->cust_zipcode;}?></p>
              
              <b>
                <!-- Order Information -->
                <?php echo $this->lang->line('lbl_order_info');?>
              </b><br>

              <?php foreach ($quotation_items as $order) {?>
                  <?php if(isset($order->qty)){echo $order->qty;}?> X <?php if(isset($order->item_name)){echo $order->item_name;}?><br>
              <?php } ?>
              <br>
              <!-- Regards -->
              <b>Best Regards</b>
              <!-- Vaksys Pvt. Ltd. -->
              <p><?php if(isset($country->name)){echo $country->name;} ?></p>
            </textarea>
            
          <p id="z" style="color:#990000;"></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
            <!-- Close -->
            <?php echo $this->lang->line('btn_modal_close');?>
          </button>
          <!--<button type="submit" class="btn btn-primary btn-sm">
            <?php echo $this->lang->line('btn_modal_send');?>
          </button>-->
          <input type="submit" class="btn btn-info btn-flat" id="btn" name="sendemail" value="<?php echo $this->lang->line('btn_modal_send');?>">
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--Modal end -->



<?php 
  $this->load->view('layout/footer');
?>
<script type="text/javascript">
  $(document).ready(function()
  {
    $("#printBtn").click(function(){
    
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("section.orderPrint").printArea( options );
    });
  });
</script>