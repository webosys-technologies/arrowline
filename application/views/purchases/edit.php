<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("edit_purchase",$user_session)){
      redirect('purchases','refresh');
  }
?>

<div class="content-wrapper">
  <section class="content">
     <div class="row">
       <div class="col-md-12">
         <div class="box box-default">
           <div class="box-body">
            <form action="<?php echo base_url();?>purchases/edit_purchase" method="POST" name="purchase" id="purchase_form">  
              <div class="row">
                   <div class="col-md-3">
                   <?php foreach ($purchase as $purchase_items){
                    }
                    ?>
                    <input type="hidden" name="purchase_id" value="<?php echo $purchase_items->purchase_id?>" id="purchase_id">
                    <div class="form-group">
                       <label for="exampleInputEmail1">
                        <!-- Supplier -->
                         <?php echo $this->lang->line('lbl_addpurchase_supplier');?>
                        <span class="text-danger"> *</span></label>
                          <div class="form-group">
                            <select class="form-control select2"  tabindex="-1" aria-hidden="true" name="supplier" disabled="">
                              <option value="">
                                  <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                </option>
                              <?php 
                              if(isset($supplier)){
                              foreach ($supplier as $value) { ?>
                                  <option value="<?php echo $value->id;?>" <?php if($value->id == $purchase_items->supplier_id){ echo "selected";}?>><?php echo $value->name;?></option>
                              <?php }} ?> 

                            </select>
                           <p style="color:#990000;"></p>
                            <span style="color:#990000"><?php echo form_error('supplier');?></span>
                          </div>
                    </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">
                            <!-- Warehouse -->
                            <?php echo $this->lang->line('lbl_warehouse');?>
                            <a href="#warehouse" data-toggle="modal" data-target="" ><span class="">Add Warehouse</span></a>
                          </label>
                          <div class="form-group">
                            <select class="form-control select2" name="location" id="location_id" readonly="">
                                <option value="">
                                  <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                </option>
                                <?php
                                  if($location){
                                  foreach ($location as $value) { ?>
                                  <option value="<?php echo $value->id;?>" <?php if($value->id == $purchase_items->location_id){ echo "selected";}?>><?php echo $value->location_name;?></option>
                                <?php }} ?>
                            </select>
                            <p style="color:#990000;"></p>
                            <span style="color:#990000"><?php echo form_error('location');?></span>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>
                              <!-- Date -->
                              <?php echo $this->lang->line('lbl_addpurchase_date');?>
                            <span class="text-danger"> *</span></label>
                            <div class="form-group">
                              <input class="form-control" id="datepicker" type="text" name="purchase_date" value="<?php echo date('Y-m-d'); ?>" autocomplete="off">
                              <p style="color:#990000;"></p>
                            <span style="color:#990000"><?php echo form_error('purchase_date');?></span>
                            </div>
                            
                        </div>
                    </div>


      
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              <!-- Reference -->
                              <?php echo $this->lang->line('lbl_addpurchase_reference');?>
                            </label> 
                            <div class="input-group">
                                  <input id="reference_no" class="form-control" value="<?php echo $purchase_items->reference_no;?>" type="text" name="reference_no" readonly="">
                                  <input id="reference" class="form-control" value="<?php echo $purchase_items->reference_no;?>" type="hidden" name="reference" readonly="">
                              </div>
                            <span id="errMsg" class="text-dangser"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Vendor Invoice No 
                               <!-- <?php echo $this->lang->line('lbl_addpurchase_reference');?> -->
                            </label> 
                            <div class="input-group">
                                 <input id="vender_invoice" class="form-control" value="<?php echo $purchase_items->vendor_invoice;?>" type="text" name="vender_invoice">
                                  <p style="color:#990000;"></p>
                                  <span style="color:#990000"><?php echo form_error('vender_invoice');?></span>     
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="received_in">
                              Received In
                               <!-- <?php echo $this->lang->line('lbl_addpurchase_reference');?> -->
                            </label> 
                            <div class="input-group">
                                 <input id="received_in" class="form-control" value="<?php echo $purchase_items->received_in;?>" type="text" name="received_in">
                                  <p style="color:#990000;"></p>
                                  <span style="color:#990000"><?php echo form_error('reference_no');?></span>     
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>
                              Delivery Date
                              <!-- <?php echo $this->lang->line('lbl_addpurchase_date');?> -->
                            <div class="form-group">
                              <input class="form-control" id="datepicker1" type="text" name="delivery_date" value="<?php echo $purchase_items->delivery_date;?>" autocomplete="off">
                              <p style="color:#990000;"></p>
                            <!-- <span style="color:#990000"><?php echo form_error('purchase_date');?></span> -->
                            </div>
                            
                        </div>
                    </div>

              </div> 

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

              <div class="row">
                <div class="col-md-12">
                  <div class="box-body no-padding">
                    <div class="table-responsive">
                      <table class="table table-bordered purchase_table" id="purchase_table">
                        <thead>
                          <tr class="tbl_header_color dynamicRows">
                            <th width="8%" class="text-center">
                              <?php echo $this->lang->line('lbl_addpurchase_description');?>
                            </th>
                            <th width="8%" class="text-center">
                                <!-- HSN/SAC Code -->
                                <?php echo $this->lang->line('lbl_hsn_code');?>
                            </th>
                            <th width="7%" class="text-center">
                              <!-- Quantity -->
                              <?php echo $this->lang->line('lbl_addpurchase_quantity');?>
                            </th>
                            <th width="10%" class="text-center">
                              <!-- Rate  -->
                              <?php echo $this->lang->line('lbl_addpurchase_rate');?>
                              (<?php echo $this->session->userdata("currencySymbol");?>)
                            </th>
                            <th width="12%" class="text-center">
                              <!-- Tax -->
                              <?php echo $this->lang->line('lbl_addpurchase_tax');?>
                              (%)
                            </th>
                            <th width="10%" class="text-center">
                              <!-- Tax  -->
                              <?php echo $this->lang->line('lbl_addpurchase_tax');?>
                                (<?php echo $this->session->userdata("currencySymbol");?>)
                            </th>

<!--                            <th width="8%" class="text-center">
                               Discount (%) 
                              <?php echo $this->lang->line('lbl_add_quotation_discount');?>(%)
                            </th>-->

                            <th width="8%" class="text-center">
                              <!-- Amount  -->
                              <?php echo $this->lang->line('lbl_addpurchase_amount');?>
                              (<?php echo $this->session->userdata("currencySymbol");?>)
                            </th>

                            <th width="15%" class="text-center">
                              Shipping Status
                            </th>

                            <th width="5%" class="text-center">
                              <!-- Action -->
                              <?php echo $this->lang->line('lbl_addpurchase_action');?>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $subtotal=0;
                            $totalTax=0;
                            $ii=0;
                            $totalDiscount =0;
                            foreach ($purchase as $purchase_items) { 
                              $p = $purchase_items->qty *$purchase_items->rate;

                              $subtotal=$subtotal + $purchase_items->qty *$purchase_items->rate;
                              $totalTax=$totalTax + $purchase_items->tax_amount;

                              $totalDiscount = $totalDiscount + ($p * $purchase_items->discount/100);
                              ?>
                            <tr>            
                                <td class="purchase_data">
                                  <!-- <input type="text" name="id" value="" id="ii"> -->
                                  <input type="hidden" name="item_id" value="<?php echo $purchase_items->item_id;?>" id="<?php echo $purchase_items->item_id;?>">
                                  <input type="hidden" name="desc123" value="<?php echo $purchase_items->item_description;?>">
                                  <?php if(isset($purchase_items->item_name)){echo $purchase_items->item_name;}?>
                                </td>

                                <td>
                                    <?php if(isset($purchase_items->hsn_code)){echo $purchase_items->hsn_code;}?>
                                </td>

                                <td class="">
                                  <input type="number" name="qty1" id="qty1" value="<?php echo $purchase_items->qty;?>" class="form-control get-data qty1" min="0">
                                  
                                </td>

                                <td>
                                  <!-- <input type="hidden" name="price" id="price" value="<?php echo $purchase_items->rate;?>" class="form-control get-data price">
                                  <?php if(isset($purchase_items->rate)){echo $purchase_items->rate;}?> -->

                                  <input type="text" name="price_change" id="price_change" value="<?php if(isset($purchase_items->rate)){echo $purchase_items->rate;}?>" class="form-control" autocomplete="off">
                                  <input type="hidden" name="price" id="price" value="<?php if(isset($purchase_items->rate)){echo $purchase_items->rate;}?>" class="form-control get-data price">
                                </td>

                                <td>
                                   <select <select class="form-control" id="item_tax" name="item_tax" style="width: 100%;">>
                                        <option value="0"> Select </option>
                                        <?php if(isset($tax)){?>
                                        <?php foreach ($tax as $val) { ?>
                                            <option value="<?php echo $val->tax_id?>" <?php if($val->tax_id ==$purchase_items->tax_id){ echo "selected";}?>> <?php echo $val->tax_name;?> </option>
                                        <?php }} ?>

                                    </select>
                                  </td>
                                
                                <td>
                                    <input type="hidden" name="tax_rate" id="tax_rate" class="form-control tax_rate" value="<?php if(isset($purchase_items->tax_amount)){echo $purchase_items->tax_amount;}?>" readonly="">
                                    <input type="hidden" name="hidden_tax_rate" id="hidden_tax_rate" class="form-control" value="<?php if(isset($purchase_items->tax_value)){echo $purchase_items->tax_value;}?>">
                                    <input type="hidden" name="tax_id" id="tax_id" class="form-control" value="<?php if(isset($purchase_items->tax_id)){echo $purchase_items->tax_id;}?>">
                                    <label id="tax_label">
                                        <!-- SGST @ <?php echo $purchase_items->tax_value/2;?> = <?php echo $purchase_items->tax_amount/2;?><br>
                                        CGST @ <?php echo $purchase_items->tax_value/2;?> = <?php echo $purchase_items->tax_amount/2;?> -->
                                        GST @ <?php if(isset($purchase_items->tax_value)){echo $purchase_items->tax_value;}?> = <?php if(isset($purchase_items->tax_amount)){echo $purchase_items->tax_amount;}?>

                                        </label>

                                </td> 

<!--                                <td>
                                    <input type="text" name="discount" id="discount" class="form-control discount" value="<?php if(isset($purchase_items->discount)){echo $purchase_items->discount;}?>">

                                    <?php 
                                      $price = $purchase_items->qty *$purchase_items->rate;
                                      $dsct = $price * $purchase_items->discount/100;
                                     ?>

                                    <input type="hidden" name="hiddendiscount" id="hiddendiscount" class="form-control hiddendiscount" value="<?php if(isset($dsct)){echo $dsct;}?>">
                                  </td>-->

                                <td>
                                  <input type="text" name="subtotal" id="subtotal" class="form-control subtotal" value="<?php if(isset($purchase_items->amount)){echo number_format((float)$purchase_items->amount, 2, '.', '');}?>" readonly>
                                   <?php 
                                      $sbtotal = $purchase_items->qty *$purchase_items->rate;
                                     ?>
                                  <input type="hidden" name="totalsub" id="totalsub" class="form-control totalsub" value="<?php if(isset($sbtotal)){echo $sbtotal;}?>">
                                </td>
                                <td>
                                  <label class="radio-inline"><input type="radio" name="optradio<?php echo $ii;?>" value="yes" <?php if($purchase_items->shipping_status=="yes"){ echo "checked";}?> <?php if($purchase_items->shipping_status==null){ echo "checked";}?>>Yes</label>
                                  <label class="radio-inline"><input type="radio" name="optradio<?php echo $ii;?>" value="no" <?php if($purchase_items->shipping_status=="no"){ echo "checked";}?>>No</label>
                                  <br>
                                  Remarks
                                  <textarea rows="2" cols="20" name="remark"><?php echo $purchase_items->remarks;?></textarea>
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
                        <table class="table table-bordered quotation_table" id="quotation_table">
                            <tr class="tableInfo" style="">
                              <td align="right" width="70%"><strong>Sub Total (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                              </td>
                              <td align="left" width="30%"><strong id="subTotal"><?php if(isset($subtotal)){echo number_format((float)$subtotal, 2, '.', '');}?></strong></td>
                            </tr>
                            
<!--                            <tr class="tableInfo">
                                  <td align="right" width="70%"><strong>
                                    Total Discount
                                     <?php echo $this->lang->line('lbl_add_quotation_subtotal');?> 
                                    (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                                  </td>
                                  <td align="left" width="30%"><strong id="discount_total"><?php if(isset($totalDiscount)){echo number_format((float)$totalDiscount, 2, '.', '');}?></strong></td>
                            </tr>-->

                            <tr class="tableInfo" style="">
                                <td align="right" width="70%"><strong>Total Tax (<?php echo $this->session->userdata("currencySymbol");?>)</strong>
                                </td>
                                <td align="left" width="30%"><strong id="taxTotal"><?php if(isset($totalTax)){echo number_format((float)$totalTax, 2, '.', '');}?></strong><input type="hidden" name="totalTax" id="taxTotal1" value="<?php echo number_format((float)$totalTax, 2, '.', '');?>"></td>
                            </tr>
    
                            <tr class="tableInfo" style="">
                              <td align="right"><strong>Grand Total (<?php echo $this->session->userdata("currencySymbol");?>)</strong></td>
                              <td align="left">
                                  <input type="text" name="grandTotal" class="form-control" id="grandTotal" size="5" readonly="" value="<?php if(isset($purchase_items->total_amount)){echo $purchase_items->total_amount;}?>">
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
                    <?php echo $this->lang->line('lbl_addpurchase_note');?>
                  </label>
                  <textarea placeholder="<?php echo $this->lang->line('lbl_addpurchase_description');?>" rows="3" class="form-control" name="largeArea" id="largeArea"><?php if(isset($purchase_items->notes)){echo $purchase_items->notes;}?></textarea>
                  <input type="hidden" name="purchase_data" value="" id="purchase_data">
                  <input type="hidden" name="temptext1" value="" id="temptext1">
              </div>
              
              <center>
                <input type="submit" name="purchaseSubmit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-info btn-flat purchaseSubmit" id="purchaseSubmit">
                <a href="<?php echo base_url();?>purchases/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
              </center>
              
            </div>
          </div>
        </form>      
      </div>
    </div>                                          
  </div>
</div>
</div>

<!-- ADD NEW Warehouse -->
<div class="example-modal">
  <div class="modal fade" id="warehouse">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <center><h4 class="modal-title">
            <b>Add New Warehouse</b>
          </h4></center>
        </div>
        <div class="modal-body">
            <!-- <form class="form-horizontal" name="warehouse_form" id="warehouse_form"> -->
                <div class="form-group">
                  <label class="col-sm-4 control-label require" for="inputEmail3">        <!-- Location Name -->
                      <?php echo $this->lang->line('lbl_warehouse_name');?>
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Location Name" class="form-control valdation_check" id="warehouse_name" name="warehouse_name">
                    <span style="color: #990000"></span>
                    <p style="color:#990000;" id="warehouse_error"></p>
                  </div>
                </div>
                <br>
            <!-- </form> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
            <?php echo $this->lang->line('btn_modal_close');?>
            </button>
            <input type="button" class="btn btn-danger" value="Save" name="add_warehouse" id="add_warehouse" data-dismiss="modal">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.example-modal -->

</section>

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>

<script type="text/javascript">
  $(document).ready(function(){
    var count=<?php echo $ii;?>;

    $("#product_name").hide();


    $("#radio1").click(function(){
        $("#product_code").show();        
        $("#product_name").hide();        
    });

    $("#radio2").click(function(){
        $("#product_code").hide();        
        $("#product_name").show();        
    });    

    $('#purchase_form').on('keyup keypress keydown', function(e) {
      var keyCode = e.keyCode || e.which;
      //alert(keyCode);
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

    $("#add_warehouse").click(function ()
    {
        var warehouse = $("#warehouse_name").val();

        if(warehouse=="")
        {
          $('#warehouse_error').text("Enter Warehouse Name");
          return false;
        }

        $('#location_id').html('<option value="">Select</option>');
        $.ajax({
          url:"<?php echo base_url('quotation/add_warehouse');?>",
          method:"POST",
          data:{warehouse_name:warehouse},
          dataType : "json",
          success:function(data1)
          {
              var id = data1['warehouse_id'];
              for(i=0;i<data1['warehouse'].length;i++){
                  $('#location_id').append('<option value="' + data1['warehouse'][i].id + '">' + data1['warehouse'][i].location_name + '</option>');
              }
              $('select[name^="location"] option[value="'+id+'"]').attr("selected","selected");
              $("#warehouse_name").val("");
          }
        });
    });

    var mapping = { };
    $(function(){
            $('#product_code').autoComplete({
                minChars: 1,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    //var warehouse_id = $('#location_id').val();
                    /*alert(warehouse_id);
                    alert(term);*/
                    $.ajax({
                      url: "<?php echo base_url('purchases/getBarcodeProducts') ?>/"+term,
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
                  //var warehouse_id = $('#location_id').val();
                  $.ajax({
                    url:"<?php echo base_url('purchases/getProductUseCode') ?>/"+mapping[ui],
                    type:"GET",
                    dataType:"JSON",
                    success: function(data1){
                   
                      filterData(data1,count);
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
                    //var warehouse_id = $('#location_id').val();
                    /*alert(warehouse_id);
                    alert(term);*/
                    $.ajax({
                      url: "<?php echo base_url('purchases/getNameProducts') ?>/"+term,
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
                  //var warehouse_id = $('#location_id').val();
                  $.ajax({
                    url:"<?php echo base_url('purchases/getProductUseName') ?>/"+mapping[ui],
                    type:"GET",
                    dataType:"JSON",
                    success: function(data1){
                      filterData(data1,count);
                      $('#product_name').val('');
                    }
                  });
                } 
            });
            
      });



    $("#add_item1").change(function ()
    {
        //$('#purchaseInvoice').html('');
       
        var id=this.value;
        $.ajax({
          url:"<?php echo base_url(); ?>purchases/get_items",
          method:"POST",
          data:{item_id:id},
          dataType : "json",
          success:function(data1)
          {
              var item_id=data1['items'].id;
              var item_desc=data1['items'].item_description;
              var tax_id1=data1['items'].tax_id;

              var flag=0;
              $("table.purchase_table").find('input[name^="item_id"]').each(function () {
                    if(data1['items'].id  == +$(this).val()){
                      flag=1;
                      alert("Oops Product Already In Exists !!");
                    }   
                });
             
                if(flag == 0){
                    addRow(data1,count);        
                }
                count++
               
          }
        });

        $('#mySelect').on('change',function(){
           var currentRow=$(this).closest("tr");
          var ii=+currentRow.find('input[name^="id"]').val();
            alert(ii);
            var id=$(this).val();
            itemArray[ii].tax_id=id;
            $('#largeArea').val(JSON.stringify(itemArray));
        });

    });
    

    $("input[name='purchaseSubmit']").click(function(e){
      var date=chkEmpty("purchase","purchase_date","Please Select Date");
      var total=chkGrandTotal("purchase","grandTotal","Please Select one Item");
      if(date+total < 1)
      {

        var flag = 0;
        $('.purchase_data').each(function(){
          var currentRow=$(this).closest("tr");
          
          var qty1=+currentRow.find('input[name^="qty1"]').val();
          if(qty1 == 0)
          {
            flag = 1;
          }
        });

        if(flag == 0){
          purchase.submit();
          return true;
        }
        else{
          alert("Quantity is missing")
          return false;
        }
      }else{
        return false;
      }

    });

    
    $("table.purchase_table").on("keyup change",'input[name^="qty1"]', function (event) {

          var currentRow=$(this).closest("tr");

          var ii=+currentRow.find('input[name^="id"]').val();

          var qty1=+currentRow.find('input[name^="qty1"]').val();
          var rate=+currentRow.find('input[name^="price"]').val();
//          var discount=+currentRow.find('input[name^="discount"]').val();
          var discount=0;
          var tax_rate=+currentRow.find('input[name^="hidden_tax_rate"]').val();

          var subtotal = calculatePrice(qty1,rate);
          
          var discount_price = calculateDiscount(subtotal,discount);

          var tax_id=+currentRow.find('input[name^="tax_id"]').val();
          currentRow.find('select[name^="item_tax"]').val(tax_id).attr("selected","selected");

          var discountPrice=calculateDiscountPrice(subtotal,discount);
          var tax_rate1= (discountPrice*tax_rate)/100;

          var finalsubtotal = discountPrice + tax_rate1;
          
          currentRow.find('input[name^="subtotal"]').val(finalsubtotal.toFixed(2));  
          currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2));  
          currentRow.find('input[name^="hiddendiscount"]').val(discount_price);
          currentRow.find('input[name^="totalsub"]').val(subtotal);

          /*currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));*/
          currentRow.find('#tax_label').html('GST @'+ (tax_rate) + ' = ' + (tax_rate1));
          total();
          taxTotal();
          grandTotal();  
          totalDiscount();
    });

    $("table.purchase_table").on("keyup",'input[name^="discount"]', function (event) {

          var currentRow=$(this).closest("tr");
          var ii=+currentRow.find('input[name^="id"]').val();
//          var discount=+currentRow.find('input[name^="discount"]').val();
          var discount=0;
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

          //currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));
          currentRow.find('#tax_label').html('GST @'+ (tax_rate) + ' = ' + (tax_rate1));

          total();
          taxTotal();
          grandTotal();
          totalDiscount();
    });

    $("table.purchase_table").on("keyup",'input[name^="price_change"]', function (event) {
          var currentRow=$(this).closest("tr");
          var change=+currentRow.find('input[name^="price"]').val();

          currentRow.find('input[name^="price"]').val(change);  
          var qty1=+currentRow.find('input[name^="qty1"]').val();

          var rate=+currentRow.find('input[name^="price_change"]').val();
//          var discount=+currentRow.find('input[name^="discount"]').val();
          var discount=0;
          var tax_rate=+currentRow.find('input[name^="hidden_tax_rate"]').val();

          var subtotal = calculatePrice(qty1,rate);

          var discount_price = calculateDiscount(subtotal,discount);

          var tax_id=+currentRow.find('input[name^="tax_id"]').val();
          currentRow.find('select[name^="item_tax"]').val(tax_id).attr("selected","selected");

          var discountPrice=calculateDiscountPrice(subtotal,discount);
          var tax_rate1= (discountPrice*tax_rate)/100;

          var finalsubtotal = discountPrice + tax_rate1;
          
          currentRow.find('input[name^="subtotal"]').val(finalsubtotal.toFixed(2));  
          currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2));  
          currentRow.find('input[name^="hiddendiscount"]').val(discount_price);
          currentRow.find('input[name^="totalsub"]').val(subtotal);

          currentRow.find('#tax_label').html('GST @'+ (tax_rate) + ' % = ' + (tax_rate1));

          total(ii);
          taxTotal();
          grandTotal();
          totalDiscount();
    });



    $("table.purchase_table").on("change",'#item_tax',function (event) 
    {
          
        var currentRow=$(this).closest("tr");
        var ii=+currentRow.find('input[name^="id"]').val();
        var id=+currentRow.find('#item_tax').val();
        var tax_rate = "";

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
//              var discount=+currentRow.find('input[name^="discount"]').val();
              var discount=0;
        
              var subtotal = calculatePrice(qty1,rate);
        
              var discountPrice=calculateDiscountPrice(subtotal,discount);
              var tax_rate1= (discountPrice*tax_rate)/100;

              var finalsubtotal = discountPrice + tax_rate1;
                  
              currentRow.find('input[name^="subtotal"]').val(finalsubtotal.toFixed(2));  
              currentRow.find('input[name^="tax_rate"]').val(tax_rate1.toFixed(2));  
              currentRow.find('input[name^="hidden_tax_rate"]').val(tax_rate);  

              //currentRow.find('label').html('SGST @'+ (tax_rate/2) + ' = ' + (tax_rate1/2)+ '\n' + 'CGST@'+ (tax_rate/2) + ' = ' + (tax_rate1/2));  
              currentRow.find('#tax_label').html('GST @'+ (tax_rate) + ' = ' + (tax_rate1));

              total(ii);
              taxTotal();
              grandTotal(); 
          }
        });

    });

    

    $('#purchase_table').on('click', '.delete', function () {
      var row_id = $(this).attr("id");
      $(this).closest('tr').remove();
      total();
      taxTotal();
      grandTotal();
      totalDiscount();
    });


    $(document).on("click",".purchaseSubmit",function(){
      var ii=0;
      var loc_id = $("#location_id").val();
      itemArray = new Array();
      var data="";
      $('.purchase_data').each(function(){
          var currentRow=$(this).closest("tr");
          var qty1=+currentRow.find('input[name^="qty1"]').val();
          var item_id=+currentRow.find('input[name^="item_id"]').val();
          var qty1=+currentRow.find('input[name^="qty1"]').val();
          var rate=+currentRow.find('input[name^="price"]').val();
//          var discount=+currentRow.find('input[name^="discount"]').val();
          var discount=0;
          var tax_rate=+currentRow.find('input[name^="tax_rate"]').val();
          var tax_id=+currentRow.find('input[name^="tax_id"]').val();
          var amount=+currentRow.find('input[name^="subtotal"]').val();
          var ship_status=currentRow.find('input[name^="optradio"]:checked').val();
          if(ship_status === undefined){ ship_status=null;}
          var remark=currentRow.find('textarea[name^="remark"]').val();
          var purchase_id=$('#purchase_id').val();
          var items={"item_id":item_id,"purchase_id":purchase_id,"qty":qty1,"rate":rate,"tax_id":tax_id,"tax_amount":tax_rate,"discount":discount,"amount":amount,"status":ship_status,"remarks":remark,"location_id":loc_id}
          itemArray[ii]=items;

          data += item_id+','+purchase_id+','+qty1+','+rate+','+tax_id+','+tax_rate+','+amount+','+loc_id+','+ship_status+','+remark+'~';
          ii++;
      });
      $("input[name='purchase_data']").val(JSON.stringify(itemArray));
      $("input[name='temptext1']").val(data);
    });
  });
  
  function filterData(data1,count)
  { 
      var flag=0;
      $("table.purchase_table").find('input[name^="item_id"]').each(function () {
            if(data1['items'].id  == +$(this).val())
            {
              flag=1;
              alert("Oops Product Already In Purchase !!");
            }   
      });
      if(flag == 0){
          addRow(data1,count);        
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
    $("table.purchase_table").find('input[name^="hiddendiscount"]').each(function () {
      discount_total += +$(this).val();
    });
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
    $("table.purchase_table").find('input[name^="totalsub"]').each(function () {
      grandTotal += +$(this).val();
    });
    //itemArray[ii].total=grandTotal;
    $("#subTotal").text(grandTotal.toFixed(2));  
  }

  function taxTotal()
  {
    var taxTotal = 0;
    $("table.purchase_table").find('input[name^="tax_rate"]').each(function () {
      taxTotal += +$(this).val();
    });
    $("#taxTotal").text(taxTotal.toFixed(2));
    $("#taxTotal1").val(taxTotal.toFixed(2));

  }

  function grandTotal()
  {
    /*var sub=parseFloat($('#subTotal').text());
    var tax=parseFloat($('#taxTotal').text());
    var subtotal = sub + tax;
    $("#grandTotal").val(subtotal.toFixed(2));*/
    var Total = 0;
    $("table.purchase_table").find('input[name^="subtotal"]').each(function () {
      Total += +$(this).val();
    });

    $("#grandTotal").val(Total.toFixed(2));
  }


  function addRow(data1,count)
  {
      /*var taxtype="";
      for (var i in data1['tax']) {
        taxtype += '<option value="'+ data1['tax'][i].id +'">'+data1['tax'][i].tax_name+'</option>';
      }*/

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
                '<td class="purchase_data">'+
                  '<input type="hidden" name="id" value="'+count+'" id="ii">'+
                  '<input type="hidden" name="item_id" value="'+data1['items'].id+'" id="'+data1['items'].id+'">'+
                  data1['items'].item_name+
                '</td>'+

                '<td>'+
                  data1['items'].hsn_code+
                '</td>'+

                '<td>'+
                  '<input type="number" name="qty1" id="qty1" value="0" class="form-control get-data qty1" autocomplete="off" min="0">'+
                '</td>'+

                '<td>'+
                  '<input type="text" name="price_change" id="price_change" value="'+data1['items'].purchase_price+'" class="form-control" autocomplete="off">'+
                  '<input type="hidden" name="price" id="price" value="'+data1['items'].purchase_price+'" class="form-control get-data price">'+
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

//                '<td>'+
//                  '<input type="text" name="discount" id="discount" class="form-control discount" value="0" autocomplete="off">'+
//                  '<input type="hidden" name="hiddendiscount" id="hiddendiscount" class="form-control hiddendiscount">'+
//                '</td>'+


                '<td>'+
                  '<input type="text" name="subtotal" id="subtotal" class="form-control subtotal" value="'+data1['items'].purchase_price * 0 +'" readonly>'+
                  '<input type="text" name="totalsub" id="totalsub" class="form-control totalsub" value="">'+
                '</td>'+
                '<td>'+
                  '<label class="radio-inline"><input type="radio" name="optradio'+count+'" value="yes" checked>Yes</label>'+
                  '<label class="radio-inline"><input type="radio" name="optradio'+count+'" value="no">No</label>'+
                  '<br>'+
                  'Remarks <textarea rows="2" cols="20" name="remark"></textarea>'+
                '</td>'+
                '<td>'+
                      '<button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory delete" onclick="hello(this.value);" value="" id=""><span class="fa fa-remove"></span></button>'+ 
                '</td>'+

              '<tr>';
              
              $('#purchase_table').append(table);
              total();
              taxTotal();
              grandTotal();
      }

</script>

<script src="<?php echo base_url('assets/plugins/autocomplite/');?>jquery.auto-complete.js"></script>