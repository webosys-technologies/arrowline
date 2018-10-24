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
                    <?php echo $this->lang->line('lbl_edit_tax_header');?>
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
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('tax/editTax');?>">
                  <?php foreach($data as $row){?>

                    <div class="form-group">
                      <label for="frequency">Tax Type</label>
                      <select class="form-control select2" id="tax_type" name="tax_type" style="width: 100%;">
                        <option value="1" <?php if($row->tax_type==1){echo "selected";}?>>GST</option>
                        <option value="2" <?php if($row->tax_type==2){echo "selected";}?>>Non-GST Supplies</option>
                        <option value="3" <?php if($row->tax_type==3){echo "selected";}?>>Nil Rated</option>
                        <option value="4" <?php if($row->tax_type==4){echo "selected";}?>>Exempted</option>
                      </select>
                      <span class="validation-color" id="err_frequency" style="color: #990000;"><?php echo form_error('frequency'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="tax_name">Tax Name <span class="validation-color" style="color: #990000;">*</span></label>
                      <input type="text" class="form-control" id="tax_name" name="tax_name" value="<?php echo $row->tax_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->tax_id;?>">
                      <span class="validation-color" id="err_tax_name" style="color: #990000;"><?php echo form_error('tax_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="start_from">Start From <span class="validation-color" style="color: #990000;">*</span></label>
                      <input type="text" class="form-control datepicker" id="datepicker" name="start_from" value="<?php echo $row->start_from; ?>">
                      <span class="validation-color" id="err_start_from" style="color: #990000;"><?php echo form_error('start_from'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="registration_number">Registration Number</label>
                      <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo $row->registration_number; ?>">
                      <span class="validation-color" id="err_registration_number" style="color: #990000;"><?php echo form_error('registration_number'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="frequency">Filling Frequency <span class="validation-color" style="color: #990000;">*</span></label>
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
                      <textarea class="form-control" id="description" name="description"><?php echo $row->description; ?></textarea>
                      <span class="validation-color" id="err_registration_number"><?php echo form_error('registration_number'); ?></span>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="frequency">Tax applies to <span class="validation-color" style="color: #990000;">*</span></label>
                    <ul type="none">
                      <li><input type="checkbox" name="sales" id="sales" <?php if($row->tax_value != 0){ echo "checked"; } ?>> Sales</li>
                      <li><input type="checkbox" name="purchase" id="purchase" <?php if($row->purchase_tax_value != 0){ echo "checked"; } ?>> Purchase</li>
                    </ul>
                    <span class="validation-color" id="err_frequency"><?php echo form_error('frequency'); ?></span>
                  </div>
                  <div class="form-group calculate_on">
                    <label for="calculate_on">Calculate On<span class="validation-color" style="color: #990000;">*</span></label>
                    <div class="input-group">
                      <input class="form-control text-right" type="text" id="calculate_on" name="calculate_on" value="<?php echo $row->calculate_on; ?>" placeholder="100">
                      <span class="input-group-addon">%</span>
                    </div>
                    <span class="validation-color" id="err_calculate_on" style="color: #990000;"><?php echo form_error('calculate_on'); ?></span>
                  </div>
                  
                  <div class="form-group sales">
                    <label for="tax_value">Sales Tax Rate <span class="validation-color" style="color: #990000;">*</span></label>
                    <div class="input-group">
                      <input type="text" class="form-control text-right" id="tax_value" name="tax_value" value="<?php echo $row->tax_value; ?>">
                      <span class="input-group-addon">%</span>
                    </div>
                    <span class="validation-color" id="err_tax_value" style="color: #990000;"><?php echo form_error('tax_value'); ?></span>
                  </div>
                  
                  <div class="form-group purchase">
                    <label for="purchase_tax_value">Purchase Tax Rate <span class="validation-color" style="color: #990000;">*</span></label>
                    <div class="input-group">
                      <input type="text" class="form-control text-right" id="purchase_tax_value" name="purchase_tax_value" value="<?php echo $row->purchase_tax_value; ?>">
                      <span class="input-group-addon">%</span>
                    </div>
                    <span class="validation-color" id="err_purchase_tax_value" style="color: #990000;"><?php echo form_error('purchase_tax_value'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <center>
                      <button type="submit" id="submit" class="btn btn-info btn-flat">Update</button>
                      <a href="<?php echo base_url()?>tax/" class="btn btn-default btn-flat">Cancel</a>
                      <!-- <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('tax')">Cancel</span> -->
                    </center>
                  </div>
                </div>
                   <?php } ?>
                </form>
              </div>
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

<?php
  if($data[0]->tax_value == 0){ 
?>
  <script>
    $('.sales').hide();
  </script>
<?php
  }
  if($data[0]->purchase_tax_value == 0){ 
?>
  <script>
    $('.purchase').hide();
  </script>
<?php
  }
?>


<?php 
  $this->load->view('layout/footer');
?> 

<script>
  $(document).ready(function(){
    $("#submit").click(function(event){
      var name_regex = /^[a-zA-Z0-9\s@%]+$/;
      //var tax_regex = /^\$?[0-9]*([0-9]+)?$/;
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

    $("#tax_name").blur(function(event){
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

    /*$("#tax_value").blur(function(event){
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