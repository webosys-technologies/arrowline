<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("edit_bank_account",$user_session)){
      redirect('bank','refresh');
  }
?>
<?php
  foreach ($acc as $row) {
  }
?>

  <div class="content-wrapper">
    
    <!-- <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> 
          <?php echo $this->lang->line('home');?>
          </a></li>
          <li class="active">
            <?php echo $this->lang->line('lbl_bankaccount_header');?>
          </li>
        </ol>
      </h5>
      
    </section>     -->
    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-body">
          <strong>
           <!-- Bank Account -->
           <?php echo $this->lang->line('lbl_bankaccount_header');?>
          </strong>
        </div>
      </div>

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">
                <!-- Add New bankaccount -->
                <?php echo $this->lang->line('lbl_bankaccount_header');?>
              </h3>
            </div>

          <form action="<?php echo base_url();?>bank/update"  method="post" class="form-horizontal" name="bankForm">
              <div class="box-body" style="padding: 20px">
              <!-- <input type="hidden" name="id" value="<?php echo $row->id;?>"> -->
              <input type="hidden" name="id" id="id" value="<?php echo $row->id;?>">
                <div class="form-group">
                  <label for="accountname" class="col-sm-2 control-label">
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_addbank_accountname');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="accountname" placeholder="<?php echo $this->lang->line('lbl_addbank_accountname');?>" name="accname" value="<?php echo $row->account_name;?>">
                        <p style="color:#990000;"></p>
                        
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="accounttype" class="col-sm-2 control-label">
                    <!-- Account Type -->
                    <?php echo $this->lang->line('lbl_addbank_type');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                          <select class="form-control select2" id="accounttype" name="acctype" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name";' value="<?php echo $row->account_type;?>">
                                 <option value="">
                                  <!-- Select One -->
                                    <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                  </option>
                                  <option value="Savings" <?php if($row->account_type=='Savings'){ echo "selected"; }?>>
                                    <!-- Savings Account -->
                                    <?php echo $this->lang->line('lbl_account_typesaving');?>
                                  </option>
                                  <option value="Chequing" <?php if($row->account_type=='Chequing'){ echo "selected"; }?>>
                                    <!-- Chequing Account -->
                                    <?php echo $this->lang->line('lbl_account_Chequing');?>
                                  </option>
                                  <option value="Credit" <?php if($row->account_type=='Credit'){ echo "selected"; }?>>
                                    <!-- Credit Account -->
                                    <?php echo $this->lang->line('lbl_account_credit');?>
                                  </option>
                                  <option value="Cash" <?php if($row->account_type=='Cash'){ echo "selected"; }?>>
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
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="accountnumber" placeholder="<?php echo $this->lang->line('lbl_addbank_number');?>" name="accnumber" value="<?php echo $row->account_no;?>">
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="accountname" class="col-sm-2 control-label">
                    <!-- Bank Name -->
                    <?php echo $this->lang->line('lbl_addbank_bankname');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="Accountname" placeholder="<?php echo $this->lang->line('lbl_addbank_bankname');?>" name="bankname" value="<?php echo $row->bank_name;?>">
                        <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>
                
                
                 <div class="form-group">
                  <label for="openingbalance" class="col-sm-2 control-label">
                    <!-- Opening Balance -->
                    <?php echo $this->lang->line('lbl_addbank_openingbalance');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="balance" placeholder="<?php echo $this->lang->line('lbl_addbank_openingbalance');?>" min="0" name="balance" value="<?php echo $row->opening_balance;?>">
                      </div> 
                  </div>
                </div>
                    
              <div class="form-group">
                  <label for="bankaddress" class="col-sm-2 control-label">
                    <!-- Bank Address -->
                    <?php echo $this->lang->line('lbl_addbank_address');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" id="bankaddress" placeholder="<?php echo $this->lang->line('lbl_addbank_address');?>" name="address" value="<?php echo $row->bank_address;?>">
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
                     <select class="form-control select2" name="defacc" id="default_account" value="<?php echo $row->default_account;?>">
                      <option value="yes" <?php if($row->default_account=='yes'){ echo "selected"; }?> >
                        <!-- YES -->
                        <?php echo $this->lang->line('yes');?>
                      </option>
                          <option value="no" <?php if($row->default_account=='no'){echo "selected"; }?>>
                            <!-- NO -->
                            <?php echo $this->lang->line('no');?>
                      </option>
                      </select>
                  </div>
                </div>                 
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-6">
                <center>
                  <input type="submit" class="btn btn-primary btn-flat" name="bankSubmit" value="<?php echo $this->lang->line('btn_submit');?>">

                  <a href="<?php echo base_url();?>bank/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
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
          
           var b=chkEmpty("bankForm","accname","Please Enter Account Name");      
           var d=chkEmpty("bankForm","accnumber","Please Enter Account Number");
           var bal=chkEmpty("bankForm","balance","Please Enter Balance");
           var e=chkEmpty("bankForm","bankname","Please Enter Bank Name");
           var g=chkDrop("bankForm","acctype","Please Enter Account Type");
           
           if((b+d+bal+e+g) < 1){
             bankForm.submit();
             return true;
           }else{
             return false;
           }
           
         });   
   });
</script>

<script type="text/javascript">
  
    $('#accountnumber').keyup(function() 
    {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
        $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
    });

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
