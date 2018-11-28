<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
?>

<?php foreach ($orderdetails as $value)?>

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
              <!-- Quotation -->
                <?php echo $this->lang->line('quotation_header');?>
              </div>
            </div>
            <div class="col-md-2">
              <?php if(in_array("add_invoice",$user_session)){?>
                <a class="btn btn-primary btn-flat pull-right" href="<?php echo base_url()?>quotation/add_form"><i class="fa fa-truck"></i> 
                <!-- New Invoice -->
                <?php echo $this->lang->line('btn_add_quotation');?>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <!---Top Section End-->
      <div class="row">
        <div class="col-md-8 right-padding-col8">
            <div class="box box-default">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <strong>
                      <!-- Quotation Date :  -->
                    <?php echo $this->lang->line('lbl_quotation_date');?> :
                    <?php 

                    if(isset($value->date)){
                      echo $value->date;
                    }
                    ?></strong>
                    <br>
                    <strong>
                      <?php echo $this->lang->line('lbl_add_quotation_location');?> : 
                      <?php 
                      if(isset($value->location_name))
                      {
                        echo $value->location_name;
                      }
                      ?></strong>
                  </div>
                  <div class="col-md-8">
                    <div class="btn-group pull-right">
                      <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailReceipt">
                        <!-- Email -->
                        <?php echo $this->lang->line('btn_email');?>
                      </button>

                      <a target="_blank" href="<?php echo base_url()?>quotation/order_print/<?php echo $value->quotation_id;?>" title="Print" class="btn btn-default btn-flat">
                        <!-- Print -->
                        <?php echo $this->lang->line('btn_print');?>
                      </a>

                      <?php 
                          if($value->status_edit == "draft"){
                        ?>
                      <a href="<?php echo base_url();?>quotation/edit_data/<?php echo $value->quotation_id;?>" title="Edit" class="btn btn-default btn-flat">
                          <!-- Edit -->
                        <?php echo $this->lang->line('btn_edit');?>
                      </a>
                      <?php } ?>

                      <a href="#<?php echo''.$value->quotation_id.'';?>" data-toggle="modal" data-target="" class="btn btn-default btn-flat">
                        <!-- Delete -->
                        <?php echo $this->lang->line('btn_delete');?>
                      </a>
                      
                      <div class="example-modal">
                          <div class="modal fade" id="<?php echo''.$value->quotation_id.'';?>">
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
                                    <a href="<?php echo base_url();?>quotation/delete/<?php echo $value->quotation_id; ?>" class="btn btn-danger" ><?php echo $this->lang->line('btn_modal_delete');?></a>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                        </div>
                        <!-- /.example-modal -->

                    </div>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <strong>
                      <!-- Billing -->
                      <?php if(isset($country->name)){echo $country->name;} ?>
                    </strong>
                    <h5 class=""><?php 
                    if(isset($country->street)){
                      echo $country->street.','.$country->city_name; 
                    }
                    ?></h5>
                    <h5 class=""><?php
                      if(isset($country->state_name))
                      {
                        echo $country->state_name; 
                      }
                     ?></h5>
                    <h5 class=""><?php 
                    if (isset($country->country_name)) {
                        echo $country->country_name.','.$country->zip_code;   
                      }
                    ?></h5>
                  </div>
                  <div class="col-md-6">
                    <strong>
                      <!-- Bill To -->
                      <?php echo $this->lang->line('lbl_bill_to');?>
                    </strong>
                    <h5><?php if(isset($value->cust_name)){echo $value->cust_name;}?></h5>
                    <h5><?php if(isset($value->cust_street)){echo $value->cust_street.",";}?>  <?php if(isset($value->cust_city)){echo $value->cust_city;}?></h5>
                    <h5><?php if(isset($value->cust_state)){echo $value->cust_state.",";}?></h5>
                    <h5> <?php if(isset($value->country_name)){echo $value->country_name;}?> <?php if(isset($value->cust_zipcode)){echo $value->cust_zipcode;}?></h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                        <tr class="tbl_header_color dynamicRows">
                          <th width="" class="text-center">
                            <!-- Item Name -->
                            <?php echo $this->lang->line('add_item_name');?>
                          </th>
                          <th width="" class="text-center">
                            <!-- Description -->
                            <?php echo $this->lang->line('lbl_add_quotation_desc');?>
                          </th>
                          <th width="" class="text-center">
                            <!-- HSN/SAC Code -->
                            <?php echo $this->lang->line('lbl_hsn_code');?>
                          </th>
                          <th width="" class="text-center">
                           <!--  Quantity -->
                            <?php echo $this->lang->line('lbl_add_quotation_quantity');?>
                          </th>
                          <th width="" class="text-center">
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
                            <?php echo $this->lang->line('lbl_igst');?>
                          </th>
                          <!-- <th width="10%" class="text-center">
                            <?php echo $this->lang->line('lbl_tax_amount');?>(<?php echo $this->session->userdata("currencySymbol");?>)
                          </th> -->
                          
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
                          foreach ($orderdetails as $value) 
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
                          <td class="text-center"><?php if(isset($value->discount)){echo $value->discount;}?></td>
                          <td class="text-center"><?php if(isset($dis)){echo $dis;}?></td>
                          <td class="text-center"><?php if(isset($taxable_value)){echo $taxable_value;}?></td>
                          <td class="text-center"><?php if(isset($sgst)){echo $sgst.' ('.$sgst_percent.'%)';}?></td>
                          <td class="text-center"><?php if(isset($cgst)){echo $cgst.' ('.$sgst_percent.'%)';}?></td>
                          <td class="text-center"><?php if(isset($igst)){echo $igst.' ('.$igst_percent.'%)';}?></td>
                          <td align="right"><?php if(isset($value->amount)){echo $value->amount;}?>.00</td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td class="text-right" colspan="5"><b><?php echo $this->lang->line('lbl_quotation_total');?></b></td>
                          <td class="text-center">
                            <!-- <?php echo $total_price;?> -->
                            <?php if(isset($total_price)){echo number_format((float)$total_price, 2, '.', '');}?>
                          </td>
                          <td class="text-center"></td>
                          <td class="text-center">
                            <!-- <?php echo $total_discount;?> -->
                            <?php if(isset($total_discount)){echo number_format((float)$total_discount, 2, '.', '');}?>  
                          </td>
                          <td class="text-center">
                            <!-- <?php echo $total_taxablevalue;?> -->
                            <?php if(isset($total_taxablevalue)){echo number_format((float)$total_taxablevalue, 2, '.', '');}?>  
                          </td>
                          <td class="text-center">
                            <!-- <?php echo $total_sgst;?> -->
                            <?php if(isset($total_sgst)){echo number_format((float)$total_sgst, 2, '.', '');}?>  
                          </td>
                          <td class="text-center">
                            <!-- <?php echo $total_cgst;?> -->
                            <?php if(isset($total_cgst)){echo number_format((float)$total_cgst, 2, '.', '');}?>    
                          </td>
                          <td class="text-center">
                            <!-- <?php echo $total_igst;?> -->
                            <?php if(isset($total_igst)){echo number_format((float)$total_igst, 2, '.', '');}?>
                          </td>
                          <td class="text-center">
                            <!-- <?php echo $value->total_amount;?> -->
                            <?php if(isset($value->total_amount)){echo number_format((float)$value->total_amount, 2, '.', '');}?>
                          </td>
                        </tr>


                        <?php foreach ($orderdetails as $value)?>

                        <tr class="tableInfos">
                          <td colspan="12" align="right">
                            <!-- Total Quantity -->
                            <?php echo $this->lang->line('lbl_quantity_total');?>
                          </td>
                          <td align="right">
                            <?php if(isset($qty_total)){echo $qty_total;}?>
                          </td>
                        </tr>

                        <tr class="tableInfos">
                          <td colspan="12" align="right">
                            <!-- Sub Total  -->
                            <?php echo $this->lang->line('lbl_add_quotation_subtotal');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </td>
                          <td align="right">
                            <?php if(isset($total_price)){echo $total_price;}?>
                          </td>
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
                          <td class="text-right">
                            <?php if(isset($value->total_tax)){echo $value->total_tax;}?>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="12" align="right">
                          Shipping Charges
                          <!-- <?php echo $this->lang->line('lbl_add_quotation_totaltax');?> -->
                          (<?php echo $this->session->userdata("currencySymbol");?>)</td>
                          <td class="text-right">
                            <?php if(isset($value->shipping_charges)){echo $value->shipping_charges;}?>
                          </td>
                        </tr>

                        <tr class="tableInfos">
                          <td colspan="12" align="right"><strong>
                            <!-- Grand Total  -->
                            <?php echo $this->lang->line('lbl_add_quotation_grandtotal');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                          </td>
                          <td class="text-right"><strong> 
                            <?php if(isset($value->total_amount)){echo $value->total_amount;}?></strong>
                          </td>
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
                <!-- Quotation No  -->
                <?php echo $this->lang->line('lbl_quotation_no');?>
                # <a href="<?php echo base_url();?>quotation/"><?php echo $value->reference_no;?></a></b></h5>
            </div>
          </div>
          <!--Start-->
          <div class="box box-default">
            <div class="box-header text-center">
              <strong>
                <!-- Invoice -->
                <?php echo $this->lang->line('lbl_invoice');?>
              </strong>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12 btn-block-left-padding">
                <?php if(empty($invoice)){?>
                  <?php if(in_array("add_invoice",$user_session)){?>
                    <a href="<?php echo base_url();?>invoice/generate_invoice/<?php echo $value->quotation_id;?>" title="Convert to invoice" class="btn btn-primary btn-flat btn-block ">
                      <!-- Generate Invoice -->
                      <?php echo $this->lang->line('btn_generateinvoice');?>
                    </a>
                <?php } ?>
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
            <div class="box-body">
              <h5 class="text-center">
                <!-- No payment found! -->
                <?php echo $this->lang->line('lbl_null_payment');?>
              </h5>
            </div>
          </div>      
        </div>      
    </div>
  </section>

<!--Modal start-->
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
                  <input type="email" value="<?php echo $value->email;?>" class="form-control" name="email" id="email">
                  <span style="font-size:20px;"></span>
              <p id="z" style="color:#990000;"></p>
                </div>
                <div class="form-group">
                  <label for="subject">
                    <!-- Subject -->
                    <?php echo $this->lang->line('lbl_email_subject');?>:
                    </label>
                  <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $this->lang->line('lbl_email_model_subject');?> #<?php echo $value->reference_no;?>.">
                  <span style="font-size:20px;"></span>
              <p id="z" style="color:#990000;"></p>
                </div>
                <div class="form-groupa">
                  <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px">
                    <?php echo $this->lang->line('hi');?> <?php echo $value->name;?><br>

                    <p><?php echo $this->lang->line('lbl_email_model_lines1');?> #<?php echo $value->reference_no;?> <?php echo $this->lang->line('lbl_email_model_lines2');?> <?php echo $value->date?></p>

                    <br>
                    <p><b><?php echo $this->lang->line('lbl_email_model_payment');?> : </b></p>
                    <!-- Your Payment Information below describe -->
                     Your order amount is <?php if(isset($value->total_amount)){echo $value->total_amount;}?><br>

                    <p><b><?php echo $this->lang->line('lbl_cust_info');?></b></p>
                    
                    <p><?php if(isset($value->name)){echo $value->name;}?></p>
                    <p><?php if(isset($value->street)){echo $value->street;}?></p>
                    <p><?php if(isset($value->cust_city)){echo $value->cust_city;}?> - <?php if(isset($value->cust_state)){echo $value->cust_state;}?></p>
                    <p><?php if(isset($value->country_name)){echo $value->country_name;}?> - <?php if(isset($value->zip_code)){echo $value->zip_code;}?></p>
                    
                    <b>
                      <!-- Order Information -->
                      <?php echo $this->lang->line('lbl_order_info');?>
                    </b><br>

                    <?php foreach ($orderdetails as $order) {?>
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