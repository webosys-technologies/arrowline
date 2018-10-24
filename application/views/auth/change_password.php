<?php 
  $this->load->view('layout/header');
?>
<div class="content-wrapper">
  <div id="notifications" class="row no-print">
    <div class="col-md-12">
    </div>
  </div>  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Settings</h3>
          </div>
          <div class="box-body no-padding" style="display: block;">
            <ul class="nav nav-pills nav-stacked" style="margin-left: 10%;min-height: 150px;">

            <!-- <?php if(isset($user->profile)){ ?>

              <img src="<?php echo base_url();?>assets/images/<?php echo $user->profile;?>" class="img-responsive" height="80%" width="80%">
            <?php }
            ?> -->

            <?php
                $profile = $this->session->userdata('profile');
                if(!empty($profile))
                {
                ?>
                  <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata('profile');?>" class="img-circle" class="img-responsive" height="80%" width="80%">
                <?php
                  }
                else{
                ?>
                  <img src="<?php echo base_url();?>assets/logo/user.png" class="img-circle" alt="User Image" class="img-responsive" height="80%" width="80%">  
                <?php }?>
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
                <strong><h3 class="box-title"> Change Password Page</h3></strong>
              </center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <div id="infoMessage"><?php echo $message;?></div> -->
            <?php echo form_open("auth/change_password",'class="form-horizontal row-border"');?>
              <div class="box-body" style="padding: 20px">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Old Password <span class="text-danger"> *</span></label>
                  <div class="col-sm-9">
                    <?php echo form_input($old_password,'','class="form-control" id="firstname" placeholder="Old Password"');?>
                    <span id="name" style="color: red"><?php echo form_error('old');?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="new_password" class="col-sm-3 control-label"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?> <span class="text-danger"> *</span></label>

                  <div class="col-sm-9">
                    <?php echo form_input($new_password,'','class="form-control" id="lastname" placeholder="New Password"');?>
                    <span id="new" style="color: red"><?php echo form_error('new');?></span>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password <span class="text-danger"> *</span></label>
                  <div class="col-sm-9">
                    <?php echo form_input($new_password_confirm,'','class="form-control" id="firstname" placeholder="Confirm Password"');?>
                    <span id="new_confirm" style="color: red"><?php echo form_error('new_confirm');?></span>
                  </div>
                </div>
                <?php echo form_input($user_id);?>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <center>
                  <?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-info"');?>
                </center>
              </div>
              <!-- /.box-footer -->
            <?php echo form_close();?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    
  </section>
</div>
<?php 
  $this->load->view('layout/footer');
?> 
