<?php
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_payment_gateway",$user_session)){
      redirect('auth','refresh');
  }
?>

<div class="content-wrapper">
    <div id="notifications" class="row no-print">
    <div class="col-md-12">
                
    </div>
</div>

    
       
        <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                 <div class="top-bar-title padding-bottom">Payment Gateway</div>
                </div> 
              </div>
            </div>
          </div>
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url();?>settings/add_pgetway" method="post" id="supplier" class="form-horizontal" name="paymentForm">

              
              <div class="box-body">
                <div class="form-group">
                  <label for="input_paypal_username" class="col-sm-2 control-label">Paypal Username<em class="text-danger">*</em></label>

                  <div class="col-sm-4">
                  <input type="text" placeholder="" class="form-control" id="username" name="username" value="" onblur='chkEmpty("paymentForm","username","Please Enter User Name")'>
                    <span style="font-size:20px;"><?php echo form_error('username');?></span>
                        <p style="color:#990000;"></p>
                  </div>
                </div>
              
                <div class="form-group">
                  <label for="input_paypal_password" class="col-sm-2 control-label">Paypal Password<em class="text-danger">*</em></label>

                  <div class="col-sm-4">
                      <input type="text" class="form-control valdation_check" id="password" name="password" value="" >
                      <span style="font-size:20px;"><?php echo form_error('password');?></span>
                        <p style="color:#990000;"></p>
                  </div>
                </div>
              
              
                <div class="form-group">
                  <label for="input_paypal_signature" class="col-sm-2 control-label">Paypal Signature</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control valdation_check" id="signature" name="signature" value="">

                    <span style="font-size:20px;"><?php echo form_error('signature');?></span>
                        <p style="color:#990000;"></p>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="input_paypal_mode" class="col-sm-2 control-label">Paypal Mode</label>

                <div class="col-sm-4">
                  <select class="form-control" name="mode" id="mode">
                  <option value="">Select one</option>
                    <option value="sandbox">Sandbox</option>
                    <option value="live" >Live</option>
                </select>
                    <span style="font-size:20px;"><?php echo form_error('mode');?></span>
                        <p style="color:#990000;"></p>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  
                  <input type="submit" class="btn btn-info btn-flat" name="btnsubmit" value="Submit">

                  <a type="<?php echo base_url();?>settings/pgetway" class="btn btn-default btn-flat" name="cancel">Cancel</a>
                  
                
            </div>
              <!-- /.box-footer -->
           </form>

            </div>
          </div>
        </div>
      </div>
    
    </section>
    <!-- Modal Dialog -->

  <!-- /.content -->
  </div>
  <script type="text/javascript">

    $(document).ready(function(){

       $("input[name='btnsubmit']").click(function(e){
           
           var b=chkEmpty("paymentForm","username","Please Enter User Name");
           var d=chkEmpty("paymentForm","password","Please Enter Password");
           var f=chkDrop("paymentForm","mode","Please select mode");

           if((b+d+f) < 1){
             paymentForm.submit();
             return true;
           }else{
             return false;
           }
           
         });      
   });

</script>
  <?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>
<script type="text/javascript">
  jQuery('#username').keyup(function (){

       this.value = this.value.replace(/[^a-zA-Z ]/g, function(str) 
      { 
        $("input[name='username']").parent().addClass("has-error has-feedback");
        $("input[name='username']").parent().find("span").addClass("fa fa-remove form-control-feedback");
        $("input[name='username']").parent().find("p").text("Please Enter only alphabetic");

       ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
        if($(this).val().length > 20)
        {
           $(this).val($(this).val().substring(0, 20));
        }
   });
</script>