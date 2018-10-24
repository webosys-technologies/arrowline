<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<?php foreach ($quotation_order as $value)?>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <!---Top Section Start-->
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10">
             <div class="top-bar-title">
              <!-- Invoice -->
              <?php echo $this->lang->line('lbl_invoice');?>
            </div>
            </div>
            <div class="col-md-2">
              <?php if(in_array("add_invoice",$user_session)){?>
                <a class="btn btn-primary btn-flat pull-right" href="<?php echo base_url()?>sales/add_form"><i class="fa fa-truck"></i> 
                <!-- New Invoice -->
                <?php echo $this->lang->line('btn_add_invoice');?>
                </a>
              <?php } ?>
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

                  <div class="col-md-2">
                    <?php if($value->paid_amount == 0){?>
                      <div class="btn btn-warning" disabled>
                      <!-- Unpaid -->
                      <?php echo $this->lang->line('btn_payment_status_unpaid');?>
                      </div>
                    <?php }else if($value->sales_amount > $value->paid_amount){?>
                      <div class="btn btn-info" disabled>
                        <!-- Partially paid -->
                        <?php echo $this->lang->line('btn_payment_status_partially');?>
                      </div>
                    <?php }else{?>  
                      <div class="btn btn-success" disabled>
                        <!-- Paid -->
                        <?php echo $this->lang->line('btn_payment_status_paid');?>
                      </div>
                    <?php }?>
                  </div>

                  <div class="col-md-10">
                    <div class="btn-group pull-right">
                      <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailReceipt">
                        <!-- Email -->
                        <?php echo $this->lang->line('btn_email');?>
                      </button>

                      <a target="_blank" href="<?php echo base_url();?>invoice/sales_print/<?php echo $value->sales_id;?>" title="Print" class="btn btn-default btn-flat">
                        <!-- Print -->
                        <?php echo $this->lang->line('btn_print');?>
                      </a>

                      <?php if($value->final_status == "draft"){ ?>
                      <a href="<?php echo base_url();?>sales/edit_data/<?php echo $value->sales_id;?>" title="Edit" class="btn btn-default btn-flat">
                        <!-- Edit -->
                        <?php echo $this->lang->line('btn_edit');?>
                      </a>
                      <?php } ?>

                      <a href="#<?php echo''.$value->sales_id.'';?>" data-toggle="modal" data-target="" class="btn btn-default btn-flat delete-btn">
                        <!-- Delete -->
                        <?php echo $this->lang->line('btn_delete');?>
                      </a>

                      <?php $due = $value->sales_amount - $value->paid_amount;?>
                        <?php 
                          if(isset($user_session)){
                            if(in_array("add_payment",$user_session)){?>
                              <?php if($due > 0){?>
                                  <a href="<?php echo base_url();?>invoice/payment_details/<?php echo $value->sales_id;?>/<?php echo $value->invoice_id;?>" title="Print" class="btn btn-primary btn-flat delete-btn">
                                    <!-- Print -->
                                    <?php echo $this->lang->line('btn_pay_now');?>
                                  </a>
                      <?php }}} ?>


                      <div class="example-modal">
                        <div class="modal fade" id="<?php echo''.$value->sales_id.'';?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <center><h4 class="modal-title">
                                  <!-- !!  Delete Sales !! -->
                                  <?php echo $this->lang->line('lbl_sales_delete_modal');?>
                                </h4></center>
                              </div>
                              <div class="modal-body">
                                <p><h4><b>
                                  <!-- Are you sure to delete this Record !!&hellip; -->
                                  <?php echo $this->lang->line('delete_modal');?>
                                </b></h4></p>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">
                                  <!-- Close -->
                                  <?php echo $this->lang->line('btn_modal_close');?>
                                  </button>
                                  <a href="<?php echo base_url();?>sales/delete/<?php echo $value->sales_id; ?>" class="btn btn-danger">
                                    <!-- Delete -->
                                    <?php echo $this->lang->line('btn_modal_delete');?>
                                  </a>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="box-body">

                <div class="row">
                  <div class="col-md-4">
                    <strong>
                     <!--  goBilling -->
                      <?php if(isset($country->name)){echo $country->name;} ?>
                    </strong>
                    <h5 class=""><?php if(isset($country->street)){echo $country->street;} ?>,<?php if(isset($country->city_name)){echo $country->city_name;} ?></h5>
                    <h5 class=""><?php if(isset($country->state_name)){echo $country->state_name;} ?></h5>
                    <h5 class=""><?php if(isset($country->country_name)){echo $country->country_name;} ?>, <?php if(isset($country->zip_code)){echo $country->zip_code;} ?></h5>
                  </div>
                  <div class="col-md-4">
                    <strong>
                      <!-- Bill To -->
                      <?php echo $this->lang->line('lbl_bill_to');?>
                    </strong> 
                    <h5><?php if(isset($value->cust_name)){echo $value->cust_name;}?></h5>
                    <h5><?php if(isset($value->cust_street)){echo $value->cust_street;}?>  <?php if(isset($value->cust_city)){echo $value->cust_city;}?></h5>
                    <h5><?php if(isset($value->cust_state)){echo $value->cust_state;}?>  <?php if(isset($value->country_name)){echo $value->country_name;}?></h5>
                  </div>
                  <div class="col-md-4">
                    <strong>
                      <!-- Invoice No  -->
                      <?php echo $this->lang->line('lbl_invoice_invoiceno');?>
                      # <?php if($value->invoice_no){echo $value->invoice_no;}?></strong>
                    <h5>
                      <!-- Location  -->
                      <?php echo $this->lang->line('lbl_add_quotation_location');?>
                      : <?php if(isset($value->location_name)){echo $value->location_name;}?></h5>
                    <h5>
                      <!-- Invoice Date  -->
                      <?php echo $this->lang->line('lbl_invoice_date');?>
                      :<?php if(isset($value->invoice_date)){echo $value->invoice_date;}?></h5>
                    <!-- <h5>Due Date : 19-05-2017</h5> -->
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                        <tr class="tbl_header_color dynamicRows">
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
                          <th class="text-center" width="10%">
                            <!-- Discount -->
                             <?php echo $this->lang->line('lbl_add_quotation_discount');?>(%)
                          </th>
                          <th width="" class="text-center">
                            <!-- Discount Value -->
                            <?php echo $this->lang->line('lbl_discount_value');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </th>
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
                        <?php 
                          $qty_total=0;
                          $sub_total=0;
                          $total_price=0;
                          $total_discount=0;
                          $total_taxablevalue = 0;
                          $total_sgst = 0;
                          $total_cgst = 0;
                          $total_igst = 0;
                          foreach ($quotation_order as $value) 
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
                              $sgst = $value->tax_amount/2;
                              $cgst = $value->tax_amount/2;  

                              $sgst_percent = $value->tax_value/2;
                              $cgst_percent = $value->tax_value/2;

                            }
                            else
                            {
                              $igst = $value->tax_amount;  
                              $igst_percent = $value->tax_value;
                            }

                            $total_sgst += $sgst; 
                            $total_cgst += $cgst;
                            $total_igst += $igst;

                            $qty_total=$qty_total + $value->qty; 
                            $sub_total=$sub_total + $value->amount;




                         /* $qty_total=0;
                          $sub_total=0;
                          foreach ($quotation_order as $value) {
                            $qty_total=$qty_total + $value->qty; 
                            $sub_total=$sub_total + $value->amount;*/
                          ?>
                        <tr>
                          <td class="text-center"><?php if(isset($value->item_name)){echo $value->item_name;}?></td>
                          <td class="text-center"><?php if(isset($value->item_description)){echo $value->item_description;}?></td>
                          <td class="text-center"><?php if(isset($value->hsn_code)){echo $value->hsn_code;}?></td>
                          <td class="text-center"><?php if(isset($value->qty)){echo $value->qty;}?></td>
                          <td class="text-center"><?php if(isset($value->rate)){echo $value->rate;}?></td>
                          <td class="text-center"><?php if(isset($net)){echo $net;}?></td>
                          <td class="text-center"><?php if(isset($value->discount)){echo $value->discount;}?></td>
                          <td class="text-center"><?php if(isset($dis)){echo $dis;}?></td>
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
                          <td class="text-center"></td>
                          <td class="text-center"><?php if(isset($total_discount)){echo $total_discount;}?></td>
                          <td class="text-center"><?php if(isset($total_taxablevalue)){echo $total_taxablevalue;}?></td>
                          <td class="text-center"><?php if(isset($total_sgst)){echo $total_sgst;}?></td>
                          <td class="text-center"><?php if(isset($total_cgst)){echo $total_cgst;}?></td>
                          <td class="text-center"><?php if(isset($total_igst)){echo $total_igst;}?></td>
                          <td class="text-center"><?php if(isset($value->total_amount)){echo $value->total_amount;}?></td>
                        </tr>

                        <?php //foreach ($orderdetails as $value)?>

                        <tr class="tableInfos">
                          <td colspan="12" align="right">
                            <!-- Total Quantity -->
                            <?php echo $this->lang->line('lbl_quantity_total');?>
                          </td><td align="right"><?php if(isset($qty_total)){echo $qty_total;}?></td>
                        </tr>
                        <tr class="tableInfos">
                          <td colspan="12" align="right">
                            <!-- Sub Total  -->
                            <?php echo $this->lang->line('lbl_total_taxable_value');?>
                          (<?php echo $this->session->userdata("currencySymbol");?>)</td>
                          <td align="right"><?php if(isset($total_price)){echo $total_price;}?></td>
                        </tr>
                        <tr class="tableInfos">
                          <td colspan="12" align="right">
                            <!-- Total Discount -->
                            <?php echo $this->lang->line('lbl_total_discount');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </td>
                          <td align="right">
                            <?php if(isset($total_discount)){echo $total_discount;}?>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="12" align="right">
                            <!-- Tax  -->
                            <?php echo $this->lang->line('lbl_add_quotation_totaltax');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)</td>
                          <td class="text-right"><?php if(isset($value->total_tax)){echo $value->total_tax;}?></td>
                        </tr>

                        <tr>
                          <td colspan="12" align="right">
                            <!-- Shipping Charges -->
                            <?php echo $this->lang->line('lbl_shipping');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)</td>
                          <td class="text-right"><?php if(isset($value->shipping_charges)){echo $value->shipping_charges;}?></td>
                        </tr>

                        <tr class="tableInfos">
                          <td colspan="12" align="right"><strong>
                            <!-- Grand Total  -->
                            <?php echo $this->lang->line('lbl_add_quotation_grandtotal');?>
                          (<?php echo $this->session->userdata("currencySymbol");?>)</strong></td>
                          <td class="text-right"><strong><?php if(isset($value->total_amount)){echo $value->total_amount;}?></strong></td>
                        </tr>
                        
                        <tr class="tableInfos">
                          <td colspan="12" align="right"><strong>
                          <!-- Paid --> 
                          <?php echo $this->lang->line('btn_payment_status_paid');?>
                          (<?php echo $this->session->userdata("currencySymbol");?>)</strong></td>
                          <td class="text-right"><strong><?php if(isset($value->paid_amount)){echo $value->paid_amount;}?></strong></td>
                        </tr>
                        <tr class="tableInfos">
                          <td colspan="12" align="right"><strong>
                            <!-- Due Amount  -->
                            <?php echo $this->lang->line('lbl_payment_due');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)</strong></td>
                          <?php
                            //$sales =  $value->total_amount + $value->shipping_charges;
                            $due =  $value->total_amount - $value->paid_amount;

                            ?>
                          <td class="text-right"><strong><?php if(isset($due)){echo $due;}?></strong></td>
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

        <div class="col-md-4 left-padding-col4">
          <div class="box box-default">
            <div class="box-header text-center">
              <h5 class="text-left text-info"><b>
              <?php echo $this->lang->line('lbl_quotation_no');?> # <a href="<?php echo base_url()?>invoice/invoice_details/<?php echo $value->sales_id;?>"><?php echo $value->reference_no;?></a></b></h5>
            </div>
          </div>
          <div class="box box-default">
            <div class="box-header text-center">
              <strong>
                <!-- Invoice -->
                <?php echo $this->lang->line('lbl_invoice');?>
              </strong>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12 text-center">
                Quotation Invoiced on <?php echo $value->invoice_date;?>
                </div>
              </div>
            </div>
          </div>    
            <!--END-->
          <div class="box box-default">
            <div class="box-header text-center">
              <strong>
                <!-- Payments -->
                <?php echo $this->lang->line('payments');?>
              </strong>
            </div>
            <?php if($value->paid_amount == 0){?>
            <div class="box-body">
              <h5 class="text-center">
                <!-- No payment found! -->
                <?php echo $this->lang->line('lbl_null_payment');?>
              </h5>
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
                      <?php echo $this->lang->line('lbl_invoice_invoiceno');?>
                    </th>
                    <th>
                      <!-- Method -->
                      <?php echo $this->lang->line('lbl_add_quotation_payment');?>
                    </th>
                    <th>
                      <!-- Amount  -->
                      <?php echo $this->lang->line('lbl_add_quotation_amount');?>
                      (<?php echo $this->session->userdata("currencySymbol");?>)
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($payment)){?>
                  <?php foreach ($payment as $pay) {?>
                  <tr>
                    <td align="center"><?php echo $pay->invoice_no;?></td>
                    <td align="center"><?php echo $pay->name;?></td>
                    <td align="right"><?php echo $pay->amount;?></td>
                  </tr>
                  <?php }} ?>
                  <tr>
                    <td colspan="2" align="right">
                      <strong>
                      <!-- Total  -->
                      <?php echo $this->lang->line('lbl_quotation_total');?>
                      (<?php echo $this->session->userdata("currencySymbol");?>)
                      </strong>
                    </td>
                    <td align="right">
                      <strong> <?php echo $value->paid_amount;?></strong>
                    </td>
                  </tr>
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
        <form id="" method="POST" action="<?php echo base_url();?>invoice/sales_email" name="sendMail">
          <div class="modal-content">
            <div class="modal-header btn-info">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><center>
              <!-- Send Quotation information to client -->
              <?php echo $this->lang->line('lbl_sales_email_title');?>
              </center></h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="email">
                  <!-- Send To: -->
                  <?php echo $this->lang->line('lbl_email_sendto');?>
                </label>
                <input type="email" value="<?php if(isset($value->email)){echo $value->email;}?>" class="form-control" name="email" id="email">
                <span style="font-size:20px;"></span>
                <p id="z" style="color:#990000;"></p>
              </div>
              <div class="form-group">
                <label for="subject">
                  <!-- Subject: -->
                  <?php echo $this->lang->line('lbl_email_subject');?>:
                </label>
                <input type="text" class="form-control" name="subject" id="subject" value="Your invoice has been created with invoice no # <?php if(isset($value->invoice_no)){echo $value->invoice_no;}?>.">
                <span style="font-size:20px;"></span>
                <p id="z" style="color:#990000;"></p>
              </div>
              <div class="form-groupa">
                <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px">
                  <?php echo $this->lang->line('hi');?> <?php if(isset($value->name)){echo $value->name;}?><br>

                  <p>Thank you for your order .Here is a brief overview of your invoice: Invoice No #<?php if(isset($value->reference_no)){echo $value->reference_no;}?>.This invoice total is <?php if(isset($value->total_amount)){echo $value->total_amount;}?><br>
                  
                   Your Payment Information below describe</p><br>

                  <b>Your order amount is <?php if(isset($value->total_amount)){echo $value->total_amount;}?></b><br>
                 

                  <p><b>Customer information</b></p>

                  <p><?php if(isset($value->name)){echo $value->name;}?></p>
                  <p><?php if(isset($value->street)){echo $value->street;}?></p>
                  <p><?php if(isset($value->cust_city)){echo $value->cust_city;}?> , <?php if(isset($value->cust_state)){echo $value->cust_state;}?></p>
                  
                  <p><?php if(isset($value->country_name)){echo $value->country_name;}?> - <?php if(isset($value->zip_code)){echo $value->zip_code;}?></p>
                  

                  <b>Order Information</b>

                  <?php foreach ($quotation_order as $order) {?>
                      <p><?php if(isset($order->qty)){echo $order->qty;}?> X <?php if(isset($order->item_name)){echo $order->item_name;}?></p>
                  <?php } ?>
                    <!-- Regards -->
                    <b>Best Regards</b>
                    <!-- Vaksys Pvt. Ltd. -->
                    <p><?php if(isset($country->name)){echo $country->name;} ?></p>
                </textarea>

                <p id="z" style="color:#990000;"></p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><?php echo $this->lang->line('btn_modal_close');?></button>
              <!-- <button type="submit" class="btn btn-primary btn-sm"><?php echo $this->lang->line('btn_modal_send');?></button> -->
              <input type="submit" class="btn btn-info btn-flat" id="btn" name="sendemail" value="<?php echo $this->lang->line('btn_modal_send');?>">
            </div>
          </div>
        </form>
      </div>
    </div>
<!--Modal end -->
</div>


<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>

<script type="text/javascript">
    $(document).ready(function(){
     
        $("input[name='sendemail']").click(function(e){
            
            var email=chkEmpty("sendMail","email","Please Enter Email");
            var subject=chkEmpty("sendMail","subject","Please Enter Subject");
            var des=chktxtArea("emailSend","message","Please Enter Description");

            if(email + subject + des < 1)
            {
              sendMail.submit();
              return true;
            }
            else
            {
              return false;
            }

         });  
    });
</script>
