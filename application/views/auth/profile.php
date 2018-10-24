<?php 
  $this->load->view('layout/header');
?>
<div class="content-wrapper">
  <div id="notifications" class="row no-print">
    <div class="col-md-12">
    </div>
  </div>  
  <!-- Main content -->
  <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i>Alert!</h4>
                Profile change is not available in demo version
            </div>
        </div> 
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Profile Settings</h3>
          </div>
          <div class="box-body no-padding" style="display: block;">
            <ul class="nav nav-pills nav-stacked" style="margin: 5%;">

            <!-- <?php if(isset($user->profile)){ ?>

              <img src="<?php echo base_url();?>assets/images/<?php echo $user->profile;?>" class="img-responsive" height="80%" width="80%">
            <?php }
            ?> -->

            <?php
                if(isset($user->profile))
                {
                ?>
                  <img src="<?php echo base_url();?>assets/images/<?php echo $user->profile;?>" class="img-circle" class="img-responsive" height="80%" width="80%">
                <?php
                  }
                else{
                ?>
                  <img src="<?php echo base_url();?>assets/logo/user.png" class="img-circle" alt="User Image" class="img-responsive" height="80%" width="80%">  
                <?php }?>
            </ul>
            <hr> 
            <ul class="nav nav-pills nav-stacked" style="margin: 5%;">
              <center>
                <a href="<?php echo base_url();?>auth/change_password" class="btn btn-info btn-flat">Change Password</a>
              </center>
            </ul>
             
          </div>
          <!-- /.box-body -->
        </div>
        
      </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-info">
            <div class="box-header with-border">
              <center>
                <strong><h3 class="box-title"> Profile Details </h3></strong>
              </center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo base_url();?>auth/edit" method="post" id="profileForm" class="form-horizontal" name="profileForm" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $this->session->userdata("userId");?>" name="id">
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="fname">First Name <span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="First Name" class="form-control" id="fname" name="fname" value="<?php echo $user->first_name;?>" onblur='chkEmpty("profileForm","fname","Please Enter First Name");'>
                    <span id="name" style="color: red"><?php echo form_error('fname');?></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="lname">Last Name <span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="Last Name" class="form-control" id="lname" name="lname" value="<?php echo $user->last_name;?>" onblur='chkEmpty("profileForm","lname","Please Enter Last Name");'>
                    <span id="val_loc_code" style="color:red"><?php echo form_error('lname');?></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="email"> Email <span class="text-danger"> *</span></label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" value="<?php echo $user->email;?>">
                    <span style="color: red"></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="phone">Phone <span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="Phone" class="form-control" name="phone" value="<?php echo $user->phone;?>" id="phone" onblur='chkEmpty("profileForm","phone","Please Enter Phone Number");'>
                    <span style="color: red"></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-md-3 control-label">Profile 
                    <!-- <span class="required">*</span> -->
                  </label>
                  <div class="col-md-6">
                    <input type="file" class="form-control" name="images">
                    <p class="help-block">Images only (image/*)</p>
                    <label for="file1" class="has-error help-block" generated="true"></label>
                    <input type="text" name="temp" value="<?php echo $user->profile;?>">
                  </div>
                </div>  
              <!-- /.box-body -->
              <div class="box-footer">
                <center>
                  <input class="btn btn-info btn-flat" type="submit" name="btnSubmit" value="Submit" id="btnSubmit">
                </center>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    
  </section>
</div>
<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 

<script type="text/javascript">

  $(document).ready(function(){

    /*jQuery('#fname').keyup(function (){
       this.value = this.value.replace(/[^a-zA-Z ]/g, function(str) 
       { 
          $("input[name='fname']").parent().addClass("has-error has-feedback");
          $("input[name='fname']").parent().find("span").addClass("fa fa-remove form-control-feedback");
          $("input[name='fname']").parent().find("p").text("Please enter alphabetic only");


        ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
         if($(this).val().length > 20)
         {
            $(this).val($(this).val().substring(0, 20));
         }
         
    });


    jQuery('#lname').keyup(function (){
       this.value = this.value.replace(/[^a-zA-Z ]/g, function(str) 
       { 
          $("input[name='lname']").parent().addClass("has-error has-feedback");
          $("input[name='lname']").parent().find("span").addClass("fa fa-remove form-control-feedback");
          $("input[name='lname']").parent().find("p").text("Please enter alphabetic only");

        ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
         if($(this).val().length > 20)
         {
            $(this).val($(this).val().substring(0, 20));
         }
    });


    jQuery('#phone').keyup(function (){
       this.value = this.value.replace(/[^0-9 ]/g, function(str) 
       { 
          $("input[name='phone']").parent().addClass("has-error has-feedback");
          $("input[name='phone']").parent().find("span").addClass("fa fa-remove form-control-feedback");
          $("input[name='phone']").parent().find("p").text("Please enter numeric only");

        ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
         if($(this).val().length > 12)
         {
            $(this).val($(this).val().substring(0, 12));
         }
         
    });*/


    $("input[name='btnSubmit']").click(function(e)
    {
       var fname=chkEmpty("profileForm","fname","Please Enter First Name");
       var lname=chkEmpty("profileForm","lname","Please Enter Last Name");
       var phone=chkEmpty("profileForm","phone","Please Enter Phone");

       if((fname+lname+phone) < 1)
       {
         profileForm.submit();
         return true;
       }
       else
       {
         return false;
       }

    }); 

  });

</script>
