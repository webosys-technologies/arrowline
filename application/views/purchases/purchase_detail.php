<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }


?>
<?php foreach ($purchasedetail as $value)?>

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
              <!-- Purchase -->
              <?php echo $this->lang->line('lbl_purchase_heading');?>
              </div>
            </div>
            <div class="col-md-2">
            </div>
          </div>
        </div>
      </div>
      <!---Top Section End-->
      <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
              <div class="box-body">
                <div class="row">
            
                  <div class="col-md-12">
                    <div class="btn-group pull-right">
                     
                      <a target="_blank" href="<?php echo base_url()?>purchases/purchase_print/<?php echo $value->purchase_id;?>" title="Print" class="btn btn-default btn-flat">
                        <!-- Print -->
                          <?php echo $this->lang->line('btn_print');?>
                        </a>
 
                      <a href="<?php echo base_url();?>purchases/edit/<?php echo $value->purchase_id;?>" title="Edit" class="btn btn-default btn-flat">
                        <!-- Edit -->
                        <?php echo $this->lang->line('btn_edit');?>
                      </a>


                       <a href="#<?php echo''.$value->purchase_id.'';?>" data-toggle="modal" data-target="" class="btn btn-default btn-flat">
                        <!-- Delete -->
                        <?php echo $this->lang->line('btn_delete');?>
                        </a>

                        <div class="example-modal">
                              <div class="modal fade" id="<?php echo''.$value->purchase_id.'';?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      <center><h4 class="modal-title">
                                        <!-- !!  Delete Purchase !! -->
                                        <?php echo $this->lang->line('lbl_purchase_delete_modal');?>
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
                                        <a href="<?php echo base_url();?>purchases/delete/<?php echo $value->purchase_id; ?>" class="btn btn-danger">
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
                            <!-- /.example-modal -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <strong>
                      <!-- goBilling -->
                      <!-- <?php echo $this->lang->line('lbl_company_name');?> -->
                      <?php if(isset($country->name)){echo $country->name;} ?>
                    </strong>
                    <h5 class=""><?php 
                      if(isset($country->street)){
                        echo $country->street.','.$country->city_name;
                      }?>
                    </h5>
                    <h5 class=""><?php 
                      if (isset($country->state_name)) {
                        echo $country->state_name;  
                      }?>
                    </h5>
                    <h5 class=""><?php 
                    if (isset($country->country_name)) {
                      echo $country->country_name.','.$country->zip_code;  
                    }
                     ?></h5>
                  </div>
                  <div class="col-md-4">
                    <strong>
                      <!-- Bill To -->
                      <?php echo $this->lang->line('lbl_bill_to');?>
                    </strong>
                    <h5><?php if(isset($value->name)){echo $value->name;}?></h5>
                    <h5><?php if(isset($value->street)){echo $value->street;}?> , <?php if(isset($value->cust_city)){echo $value->cust_city;}?></h5>
                    <h5><?php if(isset($value->cust_state)){echo $value->cust_state;}?></h5>
                    <h5><?php if(isset($value->country_name)){echo $value->country_name;}?>-<?php if(isset($value->zipcode)){echo $value->zipcode;}?></h5>
                  </div>
                  <div class="col-md-4">
                    <strong>
                      <!-- Invoice No -->
                      <?php echo $this->lang->line('lbl_invoice_invoiceno');?>
                      #<?php if(isset($value->reference_no)){echo $value->reference_no;}?></strong><br>
                    <strong>
                      <!-- Date  -->
                      <?php echo $this->lang->line('lbl_invoice_date');?>
                      :<?php if(isset($value->date)){echo $value->date;}?></strong><br>
                    <strong>
                      <!-- Location  -->
                      <?php echo $this->lang->line('lbl_add_quotation_location');?>
                      : <?php if(isset($value->location_name)){echo $value->location_name;}?></strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered" id="salesInvoice">
                        <tbody>
                        <tr class="tbl_header_color dynamicRows">
                          <th width="35%" class="text-center">
                            <!-- Item Name -->
                            <?php echo $this->lang->line('add_item_name');?> 
                          </th>
<!--                          <th width="20%" class="text-center">
                             Description 
                            <?php echo $this->lang->line('lbl_add_quotation_desc');?>
                          </th>-->
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
<!--                          <th class="text-center" width="10%">
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
                            <?php echo $this->lang->line('lbl_igst');?>
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
                          foreach ($purchase as $value) 
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

                            if($country->state_id == $value->state_id)
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


                           /* $sgst = $value->tax_amount/2;
                            $cgst = $value->tax_amount/2;
                            $igst = 0;*/

                            $total_sgst += $sgst; 
                            $total_cgst += $cgst;
                            $total_igst += $igst;

                            $qty_total=$qty_total + $value->qty; 
                            $sub_total=$sub_total + $value->amount;
        
                          ?>
                        <tr>
                          <td class="text-center"><?php if(isset($value->item_name)){echo $value->item_name;}?></td>
                          <!--<td class="text-center"><?php if(isset($value->item_description)){echo $value->item_description;}?></td>-->
                          <td class="text-center"><?php if(isset($value->hsn_code)){echo $value->hsn_code;}?></td>
                          <td class="text-center"><?php if(isset($value->qty)){echo $value->qty;}?></td>
                          <td class="text-center"><?php if(isset($value->rate)){echo $value->rate;}?></td>
                          <td class="text-center"><?php if(isset($net)){echo $net;}?></td>
<!--                          <td class="text-center"><?php if(isset($value->discount)){echo $value->discount;}?></td>
                          <td class="text-center"><?php if(isset($dis)){echo $dis;}?></td>-->
                          <td class="text-center"><?php if(isset($taxable_value)){echo $taxable_value;}?></td>
                          <td align="right"><?php if(isset($sgst)){echo $sgst.' ('.$sgst_percent.'%)';}?></td>
                          <td align="right"><?php if(isset($cgst)){echo $cgst.' ('.$sgst_percent.'%)';}?></td>
                          <td align="right"><?php if(isset($igst)){echo $igst.' ('.$igst_percent.'%)';}?></td>
                          <td class="text-center"><?php if(isset($value->amount)){echo $value->amount;}?></td>
                        </tr>
                        <?php } ?>

                        <tr>
                          <td class="text-right" colspan="4"><b> <?php echo $this->lang->line('lbl_quotation_total');?> </b></td>
                          <td class="text-center">
                            <?php if(isset($total_price)){echo number_format((float)$total_price, 2, '.', '');}?>
                            <!-- <?php echo $total_price;?> -->
                            
                          </td>
<!--                          <td class="text-center"></td>
                          <td class="text-center">
                            <?php if(isset($total_discount)){echo number_format((float)$total_discount, 2, '.', '');}?>
                             <?php echo $total_discount;?> 
                            
                          </td>-->
                          <td class="text-center">
                            <?php if(isset($total_taxablevalue)){echo number_format((float)$total_taxablevalue, 2, '.', '');}?>
                            <!-- <?php echo $total_taxablevalue;?> -->
                            
                          </td>
                          <td class="text-center">
                            <?php if(isset($total_sgst)){echo number_format((float)$total_sgst, 2, '.', '');}?>
                            <!-- <?php echo $total_sgst;?> -->
                            
                          </td>
                          <td class="text-center">
                            <?php if(isset($total_cgst)){echo number_format((float)$total_cgst, 2, '.', '');}?>
                            <!-- <?php echo $total_cgst;?> -->
                            
                          </td>
                          <td class="text-center">
                            <?php if(isset($total_igst)){echo number_format((float)$total_igst, 2, '.', '');}?>
                            <!-- <?php echo $total_igst;?> -->
                            
                          </td>
                          <td class="text-center">
                            <?php if(isset($value->total_amount)){echo number_format((float)$value->total_amount, 2, '.', '');}?>
                            <!-- <?php echo $value->total_amount;?> -->
                            
                          </td>
                        </tr>

                        <?php foreach ($purchase as $value)?>

                        <tr class="tableInfos">
                          <td colspan="9" align="right">
                            <!-- Total Quantity  -->
                             <?php echo $this->lang->line('lbl_quantity_total');?>
                          </td><td align="right" colspan="2"><?php if(isset($qty_total)){echo $qty_total;}?></td>
                        </tr>
                        <tr class="tableInfos">
                          <td colspan="9" align="right">
                            <!-- Sub Total  -->
                            <?php echo $this->lang->line('lbl_add_quotation_subtotal');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)</td><td align="right" colspan="2"><?php if(isset($sub_total)){echo $sub_total;}?></td>
                        </tr>
<!--                        <tr class="tableInfos">
                          <td colspan="12" align="right">
                             Total Discount 
                            <?php echo $this->lang->line('lbl_total_discount');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </td>
                          <td align="right">
                            <?php if(isset($total_discount)){echo $total_discount;}?>
                          </td>
                        </tr>-->
                        <tr>
                          <td colspan="9" align="right">
                            <!-- Tax  -->
                            <?php echo $this->lang->line('lbl_add_quotation_totaltax');?>

                            (<?php echo $this->session->userdata("currencySymbol");?>)</td>
                          <td class="text-right"><?php if(isset($value->total_tax)){echo $value->total_tax;}?></td>
                        </tr>
                        <tr class="tableInfos">
                          <td colspan="9" align="right"><strong>
                            <!-- Grand Total  -->
                            <?php echo $this->lang->line('lbl_add_quotation_grandtotal');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)</strong></td>
                          <td class="text-right"><strong><?php if(isset($value->total_amount)){echo $value->total_amount;}?></strong></td>
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
  
  </section>
</div>
<!--Model End -->
<?php 
  $this->load->view('layout/footer');
?>