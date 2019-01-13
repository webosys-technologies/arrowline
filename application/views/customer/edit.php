<?php 
  $this->load->view('layout/header');
  $user = $this->session->userdata('userRole');
  if(empty($user))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("edit_customer",$user)){
      redirect('customer','refresh');
  }
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="box-footer">
             <h4 class="box-title">
             <!-- Customer -->
             <?php echo $this->lang->line('customers_header');?>
             </h4>
      </div>
       <br>

      <form name="customerForm" class="form-horizontal row-border" method="post" action="<?php echo base_url(); ?>customer/edit" >
            <div class="box-footer">
                <div class="box-body" style="padding: 20px">
                    <div class="row">
                       <div class="col-md-12">
                          <div class="col-md-6">
                              <h4 class="text-info text-center">
                                <!-- Customer Information -->
                                <?php echo $this->lang->line('lbl_cust_info');?>
                              </h4>

                              <div class="form-group">
                                <label class="col-sm-4 control-label require" for="name">
                                  <!-- Name -->
                                  <?php echo $this->lang->line('lbl_name');?>
                                  <label style="color:red;">*</label>
                                </label>
                                     <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $data->name;?>" tabindex="1">
                                        <span style="color: red;"><?php echo form_error('name'); ?></span>
                                        <span style="font-size:20px;"></span>
                                        <p id="name" style="color:#990000;"></p>
                                  </div>
                              </div>
                         
                              <div class="form-group">
                                  <label class="col-sm-4 control-label require" for="email">
                                    <!-- Email -->
                                    <?php echo $this->lang->line('lbl_email');?>
                                  </label>
                                      <div class="col-sm-8">
                                          <input type="email" value="<?php echo $data->email;?>" class="form-control" name="email" tabindex="2">
                                          <span style="color: red;"></span>
                                          <span style="font-size:20px;"></span>
                                           <h4 id="emailspan" style="font-size:16px;color:#990000"></h4>
                                          <p id="a" style="color:#990000;"></p>
                                     </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-sm-4 control-label" for="contact">
                                  <!-- Phone -->
                                  <?php echo $this->lang->line('lbl_phone');?>
                                  <label style="color:red;">*</label></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="<?php echo $data->phone;?>" id="contact" class="form-control" name="phone" tabindex="3">
                                        <span style="color: red;"><?php echo form_error('phone'); ?></span>
                                        <span style="font-size:20px;"></span>
                                        <h4 id="phonespan" style="font-size:16px;color:#990000"></h4>
                                        <p id="c" style="color:#990000;"></p>
                                    </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label require" for="street">
                                  <!-- Street -->
                                  <?php echo $this->lang->line('lbl_street');?>
                                </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="street" name="street" value="<?php echo $data->street;?>" tabindex="4">
                                        <span style="color: red;"><?php echo form_error('street'); ?></span>
                                        <span style="font-size:20px;"></span>
                                        <p style="color:#990000;"></p>
                                    </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-4 control-label" for="country">
                                    <!-- Country -->
                                    <?php echo $this->lang->line('lbl_country');?>
                                  </label>
                                    <div class="col-sm-8">
                                       <select class="form-control select2" id="country" name="country" tabindex="5">
                                          <option value="">- Select country -</option> 
                                          <?php foreach ($country as $value) {?>
                                           <option value="<?php echo $value->id;?>" <?php if($value->id == $data->country_id){ echo "selected"; }?>><?php echo $value->name;?></option>
                                           <?php } ?>
                                      </select>
                                      <span style="color: red;"></span>
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                    </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label" for="state">
                                  <!-- State -->
                                   <?php echo $this->lang->line('lbl_state');?>
                                </label>
                                 <div class="col-sm-8">
                                  <select class="form-control select2" id="state" name="state" tabindex="6">

                                       <?php 
                                      
                                        if(isset($state)){
                                         foreach ($state as $val) {?>
                                          <option value="<?php echo $val->id;?>" <?php if($val->id == $data->state_id){ echo "selected"; }?>><?php echo $val->name;?></option>
                                          <?php }} ?>
                                      </select>
                                  <span style="color: red;"></span>
                                  <span style="font-size:20px;"></span>
                                  <p style="color:#990000;"></p>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label" for="state_code">
                                  State code
                                  <!-- <?php echo $this->lang->line('lbl_zipcode');?> -->
                                </label>
                                  <div class="col-sm-8">
                                    <input type="text" placeholder="State code" class="form-control" id="state_code" name="state_code" tabindex="7" value="<?php if(isset($data->state_code)){echo $data->state_code;}?>">
                                    <span style="color: red;"><?php echo form_error('state_code'); ?></span>
                                    <span style="font-size:20px;"></span>
                                     <p style="color:#990000;"></p>
                                    </div>
                              </div>


                              <div class="form-group">
                                <label class="col-sm-4 control-label require" for="city">
                                  <!-- City -->
                                  <?php echo $this->lang->line('lbl_city');?>
                                </label>
                                  <div class="col-sm-8">
                                    <select class="form-control select2" id="city" name="city" tabindex="8">
                                     <?php 
                                      if(isset($city)){
                                          
                                      foreach ($city as $value) {?>
                                          <option value="<?php echo $value->id;?>" <?php if($value->id == $data->city_id){ echo "selected"; }?>><?php echo $value->name;?></option>
                                          <?php }} ?>
                                        </select>
                                      <span style="color: red;"></span>
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-4 control-label" for="zip_code">
                                      <!-- Zip code -->
                                      <?php echo $this->lang->line('lbl_zipcode');?>
                                  </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo $data->zip_code;?>" tabindex="9">

                                        <span style="color: red;"></span>
                                        <span style="font-size:20px;"></span>
                                        <p id="b" style="color:#990000;"></p>
                                    </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label" for="gstin">
                                <!-- GSTIN -->
                                <?php echo $this->lang->line('lbl_gstin');?>
                                </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="gstin" name="gstin" tabindex="10" value="<?php echo $data->gstin;?>" maxlength="15">
                                        <label>ex : 22AAAAA0000A1Z5(15 digit)</label>
                                        <span style="color: red;"></span>
                                        <span style="font-size:20px;"></span>
                                        <p id="gstinno" style="color:#990000;"></p>
                                    </div>
                               </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label" for="country">
                                  GST Registration Type
                                    <!-- <?php echo $this->lang->line('lbl_country');?> -->
                                  </label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" id="gst_reg_type"  name="gst_reg_type" tabindex="5">
                                          <option <?php if($data->gst_registration_type=='Registered'){ echo "selected";}?>>Registered</option>
                                          <option <?php if($data->gst_registration_type=='Unregistered'){ echo "selected";}?>>Unregistered</option>
                                          <option <?php if($data->gst_registration_type=='Composition Scheme'){ echo "selected";}?>>Composition Scheme</option>
                                          <option <?php if($data->gst_registration_type=='Input Service Distributor'){ echo "selected";}?>>Input Service Distributor</option>
                                          <option <?php if($data->gst_registration_type=='E-Commerece Operator'){ echo "selected";}?>>E-Commerece Operator</option>
                                        </select>
                                        <span style="color: red;"><?php echo form_error('country'); ?></span>
                                        <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                  </div>
                                </div>

                          </div>

                                   <div class="col-md-6">
                                        <h4 class="text-primary text-center">
                                            <!-- Shipping Address  -->
                                            <?php echo $this->lang->line('lbl_shipping_address');?>
                                        </h4>
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label" for="street1">
                                           <!-- Street -->
                                            <?php echo $this->lang->line('lbl_street');?>
                                          </label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="street1" id="street1" value="<?php if(isset($shipping->street)){echo $shipping->street;}?>" tabindex="11">
                                              <span style="color: red;"></span>
                                              <span style="font-size:20px;"></span>
                                              <p style="color:#990000;"></p>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label" for="country1">
                                            <!-- Country -->
                                             <?php echo $this->lang->line('lbl_country');?>
                                          </label>
                                              <div class="col-sm-8">
                                                  <select class="form-control select2" id="country1"  name="country1" tabindex="12">
                                                      <option value="">- Select country -</option> 
                                                      <?php foreach ($country as $value) {?>
                                                       <option value="<?php echo $value->id;?>" 
                                                          <?php if(isset($shipping->country_id)){ 
                                                              if($value->id == $shipping->country_id){ 
                                                                  echo "selected"; 
                                                          }}?>>
                                                          <?php echo $value->name;?></option>     
                                                       <?php } ?>
                                                  </select>
                                                  <span style="color: red;"></span>
                                                  <span style="font-size:20px;"></span>
                                                  <p style="color:#990000;"></p>
                                              </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-sm-4 control-label" for="state1">
                                            <!-- State -->
                                              <?php echo $this->lang->line('lbl_state');?>
                                            </label>
                                             <div class="col-sm-8">
                                              <select class="form-control select2" id="state1" name="state1" tabindex="13">
                                                   <?php foreach ($state1 as $value) {?>
                                                    <option value="<?php echo $value->id;?>" <?php if($value->id == $shipping->state_id){ echo "selected"; }?>><?php echo $value->name;?></option>
                                                    <?php } ?>
                                              </select>
                                              <span style="color: red;"></span>
                                              <span style="font-size:20px;"></span>
                                              <p style="color:#990000;"></p>
                                            </div>
                                         </div>

                                         <div class="form-group">
                                          <label class="col-sm-4 control-label require" for="city1"><!-- City -->
                                            <?php echo $this->lang->line('lbl_city');?>
                                          </label>
                                            <div class="col-sm-8">
                                              <select class="form-control select2" id="city1" name="city1" tabindex="14">

                                                <?php 
                                                  if(isset($city1)){
                                                  foreach ($city1 as $value) {?>
                                                  <option value="<?php echo $value->id;?>" <?php if($value->id == $shipping->city_id){ echo "selected"; }?>><?php echo $value->name;?></option>
                                                  <?php }} ?>
                                                </select>
                                                  <span style="color: red;"><?php echo form_error('city'); ?></span>
                                                  <span style="font-size:20px;"></span>
                                                  <p style="color:#990000;"></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label" for="zip_code1">
                                          <!-- Zip code -->
                                          <?php echo $this->lang->line('lbl_zipcode');?>
                                          </label>
                                              <div class="col-sm-8">
                                                <input type="text" class="form-control" id="zip_code1"  name="zip_code1" value="<?php if(isset($shipping->zip_code)){echo $shipping->zip_code;}?>" tabindex="15">
                                                <span style="color: red;"><?php echo form_error('zip_code1'); ?></span>
                                                <span style="font-size:20px;"></span>
                                                <p id="z" style="color:#990000;"></p>
                                              </div>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <input type="hidden" class="form-control" name="id" value="<?php if(isset($data->id)){echo $data->id;}?>">
                                            <input type="hidden" class="form-control" name="shippingid" value="<?php if(isset($shipping->id)){echo $shipping->id;}?>">  
                                        </div>
                                     </div>
                                  </div>
                              </div>
                                      
                            <div class="box-footer">
                              <center>
                                  <input type="submit" class="btn btn-info btn-flat" id="btnSubmit" name="customerSubmit" value="<?php echo $this->lang->line('btn_submit');?>"> 
                                  <a href="<?php echo base_url();?>customer/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
                              </center>
                             </div>
                       </form>
                   </div>
                </div>
           </div>   
       </section>    
        

    <script type="text/javascript">
         $(document).ready(function()
         {

            $("input[name='customerSubmit']").click(function(e)
            {
                var name=chkEmpty("customerForm","name","Please Enter Name");
                var phone=chkEmpty("customerForm","phone","Please Enter number");
                if(name + phone < 1){
                  customerForm.submit();
                  return true;
                }else{
                  return false;
                }    
            }); 

            $('#country').change(function(){
              var id = $(this).val();
              $('#state').html('<option value="">Select</option>');
              $('#city').html('<option value="">Select</option>');
              $.ajax({
                  url: "<?php echo base_url('customer/getState') ?>/"+id,
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
                var country=$('#country').val();
               // alert(id);
                $('#city').html('<option value="">Select</option>');
                $.ajax({
                    url: "<?php echo base_url('customer/getCity') ?>/"+id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                      for(i=0;i<data.length;i++){
                        $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                      }
                    }
                  });

                $.ajax({
                    url: "<?php echo base_url('supplier/get_statecode')?>/"+id+'/'+country,
                    type: "GET",
                    dataType: "TEXT",
                    success: function(data){
                      //alert(data);
                      $('#state_code').val(data);
                      //alert(data.state_code[0].state_code);
                    }
                  });

             });

             $('#country1').change(function(){
                var id = $(this).val();
             // alert(id);
                $('#state1').html('<option value="">Select</option>');
                $('#city1').html('<option value="">Select</option>');
                $.ajax({
                    url: "<?php echo base_url('customer/getState') ?>/"+id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                      for(i=0;i<data.length;i++){
                        $('#state1').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                      }
                    }
                  });
              });

            $('#state1').change(function(){
              var id = $(this).val();
             // alert(id);
              $('#city1').html('<option value="">Select</option>');
              $.ajax({
                  url: "<?php echo base_url('customer/getCity') ?>/"+id,
                  type: "GET",
                  dataType: "JSON",
                  success: function(data){
                    for(i=0;i<data.length;i++){
                      $('#city1').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                    }
                  }
                });
            });
     
      });
    </script>
    

<?php 
   $this->load->view('layout/footer');
   $this->load->view('layout/validation');
?>
