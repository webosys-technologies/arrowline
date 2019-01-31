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
           <?php echo 'Lead Status'//$this->lang->line('lbl_transfer_header');?>
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

            <form action="<?php echo base_url();?>Management/update_status"  method="post" class="form-horizontal" enctype="multipart/form-data" name="transferForm">
                <input type="hidden" name="status_id" value="<?php echo $status_id;?>">
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
                  <label for="bank_name" class="col-sm-2 control-label">
                    Status Name
                    <!-- <?php echo $this->lang->line('lbl_addtransfer_reference');?> -->
                  </label>
                  <div class="col-sm-4">
                    <div class="control">
                        <input type="text" class="form-control" name="name" id="name" value='<?php echo $status->name;?>' placeholder="Bank Name">
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
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
                        <input type="text" class="form-control" name="description" id="desc" placeholder="<?php echo $this->lang->line('lbl_addtransfer_desc');?>" value="<?php echo $status->description;?>">
                        
                        <span style="font-size:20px;"><?php echo form_error('desc');?></span>
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

//      $("input[name='transferSubmit']").click(function(e){
//          var from = $("#from").val();
//          var to = $("#to").val();
//
////          if(from == to)
////          {
////            $("select[name='to']").parent().find("p").text("From account and to account should not be same");
////            return false;
////          }
//
//         /*var b=chkEmpty("transferForm","desc","Please Enter Description"); */         
//         var acc_from=chkDrop("transferForm","name","Please add Status Name");
//        
//
//         if((name < 1){
//           transferForm.submit();
//           return true;
//         }
//         else
//         {
//          
//           return false;
//         }
//
//
//
//      });      
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