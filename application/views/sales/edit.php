<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  
  if(!in_array("edit_invoice",$user_session)){
      redirect('sales','refresh');
  }
?>

<div class="content-wrapper">  
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
           <div class="box-body">
              <form action="<?php echo base_url();?>sales/edit" method="POST" name="sales" id="sales_form">  
                
                   <!-- <?php foreach ($sales as $sales_items){
                    }
                    ?> -->
                    <input type="hidden" name="sales_id" value="<?php echo $sales_items->sales_id?>" id="sales_id">

                  <div class="col-md-6">
                  <h5><b>Customer Information</b></h5>
                  <div class="well">

                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>
                            <!-- Customer  -->
                            <?php echo $this->lang->line('lbl_add_quotation_customer');?>
                            <span class="text-danger"> *</span>
                            <a href="#customer" data-toggle="modal" data-target=""><span class="">Add Customer</span></a>
                          </label>
                          <div class="form-group">
                            <select class="form-control select2" style="" name="customer" id="customer_id">
                              <option value="">
                                <!-- Select Customer -->
                                <?php echo $this->lang->line('lbl_dropdown_customer');?>
                              </option>
                              <?php foreach ($customer as $value) { ?>
                                <option value="<?php echo $value->id;?>" <?php if($value->id == $sale->customer_id){ echo "selected"; }?>><?php echo $value->name;?></option>
                              <?php } ?>
                            </select>
                            <p style="color:#990000;"></p>
                            <span style="color:#990000"><?php echo form_error('customer');?></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">
                                <!-- Warehouse -->
                                <?php echo $this->lang->line('lbl_warehouse');?>
                              <span class="text-danger"> *</span></label>
                              <div class="form-group">
                                <select class="form-control select2" name="location" id="location_id">
                                  <option value="">
                                    <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                  </option>
                                    <?php foreach ($location as $value) { ?>
                                      <option value="<?php echo $value->id;?>" <?php if($value->id == $sale->location_id){ echo "selected"; }?>><?php echo $value->location_name;?></option>
                                    <?php } ?>
                                </select>
                                <p style="color:#990000;"></p>
                                <span style="color:#990000"><?php echo form_error('location');?></span>
                              </div>
                          </div>
                      </div>                      
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              <!-- Payment Method  -->
                              <?php echo $this->lang->line('lbl_add_quotation_payment');?>
                              <a href="#paymentmethod" data-toggle="modal" data-target=""><span class="" style="">Add Method</span></a>
                            <span class="text-danger"> *</span></label>
                            <div class="form-group">
                              <select class="form-control select2" name="paymentmethod" id="paymentmethod_id">
                                <option value="">
                                  <!-- Select Payment Method -->
                                  <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                </option>
                                  <?php foreach ($paymentmethod as $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id == $sale->payment_method_id){ echo "selected"; }?>><?php echo $value->name;?></option>
                                  <?php } ?>
                              </select>
                              <p style="color:#990000;"></p>
                              <span style="color:#990000"><?php echo form_error('paymentmethod');?></span>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>
                                <!-- Date -->
                                <?php echo $this->lang->line('lbl_add_quotation_date');?>
                              <span class="text-danger"> *</span></label>
                              <div class="form-group">
                                <input class="form-control" id="datepicker" type="text" name="sales_date" value="<?php echo $sale->date;?>" autocomplete="off">
                                <span style="color:#990000"><?php echo form_error('sales_date');?></span>
                                <p style="color:#990000;"></p>
                              
                              </div>
                              
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              <!-- Payment Term  -->
                              <?php echo $this->lang->line('lbl_payment_term');?>
                              <a href="#paymentterm1" data-toggle="modal" data-target=""><span class="" style="">Add Term</span></a>
                            <span class="text-danger"> *</span></label>
                            <div class="form-group">
                              <select class="form-control select2" name="paymentterm" id="paymentterm">
                                  <option value="">
                                    <!-- Select Payment Term -->
                                    <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                  </option>
                                  <?php foreach ($paymentTerm as $value) { ?>
                                    <option value="<?php echo $value->id;?>" <?php if($value->id == $sale->payment_term_id){ echo "selected"; }?>><?php echo $value->term;?></option>
                                  <?php } ?>
                              </select>
                              <p style="color:#990000;"></p>
                              <span style="color:#990000"><?php echo form_error('paymentterm');?></span>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">
                                <!-- Reference  -->
                                <?php echo $this->lang->line('lbl_addpurchase_reference');?>
                              </label> 
                              <div class="input-group">
                                   <input id="reference_no" class="form-control" value="<?php echo $sale->reference_no;?>" type="text" name="reference" readonly="">
                                   <input id="reference" class="form-control" value="<?php echo $sale->reference_no;?>" type="hidden" name="reference">
                              </div>
                              <p style="color:#990000;"></p>
                              <span style="color:#990000"><?php echo form_error('reference');?></span>
                          </div>
                      </div>  

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Status
                              <!-- <?php echo $this->lang->line('lbl_add_quotation_payment');?> -->
                            <span class="text-danger"> *</span></label>
                            <div class="form-group">
                              <select class="form-control select2" name="status">
                                  <option value="publish" <?php if($sale->status=='publish'){ echo 'selected';}?>> Publish </option>
                                  <option value="draft" <?php if($sale->status=='draft'){ echo 'selected';}?>> Draft </option>
                                  <!-- <?php foreach ($paymentmethod as $value) { 
                                      echo "<option value='$value->id'".set_select('paymentmethod',$value->id).">$value->name</option>";   
                                  }?> --> 
                              </select>
                              <p style="color:#990000;"></p>
                              <span style="color:#990000"><?php echo form_error('status');?></span>
                            </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="sales_invoice">Invoice Type</label>
                          <select id="sales_invoice" name="sales_invoice" class="form-control select2">
                            <option value="1" <?php if($sale->sales_invoice==1){ echo 'selected';} ?>>Regular</option>
                            <option value="2" <?php if($sale->sales_invoice==2){ echo 'selected';} ?>>SEZ Supplies with Payment</option>
                            <option value="3" <?php if($sale->sales_invoice==3){ echo 'selected';} ?>>SEZ Supplies without Payment</option>
                            <option value="4" <?php if($sale->sales_invoice==4){ echo 'selected';} ?>>Deemed Export</option>
                          </select>
                          <span class="validation-color" id="err_shipping_charge"><?php echo form_error('shipping_charge'); ?></span>
                        </div>
                      </div>

                      <div class="invoice_type_hide">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="port_code">Port Code</label>
                            <input type="text" name="port_code" id="port_code" class="form-control" value="<?php echo $sale->port_code; ?>">
                            <span class="validation-color" id="err_port_code"><?php echo form_error('port_code'); ?></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="shipping_bill_no">Shipping Bill Number</label>
                            <input type="text" name="shipping_bill_no" id="shipping_bill_no" class="form-control" value="<?php echo $sale->shipping_bill_no; ?>">
                            <span class="validation-color" id="err_shipping_bill_no"><?php echo form_error('shipping_bill_no'); ?></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="shipping_bill_date">Shipping Bill Date</label>
                            <input type="text" name="shipping_bill_date" id="datepicker1" class="form-control datepicker" value="<?php echo $sale->shipping_bill_date; ?>">
                            <span class="validation-color" id="err_shipping_bill_date"><?php echo form_error('shipping_bill_date'); ?></span>
                          </div>
                        </div>
                      </div>
                      <?php
                        if($sale->sales_invoice==1){
                      ?>
                        <script>
                          $('.invoice_type_hide').hide();
                        </script>
                      <?php
                        }
                      ?>
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <label>Sales Type</label><br>
                        <input type="radio" name="sales_type" id="sales_type" value="0" <?php if($sale->sales_type==0){ echo 'checked';} ?>> Through E-commerce <br>
                        <input type="radio" name="sales_type" id="sales_type" value="1" <?php if($sale->sales_type==1){ echo 'checked';} ?>> Other than E-commerce 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="checkbox" class="" id="gst_payable" name="gst_payable" value="YES" <?php if($sale->gst_payable=='YES'){ echo 'checked';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="gst_payable">GST Payable On Reverse Charge</label>
                        <span class="validation-color" id="err_gst_payable"><?php echo form_error('gst_payable'); ?></span>
                      </div>
                    </div>

                    </div>
                  </div>
                </div>

              <div class="col-md-6">
              <h5><b>Shipping Address</b></h5>
              <div class="well">                

                <div class="row">
                    <div class="col-md-6">
                          <div class="form-group">
                            <label>
                              <!-- Country -->
                              <?php echo $this->lang->line('lbl_country');?>
                            <span class="text-danger"> *</span></label>
                            <div class="form-group">
                              <select class="form-control select2" style="" name="country" id="country">
                                <option value="">
                                  <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                </option>
                                <?php foreach ($country as $val) { ?>
                                   <option value="<?php echo $val->id;?>" <?php if($val->id == $sale->country_id){ echo "selected"; }?>><?php echo $val->name;?></option>
                                  <?php } ?>
                              </select>

                              <p style="color:#990000;"></p>
                              <span style="color:#990000"><?php echo form_error('state');?></span>
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>
                          <!-- State -->
                          <?php echo $this->lang->line('lbl_state');?>
                        <span class="text-danger"> *</span></label>
                        <div class="form-group">
                          <select class="form-control select2" style="" name="state" id="state">
                            <option value="">
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                            <?php foreach ($state1 as $val) { ?>
                               <option value="<?php echo $val->id;?>" <?php if($val->id == $sale->state_id){ echo "selected"; }?>><?php echo $val->name;?></option>
                              <?php } ?>
                          </select>

                          <p style="color:#990000;"></p>
                          <span style="color:#990000"><?php echo form_error('state');?></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>
                          <!-- City -->
                          <?php echo $this->lang->line('lbl_city');?>
                        <span class="text-danger"> *</span></label>
                        <div class="form-group">
                          <select class="form-control select2" style="" name="city" id="city">
                            <option value="">
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                            <?php foreach ($city1 as $value) { ?>
                               <option value="<?php echo $value->id;?>" <?php if($value->id == $sale->city_id){ echo "selected"; }?>><?php echo $value->name;?></option>    
                            <?php } ?>
                              
                          </select>
                          <p style="color:#990000;"></p>
                          <span style="color:#990000"><?php echo form_error('city');?></span>
                        </div>
                      </div>
                    </div>        
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>
                          Shiping Address
                          <!-- <?php echo $this->lang->line('lbl_add_quotation_customer');?> -->
                        <span class="text-danger"> *</span></label>
                        <div class="form-group">
                          <textarea class="form-control" rows="2" id="shipping_address" name="shipping_address"><?php echo $sale->shipping_address;?></textarea>
                          <p style="color:#990000;"></p>
                          <span style="color:#990000"><?php echo form_error('shipping_address');?></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              <!-- Shipping Charge -->
                              <?php echo $this->lang->line('lbl_shipping');?>
                            </label> 
                              <div class="input-group">
                                   <input id="shipping" class="form-control text-right" value="<?php echo $sale->shipping_charges;?>" type="text" name="shipping">
                              </div>
                            <p style="color:#990000;"></p>
                            <span style="color:#990000"><?php echo form_error('reference_no');?></span>
                        </div>
                    </div> 

                </div>
              </div>
              </div>
              
              <div class="col-md-12">
                <div class="well">
                  <div class="row">

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Supplier Reference
                            </label> 
                              <div class="input-group">
                                   <input id="supplier_reference" class="form-control" type="text" name="supplier_reference" placeholder="Supplier Reference" value="<?php if(isset($sale->supplier_ref)){ echo $sale->supplier_ref;}?>">
                              </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Buyer Order No
                            </label> 
                              <div class="input-group">
                                   <input id="buyer_order_no" class="form-control" type="text" name="buyer_order_no" placeholder="Buyer Order No" value="<?php if(isset($sale->buyer_order)){ echo $sale->buyer_order;}?>">
                              </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Dispatch Document No
                            </label> 
                              <div class="input-group">
                                   <input id="dispatch_doc_no" class="form-control" type="text" name="dispatch_doc_no" placeholder="Dispatch Document No" value="<?php if(isset($sale->dispatch_doc_no)){ echo $sale->dispatch_doc_no;}?>">
                              </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label require" for="inputEmail3">  
                           Delivery Note Date
                          <span class="text-danger"> *</span></label>
                          <div class="form-group">
                            <input type="text" placeholder="Date" class="form-control valdation_check" id="datepicker1" name="del_note_date" value="<?php if(isset($sale->dilivery_note_date)){ echo $sale->dilivery_note_date;}?>">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Dispatch through
                            </label> 
                              <div class="input-group">
                                   <input id="dispatch_through" class="form-control" type="text" name="dispatch_through" placeholder="Dispatch through" value="<?php if(isset($sale->dispatch_through)){ echo $sale->dispatch_through;}?>">
                              </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Delivery Note
                            </label> 
                              <div class="input-group">
                                   <textarea placeholder="Terms of delivery" rows="3" class="form-control" name="delivery_note" id="delivery_note"><?php if(isset($sale->delivery_note)){ echo $sale->delivery_note;}?>
                                   </textarea>
                              </div>
                        </div>
                      </div>


                  </div>
                </div>
              </div>



                <div class="col-md-12">
                <div class="well">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio" name="optradio" id="radio1" checked>Product Code
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="optradio" id="radio2">Product Name
                          </label>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="exampleInputEmail1">
                            <!-- Add Items -->
                            <?php echo $this->lang->line('lbl_add_quotation_additems');?>
                          </label>
                          <input id="product_code" class="form-control" type="text" name="product_code" placeholder="Enter Product Code" autocomplete="off">
                          <input id="product_name" class="form-control" type="text" name="product_name" placeholder="Enter Product Name" style="display: none;" autocomplete="off">
                      </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-center" id="quantityMessage" style="color:#990000; font-weight:bold">
                    </div>
                  </div>
                </div>

                  <div class="row">
                      <div class="col-md-12">
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                          <div class="table-responsive">
                          <table class="table table-bordered sales_table" id="sales_table">
                            <thead>
                                <tr class="tbl_header_color dynamicRows">
                                  <th width="10%" class="text-center">
                                    <!-- Description -->
                                    <?php echo $this->lang->line('lbl_add_quotation_desc');?>
                                  </th>
                                  <th width="10%" class="text-center">
                                    <!-- HSN/SAC Code -->
                                    <?php echo $this->lang->line('lbl_hsn_code');?>
                                    <!-- <?php echo $this->lang->line('lbl_add_quotation_desc');?> -->
                                  </th>
                                  <th width="10%" class="text-center">
                                    <!-- Quantity -->
                                    <?php echo $this->lang->line('lbl_add_quotation_quantity');?>
                                  </th>
                                  <th width="8%" class="text-center">
                                    Available Qty
                                    <!-- <?php echo $this->lang->line('lbl_add_quotation_quantity');?> -->
                                  </th>
                                  <th width="10%" class="text-center">
                                    <!-- Rate -->
                                    <?php echo $this->lang->line('lbl_add_quotation_rate');?>
                                    (<?php echo $this->session->userdata("currencySymbol");?>)
                                  </th>
                                  <th width="15%" class="text-center">
                                    <!-- Tax -->
                                    <?php echo $this->lang->line('lbl_add_quotation_tax');?>
                                    (%)
                                  </th>
                                  <th width="15%" class="text-center">
                                    <!-- Tax --> 
                                    <?php echo $this->lang->line('lbl_add_quotation_tax');?>
                                    (<?php echo $this->session->userdata("currencySymbol");?>)
                                  </th>
                                  <th width="10%" class="text-center">
                                    <!-- Discount -->
                                    <?php echo $this->lang->line('lbl_add_quotation_discount');?>
                                    (%)
                                  </th>
                                  <th width="15%" class="text-center">
                                    <!-- Amount  -->
                                    <?php echo $this->lang->line('lbl_add_quotation_amount');?>
                                    (<?php echo $this->session->userdata("currencySymbol");?>)
                                  </th>
                                  <th width="5%" class="text-center">
                                    <!-- Action -->
                                    <?php echo $this->lang->line('lbl_quotation_action');?>
                                  </th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                              $subtotal=0;
                              $totalTax=0;
                              $ii=0;
                              $totalDiscount =0;
                              foreach ($sales as $sales_items) { 
                                $p = $sales_items->qty *$sales_items->rate;

                                $subtotal=$subtotal + $p;
                                $totalTax=$totalTax + $sales_items->tax_amount;

                                $totalDiscount = $totalDiscount + ($p * $sales_items->discount/100);
                                ?>
                              <tr>            
                                  <td class="sales_data">
                                    <input type="hidden" name="item_id" value="<?php echo $sales_items->item_id;?>" id="<?php echo $sales_items->item_id;?>">
                                    <input type="hidden" name="desc123" value="<?php echo $sales_items->item_description;?>">
                                    <?php echo $sales_items->item_name;?>
                                  </td>
                                  <td>
                                    <?php echo $sales_items->hsn_code;?>
                                  </td>
                                  <td>
                                    <input type="number" name="qty1" id="qty1" value="<?php echo $sales_items->qty;?>" class="form-control get-data qty1" autocomplete="off">
                                    <p class="qty_error" style="color:#990000;"></p>
                                  </td>
                                  <td>
                                    <?php echo $sales_items->available_qty;?>
                                    <input type="hidden" name="hidden_available_qtyhidden_available_qty" id="hidden_available_qty" value="<?php echo $sales_items->available_qty;?>" class="form-control" autocomplete="off">
                                  </td>
                                  <td>
                                    <!-- <input type="hidden" name="price" id="price" value="<?php echo $sales_items->rate;?>" class="form-control get-data price">
                                    <?php echo $sales_items->rate;?></td> -->

                                    <input type="text" name="price_change" id="price_change" value="<?php echo $sales_items->rate;?>" class="form-control" autocomplete="off">
                                    <input type="hidden" name="price" id="price" value="<?php echo $sales_items->rate;?>" class="form-control get-data price">


                                  <td>
                                   <select <select class="form-control" id="item_tax" name="item_tax" style="width: 100%;">>
                                        <option value="0"> Select </option>

                                        <?php foreach ($tax as $val) { ?>
                                            <option value="<?php echo $val->tax_id?>" <?php if($val->tax_id ==$sales_items->tax_id){ echo "selected";}?>> <?php echo $val->tax_name;?> </option>
                                        <?php } ?>

                                    </select>
                                  </td>
                                  
                                  <td>
                                      <input type="hidden" name="tax_rate" id="tax_rate" class="form-control tax_rate" value="<?php echo $sales_items->tax_amount;?>">
                                      <input type="hidden" name="hidden_tax_rate" id="hidden_tax_rate" class="form-control" value="<?php echo $sales_items->tax_value;?>">
                                      <input type="hidden" name="tax_id" id="tax_id" class="form-control" value="<?php echo $sales_items->tax_id;?>">
                                      <label id="tax_label">
                                        GST @ <?php echo $sales_items->tax_value;?> = <?php echo $sales_items->tax_amount;?><br>
                                        <!-- CGST @ <?php echo $sales_items->tax_value/2;?> = <?php echo $sales_items->tax_amount/2;?> -->
                                        </label>
                                  </td>

                                  <td>
                                    <input type="text" name="discount" id="discount" class="form-control discount" value="<?php echo $sales_items->discount;?>" autocomplete="off">

                                    <?php 
                                      $price = $sales_items->qty *$sales_items->rate;
                                      $dsct = $price * $sales_items->discount/100;
                                     ?>
                                    <input type="hidden" name="hiddendiscount" id="hiddendiscount" class="form-control hiddendiscount" value="<?php echo $dsct;?>">
                                  </td>

                                  <td>
                                    <input type="text" name="subtotal" id="subtotal" class="form-control subtotal" value="<?php echo $sales_items->amount;?>" readonly>
                                    <?php 
                                      $sbtotal = $sales_items->qty *$sales_items->rate;
                                     ?>
                                    <input type="hidden" name="totalsub" id="totalsub" class="form-control totalsub" value="<?php echo $sbtotal;?>">
                                  </td>

                                  <td>
                                    <button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory delete" onclick="hello(this.value);" value="" id=""><span class="fa fa-remove"></span></button>
                                  </td>
                              <tr>  
                              <?php 
                              $ii++; 
                              } ?>
                            </tbody>
                          </table>
                          <table class="table table-bordered" id="">
                              
                              <tr class="tableInfo">
                                  <td align="right" width="70%"><strong>
                                    <!-- Sub Total  -->
                                    <?php echo $this->lang->line('lbl_add_quotation_subtotal');?>
                                    (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                                  </td>
                                  <td align="left" width="30%"><strong id="subTotal"><?php echo number_format((float)$subtotal, 2, '.', '');?></strong></td>
                              </tr>
                              <tr class="tableInfo">
                                  <td align="right" width="70%"><strong>
                                    Total Discount
                                    <!-- <?php echo $this->lang->line('lbl_add_quotation_subtotal');?> -->
                                    (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                                  </td>
                                  <td align="left" width="30%"><strong id="discount_total"><?php echo number_format((float)$totalDiscount, 2, '.', '');?></strong></td>
                              </tr>
                              <tr class="tableInfo">
                                  <td align="right"><strong>
                                    <!-- Total Tax  -->
                                    <?php echo $this->lang->line('lbl_add_quotation_totaltax');?>
                                  (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                                  </td>
                                
                                  <td align="left" colspan="2"><strong id="taxTotal"><?php echo number_format((float)$totalTax, 2, '.', '');?></strong><input type="hidden" name="totalTax" id="taxTotal1" value="<?php echo number_format((float)$totalTax, 2, '.', '');?>"></td>
                              </tr>

                              <tr class="tableInfo">
                                  <td align="right"><strong>
                                    Shipping Charges
                                    <!-- <?php echo $this->lang->line('lbl_add_quotation_totaltax');?> -->
                                    (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                                  </td>
                                  <td align="left" colspan="2"><strong id=""><label id="shipp_charges"><?php echo $sales_items->shipping_charges;?></label></strong></td>

                              </tr>

                              <tr class="tableInfo">
                                <td align="right"><strong>
                                  <!-- Grand Totals  -->
                                  <?php echo $this->lang->line('lbl_add_quotation_grandtotal');?>
                                  (<?php echo $this->session->userdata("currencySymbol");?>)</strong></td>
                                <td align="left">
                                  <input type="text" name="grandTotal" class="form-control" id="grandTotal" size="5" readonly="" value="<?php echo $sales_items->total_amount;?>">
                                  <p style="color:#990000;"></p>
                                </td>
                              </tr>
                          </table>
                          </div>
                          <br>
                         <br>    
                       </div>
                      </div>
                      
                    <div class="col-md-12">
                          
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              <!-- Note -->
                              <?php echo $this->lang->line('lbl_add_quotation_note');?>
                            </label>
                            <textarea placeholder="<?php echo $this->lang->line('lbl_add_quotation_desc');?>" rows="3" class="form-control" name="comments" id="largeArea1"><?php echo $sales_items->notes;?></textarea>
                            <input type="hidden" name="largeArea" id="largeArea">
                            <input type="hidden" name="temptext" id="temptext">
                            <input type="hidden" name="temptext1" id="temptext1">
                        </div>
                        
                        <center>
                            <input type="submit" name="salesSubmit" class="btn btn-info btn-flat salesSubmit"
                            value="<?php echo $this->lang->line('btn_submit');?>">
                            <a href="<?php echo base_url();?>sales/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
                        </center>
                    </div>
                  </div>
              </form>
      </div>
    </div>
  </div>
 </div>
</section>

<!-- ADD NEW CUSTOMER -->
<div class="example-modal">
  <div class="modal fade" id="customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <center><h4 class="modal-title">
            <b>Add New Customer</b>
          </h4></center>
        </div>
        <div class="modal-body">
          
              <div class="box-footer">
                <div class="box-body" style="padding: 20px">
                    <div class="row">
                       <div class="col-md-12">
                          <div class="col-md-12">
                              <h4 class="text-primary text-center">
                                <!-- Customer Information -->
                                <?php echo $this->lang->line('lbl_cust_info');?>
                              </h4>

                              <div class="form-group">
                                  <label class="col-sm-4 control-label require" for="name">
                                  <!-- Name -->
                                  <?php echo $this->lang->line('lbl_name');?>
                                  <label style="color:red;">*</label></label>
                                      <div class="col-sm-8">
                                         <input type="text" class="form-control" id="name" name="name" tabindex="1" onblur='chkEmpty("customerForm","name","Please Enter Name");' >
                                         <span style="color: red;"><?php echo form_error('name'); ?></span>
                                         <span style="font-size:20px;"></span>
                                          <p id="name_error" style="color:#990000;"></p>
                                         
                                     </div>
                              </div>
               
                              <div class="form-group">
                                  <label class="col-sm-4 control-label require" for="inputEmail3">
                                  <!-- Email -->
                                    <?php echo $this->lang->line('lbl_email');?>
                                  </label>
                                    <div class="col-sm-8">
                                        <input type="email" value="" class="form-control" id="email" name="email" tabindex="2">
                                        <span style="color: red;"></span>
                                        <span style="font-size:20px;"></span>
                                         <h4 id="emailspan" style="font-size:15px;color:#990000"></h4>
                                        <p id="a" style="color:#990000;"></p>
                                    </div>
                              </div>

                              <div class="form-group">
                                   <label class="col-sm-4 control-label" for="contact">
                                   <!-- Phone -->
                                    <?php echo $this->lang->line('lbl_phone');?>
                                   <label style="color:red;">*</label></label>
                                     <div class="col-sm-8">
                                         <input type="text" value="" class="form-control" id="phone" name="phone" tabindex="3">
                                         <span style="color: red;"><?php echo form_error('phone'); ?></span>
                                         <span style="font-size:20px;"></span>
                                          <h4 id="phonespan" style="font-size:15px;color:#990000"></h4>
                                         <p id="phone_error" style="color:#990000;"></p>
                                    </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label require" for="street">Street</label>
                                  <div class="col-sm-8">
                                      <input type="text" class="form-control" id="street" name="street" tabindex="4">
                                      <span style="color: red;"></span>
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label" for="country">
                                <!-- Country -->
                                  <?php echo $this->lang->line('lbl_country');?>
                                </label>
                                  <div class="col-md-8">
                                      <select class="form-control select2" id="country_model"  name="country_model" tabindex="5" style="width: 100%">
                                         <option value="">
                                          <?php echo $this->lang->line('lbl_dropdown_customer');?>  
                                          </option>

                                          <?php 
                                            if(isset($country)){
                                              foreach ($country as $value) {?>
                                                <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option> 
                                            <?php }} ?>
                                      </select>
                                         <span style="color: red;"><?php echo form_error('country'); ?></span>
                                         <span style="font-size:20px;"></span>
                                    <p style="color:#990000;"></p>
                                </div>
                              </div>

                              <div class="form-group">
                               <label class="col-md-4 control-label" for="inputEmail3"><!-- State -->
                                <?php echo $this->lang->line('lbl_state');?>  
                               </label>
                                <div class="col-md-8">
                                  <select class="form-control select2" id="state_model" name="state_model" tabindex="6" style="width: 100%">
                                       <option value="">
                                       <!-- Select One -->
                                       <?php echo $this->lang->line('lbl_dropdown_customer');?> 
                                       </option>
                                    </select>
                                  <span style="color: red;"><?php echo form_error('state'); ?></span>
                                  <span style="font-size:20px;"></span>
                                  <p style="color:#990000;"></p>
                                </div>
                               </div>
                               <div class="form-group">
                                  <label class="col-md-4 control-label" for="state_code">
                                    State code
                                    
                                    <!-- <?php echo $this->lang->line('lbl_zipcode');?> -->
                                  </label>
                                    <div class="col-md-8">
                                      <input type="text" placeholder="State code" class="form-control" id="state_code" name="state_code" tabindex="7" value="">
                                      <span style="color: red;"></span>
                                      <span style="font-size:20px;"></span>
                                       <p style="color:#990000;"></p>
                                      </div>
                                </div>


                               <div class="form-group">
                                <label class="col-md-4 control-label require" for="inputEmail3">
                                <!-- City -->
                                  <?php echo $this->lang->line('lbl_city');?>  
                                </label>
                                  <div class="col-md-8">
                                    <select class="form-control select2" id="city_model" name="city_model" tabindex="8" style="width: 100%">
                                      <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                                    </select>
                                      <span style="color: red;"><?php echo form_error('city'); ?></span>
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label" for="zip_code">
                                <!-- Zip code -->
                                <?php echo $this->lang->line('lbl_zipcode');?>
                                </label>
                                  <div class="col-sm-8">
                                      <input type="text" class="form-control" id="zip_code" name="zip_code" tabindex="9">
                                      <span style="color: red;"></span>
                                      <span style="font-size:20px;"></span>
                                      <p id="b" style="color:#990000;"></p>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label" for="gstin">
                                <!-- GSTIN -->
                                <?php echo $this->lang->line('lbl_gstin');?>
                                </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="gstin" name="gstin" tabindex="10" maxlength="15">
                                        <span style="font-size:20px;"></span>
                                        <label>ex : 22AAAAA0000A1Z5(15 digit)</label>
                                        <span style="color: red;"></span>
                                        <p id="gstinno" style="color:#990000;"></p>
                                    </div>
                              </div>
                          </div>
              
                        </div>
                    </div>
                </div>
              </div>
            

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
            <?php echo $this->lang->line('btn_modal_close');?>
            </button>
            <input type="button" class="btn btn-danger" value="Save" name="add_customer" id="add_customer" data-dismiss="modal">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.example-modal -->


<!-- ADD NEW PAYMENT METHOD -->
<div class="example-modal">
  <div class="modal fade" id="paymentmethod">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <center><h4 class="modal-title">
            <b>Add New Payment Method</b>
          </h4></center>
        </div>
        <div class="modal-body">  
                <div class="form-group">
                  <label class="col-sm-4 control-label require" for="inputEmail3"> 
                      Payment Method
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Payment Method Name" class="form-control valdation_check" id="payment_method" name="payment_method">
                    <span style="color: #990000"></span>
                    <p style="color:#990000;" id="method_error"></p>
                  </div>
                </div>
                <br>
                <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
            <?php echo $this->lang->line('btn_modal_close');?>
            </button>
            <input type="submit" class="btn btn-danger" value="Save" id="add_payment" name="add_payment" data-dismiss="modal">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.example-modal -->

<!-- ADD NEW PAYMENT TERM -->
<div class="example-modal">
  <div class="modal fade" id="paymentterm1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <center><h4 class="modal-title">
            <b>Add New Payment Term </b>
          </h4></center>
        </div>
        <div class="modal-body">
          
                <div class="form-group">
                  <label class="col-sm-4 control-label require" for="inputEmail3"> 
                      Payment Term
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Payment Term" class="form-control valdation_check" id="payment_term" name="payment_term">
                    <span style="color: #990000"></span>
                    <p style="color:#990000;" id="term_error"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label require" for="inputEmail3"> 
                      Due Days
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Due Days" class="form-control" id="due_days" name="due_days">
                    <span style="color: #990000"></span>
                    <p style="color:#990000;" id="duedays_error"></p>
                  </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
            <?php echo $this->lang->line('btn_modal_close');?>
            </button>
            <input type="submit" class="btn btn-danger" value="Save" id="add_paymentterm" name="add_paymentterm" data-dismiss="modal">
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

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>


<script type="text/javascript">
  $(document).ready(function(){

      $('#sales_invoice').change(function(){
        var id = $('#sales_invoice').val();
        if(id==1){
          $('.invoice_type_hide').hide();
          $('#port_code').val('');
          $('#shipping_bill_no').val('');
          $('#shipping_bill_date').val('');
        }
        else{
          $('.invoice_type_hide').show();
        }
      });


    $("#product_name").hide();
    $("#radio1").click(function(){
        $("#product_code").show();        
        $("#product_name").hide();        
    });

    $("#radio2").click(function(){
        $("#product_code").hide();        
        $("#product_name").show();        
    });    

    $('#sales_form').on('keyup keypress keydown', function(e) {
      var keyCode = e.keyCode || e.which;
      //alert(keyCode);
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

    $("#add_customer").click(function ()
    {
        var cust_name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var street = $("#street").val();
        var country = $("#country_model").val();
        var state = $("#state_model").val();
        var state_code = $("#state_code").val();
        var city = $("#city_model").val();
        var zipcode = $("#zip_code").val();
        var gstin = $("#gstin").val();

        if(cust_name=="")
        {
          $('#name_error').text("Enter Customer Name");
          return false;
        }

        if(phone=="")
        {
          $('#phone_error').text("Enter Phone No");
          return false;
        }        

        $('#customer_id').html('<option value="">Select</option>');
        $.ajax({
          url:"<?php echo base_url('quotation/add_customer');?>",
          method:"POST",
          data:{
              name:cust_name,
              email:email,
              phone:phone,
              street:street,
              country:country,
              state:state,
              state_code:state_code,
              city:city,
              zip_code:zipcode,
              gstin:gstin
          },
          dataType : "json",
          success:function(data1)
          {
              var id = data1['customer'];
              for(i=0;i<data1['list'].length;i++){
                  $('#customer_id').append('<option value="'+ data1['list'][i].id + '">' + data1['list'][i].name + '</option>');
              }
              $('select[name^="customer"] option[value="'+id+'"]').attr("selected","selected");
              $('#customer_id').trigger("change");
          }
        });

    });


    $("#add_payment").click(function ()
    {
        var paymentmethod = $("#payment_method").val();
        if(paymentmethod=="")
        {
          $('#method_error').text("Enter Payment Method Name");
          return false;
        }

        $('#paymentmethod_id').html('<option value="">Select</option>');
        $.ajax({
          url:"<?php echo base_url('quotation/add_paymentmethod');?>",
          method:"POST",
          data:{payment_method:paymentmethod},
          dataType : "json",
          success:function(data1)
          {
              var id = data1['paymentmethod'];
              
              for(i=0;i<data1['method'].length;i++){
                  $('#paymentmethod_id').append('<option value="' + data1['method'][i].id + '">' + data1['method'][i].name + '</option>');
              }
              $('select[name^="paymentmethod"] option[value="'+id+'"]').attr("selected","selected");
              $("#payment_method").val("");
          }
        });
    });

    $("#add_paymentterm").click(function ()
    {
        var payment_term = $("#payment_term").val();
        var due_days = $("#due_days").val();

        if(payment_term=="")
        {
          $('#term_error').text("Enter Payment Term");
          return false;
        }

        if(due_days=="")
        {
          $('#duedays_error').text("Enter Due Days");
          return false;
        }


        $('#paymentterm').html('<option value="">Select</option>');

        $.ajax({
          url:"<?php echo base_url('quotation/add_paymentterm');?>",
          method:"POST",
          data:{
              payment_term:payment_term,
              due_days:due_days
          },
          dataType : "json",
          success:function(data1)
          {
              var id = data1['paymentterm'];
              for(i=0;i<data1['term'].length;i++){
                  $('#paymentterm').append('<option value="'+ data1['term'][i].id + '">' + data1['term'][i].term + '</option>');
              }
              $('select[name^="paymentterm"] option[value="'+id+'"]').attr("selected","selected");
              $("#payment_term").val("");
              $("#due_days").val("");
          }
    });
  });



    var mapping = { };
    $(function(){
            $('#product_code').autoComplete({
                minChars: 1,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    var warehouse_id = $('#location_id').val();
                    /*alert(warehouse_id);
                    alert(term);*/
                    $.ajax({
                      url: "<?php echo base_url('sales/getBarcodeProducts') ?>/"+term+'/'+warehouse_id,
                      type: "GET",
                      dataType: "json",
                      success: function(data){
                        var suggestions = [];
                        for(var i = 0; i < data.length; ++i) {
                            suggestions.push(data[i].product_code);
                            mapping[data[i].product_code] = data[i].id;
                        }
                        suggest(suggestions);
                        }
                    });
                },
                onSelect: function(event, ui) {
                  var warehouse_id = $('#location_id').val();
                  $.ajax({
                    url:"<?php echo base_url('sales/getProductUseCode') ?>/"+mapping[ui]+'/'+warehouse_id,
                    type:"GET",
                    dataType:"JSON",
                    success: function(data1){
                      filterData(data1);
                      $('#product_code').val('');
                    }
                  });
                } 
            });
            
      });

    var mapping = { };
    $(function(){
            $('#product_name').autoComplete({
                minChars: 1,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    var warehouse_id = $('#location_id').val();
                    /*alert(warehouse_id);
                    alert(term);*/
                    $.ajax({
                      url: "<?php echo base_url('sales/getNameProducts') ?>/"+term+'/'+warehouse_id,
                      type: "GET",
                      dataType: "json",
                      success: function(data){
                        var suggestions = [];
                        for(var i = 0; i < data.length; ++i) {
                            suggestions.push(data[i].item_name);
                            mapping[data[i].item_name] = data[i].id;
                        }
                        suggest(suggestions);
                        }
                    });
                },
                onSelect: function(event, ui) {
                  var warehouse_id = $('#location_id').val();
                  $.ajax({
                    url:"<?php echo base_url('sales/getProductUseName') ?>/"+mapping[ui]+'/'+warehouse_id,
                    type:"GET",
                    dataType:"JSON",
                    success: function(data1){
                      filterData(data1);
                      $('#product_name').val('');
                    }
                  });
                } 
            });
            
      });


    $("#shipping").on('keyup',function(){
        var ship = $(this).val();
        
        $("#shipp_charges").text(ship); 
        total();
        taxTotal();
        grandTotal();
        totalDiscount();     
    });

    $('#customer_id').change(function(){
        
        var id = $(this).val();

        $('#city').html('<option value="">Select One</option>');
        $('#state').html('<option value="">Select One</option>');
        $.ajax({
            url: "<?php echo base_url('quotation/getShippingData') ?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {


              for(i=0;i<data.country1.length;i++){
                $('#country').append('<option value="' + data.country1[i].id + '">' + data.country1[i].name + '</option>');
              }

              for(i=0;i<data.state1.length;i++){
                $('#state').append('<option value="' + data.state1[i].id + '">' + data.state1[i].name + '</option>');
              }

              for(i=0;i<data.city1.length;i++){
                $('#city').append('<option value="' + data.city1[i].id + '">' + data.city1[i].name + '</option>');
              }

              var country = "";
              var state = "";
              var city = "";
              var address = "";

              if(data.shipping)
              {
                  country = data.shipping.country_id;
                  state = data.shipping.state_id;
                  city = data.shipping.city_id;
                  address = data.shipping.street;
              }

              if(data.data1)
              {
                  country = data.data1.country_id;
                  state = data.data1.state_id;
                  city = data.data1.city_id;
                  //address = data.data1.street;
              }
              
              
              $('select[name^="country"]').val(country).attr("selected","selected");
              $('select[name^="state"]').val(state).attr("selected","selected");
              $('select[name^="city"]').val(city).attr("selected","selected");
              $('#shipping_address').text(address);
            }
          });


    });

    $('#location_id').change(function(){
        var id = $(this).val();
        $('#sales_table tbody').html("");
        $('#add_item1').html('<option value="">Select One</option>');
        $.ajax({
            url: "<?php echo base_url('sales/get_location_item') ?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              for(i=0;i<data.length;i++){
                $('#add_item1').append('<option value="' + data[i].id + '">' + data[i].item_name + '</option>');
              }
            }
          });
    });

    $('#state').change(function(){
        var id = $(this).val();
       
        $('#city').html('<option value="">Select One</option>');
        $.ajax({
            url: "<?php echo base_url('sales/getCity') ?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              for(i=0;i<data.length;i++){
                $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
              }
            }
          });
      });
    
    $('#country').change(function(){
      var id = $(this).val(); 
      $('#state').html('<option value="">Select One</option>');
      $.ajax({
          url: "<?php echo base_url('sales/getState') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            for(i=0;i<data.length;i++)
            {
              $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
      });
    });

    $('#country_model').change(function(){
        var id = $(this).val();
    
          $('#state_model').html('<option value="">Select</option>');
          $.ajax({
              url: "<?php echo base_url('customer/getState') ?>/"+id,
              type: "GET",
              dataType: "JSON",
              success: function(data){
                for(i=0;i<data.length;i++){
                  $('#state_model').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
              }
          });
    });



    $('#state_model').change(function(){
          var id = $(this).val();
          var country=$('#country_model').val();
         
          $('#city_model').html('<option value="">Select</option>');
          $.ajax({
              url: "<?php echo base_url('customer/getCity') ?>/"+id,
              type: "GET",
              dataType: "JSON",
              success: function(data){
                for(i=0;i<data.length;i++){
                  $('#city_model').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
              }
            });

          $.ajax({
              url: "<?php echo base_url('supplier/get_statecode')?>/"+id+'/'+country,
              type: "GET",
              dataType: "TEXT",
              success: function(data){
                //alert(data);
                $('#state_code').val(data);
                //alert(data.state_code[0].state_code);
              }
            });
       });

    var ii=0;
    itemArray = new Array();

    $("#add_item1").change(function ()
    {
        var id=this.value;
        var id1 = $("#location_id").val();

        /*alert(id+" "+id1);*/
        $.ajax({
          url:"<?php echo base_url('sales/get_items') ?>/"+ id +"/"+ id1,
          method:"POST",
          data:{item_id:id},
          dataType : "json",
          success:function(data1)
          {
          
            var item_id=data1['items'].id;
            var item_desc=data1['items'].item_description;
            var tax_id1=data1['items'].tax_id;

            var flag=0;
            
            $("table.sales_table").find('input[name^="item_id"]').each(function () {
                  if(data1['items'].id  == +$(this).val())
                  {
                    flag=1;
                    
                    alert("Oops Product Already In Sales !!");

                  }   
              });
              
              if(flag == 0){

                  addRow(data1,ii);        
              }
              ii++;
          }
        });

        $('#mySelect').on('change',function(){
          var currentRow=$(this).closest("tr");

          var ii=+currentRow.find('input[name^="id"]').val();
          //alert(ii);
          var id=$(this).val();
          
          itemArray[ii].tax_id=id;
          $('#largeArea').val(JSON.stringify(itemArray));
        });

    });

    $("table.sales_table").on("keyup change",'input[name^="qty1"]', function (event) {

          var currentRow=$(this).closest("tr");

          var ii=+currentRow.find('input[name^="id"]').val();

          var qty1=+currentRow.find('input[name^="qty1"]').val();

          var available_qty=+currentRow.find('input[name^="hidden_available_qty"]').val();

          if(qty1 > available_qty)
          {                      

            currentRow.find('input[name^="qty1"]').val(0);  
            qty1 = 0;
            currentRow.find('.qty_error').text('Quantity is greater then available!').fadeOut(3000);
            total(ii);
            taxTotal();
            grandTotal();
            totalDiscount();
            
          }

          var rate=+currentRow.find('input[name^="price"]').val();
          var discount=+currentRow.find('input[name^="discount"]').val();
          var tax_rate=+currentRow.find('input[name^="hidden_tax_rate"]').val();
          var tax_id=+currentRow.find('input[name^="tax_id"]').val();
          var subtotal = calculatePrice(qty1,rate);
          
          var discount_price = calculateDiscount(subtotal,discount);

          currentRow.find('select[name^="item_tax"]').val(tax_id).attr("selected","selected");

          var discountPrice=calculateDiscountPrice(subtotal,discount);
          var tax_rate1= (discountPrice*tax_rate)/100;

          var finalsubtotal = discountPrice + tax_rate1;

          /*currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));*/
          currentRow.find('label').html('GST @'+ (tax_rate) + ' = ' + (tax_rate1));

          currentRow.find('input[name^="subtotal"]').val(finalsubtotal.toFixed(2));  
          currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2));  
          currentRow.find('input[name^="hiddendiscount"]').val(discount_price);
          currentRow.find('input[name^="totalsub"]').val(subtotal);

          total();
          taxTotal();
          grandTotal();
          totalDiscount();
          
    });

    $("table.sales_table").on("keyup",'input[name^="discount"]', function (event) {

      var currentRow=$(this).closest("tr");
      var ii=+currentRow.find('input[name^="id"]').val();
      var discount=+currentRow.find('input[name^="discount"]').val();
      var rate=+currentRow.find('input[name^="price"]').val();
      var qty=+currentRow.find('input[name^="qty1"]').val();

      var price=calculatePrice(rate,qty);
      var discount_price = calculateDiscount(price,discount);

      var discountPrice=calculateDiscountPrice(price,discount);

     

      var tax_rate=+currentRow.find('input[name^="hidden_tax_rate"]').val();
      var tax_rate1= (discountPrice*tax_rate)/100;

       var finalsubtotal = discountPrice + tax_rate1;

      currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2)); 
      currentRow.find('input[name^="subtotal"]').val(finalsubtotal);
      currentRow.find('input[name^="hiddendiscount"]').val(discount_price);

      /*currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));*/
      currentRow.find('label').html('GST @'+ (tax_rate) + ' = ' + (tax_rate1));

      total();
      taxTotal();
      grandTotal();
      totalDiscount();
    });

    $("table.sales_table").on("keyup",'input[name^="price_change"]', function (event) {

          var currentRow=$(this).closest("tr");

          var ii=+currentRow.find('input[name^="id"]').val();

          var change=+currentRow.find('input[name^="price"]').val();
          
          currentRow.find('input[name^="price"]').val(change);  


          var qty1=+currentRow.find('input[name^="qty1"]').val();


          var rate=+currentRow.find('input[name^="price"]').val();
          var discount=+currentRow.find('input[name^="discount"]').val();
          var tax_rate=+currentRow.find('input[name^="hidden_tax_rate"]').val();
          var subtotal = calculatePrice(qty1,rate);
          var discount_price = calculateDiscount(subtotal,discount);

          var tax_id=+currentRow.find('input[name^="tax_id"]').val();
          currentRow.find('select[name^="item_tax"]').val(tax_id).attr("selected","selected");


          //alert(discount_price);
          var discountPrice=calculateDiscountPrice(subtotal,discount);
          var tax_rate1= (discountPrice*tax_rate)/100;

          var finalsubtotal = discountPrice + tax_rate1;
          
          currentRow.find('input[name^="subtotal"]').val(finalsubtotal.toFixed(2));  
          currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2));  
          currentRow.find('input[name^="hiddendiscount"]').val(discount_price);
          currentRow.find('input[name^="totalsub"]').val(subtotal);

          /*currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));*/
          currentRow.find('label').html('GST @'+ (tax_rate) + ' = ' +(tax_rate1));
          total();
          taxTotal();
          grandTotal();  
          totalDiscount();
    });


    $("table.sales_table").on("change",'#item_tax',function (event) 
        {
          
          var currentRow=$(this).closest("tr");
          var ii=+currentRow.find('input[name^="id"]').val();
          var id=+currentRow.find('#item_tax').val();
          var tax_rate="";
          //itemArray[ii].tax_id=id;

          $.ajax({
            url:"<?php echo base_url(); ?>quotation/find_tax",
            method:"POST",
            data:{tax_id:id},
            dataType : "json",
            success:function(data1)
            {
                
                if(id == 0)
                {
                  tax_rate = 0; 
                }
                else{
                  tax_rate=data1['taxvalue'].tax_value; 
                }

                //var tax_rate=data1['taxvalue'].tax_value; 
                
                currentRow.find('input[name^="hidden_tax_rate"]').val(tax_rate); 
                currentRow.find('input[name^="tax_id"]').val(id); 

                var qty1=+currentRow.find('input[name^="qty1"]').val();
                var rate=+currentRow.find('input[name^="price"]').val();
                var discount=+currentRow.find('input[name^="discount"]').val();
          
                var subtotal = calculatePrice(qty1,rate);
          
                var discountPrice=calculateDiscountPrice(subtotal,discount);
                var tax_rate1= (discountPrice*tax_rate)/100;

                var finalsubtotal = discountPrice + tax_rate1;
                
                /*itemArray[ii].qty=qty1;
                itemArray[ii].rate=rate;
                itemArray[ii].tax=tax_rate1;
                itemArray[ii].amount=finalsubtotal;
                
                $('#largeArea').val(JSON.stringify(itemArray));*/
                
                currentRow.find('input[name^="subtotal"]').val(finalsubtotal.toFixed(2));  
                currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2));  
                currentRow.find('input[name^="hidden_tax_rate"]').val(tax_rate);  

                /*currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));*/  
                currentRow.find('label').html('GST @'+ (tax_rate) + ' = ' + (tax_rate1));


                total(ii);
                taxTotal();
                grandTotal(); 
            }
          });

        });

    $('#sales_table').on('click', '.delete', function () {

      var row_id = $(this).attr("id");
      $(this).closest('tr').remove();

      var currentRow=$(this).closest("tr");
      var ii=+currentRow.find('input[name^="id"]').val();

      itemArray[ii]=null;
      $('#largeArea').val(JSON.stringify(itemArray));

      total();
      taxTotal();
      grandTotal();
      totalDiscount();
    });


    $("input[name='salesSubmit']").click(function(e)
    {
        var customer=chkDrop("sales","customer","Please Select Customer");
        var location=chkDrop("sales","location","Please Select Location");
        var paymentmethod=chkDrop("sales","paymentmethod","Please Select Payment");
        var sales_date=chkEmpty("sales","sales_date","Enter Sales Date");
        var paymentterm=chkDrop("sales","paymentterm","Please Select Payment Term");
        var total=chkGrandTotal("sales","grandTotal","Please Select one Item");

        var state=chkDrop("sales","state","Please Select State");
        var country=chkDrop("sales","state","Please Select Country");
        
        

        if((customer +location + paymentmethod + sales_date + paymentterm + total + state + country) < 1)
        {

          var flag = 0;
          $('.sales_data').each(function(){
            var currentRow=$(this).closest("tr");
            
            var qty1=+currentRow.find('input[name^="qty1"]').val();
            if(qty1 <= 0)
            {
              flag = 1;
            }
          });

          if(flag == 0){
            sales.submit();
            return true;
          }
          else{
            alert("Quantity is missing")
            return false;
          }

          /*sales.submit();
          return true;*/
        }
        else
        {
          return false;
        }
    });

    $(document).on("click",".salesSubmit",function(){
      var id1 = $("#location_id").val();
      var ii=0;
      itemArray = new Array();
      var data="";
      $('.sales_data').each(function(){
          var currentRow=$(this).closest("tr");
          var qty1=+currentRow.find('input[name^="qty1"]').val();

          var item_id=+currentRow.find('input[name^="item_id"]').val();
          var qty1=+currentRow.find('input[name^="qty1"]').val();
          var rate=+currentRow.find('input[name^="price"]').val();
          var discount=+currentRow.find('input[name^="discount"]').val();
          var tax_rate=+currentRow.find('input[name^="tax_rate"]').val();
          var tax_id=+currentRow.find('input[name^="tax_id"]').val();
          var amount=+currentRow.find('input[name^="subtotal"]').val();
          var sales_id=$('#sales_id').val();
          
          var items={"item_id":item_id,"sales_id":sales_id,"rate":rate,"qty":qty1,"tax_amount":tax_rate,"tax_id":tax_id,"discount":discount,"amount":amount,"location_id":id1}
          itemArray[ii]=items;

          data += item_id+','+sales_id+','+rate+','+qty1+','+tax_rate+','+tax_id+','+discount+','+amount+'~';
          $('#largeArea').val(JSON.stringify(itemArray));
          ii++;
      });
      $("input[name='temptext']").val(JSON.stringify(itemArray));
      $("input[name='temptext1']").val(data);
      /*alert(data);
      alert(JSON.stringify(itemArray));*/
    });

  });


  function filterData(data1)
  {
      var flag=0;
      $("table.sales_table").find('input[name^="item_id"]').each(function () {
            if(data1['items'].id  == +$(this).val())
            {
              flag=1;
              alert("Oops Product Already In Sales !!");
            }   
        });
        if(flag == 0){
            addRow(data1);        
        }
  }  


  function calculateDiscount(price,discount)
  {
    var dis = price * discount/100;
    return dis;
  }

  function totalDiscount()
  {
    var discount_total = 0;
    $("table.sales_table").find('input[name^="hiddendiscount"]').each(function () {
      discount_total += +$(this).val();
    });
    //itemArray[ii].total=grandTotal;
    $("#discount_total").text(discount_total.toFixed(2));  
  }


  function calculateDiscountPrice(p,d){
    var discount = [(d*p)/100];
    var result = (p-discount); 
    return result;
  }

  function calculatePrice (qty,rate){
     var price = (qty*rate);
     return price;
  }   


  function calculateTax(qty,tax)
  {
    var tax = (qty * tax);
    return tax;
  }

  function total()
  {
    
   var grandTotal = 0;
    $("table.sales_table").find('input[name^="totalsub"]').each(function () {
      grandTotal += +$(this).val();
    });
    //itemArray[ii].total=grandTotal;
    $("#subTotal").text(grandTotal.toFixed(2)); 
  }

  function taxTotal()
  {
    var taxTotal = 0;
    $("table.sales_table").find('input[name^="tax_rate"]').each(function () {
      taxTotal += +$(this).val();
    });
    $("#taxTotal").text(taxTotal.toFixed(2));
    $("#taxTotal1").val(taxTotal.toFixed(2));

  }

  function grandTotal()
  {
    /*var sub=parseInt($('#subTotal').text());
    var tax=parseInt($('#taxTotal').text());
    var subtotal = sub + tax;
    $("#grandTotal").val(subtotal.toFixed(2));*/

    var Total = 0;
    $("table.sales_table").find('input[name^="subtotal"]').each(function () {
      Total += +$(this).val();
    });

    var shipping=parseFloat($('#shipping').val());
    if(isNaN(shipping)){
      shipping = 0;
    }

    var grand = Total + shipping;


    $("#grandTotal").val(grand.toFixed(2));
    
  }


  function addRow(data1,ii)
  {

      var select_tax = "";
      select_tax += '<div class="form-group">';
      select_tax += '<select class="form-control select2" id="item_tax" name="item_tax" style="width: 100%;">';
      select_tax += '<option value="0">Select</option>';
        for(b=0;b<data1['tax'].length;b++){
          //var id =data1['tax'][b].tax_value +'|'+ data1['tax'][b].tax_id;

          select_tax += '<option value="' + data1['tax'][b].tax_id +'">' + data1['tax'][b].tax_name+ '</option>';
        }
      select_tax += '</select></div>';


      var table='<tr>'+                
      '<td class="sales_data">'+
        '<input type="hidden" name="id" value="'+ii+'" id="ii">'+
        '<input type="hidden" name="item_id" value="'+data1['items'].id+'" id="'+data1['items'].id+'">'+
        data1['items'].item_name+
      '</td>'+
      '<td>'+
          data1['items'].hsn_code+
        '</td>'+
      '<td>'+
        '<input type="number" name="qty1" id="qty1" value="0" class="form-control get-data qty1" autocomplete="off">'+
        '<p class="qty_error" style="color:#990000;"></p>'+
      '</td>'+
      '<td>'+
          data1['items'].qty_available+
          '<input type="hidden" name="hidden_available_qty" id="hidden_available_qty" class="form-control" value="'+data1['items'].qty_available+'">'+
      '</td>'+
      '<td>'+
          '<input type="text" name="price_change" id="price_change" value="'+data1['items'].sales_price+'" class="form-control" autocomplete="off">'+
          '<input type="hidden" name="price" id="price" value="'+data1['items'].sales_price+'" class="form-control get-data price">'+
      '</td>'+
      '<td>'+
          select_tax+
      '</td>'+
      '<td>'+
          '<input type="hidden" name="tax_rate" id="tax_rate" class="form-control tax_rate" value="0" readonly="">'+
          '<input type="hidden" name="hidden_tax_rate" id="hidden_tax_rate" class="form-control" value="'+data1['items'].tax_value+'">'+
          '<input type="hidden" name="tax_id" id="tax_id" class="form-control" value="'+data1['items'].tax_id+'">'+
          '<label id="tax_label"></label>'+
      '</td>'+

      '<td>'+
        '<input type="text" name="discount" id="discount" class="form-control discount" value="0" autocomplete="off">'+
        '<input type="hidden" name="hiddendiscount" id="hiddendiscount" class="form-control hiddendiscount">'+
      '</td>'+

      '<td>'+
        '<input type="text" name="subtotal" id="subtotal" class="form-control subtotal" value="'+data1['items'].sales_price * 0 +'" readonly>'+
        '<input type="hidden" name="totalsub" id="totalsub" class="form-control totalsub" value="">'+
      '</td>'+

      '<td>'+
            '<button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory delete" onclick="hello(this.value);" value="" id=""><span class="fa fa-remove"></span></button>'+ 
      '</td>'+

    '<tr>';
    
    $('#sales_table tbody').append(table);
    total();
    taxTotal();
    grandTotal();
  }
</script>

<script src="<?php echo base_url('assets/plugins/autocomplite/');?>jquery.auto-complete.js"></script>