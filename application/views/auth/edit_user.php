 <?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("edit_team_member",$user_session)){
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
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                 <div class="top-bar-title padding-bottom">
                      <!-- Update Team Members -->  
                    <?php echo $this->lang->line('btn_add_teammember_createuser');?>        
                  </div>
                </div> 
                <div class="col-md-4">
                 
                </div>
              </div>
            </div>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

                <div id="infoMessage"><?php echo $message;?></div>
                <!-- <?php echo form_open_multipart("auth/create_user",'class="form-horizontal row-border"');?> -->
                <?php echo form_open_multipart(uri_string(),'class="form-horizontal row-border"');?>
                  <div class="box-body" style="padding: 20px">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">
                        <!-- First Name --> 
                      <?php echo $this->lang->line('lbl_add_teammember_fname');?> 
                      <span class="text-danger"> *</span></label>
                      <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                        <?php echo form_input($first_name,'','class="form-control" id="firstname" placeholder="First Name"');?>
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">
                        <!-- Last Name  -->
                         <?php echo $this->lang->line('lbl_add_teammember_lname');?>
                          <span class="text-danger"> *</span>
                      </label>
                      <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                        <?php echo form_input($last_name,'','class="form-control" id="lastname" placeholder="Last Name"');?>
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">
                        <!-- Company -->
                        <?php echo $this->lang->line('lbl_add_teammember_company');?>
                      </label>
                      <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                        <?php echo form_input($company,'','class="form-control" id="lastname" placeholder="Company Name"');?>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">
                          <!-- Phone -->
                          <?php echo $this->lang->line('lbl_add_teammember_phone');?> 
                      </label>
                      <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                        <?php echo form_input($phone,'','class="form-control" id="password" placeholder="Phone"');?>
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">
                          <!-- Password -->
                          <?php echo $this->lang->line('lbl_add_teammember_password');?>
                      </label>
                      <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                        <?php echo form_input($password,'','class="form-control" id="password" placeholder="Password"');?>
                      </div>
                    </div>                

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">
                          <!-- Confirm Password --> 
                          <?php echo $this->lang->line('lbl_add_teammember_cnfpassword');?>
                      </label>
                      <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                        <?php echo form_input($password_confirm,'','class="form-control" id="confirm_password" placeholder="Confirm Password"');?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">
                          <!-- Profile -->
                          <?php echo $this->lang->line('lbl_add_teammember_profile');?> 
                        <span class="required">*</span>
                    </label>
                      <div class="col-md-4">
                        <!-- <input type="file" name="file1" class="required" accept="image/*" data-style="fileinput" data-inputsize="medium"> -->
                        <?php echo form_input($image1,'','class="required" accept="image/*" data-style="fileinput" data-inputsize="medium"');?>

                        <p class="help-block">Images only (image/*)</p>
                        <label for="file1" class="has-error help-block" generated="true" style="display:none;"></label>
                      </div>
                    </div>  
                    <?php echo form_input($tmpimg)?>
                    <?php if ($this->ion_auth->is_admin()): ?>
                    
                      <h3><?php echo $this->lang->line('lbl_edit_teammember_grouplable');?></h3>
                      <?php foreach ($groups as $group):?>
                          <label class="checkbox">
                          <?php
                              $gID=$group['id'];
                              $checked = null;
                              $item = null;
                              foreach($currentGroups as $grp) {
                                  if ($gID == $grp->id) {
                                      $checked= ' checked="checked"';
                                  break;
                                  }
                              }
                          ?>
                          <input type="checkbox" class="minimal" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?> >
                          <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                          </label>
                      <?php endforeach?>
                      
                  <?php endif ?>

                  <?php echo form_hidden('id', $user->id);?>
                  <?php echo form_hidden($csrf); ?>
                   
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    
                      <?php echo form_submit('submit', $this->lang->line('btn_edit_teammember_saveuser'),'class="btn btn-info btn-flat"');?>
                      <!-- <button type="button" class="btn btn-default btn-flat">Cancel</button
                      > -->
                      <a href="<?php echo base_url();?>settings/member_list" class="btn btn-default btn-flat"><!-- Cancel -->
                        <?php echo $this->lang->line('btn_cancel');?>
                    </a>
                    
                  </div>
                  <!-- /.box-footer -->
                <?php echo form_close();?>

              </div> 
            </div>
          <!-- /.nav-tabs-custom -->
          </div>
        <!-- /.col -->
        </div>
      <!-- /.row -->
      </div>
    </section>
</div>
<?php 
  $this->load->view('layout/footer');
?> 
