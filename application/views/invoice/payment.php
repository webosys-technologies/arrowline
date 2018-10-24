<?php 
  $this->load->view('layout/header');
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <!-- New Branch 
        <small></small> -->
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>Branch/"><i class="fa fa-dashboard"></i> 
            <!-- Payment -->
            <?php echo $this->lang->line('payment_header');?>
          </a></li>
          <li class="active">
            <!-- Payment Info -->
            <?php echo $this->lang->line('lbl_payment_info');?>
          </li>
        </ol>
      </h5>
      
    </section>    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 50px;"><b>
                <?php echo $this->lang->line('lbl_payment_info');?>
              </b></h3>
            </div>
            <center><?php echo validation_errors();?></center>
            
            <form action="<?php echo base_url();?>invoice/add_payment"  method="POST" class="form-horizontal" name="paymentForm" id="paymentForm">
                 
              <div class="box-body" style="">

                <input type="hidden" name="quotation_id" value="<?php echo $invoice->quotation_id;?>">
                <input type="hidden" name="sales_id" value="<?php echo $invoice->sales_id;?>">

                <div class="form-group">
                  <label for="description" class="col-sm-2 control-label">
                    Invoice No
                    <!-- <?php echo $this->lang->line('lbl_addtransfer_desc');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="description" id="description" value="<?php echo $invoice->invoice_no;?>" readonly="">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>


                <div class="form-group">
                  <label for="account" class="col-sm-2 control-label">
                    <!-- Account -->
                     <?php echo $this->lang->line('lbl_adddeposit_account');?>
                     <span class="text-danger"> *</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="account" name="account" tabindex="1">
                            <option value="">
                              <!-- Select Account -->
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                            <?php foreach($bankaccount as $row){ ?>
                                <option value="<?php echo $row->id; ?>">
                                <?php echo $row->account_name;?></option>  
                            <?php } ?>
                        </select>
                        <p style="color:#990000;" id="account_error"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="payment_type" class="col-sm-2 control-label">
                    <!-- Payment Type -->
                    <?php echo $this->lang->line('lbl_payment_paymentmethod');?>
                    <span class="text-danger"> *</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="payment_type" name="payment_type" tabindex="2">
                            <option value="">
                            <!-- Payment Method -->
                            <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                            <?php foreach($payment_method as $row){ ?>
                                <option value="<?php echo $row->id; ?>">
                                <?php echo $row->name;?></option>  
                            <?php } ?>
                        </select>
                        <p style="color:#990000;" id="payment_type_error"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="category" class="col-sm-2 control-label">
                    <!-- Category -->
                    <?php echo $this->lang->line('lbl_adddeposit_category');?>
                    <span class="text-danger"> *</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="category" name="category" tabindex="1">
                            <option value="">
                              <!-- Select Category -->
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                            <?php foreach($expansecategory as $row){ ?>
                                <option value="<?php echo $row->id;?>">
                                <?php echo $row->name; ?></option>  
                            <?php } ?>
                        </select>
                        <p style="color:#990000;" id="category_error"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="amount" class="col-sm-2 control-label">
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_transfer_amount');?>
                    <span class="text-danger"> *</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">

                        <?php 
                          //$sales = $invoice->sales_amount + $sales->shipping_charges;
                        $due =  $invoice->sales_amount - $invoice->paid_amount;?>
                        <input type="number" class="form-control" name="amount" id="amount" value="<?php if(isset($due)){echo $due;}?>" max="<?php if(isset($due)){echo $due;}?>">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;" id="amount_error"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="bank_name" class="col-sm-2 control-label">
                    Bank Name
                    <!-- <?php echo $this->lang->line('lbl_transfer_amount');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="bank_name" id="bank_name" value="" placeholder="Bank Name">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="cheque_no" class="col-sm-2 control-label">
                    Cheque No 
                    <!-- <?php echo $this->lang->line('lbl_transfer_amount');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="cheque_no" id="cheque_no" value="" placeholder="Cheque No">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>


                
                <div class="form-group">
                  <label for="datepicker" class="col-sm-2 control-label">
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_transfer_date');?><span class="text-danger"> *</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input class="form-control" id="datepicker" type="text" name="payment_date" value="<?php echo date('Y-m-d');?>">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;" id="datepicker_error"></p>
                      </div> 
                  </div>
                </div>


                <div class="form-group">
                  <label for="description" class="col-sm-2 control-label">
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_addtransfer_desc');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="description" id="description" value="Payement For Invoice <?php echo $invoice->invoice_no;?>" readonly="">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="reference" class="col-sm-2 control-label">
                    <!-- Reference -->
                    <?php echo $this->lang->line('lbl_addtransfer_reference');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="reference" id="reference">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

              </div>
              <div class="box-footer" style="margin-left: 120px;">
              
                  <input type="submit" name="addPayment" class="btn btn-info btn-flat" tabindex="22" value="<?php echo $this->lang->line('btn_submit');?>" id="sub_payment">
                  <a href="<?php echo base_url();?>sales/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>            
                
              </div>
              
          </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>

<script type="text/javascript">
    $(document).ready(function(){

      $("#sub_payment").click(function(){
          var account = $("#account").val();
          if(account=="")
          {
              $("#account_error").text("Account is required");
              return false;
          }
          else{
              $("#account_error").text("");
          }

          var paymenttype = $("#payment_type").val();
          if(paymenttype=="")
          {
              $("#payment_type_error").text("Payment type is required");
              return false;
          }
          else{
              $("#payment_type_error").text("");
          }

          var category = $("#category").val();
          if(category=="")
          {
              $("#category_error").text("Category is required");
              return false;
          }
          else{
              $("#category_error").text("");
          }

          var amount = $("#amount").val();
          if(amount=="" || amount=="0")
          {
              $("#amount_error").text("Amount is required");
              return false;
          }
          else{
              $("#amount_error").text("");
          }

          var date = $("#datepicker").val();
          if(date=="")
          {
              $("#datepicker_error").text("Date is required");
              return false;
          }
          else{
              $("#datepicker_error").text("");
          }
      });
      
    
        /*$("input[name='addPayment']").click(function(e){

            var account=chkDrop("paymentForm","account","Please Select Account Type");
            var payment=chkDrop("paymentForm","payment_type","Please Select Payment Type");
            var category=chkDrop("paymentForm","category","Please Select Category");
            var amount=chkEmpty("paymentForm","amount","Please Enter Amount");
            var date=chkEmpty("paymentForm","payment_date","Please Enter Payment Date");
              
            if((account + payment + category + amount + date) < 1){
                paymentForm.submit();
              return true;
            }else{
              return false;
            }

        });*/
        
        jQuery('#amount').keyup(function (){
           this.value = this.value.replace(/[^0-9 ]/g, function(str) 
           { 
            ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
             if($(this).val().length > 12)
             {
                $(this).val($(this).val().substring(0, 12));
             }
        });

    });
</script>