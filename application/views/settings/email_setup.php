<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_email_setup",$user_session)){
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
                <div class="box box-info">
                   <div class="box-header with-border">
                        <h3 class="box-title">
                            <!-- SMTP Settings -->
                            <?php echo $this->lang->line('lbl_emailsetup_header');?>
                        </h3>
                  </div><br>
                     
                  <form name="Form" action="<?php echo base_url()?>emailsetup/add" method="post" id="myform1" class="form-horizontal">
                      <?php echo validation_errors(); ?>
                      <div class="form-group">
                         <label class="col-sm-2 control-label require" for="inputEmail3">
                         <!-- Email Protocol -->
                          <?php echo $this->lang->line('lbl_emailsetup_protocol');?>
                         </label>
                           <!--  <input type="hidden" value="<?php if(isset($email->id)){echo $email->id;}?>" name="id"> -->
                              <div class="col-sm-4">
                               <label>
                                  <input name="email_protocol"  value="smtp"<?php if(isset($data[0]->protocol)){echo $data[0]->protocol;}?> checked type="radio">smtp&nbsp;&nbsp;
                                  <span style="color: red;"><?php echo form_error('email_protocol');?></span>
                                  <p style="color:#990000;"></p>
                              </label>
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                            <!-- Email Encription -->
                            <?php echo $this->lang->line('lbl_emailsetup_encription');?>
                          </label>
                             <div class="col-sm-4">
                               <input type="text" id="name" value="<?php if(isset($data[0]->protocol)){echo $data[0]->encription;}?>" class="form-control" name="email_encryption">
                               <span style="color: red;"><?php echo form_error('email_encryption'); ?></span>
                               <p style="color:#990000;"></p>
                            </div>
                       </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                            <!-- SMTP Host -->
                            <?php echo $this->lang->line('lbl_emailsetup_host');?>  
                          </label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($data[0]->protocol)){echo $data[0]->host;}?>" class="form-control" name="smtp_host" id="host">
                               <span style="color: red;"><?php echo form_error('smtp_host'); ?></span>
                                <p id="a" style="color:#990000;"></p>
                            </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                            <!-- SMTP Port -->
                             <?php echo $this->lang->line('lbl_emailsetup_port');?> 
                          </label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($data[0]->protocol)){echo $data[0]->port;}?>" class="form-control" name="smtp_port" id="port">
                               <span style="color: red;"><?php echo form_error('smtp_port'); ?></span>
                                <p id="b" style="color:#990000;"></p>
                            </div>
                          </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                              <!-- SMTP Email -->
                              <?php echo $this->lang->line('lbl_emailsetup_email');?>
                          </label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($data[0]->protocol)){echo $data[0]->email;}?>" class="form-control" name="smtp_email" id="email">
                              <span style="color: red;"><?php echo form_error('smtp_email'); ?></span>
                              <p id="c" style="color:#990000;"></p>
                            </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                              <!-- From Address -->
                              <?php echo $this->lang->line('lbl_emailsetup_address');?>
                          </label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($data[0]->protocol)){echo $data[0]->address;}?>" class="form-control" name="from_address" id="address">
                              <span style="color: red;"><?php echo form_error('from_address'); ?></span>
                              <p id="d" style="color:#990000;"></p>
                          </div>
                      </div>
                        
                      <div class="form-group">
                         <label class="col-sm-2 control-label require" for="inputEmail3">
                            <!-- From Name -->
                            <?php echo $this->lang->line('lbl_emailsetup_name');?>
                        </label>
                             <div class="col-sm-4">
                                <input type="text" value="<?php if(isset($data[0]->protocol)){echo $data[0]->name;}?>" class="form-control" name="from_name" id="from_name">
                                <span style="color: red;"><?php echo form_error('from_name'); ?></span>
                                <p id="e" style="color:#990000;"></p>
                              </div>
                        </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                            <!-- SMTP Username -->
                            <?php echo $this->lang->line('lbl_emailsetup_username');?>
                          </label>
                            <div class="col-sm-4">
                              <input type="text" value="<?php if(isset($data[0]->email)){echo $data[0]->username;}?>" class="form-control" name="smtp_username" id="username">
                              <span style="color: red;"><?php echo form_error('smtp_username'); ?></span>
                              <p id="f" style="color:#990000;"></p>
                            </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label require" for="inputEmail3">
                            <!-- SMTP Password -->
                            <?php echo $this->lang->line('lbl_emailsetup_password');?>
                          </label>
                            <div class="col-sm-4">
                               <input type="Password" value="<?php if(isset($data[0]->protocol)){echo $data[0]->password;}?>" class="form-control" name="smtp_password" id="smtp_password">
                               <span style="color: red;"><?php echo form_error('smtp_password'); ?></span>
                              <p id="g" style="color:#990000;"></p>
                            </div>
                      </div>
                        
                        <!-- /.box-body -->
                         <div class="box-footer">
                              <input class="btn btn-primary btn-flat" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" name="formSubmit">
                         </div>

                      </form>
                    </div>
                </div>
      </section>

      <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Parmanently</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure about this ?</p>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirm">Delete</button>
          </div>
        </div>
      </div>
    </div>
    

    </div>



  <script type="text/javascript">
      $(document).ready(function(){

         $("input[name='formSubmit']").click(function(e){
            
            
            var c=chkEmpty("Form","smtp_host","Please Enter Smtp Host");
            var d=chkEmpty("Form","smtp_port","Please Enter Smtp Port");
            var e=chkEmpty("Form","smtp_email","Please Enter smtp_email");
            var f=chkEmpty("Form","from_address","Please Enter address");
            var g=chkEmpty("Form","from_name","Please Enter name");
            var h=chkEmpty("Form","smtp_username","Please Enter username");
            var i=chkEmpty("Form","smtp_password","Please Enter password");
           

             if((c+d+e+f+g+h+i) < 1){
               Form.submit();
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
$(document).ready(function(){

    /*jQuery('#name').keyup(function (){
      this.value = this.value.replace(/[^a-zA-Z ]/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
        if($(this).val().length > 100)
        {
           $(this).val($(this).val().substring(0, 100));
        }
    });

    jQuery('#host').keyup(function (){
      var host = $('#host').val();
      if(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(host)==true )
      {
        $("#a").html("");
      } 
      else
      {
        $("#a").html("Please Enter Correct Host Format");
      }
    });

    jQuery('#port').keyup(function (){
     this.value = this.value.replace(/[^0-9 ]/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only Numbers.'); return ''; });
       if($(this).val().length > 3)
          {
            $("#b").html("Not allowed more than 3 Numbers").fadeOut(1500);
            $(this).val($(this).val().substring(0, 3));
          }
        });

      jQuery('#email').keyup(function (){
      var email = $('#email').val();
      if(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(email)==true )
      {
        $("#c").html("");
      } 
      else
      {
        $("#c").html("Please Enter Correct Email Format");
      }
    });

      jQuery('#address').keyup(function (){
      var address = $('#address').val();
      if(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(address)==true )
      {
        $("#d").html("");
      } 
      else
      {
        $("#d").html("Please Enter Correct address Format");
      }
    });

    jQuery('#from_name').keyup(function (){
      var from_name = $('#from_name').val();
      if(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(from_name)==true )
      {
        $("#e").html("");
      } 
      else
      {
        $("#e").html("Please Enter Correct from_name Format");
      }
    });

      jQuery('#username').keyup(function (){
      var username = $('#username').val();
      if(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(username)==true )
      {
        $("#f").html("");
      } 
      else
      {
        $("#f").html("Please Enter Correct from_name Format");
      }
    });

    jQuery('#smtp_password').keyup(function () {
     this.value = this.value.replace(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/g, function(str) { 
      ('You typed " ' + str + ' ".\n\nPlease use only Alphabetic & Numbers and Special Character.'); return ''; });
      if($(this).val().length > 12)
      {
      $("#g").html("Password should have 10 to 12 Character").fadeOut(5000);
      $(this).val($(this).val().substring(0, 12));
      }
    });*/

   
});
</script>
