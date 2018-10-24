<?php 
  
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("add_bank_account",$user_session)){
      redirect('bank','refresh');
  }


?>

  <div class="content-wrapper">
    <div id="notifications" class="row no-print">
         <div class="col-md-12">
                
        </div>
      </div>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="box">
        <div class="box-body">
          <strong>
           <!-- Bank Account -->
           <?php echo $this->lang->line('lbl_bankaccount_header');?>
          </strong>
        </div>
      </div>
      <div class="box">
        <div class="row">
          <div class="col-md-12">
            
          <!-- Horizontal Form -->
          
            <div class="box-header with-border">
              <center><h3 class="box-title">
                <!-- New Bank Account -->
                <?php echo $this->lang->line('lbl_btn_add_account');?>
              </h3></center>
            </div>

            <form action="<?php echo base_url();?>bank/add"  method="post" class="form-horizontal" name=bankForm>
                 
              <div class="box-body" style="padding: 20px">
                <div class="form-group">
                  <label for="accountname" class="col-sm-2 control-label">
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_addbank_accountname');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="accountname" placeholder="Account Name" name="accname" value="<?php echo set_value('accname');?>" tabindex="1">
                        <span style="font-size:20px;"><?php echo form_error('accname');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="accounttype" class="col-sm-2 control-label">
                    <!-- Account Type -->
                    <?php echo $this->lang->line('lbl_addbank_type');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                          <select class="form-control select2" id="accounttype" name="acctype" value="<?php echo set_value('acctype');?>" tabindex="2">
                              <option value="">
                                <!-- Select One -->
                                <?php echo $this->lang->line('lbl_dropdown_customer');?>
                              </option>
                                  <option value="Savings">
                                    <!-- Savings Account -->
                                    <?php echo $this->lang->line('lbl_account_typesaving');?>
                                  </option>
                                  <option value="Chequing">
                                    <!-- Chequing Account -->
                                    <?php echo $this->lang->line('lbl_account_Chequing');?>
                                  </option>
                                  <option value="Credit">
                                    <!-- Credit Account -->
                                    <?php echo $this->lang->line('lbl_account_credit');?>
                                  </option>
                                  <option value="Cash">
                                    <!-- Cash Account -->
                                    <?php echo $this->lang->line('lbl_account_cash');?>
                                  </option>
                                </select>
                                <p style="color:#990000;"></p>       
                      </div> 
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="accountnumber" class="col-sm-2 control-label">
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_addbank_number');?>
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="accountnumber" placeholder="Account Number" name="accnumber" value="<?php echo set_value('accnumber');?>" tabindex="2">
                        <span style="font-size:20px;">
                        <?php echo form_error('accnumber');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="accountname" class="col-sm-2 control-label">
                    <!-- Bank Name -->
                    <?php echo $this->lang->line('lbl_addbank_bankname');?>
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="bankname" placeholder="Bank Name" name="bankname" value="<?php echo set_value('bankname');?>" tabindex="4">
                        <span style="font-size:20px;"><?php echo form_error('bankname');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>
                
                
                 <div class="form-group">
                  <label for="openingbalance" class="col-sm-2 control-label">
                    <!-- Opening Balance -->
                    <?php echo $this->lang->line('lbl_addbank_openingbalance');?>
                    <span class="text-danger">*</span></label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" placeholder="Opening Balance" id="balance" name="balance" value="<?php echo set_value('balance');?>" tabindex="5">
                        <span style="font-size:20px;"><?php echo form_error('balance');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>
                    
              <div class="form-group">
                  <label for="bankaddress" class="col-sm-2 control-label">
                    <!-- Bank Address -->
                    <?php echo $this->lang->line('lbl_addbank_address');?>
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="bankaddress" placeholder="Bank Address" name="address" value="<?php echo set_value('address');?>" tabindex="6">
                        <span style="font-size:20px;"><?php echo form_error('address');?></span>
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>   


                <div class="form-group">
            <label class="col-sm-2 control-label require" for="inputEmail3">
              <!-- Default Account -->
              <?php echo $this->lang->line('lbl_addbank_defaultaccount');?>
            </label>
            <div class="col-sm-4">
               <select class="form-control select2" name="defacc" id="default_account" value="<?php echo set_value('defacc');?>" tabindex="7">
                <option value="1">
                  <!-- Yes -->
                  <?php echo $this->lang->line('yes');?>
                </option>
                <option value="0">
                  <?php echo $this->lang->line('no');?>
                </option>
                </select>
            </div>
          </div>     
              <!-- /.box-body -->
            <div class="box-footer">
              <div class="col-sm-6">
              <center>
                <input type="submit" name="bankSubmit" class="btn btn-info btn-flat" value="<?php echo $this->lang->line('btn_submit');?>">

                <a href="<?php echo base_url();?>bank/" class="btn btn-default btn-flat">
                  <?php echo $this->lang->line('btn_cancel');?>
                </a>            
              </center>
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
       $("input[name='bankSubmit']").click(function(e){
    
           var acc_name=chkEmpty("bankForm","accname","Please Enter Account Name");      
           var acc_no=chkEmpty("bankForm","accnumber","Please Enter Account Number");
           var acc_bal=chkEmpty("bankForm","balance","Please Enter Opening Balance");
           var bankname=chkEmpty("bankForm","bankname","Please Enter Bank Name");
           
           var acc_type=chkDrop("bankForm","acctype","Please Select Account Type");
           
           if(acc_name + acc_no + acc_bal + bankname + acc_type< 1){
             bankForm.submit();
             return true;
           }else{
             return false;
           }
           
         });   
   });
</script>

<script type="text/javascript">

    $("#accountnumber").keypress(function(e) {
     if (!/[0-9 \b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
   });
  $('#balance').keyup(function() 
    {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
        $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
    });

    $("#balance").keypress(function(e) {
     if (!/[0-9 \b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
   });


</script>



<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>
