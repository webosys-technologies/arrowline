<?php 
  $this->load->view('layout/header');
?> 
<div class="content-wrapper">
    <div id="notifications" class="row no-print">
      <div class="col-md-12">
                  
      </div>
    </div>
    <section class="content">
      <div class="row">
  
        <!-- /.col -->
        <div class="col-md-12">

          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                 <div class="top-bar-title padding-bottom">
                    <!-- Update Tax -->
                    <?php echo $this->lang->line('lbl_add_tax_header');?>
                  </div>
                </div> 
                <div class="col-md-3">
                          <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#add-unit" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span>Add New Unit</a> -->
                    </div>
              </div>
            </div>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" id="form" method="post" action="<?php echo base_url('tax/addTax');?>">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="frequency">Tax Type</label>
                      <select class="form-control select2" id="tax_type" name="tax_type" style="width: 100%;">
                        <option value="1">GST</option>
                        <option value="2">Non-GST Supplies</option>
                        <option value="3">Nil Rated</option>
                        <option value="4">Exempted</option>
                      </select>
                      <span class="validation-color" id="err_frequency" style="color: #990000;"><?php echo form_error('frequency'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="tax_name">Tax Name <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="tax_name" name="tax_name" value="<?php echo set_value('tax_name'); ?>">
                      <span class="validation-color" id="err_tax_name" style="color: #990000;"><?php echo form_error('tax_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="start_from">Start From <span class="validation-color">*</span></label>
                      <input type="text" class="form-control datepicker" id="datepicker" name="start_from" value="<?php echo set_value('start_from'); ?>">
                      <span class="validation-color" id="err_start_from" style="color: #990000;"><?php echo form_error('start_from'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="registration_number">Registration Number</label>
                      <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo set_value('registration_number'); ?>">
                      <span class="validation-color" id="err_registration_number" style="color: #990000;"><?php echo form_error('registration_number'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="frequency">Filling Frequency <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="frequency" name="frequency" style="width: 100%;">
                        <option value="Monthly">Monthly</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Half-Yearly">Half-Yearly</option>
                        <option value="Yearly">Yearly</option>
                      </select>
                      <span class="validation-color" id="err_frequency" style="color: #990000;"><?php echo form_error('frequency'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name="description"><?php echo set_value('description'); ?></textarea>
                      <span class="validation-color" id="err_registration_number" style="color: #990000;"><?php echo form_error('registration_number'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="frequency">Tax applies to <span class="validation-color">*</span></label>
                      <ul type="none">
                        <li><input type="checkbox" name="sales" id="sales" checked> Sales</li>
                        <li><input type="checkbox" name="purchase" id="purchase" > Purchase</li>
                      </ul>
                      <span class="validation-color" id="err_frequency" style="color: #990000;"><?php echo form_error('frequency'); ?></span>
                    </div>
                    <div class="form-group calculate_on">
                      <label for="calculate_on">Calculate On<span class="validation-color">*</span></label>
                      <div class="input-group">
                        <input class="form-control text-right" type="text" id="calculate_on" name="calculate_on" value="<?php echo set_value('calculate_on'); ?>" placeholder="100">
                        <span class="input-group-addon" style="font-weight: bold;">%</span>
                      </div>
                      <span style="font-size: 12px;">Calculate on n% of base price.</span>
                      <span class="validation-color" id="err_calculate_on"><?php echo form_error('calculate_on'); ?></span>
                    </div>
                    <div class="form-group sales">
                      <label for="tax_value">Sales Tax Rate <span class="validation-color">*</span></label>
                      <div class="input-group">
                        <input type="text" class="form-control text-right" id="tax_value" name="tax_value" value="<?php echo set_value('tax_value'); ?>">
                        <span class="input-group-addon" style="font-weight: bold;">%</span>
                      </div>
                      <span class="validation-color" id="err_tax_value" style="color: #990000;"><?php echo form_error('tax_value'); ?></span>
                    </div>
                    <div class="form-group purchase">
                      <label for="purchase_tax_value">Purchase Tax Rate <span class="validation-color">*</span></label>
                      <div class="input-group">
                        <input type="text" class="form-control text-right" id="purchase_tax_value" name="purchase_tax_value" value="<?php echo set_value('purchase_tax_value'); ?>">
                        <span class="input-group-addon">%</span>
                      </div>
                      <span class="validation-color" id="err_purchase_tax_value" style="color: #990000;"><?php echo form_error('purchase_tax_value'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="box-footer">
                      <center>
                        <button type="submit" id="submit" class="btn btn-info btn-flat">Add</button>
                        <a href="<?php echo base_url()?>tax/" class="btn btn-default btn-flat">Cancel</a>
                        <!-- <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('tax')">Cancel</span> -->
                      </center>
                    </div>
                  </div>
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

    <!-- /.content -->
</div>

<script>
  $('.purchase').hide();
</script>

<?php 
  $this->load->view('layout/footer');
?> 

<script>
  $(document).ready(function(){
    $("#submit").click(function(event){
      var name_regex = /^[a-zA-Z0-9\s@%]+$/;
      var tax_regex = /^\$?[0-9]*([0-9]+)?$/;
      var tax_name = $('#tax_name').val();
      var tax_value = $('#tax_value').val();
        if(tax_name==null || tax_name==""){
          $("#err_tax_name").text("Please Enter Tax Name.");
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }
        if (!tax_name.match(name_regex) ) {
          $('#err_tax_name').text(" Please Enter Valid Tax Name");   
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }

//tax name validation complite.        
        if(tax_value==null || tax_value==""){
          $("#err_tax_value").text("Please Enter Tax Value.");
          return false;
        }
        else{
          $("#err_tax_value").text("");
        }
        /*if (!tax_value.match(tax_regex) ) {
          $('#err_tax_value').text(" Please Enter Valid Tax value (ex : 10.100) ");   
          return false;
        }
        else{
          $("#err_tax_value").text("");
        }*/
//tax value validation complite.

        
    });

    $("#tax_name").on("blur keyup",  function (event){
        var name_regex = /^[a-zA-Z0-9\s@%]+$/;
        var tax_name = $('#tax_name').val();
        if(tax_name==null || tax_name==""){
          $("#err_tax_name").text("Please Enter Tax Name.");
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }
        if (!tax_name.match(name_regex) ) {
          $('#err_tax_name').text(" Please Enter Valid Tax Name");   
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }
        //event.preventDefault();
    });

    /*$("#tax_value").on("blur keyup",  function (event){
       var tax_value = $('#tax_value').val();
       var tax_regex = /^\$?[0-9]*([0-9]+)?$/;
        if(tax_value==null || tax_value==""){
          $("#err_tax_value").text("Please Enter Tax Value.");
          return false;
        }
        else{
          $("#err_tax_value").text("");
        }
        if (!tax_value.match(tax_regex) ) {
          $('#err_tax_value').text(" Please Enter Valid Tax value (ex : 10.100) ");   
          return false;
        }
        else{
          $("#err_tax_value").text("");
        }
    });*/
    
    $("#sales").on("change",  function (event){
      if($('#sales').is(":checked")){  
        $(".sales").show();
        $(".calculate_on").show();
      }
      else{
        $(".sales").hide();
        if($('#sales').is(":checked") && $('#sales').is(":checked")){  
          $(".calculate_on").show();
        }
        else{
          $(".calculate_on").hide();
        }
      }
      
    });
    $("#purchase").on("change",  function (event){
      if($('#purchase').is(":checked")){  
        $(".purchase").show();
        $(".calculate_on").show();
      }
      else{
        $(".purchase").hide();
        if($('#purchase').is(":checked") && $('#sales').is(":checked")){  
          $(".calculate_on").show();
        }
        else{
          $(".calculate_on").hide();
        }
      }
      
    });
}); 
</script>

<style type="text/css">
  .validation-color
  {
    color: #FF0000;
  }
</style>