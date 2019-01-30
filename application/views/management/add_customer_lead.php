<?php 
  $this->load->view('layout/header');
  $user = $this->session->userdata('userRole');

  if(empty($user))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("add_customer",$user)){
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
      <?php echo validation_errors();?>
      <form name="customerForm" class="form-horizontal row-border" method="POST" action="<?php echo base_url(); ?>Management/add" id="customerForm">     
      
        <div class="box-footer">
          <div class="box-body" style="padding: 20px">
              <div class="row">
                 <div class="col-md-12">
                    <div class="col-md-6">
                      <h4 class="text-primary text-center">
                        <!-- Customer Information -->
                        <?php echo $this->lang->line('lbl_cust_info');?>
                      </h4>
                      <?php echo validation_errors();?>
                      <div class="form-group">
                          <label class="col-sm-4 control-label require" for="name">
                          <!-- Name -->
                          <?php echo $this->lang->line('lbl_name');?>
                          <label style="color:red;">*</label></label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" id="name" name="name" tabindex="1" onblur='chkEmpty("customerForm","name","Please Enter Name");' >
                                 <span style="color: red;"><?php echo form_error('name'); ?></span>
                                 <span style="font-size:20px;"></span>
                                  <p id="alphaname" style="color:#990000;"></p>
                                 
                             </div>
                      </div>
         
                      <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                          <!-- Email -->
                            <?php echo $this->lang->line('lbl_email');?>
                          </label>
                            <div class="col-sm-8">
                                <input type="email" value="" class="form-control" id="email" name="email" tabindex="2">
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                 <h4 id="emailspan" style="font-size:15px;color:#990000"></h4>
                                <p id="a" style="color:#990000;"></p>
                            </div>
                      </div>

                      <div class="form-group">
                           <label class="col-sm-4 control-label" for="contact">
                           <!-- Phone -->
                            <?php echo $this->lang->line('lbl_phone');?>
                           <label style="color:red;">*</label></label>
                             <div class="col-sm-8">
                                 <input type="text" value="" class="form-control" id="contact" name="phone" tabindex="3" onblur='chkEmpty("customerForm","phone","Please Enter Phone");'>
                                 <span style="color: red;"><?php echo form_error('phone'); ?></span>
                                 <span style="font-size:20px;"></span>
                                  <h4 id="phonespan" style="font-size:15px;color:#990000"></h4>
                                 <p id="c" style="color:#990000;"></p>
                            </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label require" for="inputEmail3">Street</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="street" name="street" tabindex="4">
                                <span style="color: red;"></span>
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
                                <select class="form-control select2" id="country"  name="country" tabindex="5">
                                   <option value="">
                                    <?php echo $this->lang->line('lbl_dropdown_customer');?>  
                                    </option>

                                    <?php 
                                      if(isset($country)){
                                        foreach ($country as $value) {?>
                                          <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option> 
                                      <?php }} ?>
                                </select>
                                   <span style="color: red;"><?php echo form_error('country'); ?></span>
                                   <span style="font-size:20px;"></span>
                              <p style="color:#990000;"></p>
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="col-sm-4 control-label" for="inputEmail3"><!-- State -->
                          <?php echo $this->lang->line('lbl_state');?>  
                         </label>
                          <div class="col-sm-8">
                            <select class="form-control select2" id="state" name="state" tabindex="6">
                                 <option value="">
                                 <!-- Select One -->
                                 <?php echo $this->lang->line('lbl_dropdown_customer');?> 
                                 </option>
                              </select>
                            <span style="color: red;"><?php echo form_error('state'); ?></span>
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
                                <input type="text" placeholder="State code" class="form-control" id="state_code" name="state_code" tabindex="7" value="">
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                 <p style="color:#990000;"></p>
                                </div>
                          </div>


                         <div class="form-group">
                          <label class="col-sm-4 control-label require" for="inputEmail3">
                          <!-- City -->
                            <?php echo $this->lang->line('lbl_city');?>  
                          </label>
                            <div class="col-sm-8">
                              <select class="form-control select2" id="city" name="city" tabindex="8">
                                <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                              </select>
                                <span style="color: red;"><?php echo form_error('city'); ?></span>
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
                                <input type="text" class="form-control" id="zip_code" name="zip_code" tabindex="9">
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
                                  <input type="text" class="form-control" id="gstin" name="gstin" tabindex="10" maxlength="15">
                                  <span style="font-size:20px;"></span>
                                  <label>ex : 22AAAAA0000A1Z5(15 digit)</label>
                                  <span style="color: red;"></span>
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
                                  <option>Registered</option>
                                  <option>Unregistered</option>
                                  <option>Composition Scheme</option>
                                  <option>Input Service Distributor</option>
                                  <option>E-Commerece Operator</option>
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
                          <!--<button id="copy" class="btn btn-default btn-xs" type="button">Copy Address</button>--></h4>
                            <div class="form-group">
                              <label class="col-sm-4 control-label" for="inputEmail3">
                                <!-- Street -->
                                <?php echo $this->lang->line('lbl_street');?>
                              </label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="street1" name="street1" tabindex="11">
                                  <span style="color: red;"></span>
                                  <span style="font-size:20px;"></span>
                                  <p style="color:#990000;"></p>
                                </div>
                            </div>
                       
                            <div class="form-group">
                              <label class="col-sm-4 control-label" for="inputEmail3">
                                <!-- Country -->
                                <?php echo $this->lang->line('lbl_country');?>
                              </label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="country1"  name="country1" tabindex="12">
                                       <option value="">
                                        <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                         
                                       </option>
                                        <?php 
                                          if($country){
                                          foreach ($country as $value) {?>
                                            <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option> 
                                          <?php }} ?>
                                    </select>
                                    <span style="color: red;"></span>
                                    <span style="font-size:20px;"></span>
                                  <p style="color:#990000;"></p>
                              </div>
                            </div>

                            <div class="form-group">
                             <label class="col-sm-4 control-label" for="inputEmail3">
                             <!-- State -->
                              <?php echo $this->lang->line('lbl_state');?>
                             </label>
                              <div class="col-sm-8">
                                <select class="form-control select2" id="state1" name="state1" tabindex="13">
                                    <option value="">
                                      <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                    </option>
                                  </select>
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                <p style="color:#990000;"></p>
                              </div>
                             </div>

                             <div class="form-group">
                              <label class="col-sm-4 control-label require" for="inputEmail3">
                              <!-- City -->
                                <?php echo $this->lang->line('lbl_city');?>
                              </label>
                                <div class="col-sm-8">
                                  <select class="form-control select2" id="city1" name="city1" tabindex="14">
                                    <option value="">
                                      <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                    </option>
                                  </select>
                                    <span style="color: red;"></span>
                                    <span style="font-size:20px;"></span>
                                    <p style="color:#990000;"></p>
                                </div>
                            </div>
                                
                      
                            <div class="form-group">
                               <label class="col-sm-4 control-label" for="inputEmail3">
                                <!-- Zip code -->
                                <?php echo $this->lang->line('lbl_zipcode');?>
                                </label>
                                  <div class="col-sm-8">
                                      <input type="text" class="form-control" id="zip_code1" name="zip_code1" tabindex="15">
                                      <span style="color: red;"></span>
                                      <span style="font-size:20px;"></span>
                                      <p id="z" style="color:#990000;"></p>
                                  </div>
                            </div>
                            
                          <h4 class="text-primary text-center">
                          <!-- Shipping Address  -->
                          <?php echo "Lead";?>
                          <!--<button id="copy" class="btn btn-default btn-xs" type="button">Copy Address</button>--></h4>   
                        <div class="form-group">
                        <label class="col-sm-4 control-label require" for="followup">Follow Up</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="followup" name="followup">
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                <p style="color:#990000;"></p>
                            </div>
                        </div>
                         <div class="form-group">
                        <label class="col-sm-4 control-label require" for="nextfollow">Next Follow</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="nextfollow" name="nextfollow" tabindex="4">
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                <p style="color:#990000;"></p>
                            </div>
                        </div>
                         <div class="form-group">
                        <label class="col-sm-4 control-label require" for="nextfollow">Remark</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="remark" name="remark" tabindex="4">
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                <p style="color:#990000;"></p>
                            </div>
                        </div>
                            <?php
                            if(isset($status))
                            {
                            ?>
                             <div class="form-group">
                        <label class="col-sm-4 control-label require" for="nextfollow">Status</label>
                            <div class="col-sm-8">
                                <select class="form-control selcet2" id="status" name="status">
                                   <?php
                                   foreach($status as $stat)
                                   {
                                       if($stat->is_deleted!=1)
                                       {
                                   ?>
                                    <option value="<?php echo $stat->name;?>"><?php echo ucfirst($stat->name);?></option>
                                    <?php
                                   }
                                   }
                                    ?>
                                    </select>
                               
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                <p style="color:#990000;"></p>
                            </div>
                        </div>
                            <?php
                            } ?>
<!--                         <div class="form-group">
                        <label class="col-sm-4 control-label require" for="nextfollow">Telecaller</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telecaller" name="telecaller" tabindex="4">
                                <span style="color: red;"></span>
                                <span style="font-size:20px;"></span>
                                <p style="color:#990000;"></p>
                            </div>
                        </div>-->
                      </div>
                  </div>
              </div>
              
               <div class="box-footer">
                <center>
                    <input type="submit" class="btn btn-info btn-flat" id="btn" name="customerSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                    <a href="<?php echo base_url();?>customer/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
                </center>
               </div>
      </form>
          </div>
        </div>
      </div>   
   </section>    

  <script type="text/javascript">
    $(document).ready(function(){
        
        
        $("input[name='customerSubmit']").click(function(e){
          /*var gstin_regex1 = /^[0-9]{2}[0-9A-Z]{10}[0-9]{1}[Z][0-9]{1}$/;
          var gst1 = $('#gstin').val();  

          if (!gst1.match(gstin_regex1) ) {
            $('#gstinno').text("Please Enter Valid GSTIN No.");   
            return false;
          }
          else
          {
            $("#gstinno").text("");
          }*/


            
            var name=chkEmpty("customerForm","name","Please Enter Name");
            var phone=chkEmpty("customerForm","phone","Please Enter number");

            /*var d=chkEmpty("customerForm","street","Please Enter street");
            var e=chkDrop("customerForm","city","Please Enter city");
            var f=chkDrop("customerForm","state","Please Enter state");
            var g=chkEmpty("customerForm","zip_code","Please Enter Zipcode");
            var h=chkDrop("customerForm","country","Select Country");
            var i=chkEmpty("customerForm","street1","Please Enter street");
            var j=chkDrop("customerForm","city1","Please Enter city");
            var k=chkDrop("customerForm","state1","Please Enter state");
            var l=chkEmpty("customerForm","zip_code1","Please Enter Zip code");
            var m=chkDrop("customerForm","country1","Select Country");
            var gst=chkEmpty("customerForm","gstin","Please Enter GSTIN");*/

            

            if(name + phone < 1)
            {
              customerForm.submit();
              return true;
            }
            else
            {
              return false;
            }

         });  

         $('#country').change(function(){
          var id = $(this).val();
       // alert(id);
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
        //alert(id);
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

<script type="text/javascript">
/*function ValidateEmail(input)   
{  
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(customerForm.email.value))  
    {  
      return true;  
    }  
    else
    {
      //var validemail = "<?php echo $this->lang->line('lbl_error_customeremail');?>";
      $("#emailspan").text("Enter Valid Email Address");
      return false;  
    }
}*/ 


</script>

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

    jQuery('#street').keyup(function (){
      this.value = this.value.replace(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/g, function(str) { 
      ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
       if($(this).val().length > 100)
       {
         $(this).val($(this).val().substring(0, 100));
       }
    });


    jQuery('#contact').keyup(function () {
     this.value = this.value.replace(/[^0-9]/g, function(str) { 
      ('You typed " ' + str + ' ".\n\nPlease use only Numbers.'); return ''; });
      if($(this).val().length > 10)
      {
       $("#c").html("phone no. should have only 10 digits");
       $(this).val($(this).val().substring(0, 10));
      }
      else  if($(this).val().length < 10)
      {
       $("#c").html("In valid phone number");
       $(this).val($(this).val().substring(0, 10));
      }
    });

    jQuery('#zip_code').keyup(function (){
      this.value = this.value.replace(/[^0-9 ]/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only Numbers.'); return ''; });
      if($(this).val().length > 6)
      {
        $("#b").html("Not allowed more than 6 characters");
        $(this).val($(this).val().substring(0, 6));
      }
    });

    jQuery('#zip_code').keyup(function (){
      this.value = this.value.replace(/[^0-9 ]/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only Numbers.'); return ''; });
      if($(this).val().length > 6)
      {
        $("#z").html("Not allowed more than 6 characters");
        $(this).val($(this).val().substring(0, 6));
      }
    });

    jQuery('#street1').keyup(function (){
      this.value = this.value.replace(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/g, function(str) { 
      ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
       if($(this).val().length > 100)
       {
         $(this).val($(this).val().substring(0, 100));
       }
    });

    $("#gstin").on("blur keyup",  function (event){
        var gstin_regex = /^[0-9]{2}[0-9A-Z]{10}[0-9]{1}[Z][0-9]{1}/;
        
        var gstin_no = $('#gstin').val();
        if(gstin_no==null || gstin_no==""){
          $("#gstinno").text("Please Enter GSTIN Number.");
          return false;
        }
        else{
          $("#gstinno").text("");
        }
        if (!gstin_no.match(gstin_regex) ) {
          $('#gstinno').text(" Please Enter Valid GSTIN Number. ");   
          return false;
        }
        else{
          $("#gstinno").text("");
        }
    });*/


});
</script>

<script type="text/javascript">

$(document).ready(function(){ 
 
   /*$('#btn').click(function(e) 
   {
        if(!$('#contact').val().match('[0-9]{10}'))  {
           
            $("#phonespan").html("In valid mobile number");
            return true;
        }  
        else
        {
          return false;
        }

    });*/
});
</script>


<?php 
  $this->load->view('layout/footer');
   $this->load->view('layout/validation');
?>
















