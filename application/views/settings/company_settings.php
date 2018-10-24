 <?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_company_setting",$user_session)){
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
                    <!-- Company Settings -->
                    <b><?php echo $this->lang->line('lbl_company_header');?></b>
                  </div>
                </div> 
              </div>
            </div>
          </div>


          <?php if($this->session->flashdata('fail')) { ?>
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> 
              <!-- Alert! -->
              <?php echo $this->lang->line('alert');?>
              </h4>
              <?php echo $this->session->flashdata('fail');?>
            </div>
          <?php } ?>


          <div class="box">
          <div class="box-body">
            
            <!-- /.box-header -->
              <form action="<?php echo base_url();?>settings/add_company" method="post" 
              id="settingForm" class="form-horizontal" name="companyForm" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-body">

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                            <!-- Name -->
                              <?php echo $this->lang->line('lbl_company_settings_name');?>
                              <span class="text-danger">*</span>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="company_name" value="<?php if(isset($data[0]->name)){ echo $data[0]->name; }?>" onblur='chkEmpty("companyForm","name","Please Enter Company name");' >
                            <span style="font-size:20px;"><?php echo form_error('name');?></span> 
                                <p style="color:#990000;"></p>
                          </div>
                        </div>            

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                              <!-- Site Short Name -->
                               <?php echo $this->lang->line('lbl_company_settings_shortname');?>
                                 
                          </label>

                          <div class="col-sm-8">
                            <input type="text" name="short_name" id="short_name" value="<?php if(isset($data[0]->site_short_name)){ echo $data[0]->site_short_name;}?>" class="form-control">
                            <span style="font-size:20px;"><?php echo form_error('short_name');?></span>
                                <p style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                            <!-- Email -->
                              <?php echo $this->lang->line('lbl_company_settings_email');?>
                              <span class="text-danger">*</span>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($data[0]->email)){ echo $data[0]->email;}?>">
                            <span style="font-size:20px;"><?php echo form_error('email');?></span>
                                <p style="color:#990000;"></p>
                                <h4 id="emailid" style="color:#990000;"></h4>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                            <!-- Mobile -->
                              <?php echo $this->lang->line('lbl_company_settings_mobile');?>
                              <span class="text-danger">*</span>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php if(isset($data[0]->phone)){ echo $data[0]->phone; }?>" onblur='chkEmpty("companyForm","phone","Please Enter Phone");'>
                             <span style="font-size:20px;"><?php echo form_error('phone');?></span>
                                <p id="con" style="color:#990000;"></p> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                              <!-- Site Short Name -->
                               Bank Name 
                          </label>

                          <div class="col-sm-8">
                            <input type="text" name="bank_name" id="bank_name" value="<?php if(isset($data[0]->bank_name)){ echo $data[0]->bank_name;}?>" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                              <!-- Site Short Name -->
                               A/c No
                          </label>

                          <div class="col-sm-8">
                            <input type="text" name="ac_no" id="ac_no" value="<?php if(isset($data[0]->ac_no)){ echo $data[0]->ac_no;}?>" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                              <!-- Site Short Name -->
                               Branch & IFS Code
                          </label>

                          <div class="col-sm-8">
                            <input type="text" name="ifs_code" id="ifs_code" value="<?php if(isset($data[0]->ifs_code)){ echo $data[0]->ifs_code;}?>" class="form-control">
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                              <!-- Site Short Name -->
                               Company Pan No
                          </label>
                          <div class="col-sm-8">
                            <input type="text" name="pan" id="pan" value="<?php if(isset($data[0]->pan)){ echo $data[0]->pan;}?>" class="form-control">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                            <!-- Default language -->
                            <?php echo $this->lang->line('lbl_company_settings_language');?>
                          </label>

                          <div class="col-sm-8">
                            <select name="lang" class="form-control">
                           <option value="">Select</option>
                               <option value="english" <?php 
                                         if(isset($data[0]->default_language)){
                                           if($data[0]->default_language == "english"){
                                             echo "selected";
                                           }
                                         } 
                                       ?>>English
                               </option>
                               <option value="franch" <?php 
                                         if(isset($data[0]->default_language)){
                                           if($data[0]->default_language == "franch"){
                                             echo "selected";
                                           }
                                         } 
                                       ?>>Franch
                               </option>
                               <option value="chinese" <?php 
                                         if(isset($data[0]->default_language)){
                                           if($data[0]->default_language == "chinese"){
                                             echo "selected";
                                           }
                                         } 
                                       ?>>Chinese
                               </option>
                               <option value="russian" <?php 
                                         if(isset($data[0]->default_language)){
                                           if($data[0]->default_language == "russian"){
                                             echo "selected";
                                           }
                                         } 
                                       ?>>Russian
                               </option>
                               <option value="spanish" <?php 
                                         if(isset($data[0]->default_language)){
                                           if($data[0]->default_language == "spanish"){
                                             echo "selected";
                                           }
                                         } 
                                       ?>>Spanish
                               </option>
                               <option value="arabic" <?php 
                                         if(isset($data[0]->default_language)){
                                           if($data[0]->default_language == "arabic"){
                                             echo "selected";
                                           }
                                         } 
                                       ?>>Arabic
                               </option>
                           </select>
                           <span style="font-size:20px;"><?php echo form_error('lang');?></span>
                               <p style="color:#990000;"></p>
                         </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                            <!-- Default currency -->
                            <?php echo $this->lang->line('lbl_company_settings_currancy');?>
                          </label>

                          <div class="col-sm-8">
                            <select class="form-control" name="currency" >
                                 <option value=""><!-- Select -->
                                   <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                 </option>
                                <?php
                                  foreach ($currency as  $key) {
                                ?>
                                <option 
                                  value='<?php echo $key->id ?>' 
                                  <?php 
                                    if(isset($data[0]->default_currency)){
                                      if($key->id == $data[0]->default_currency){
                                        echo "selected";
                                      }
                                    } 
                                  ?>
                                >
                                <?php echo $key->name; ?>
                                </option>
                                <?php
                                 }
                                ?>
                            </select>
                                <span style="font-size:20px;"><?php echo form_error('currency');?></span>
                                <p style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="gstin">
                          <!-- GSTIN -->
                              <?php echo $this->lang->line('lbl_gstin');?>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="gstin" id="gstin" value="<?php if(isset($data[0]->gstin)){ echo $data[0]->gstin; }?>" maxlength="16">
                            <span style="font-size:20px;">
                            <?php echo form_error('gstin');?></span>
                            <label>ex : 22AAAAA0000A1Z5(15 digit)</label>
                            <p id="gstinno" style="color:#990000;"></p>
                          </div>
                        </div>

                    </div>
                  </div>

                  <!-- ================================================================= -->
                  <!-- ================================================================= -->
                  <!-- ================================================================= -->

                  <div class="col-md-6">
                    <div class="box-body">
                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                            <!-- Street -->
                              <?php echo $this->lang->line('lbl_company_settings_street');?>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="street" id="company_street" value="<?php if(isset($data[0]->street)){ echo $data[0]->street;}?>" >
                             <span style="font-size:20px;"><?php echo form_error('street');?></span>
                                <p style="color:#990000;"></p> 
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                          <!-- Country -->
                            <?php echo $this->lang->line('lbl_company_settings_country');?>
                         </label>

                          <div class="col-sm-8">
                            <select class="form-control select2" 
                            name="country" id="country">
                            <option value=""><!-- Select -->
                                <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                                <?php
                                  foreach ($country as  $key) {
                                ?>
                                <option value='<?php echo $key->id ?>'
                                  <?php 
                                    if(isset($data[0]->country_id)){
                                      if($key->id == $data[0]->country_id){
                                        echo "selected";
                                      }
                                    } 
                                  ?>
                                >
                                <?php echo $key->name; ?>
                                </option>
                                <?php
                                  }
                                ?>
                           
                          </select>
                          <span class="validation-color" id="err_country"><?php echo form_error('country'); ?></span>
                                <p id="coun" style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                          <!-- State -->
                            <?php echo $this->lang->line('lbl_company_settings_state');?>
                            <!-- <span class="text-danger">*</span> -->
                          </label>

                          <div class="col-sm-8">
                            <select class="form-control select2" name="state" id="state" value="">
                            <option value=""><!-- Select -->
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                                <?php
                                  foreach ($state as  $key) {
                                ?>
                                <option value='<?php echo $key->id ?>'
                                  <?php 
                                    if(isset($data[0]->state_id)){
                                      if($key->id == $data[0]->state_id){
                                        echo "selected";
                                      }
                                    } 
                                  ?>
                                >
                                <?php echo $key->name; ?>
                                </option>
                              <?php
                                }
                              ?>
                              </select>
                            <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span>
                                <p style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                          <!-- City -->
                          <?php echo $this->lang->line('lbl_company_settings_city');?>
                              <!-- <span class="text-danger">*</span> -->
                          </label>

                          <div class="col-sm-8">
                            <select class="form-control select2" name="city" id="city" value="" >
                            <option value=""><!-- Select -->
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                                <?php
                                  foreach ($city as  $key) {
                                ?>
                                <option value='<?php echo $key->id?>'
                                  <?php 
                                    if(isset($data[0]->city_id)){
                                      if($key->id == $data[0]->city_id){
                                        echo "selected";
                                      }
                                    } 
                                  ?>
                                > 
                                    <?php echo $key->name;?>
                                </option>
                                <?php
                                  }
                                ?>
                              </select>
                            <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                                <p style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="inputEmail3">
                          <!-- Zip code -->
                              <?php echo $this->lang->line('lbl_company_settings_zipcode');?>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php if(isset($data[0]->zip_code)){ echo $data[0]->zip_code; }?>" >
                            <span style="font-size:20px;"><?php echo form_error('zipcode');?></span>
                                <p style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="gstin">
                          <!-- GSTIN -->
                              <?php echo $this->lang->line('lbl_gstin');?>
                          </label>

                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="gstin" id="gstin" value="<?php if(isset($data[0]->gstin)){ echo $data[0]->gstin; }?>" maxlength="16">
                            <span style="font-size:20px;">
                            <?php echo form_error('gstin');?></span>
                            <label>ex : 22AAAAA0000A1Z5(15 digit)</label>
                            <p id="gstinno" style="color:#990000;"></p>
                          </div>
                        </div>

                        

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                              Login Page Logo
                          </label>

                          <div class="col-sm-8">
                            <input type="file" class="form-control" name="login_logo" id="login_logo">
                            <input type="hidden" class="form-control" name="login_image" id="login_image" value="<?php if(isset($data[0]->loginpage_image)){echo $data[0]->loginpage_image; }?>">

                             <p>Recomeded size : 300*120</p>
                                <p style="color:#990000;"></p> 
                              <?php if(isset($data[0]->loginpage_image)){?>  
                              <img src="<?php echo base_url();?>assets/images/<?php if(isset($data[0]->loginpage_image)){echo $data[0]->loginpage_image;}?>" height="50" width="100">
                              <?php } ?>
                          </div>
                        </div>   

                        <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                              Invoice Logo
                          </label>

                          <div class="col-sm-8">
                            <input type="file" class="form-control" name="invoice_logo" id="invoice_logo">
                            <input type="hidden" class="form-control" name="invoice_image" id="invoice_image" value="<?php if(isset($data[0]->invoice_image)){echo $data[0]->invoice_image; }?>">

                             <p>Recomeded size : 300*120</p>
                                <p style="color:#990000;"></p> 
                              <?php if(isset($data[0]->invoice_image)){?>  
                              <img src="<?php echo base_url();?>assets/images/<?php if(isset($data[0]->invoice_image)){echo $data[0]->invoice_image;}?>" height="50" width="100">
                              <?php } ?>
                          </div>
                        </div>   


                    </div>
                  </div>

                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                  <center>
                    <input class="btn btn-info btn-flat" type="submit" id="btn" value="Submit" name="btnsubmit" onclick="return ValidateEmail(document.companyForm.email);">
                  </center>
                  <!-- <a href="" type="button" class="btn btn-default btn-flat" value="Cancel">Cancel</a> -->
                </div>
                <!-- /.box-footer -->
              </form>
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
    <!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">D
        elete Parmanently</h4>
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
    <!-- /.content -->
</div>

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 
<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='btnsubmit']").click(function(e){  
         var b=chkEmpty("companyForm","name","Please Enter Company name");    
         var e=chkEmpty("companyForm","email","Please Enter Email");
         var f=chkEmpty("companyForm","phone","Please Enter Phone");
         var g=chkEmpty("companyForm","street","Please Enter Street");
         var cn=chkDrop("companyForm","country","Please Enter Country");
         var st=chkDrop("companyForm","state","Please Enter State");
         var ct=chkDrop("companyForm","city","Please Enter City");
           if((b+e+f+g+h+i) < 1)
           {
             companyForm.submit();
             return true;
           }
           else
           {
             return false;
           }
      });
    });      

    $('#country').change(function(){
          var id = $(this).val(); 
          $('#state').html('<option value="">Select</option>');
          $('#city').html('<option value="">Select</option>');
          $.ajax({
              url: "<?php echo base_url('settings/getState') ?>/"+id,
              type: "GET",
              dataType: "JSON",
              success: function(data){
                for(i=0;i<data.length;i++){
                  $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
              }
            });
      });

      $('#state').change(function(){
      var id = $(this).val();
      $('#city').html('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('settings/getCity') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script>

<script type="text/javascript">
  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);
</script>