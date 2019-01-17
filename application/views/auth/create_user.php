 <?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("add_team_member",$user_session)){
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
                <div class="col-md-8">
                 <div class="top-bar-title padding-bottom">
                    <!-- Add Team Members -->
                    <?php echo $this->lang->line('btn_add_teammember');?>
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
            <div class="col-md-11" >

            <!-- <div id="infoMessage"><?php echo $message;?></div>  -->
            <?php echo form_open_multipart("auth/create_user",'class="form-horizontal row-border"');?>
              <div class="box-body" style="padding: 20px">
                  <div class="row">
                      <div class=" col-md-6 col-sm-12">
                          <h3 style="text-align: center">User Info</h3><br><br>
                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                      <!-- First Name --> 
                      <?php echo $this->lang->line('lbl_add_teammember_fname');?>
                      <span class="text-danger"> *</span>
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($first_name,'','class="form-control" id="firstname" placeholder="First Name"');?>
                    <span style="color:red"><?php echo form_error('first_name');?></span>
                  </div>

                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                    <!-- Last Name --> 
                     <?php echo $this->lang->line('lbl_add_teammember_lname');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($last_name,'','class="form-control" id="lastname" placeholder="Last Name"');?>
                    <span style="color:red"><?php echo form_error('last_name');?></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                      <!-- Company -->
                     <?php echo $this->lang->line('lbl_add_teammember_company');?> 
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($company,'','class="form-control" id="lastname" placeholder="Company Name"');?>

                  </div>
                </div>


                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                      <!-- Phone -->
                      <?php echo $this->lang->line('lbl_add_teammember_phone');?>
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($phone,'','class="form-control" id="password" placeholder="Phone"');?>
                  </div>
                </div>

                <?php
                if($identity_column!=='email') {
                    echo '<p>';
                    echo lang('create_user_identity_label', 'identity');
                    echo '<br />';
                    echo form_error('identity');
                    echo form_input($identity);
                    echo '</p>';
                }
                ?>

                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                    <!-- Email --> 
                    <?php echo $this->lang->line('lbl_add_teammember_email');?>
                  <span class="text-danger"> *</span></label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($email,'','class="form-control" id="email" placeholder="Email"');?>
                     <span style="color:red"><?php echo form_error('email');?></span>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                    <!-- Password -->
                     <?php echo $this->lang->line('lbl_add_teammember_password');?> 
                        <span class="text-danger"> *</span>
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($password,'','class="form-control" id="password" placeholder="Password"');?>
                     <span style="color:red"><?php echo form_error('password');?></span>
                  </div>
                </div>                

                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label">
                    <!-- Confirm Password --> 
                    <?php echo $this->lang->line('lbl_add_teammember_cnfpassword');?>
                    <span class="text-danger">*</span>
                  </label>
                  <div class="ccol-md-8 col-sm-8">
                    <?php echo form_input($password_confirm,'','class="form-control" id="confirm_password" placeholder="Confirm Password"');?>
                     <span style="color:red"><?php echo form_error('password_confirm');?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 col-sm-4 control-label">
                      <!-- Profile -->
                      <?php echo $this->lang->line('lbl_add_teammember_profile');?>
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <?php echo form_input($image1,'','class="required" accept="image/*" data-style="fileinput" data-inputsize="medium"');?>
                    <label for="file1" class="has-error help-block" generated="true" style="display:none;"></label>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="inputEmail3" class="col-md-4 col-sm-4 control-label"> 
                      <!-- User Role -->
                     <?php echo $this->lang->line('lbl_add_teammember_userrole');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8">
                    <select class="form-control select2" name="group_id" id="group_id" class="role">
                      <option value=""><!-- Select Role -->
                        <?php echo $this->lang->line('lbl_dropdown_customer');?>
                      </option>
                      <?php foreach ($group as $value) { ?>
                        <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                      <?php } ?>
                    </select>
                    <span style="color:red"><?php echo form_error('group_id');?></span>
                  </div>
                </div>      
                          
                 </div>
                      <div class="col-md-6 ">
                          <h3 style="text-align: center" >Personal </h3><br><br>
                          <div class="form-group" >
                               <!--<label for="dob"> DOB</label>--> 
                               <label for="dob" class="col-md-4 col-sm-4 control-label">DOB</label>    
                               
                           <div class="col-md-8 col-sm-8"> 
                                <input type="date" id="dob" name="dob" class="form-control" value="" placeholder="dob">
 
                           
                                </div>
                          </div>
                          <div class="form-group">    
                            <label for="address" class="col-md-4 col-sm-4 control-label">Address</label>
                            
                        <div class="col-md-8 col-sm-8">
                            <input type="text" id="add" name="address" class="form-control" value="" placeholder="address" />
                        </div>
                          </div>
                         <div class="form-group">
                    <label for="Gender" class="col-md-4 col-sm-4 control-label">Gender</label>
                    
                        <div class="col-md-8 col-sm-8"> 
                    <select name="gender" class="form-control" >
                      <option value="male" id="male" name="gender">Male </option>
                      <option value="female" id="female" name="gender"> Female</option>
                    
                    </select>
                        </div>
                         </div>
                        <div class="form-group">
                            <label for="Education" class="col-md-4 col-sm-4 control-label">Education</label>
                            
                        <div class="col-md-8 col-sm-8"> 
                            <input type="text" id="educ" name="education" class="form-control" value="" placeholder="">
                        </div>
                        </div>

                              
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                
                <?php echo form_submit('submit', $this->lang->line('btn_add_teammember_createuser'),'class="btn btn-info btn-flat"');?>
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