<?php 

  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("add_supplier",$user_session)){
      redirect('supplier','refresh');
  }
  
?>

<div class="content-wrapper">
  <section class="content">
    <div class="box-footer">
      <h4 class="box-title">
        <!-- Suppliers -->
        <?php echo $this->lang->line('supplier_heading');?>
      </h4>
    </div>
    <br>
    
    <div class="box">
      <div class="box-body">
       <h4 class="text-info text-center">Add New Supplier</h4>
          <form name="customerForm" class="form-horizontal row-border" method="POST" action="<?php echo base_url(); ?>supplier/add">  
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">

                    <div class="form-group">
                      <label class="col-sm-2 control-label require" for="inputEmail3">
                        <!-- Supplier Name -->
                        <?php echo $this->lang->line('supplier_heading');?>

                        <label style="color:red;">*</label></label>
                        <div class="col-sm-4">
                          <input type="text" placeholder="<?php echo $this->lang->line('supplier_heading');?>" class="form-control" id="name" name="name" tabindex="1" onblur='chkEmpty("customerForm","name","Please Enter Name");' >
                          <span style="color: red;"><?php echo form_error('name'); ?></span>
                          <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label require" for="inputEmail3">
                        <!-- Email -->
                        <?php echo $this->lang->line('lbl_email');?>
                        </label>
                        <div class="col-sm-4">
                          <input type="text" placeholder="<?php echo $this->lang->line('lbl_email');?>" class="form-control" id="email" name="email" tabindex="2">
                          <span style="color: red;"><?php echo form_error('email'); ?></span>
                          <span style="font-size:20px;"></span>
                           <h4 id="emailspan" style="font-size:16px;color:#990000"></h4>
                          <p style="color:#990000;"></p>
                        </div>
                    </div>
                
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="inputEmail3">
                        <!-- Phone -->
                        <?php echo $this->lang->line('lbl_phone');?>
                      </label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="<?php echo $this->lang->line('lbl_phone');?>" class="form-control" id="contact" name="contact" tabindex="3">
                           <span style="color: red;"><?php echo form_error('contact'); ?></span>
                           <span style="font-size:20px;"></span>
                            <h4 id="phonespan" style="font-size:16px;color:#990000"></h4>
                           <p id="c" style="color:#990000;"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label require" for="inputEmail3">
                        <!-- Street -->
                        <?php echo $this->lang->line('lbl_street');?>
                      </label>
                        <div class="col-sm-4">
                         <input type="text" placeholder="<?php echo $this->lang->line('lbl_street');?>" class="form-control" id="street" name="street" tabindex="4">
                         <span style="color: red;"><?php echo form_error('street'); ?></span>
                         <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="col-sm-2 control-label" for="inputEmail3">
                        <!-- Country -->
                        <?php echo $this->lang->line('lbl_country');?>
                      <label style="color:red;">*</label></label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="country"  name="country" tabindex="5">
                                 <option value="">
                                   <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                 </option><?php foreach ($country as $value) {?>
                                 <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option> <?php } ?>
                            </select>
                                 <span style="color: red;"><?php echo form_error('country'); ?></span>
                                 <span style="font-size:20px;"></span>
                            <p style="color:#990000;"></p>
                        </div>
                    </div>

                     <div class="form-group">
                      <label class="col-sm-2 control-label" for="inputEmail3">
                        <!-- State -->
                         <?php echo $this->lang->line('lbl_state');?>
                      <label style="color:red;">*</label></label>
                        <div class="col-sm-4">
                          <select class="form-control select2" id="state" name="state" tabindex="6">
                               <option value=""> <?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                            </select>
                          <span style="color: red;"><?php echo form_error('state'); ?></span>
                          <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="state_code">
                        State code
                        <!-- <?php echo $this->lang->line('lbl_zipcode');?> -->
                      </label>
                        <div class="col-sm-4">
                          <input type="text" placeholder="State code" class="form-control" id="state_code" name="state_code" tabindex="7" value="">
                          <span style="color: red;"><?php echo form_error('state_code'); ?></span>
                          <span style="font-size:20px;"></span>
                           <p style="color:#990000;"></p>
                          </div>
                    </div>


                    <div class="form-group">
                      <label class="col-sm-2 control-label require" for="city">
                        <!-- City -->
                        <?php echo $this->lang->line('lbl_city');?>
                      <label style="color:red;">*</label></label>
                        <div class="col-sm-4">
                          <select class="form-control select2" id="city" name="city" tabindex="8">
                              <option value=""> <?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                            </select>
                          <span style="color: red;"><?php echo form_error('city'); ?></span>
                          <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                      </div>
                    </div>

                   

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="zip_code">
                        <!-- Zipcode -->
                        <?php echo $this->lang->line('lbl_zipcode');?>
                      </label>
                        <div class="col-sm-4">
                          <input type="text" placeholder="<?php echo $this->lang->line('lbl_zipcode');?>" class="form-control" id="zip_code" name="zip_code" tabindex="9">
                          <span style="color: red;"><?php echo form_error('zip_code'); ?></span>
                          <span style="font-size:20px;"></span>
                           <p id="b" style="color:#990000;"></p>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="gstin">
                        <!-- GSTIN -->
                        <?php echo $this->lang->line('lbl_gstin');?>
                      </label>
                        <div class="col-sm-4">
                          <input type="text" placeholder="<?php echo $this->lang->line('lbl_gstin');?>" class="form-control" id="gstin" name="gstin" tabindex="10" maxlength="15">
                          <span style="font-size:20px;"></span>
                          <span style="color: #990000;"><?php echo form_error('gstin'); ?></span>
                          <label>ex : 22AAAAA0000A1Z5(15 digit)</label>
                          <p id="gstinno" style="color:#990000;"></p>
                          
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-sm-6">
                        <center>
                        <input name="customerSubmit" class="btn btn-info btn-flat" id="btnSubmit" type="submit" Value="<?php echo $this->lang->line('btn_submit');?>">                     
                        <a href="<?php echo base_url();?>supplier/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
                        </center>
                        </div>
                    </div>     

                  </div>
                </div>        
              </div>
          </form>
       </div>
     </div>
  </section>
</div>



<script type="text/javascript">

   $(document).ready(function(){

      /*var gstin_regex1 = /^[0-9]{2}[0-9A-Z]{10}[0-9]{1}[Z][0-9]{1}$/;
      var gst = $('#gstin').val();*/


     $('#btnSubmit').click(function(e) 
      {
            /*if(!$('#contact').val().match('[0-9]{10}'))  
            {   
              $("#phonespan").html("In valid mobile number");
              return false;  
            }  
            else
            {
              return true;
              
            }*/
      });


      $("input[name='customerSubmit']").click(function(e)
      {
          /*var a=chkEmpty("customerForm","branch","Please Enter Branch Name");*/
          var name = chkEmpty("customerForm","name","Please Enter Name");
          //var b=chkEmpty("customerForm","email","Please Enter Email");
          //var c=chkEmpty("customerForm","contact","Please Enter number");
          //var d=chkEmpty("customerForm","street","Please Enter street");
          var city = chkDrop("customerForm","city","Please Enter city");
          var state=chkDrop("customerForm","state","Please Enter state");
          //var g=chkEmpty("customerForm","zip_code","Please Enter Zip code");
          //var gstin=chkEmpty("customerForm","gstin","Please Enter GSTIN");
          var country=chkDrop("customerForm","country","Select Country");

          /*if (!gst.match(gstin_regex1) ) {
            $('#gstinno').text("Please Enter Valid GSTIN No.");   
            return false;
          }
          else
          {
            $("#gstinno").text("");
          }*/

          if(name + city + state + country < 1){
            customerForm.submit();
            return true;
          }
          else
          {
            return false;
          }
          
      });

      /*$("#gstin").on("blur keyup",  function (event){
          var gstin_regex = /^[0-9]{2}[0-9A-Z]{10}[0-9]{1}[Z][0-9]{1}$/;
          
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


      $('#country').change(function(){
          var id = $(this).val();
        //alert(id);
          $('#state').html('<option value="">Select</option>');
          $('#city').html('<option value="">Select</option>');
          $.ajax({
              url: "<?php echo base_url('supplier/getState') ?>/"+id,
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
          url: "<?php echo base_url('supplier/getCity') ?>/"+id,
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
      return false;  
    }
} */
</script>

<script type="text/javascript">
  $(document).ready(function()
  {

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

    jQuery('#zip_code').keyup(function (){
      this.value = this.value.replace(/[^0-9 ]/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only Numbers.'); return ''; });
      if($(this).val().length > 6)
      {
        $("#b").html("Not allowed more than 6 characters");
        $(this).val($(this).val().substring(0, 6));
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
        else if($(this).val().length < 10)
        {
          $("#c").html("phone no. should have only 10 digits");
          $(this).val($(this).val().substring(0, 10));
        }
   });*/

});
</script>

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>
