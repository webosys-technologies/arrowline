<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("edit_balance_transfer",$user_session)){
      redirect('transfer','refresh');
  }

?>
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script> -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">
      <div class="box">
      <div class="box-body">
          <strong>
           <!-- Transfer -->
           <?php echo $this->lang->line('lbl_transfer_header');?>
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
                <!-- New Transfer -->
                <?php echo $this->lang->line('lbl_bank_transfer_header');?>
              </h3>
            </div>

            <form action="<?php echo base_url();?>transfer/update"  method="post" class="form-horizontal" enctype="multipart/form-data" name="transferForm">
              <input type="hidden" name="id" value="<?php echo $transfer->id?>"> 
              <div class="box-body" style="padding: 20px">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- From -->
                    <?php echo $this->lang->line('lbl_addtransfer_from');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="from" name="from" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                        <option value="">
                          <!-- Select One -->
                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                        </option>
                              <?php 
                              foreach($acc as $row) 
                              {
                              ?>
                                  <option value="<?php echo $row->id;?>"
                                  <?php if($row->id==$transfer->from_account_id)
                                    { echo "selected";}
                                  ?>>
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
                    <!-- To -->
                    <?php echo $this->lang->line('lbl_addtransfer_to');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="to" name="to" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                        <option value="">
                          <!-- Select One -->
                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                        </option>
                              <?php 
                              foreach($acc as $row)
                              
                              {
                            ?>
                                
                                <option value="<?php echo $row->id;?>"
                                <?php if($row->id==$transfer->to_account_id)
                                  { echo "selected";}
                                ?>
                                >
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
                  <input type="text" class="form-control pull-right" id="datepicker" name="date" value="<?php echo $transfer->date?>">
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
                        <input type="text" class="form-control" name="desc" id="desc" placeholder="Description" value="<?php echo $transfer->description?>">
                         <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_addtransfer_amount');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo $transfer->amount?>">
                         <p style="color:#990000;"></p>
                      </div> 
                  </div>
                </div> 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Payment Method -->
                    <?php echo $this->lang->line('lbl_addtransfer_paymentmethod');?>
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <select class="form-control select2" id="units" name="payment" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                        <option value="">
                          <!-- Select One -->
                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                        </option>
                              <?php 
                              foreach($pay as $row)
                              
                              {
                            ?>
                                
                                <option value="<?php echo $row->id;?>"
                                <?php if($row->id==$transfer->payment_method_id)
                                  { echo "selected";}
                                ?>>
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
                  <label for="bank_name" class="col-sm-2 control-label">
                    Bank Name
                    <!-- <?php echo $this->lang->line('lbl_addtransfer_reference');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?php echo $transfer->bank_name;?>">
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
                        <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Cheque No" value="<?php echo $transfer->cheque_no;?>">
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
                      <input type="text" class="form-control" name="refer" id="picture" placeholder="reference" value="<?php echo $transfer->reference_no?>">
                    </div> 
                  </div>
                </div>

            </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <center>
                <input type="submit" name="transferSubmit" class="btn btn-info btn-flat" tabindex="22" value="Submit">

                <a href="<?php echo base_url();?>transfer/" class="btn btn-default btn-flat">Cancel</a>            
                
              </center>
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

          if(from == to)
          {
              $("select[name='to']").parent().find("p").text("From account and to account should not be same");
              return false;
          }

           var e=chkDrop("transferForm","from","Please Account Name");
           var f=chkDrop("transferForm","to","Please Transfer Account Name");
           var g=chkDrop("transferForm","payment","Please Enter Payment Method");
           var a=chkEmpty("transferForm","amount","Please Enter Amount");

           if((e+f+g+a) < 1){
             transferForm.submit();
             return true;
           }else{
            

             return false;
           }
           
         });      
   });
</script>
<script type="text/javascript">
      /*$('#amount').keyup(function() 
    {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
          $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
    });*/
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
