<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("add_balance_transfer",$user_session)){
      redirect('transfer','refresh');
  }

?>
  <div class="content-wrapper"> 
       
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <div class="box">
      <div class="box-body">
          <strong>
           <!-- Transfer -->
           <?php echo 'Voucher'//$this->lang->line('lbl_transfer_header');?>
          </strong>
        </div>
      </div>
      <div class="box">
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          
            <div class="box-header with-border">
              <div style="margin-left: 50px;">
              <h3 class="box-title">
                <!-- New Transfer -->
                <b><?php echo ' '//$this->lang->line('lbl_bank_transfer_header');?></b>
              </h3>
              </div>
            </div>

            <form action="<?php echo base_url();?>voucher/add"  method="post" class="form-horizontal" enctype="multipart/form-data" name="transferForm">
                 
              <div class="box-body" style="padding: 20px">
<!--                   <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                     Voucher Type 
                    <?php echo 'Voucher Type' ?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="type" />
                          <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>-->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- From -->
                    <?php echo $this->lang->line('lbl_addtransfer_from');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="from" name="from" tabindex="1" onblur='chkEmpty("transferForm","from","Please Enter Account Name");'>
                        <option value="">
                          <!-- Select One -->
                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                        </option>
                              <?php 
                              foreach($cust as $row) 
                              {
                              ?>
                                  <option value="<?php echo $row->id;?>">
                                <?php echo $row->name;?></option>  
                            <?php
                              }
                            ?>
                          </select>
                          <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                  <!-- To -->
                    <?php echo $this->lang->line('lbl_addtransfer_to');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="to" name="to" tabindex="1" onblur='chkEmpty("transferForm","to","Please Enter Account Name");'>
                        <option value="">
                          <!-- Select One -->
                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                        </option>
                              <?php 
                              foreach($acc as $row) 
                              {
                            ?>
                               <option value="<?php echo $row->id;?>">
                                <?php echo $row->account_name;?></option>  
                            <?php
                              }
                            ?>                              
                          </select>
                          <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_addtransfer_date');?>
                  </label>
                  <div class="col-sm-4">

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <div class="control">
                          <input type="text" class="form-control pull-right" id="datepicker" name="date" value="<?php echo date('Y-m-d');?>" placeholder="<?php echo $this->lang->line('lbl_addtransfer_date');?>">
                        </div>
                    </div>

                </div>
              </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_addtransfer_desc');?>
                    
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="desc" id="desc" placeholder="<?php echo $this->lang->line('lbl_addtransfer_desc');?>" value="Account Balance Transfer">
                        
                        <span style="font-size:20px;"><?php echo form_error('desc');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Amount -->
                    <?php echo "Total ".$this->lang->line('lbl_addtransfer_amount');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="amount" 
                        id="amount" placeholder="<?php echo $this->lang->line('lbl_addtransfer_amount');?>">
                        <span style="font-size:20px;"><?php echo form_error('amount');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Amount -->
                    <?php echo "Paid ".$this->lang->line('lbl_addtransfer_amount');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="paid_amount" 
                        id="paid_amount" placeholder="Paid <?php echo $this->lang->line('lbl_addtransfer_amount');?>">
                        <span style="font-size:20px;"><?php echo form_error('amount');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Payment Method -->
                    <?php echo $this->lang->line('lbl_addtransfer_paymentmethod');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="units" name="payment" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                          <option value="">
                            <!-- Select One -->
                            <?php echo $this->lang->line('lbl_dropdown_customer');?>
                          </option>
                            <?php foreach($pay as $row){ ?>
                              <option value="<?php echo $row->id;?>">
                              <?php echo $row->name;?></option>  
                            <?php } ?>
                        </select>
                          <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="bank_name" class="col-sm-2 control-label">
                    Bank Name
                    <!-- <?php echo $this->lang->line('lbl_addtransfer_reference');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="cheque_no" class="col-sm-2 control-label">
                    Cheque No
                    <!-- <?php echo $this->lang->line('lbl_addtransfer_reference');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Cheque No">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Reference -->
                    <?php echo $this->lang->line('lbl_addtransfer_reference');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="refer" id="refer" placeholder="<?php echo $this->lang->line('lbl_addtransfer_reference');?>">
                        <span style="font-size:20px;"><?php echo form_error('refer');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div style="margin-left: 120px;">
                <input type="submit" name="transferSubmit" class="btn btn-info btn-flat transfer" tabindex="22" value="<?php echo $this->lang->line('btn_submit');?>">
                <a href="<?php echo base_url();?>transfer/" class="btn btn-default btn-flat">
                  <?php echo $this->lang->line('btn_cancel');?>
                </a>            
              </div>
              </div>
              
          </form>
      </div>
        </div>
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript">
    $(document).ready(function(){

      $("input[name='transferSubmit']").click(function(e){
          var from = $("#from").val();
          var to = $("#to").val();

//          if(from == to)
//          {
//            $("select[name='to']").parent().find("p").text("From account and to account should not be same");
//            return false;
//          }

         /*var b=chkEmpty("transferForm","desc","Please Enter Description"); */         
         var acc_from=chkDrop("transferForm","from","Please Account Name");
         var acc_to=chkDrop("transferForm","to","Please Select Transfer Account");
         var date=chkEmpty("transferForm","date","Please Select Date");
         var payment=chkDrop("transferForm","payment","Please Enter Payment Method");
         var amount=chkEmpty("transferForm","amount","Please Enter Amount");

         if((acc_from + acc_to + payment + amount + date) < 1){
           transferForm.submit();
           return true;
         }
         else
         {
          
           return false;
         }



      });      
   });
</script>

<script type="text/javascript">
  
</script>


<script type="text/javascript"> 
  $('#amount').keyup(function() 
  {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
        $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
  });

  $("#amount").keypress(function(e) {
     if (!/[0-9 \b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
  });
</script>
<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>
