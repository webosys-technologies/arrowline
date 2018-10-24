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
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">
                  <!-- Create Location -->
                  <?php echo $this->lang->line('add_location_header');?> 
              </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo base_url();?>location/add" method="post" id="myform1" class="form-horizontal" name="locationForm">
            
                <div class="form-group">
                  <label class="col-sm-2 control-label require" for="inputEmail3">        <!-- Location Name -->
                      <?php echo $this->lang->line('lbl_warehouse_name');?>
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Location Name" class="form-control valdation_check" id="name" name="location_name">
                    <span style="color: #990000"></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label require" for="inputEmail3">
                      <!-- Location Code -->
                      <?php echo $this->lang->line('lbl_warehouse_code');?>
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Location Code" class="form-control valdation_check" id="loc_code" name="loc_code">
                    <span  style="color:#990000"></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label require" for="inputEmail3">        <!-- Delivery Address -->
                      <?php echo $this->lang->line('lbl_location_address');?>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Delivery Address" id="address" class="form-control valdation_check" name="delivery_address">
                    <span  style="color: #990000"></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">
                      <!-- Phone Number -->
                      <?php echo $this->lang->line('add_location_phonenumber');?>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Phone One" class="form-control" name="phone" id="phone">
                    <span  style="color: #990000"></span>
                    <p id="no" style="color:#990000;"></p>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">
                    <!-- Fax -->
                    <?php echo $this->lang->line('add_location_fax');?>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Fax" class="form-control" name="fax" id="fax">
                    <span  style="color:#990000"></span>
                    <p style="color:#990000;"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">
                      <!-- Email -->
                      <?php echo $this->lang->line('add_location_email');?>
                        <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Email" class="form-control" name="email" id="email">
                    <h4 id="emailid" style="color:#990000"></h4>
                    <p style="color:#990000;"></p>

                  </div>
                </div>
              
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="inputEmail3">
                      Contact Person
                      <!-- <?php echo $this->lang->line('add_location_contact');?> -->
                    <span class="text-danger">*</span>
                  </label>

                  <div class="col-sm-4">
                    <input type="text" placeholder="Contact" class="form-control" name="contact" id="contact">
                    <span  style="color:#990000"></span>
                    <p id="con" style="color:#990000;"></p>
                  </div>
                </div>
              
              <!-- /.box-body -->
              <div class="box-footer">
              
                <input class="btn btn-info btn-flat" type="submit" name="btnSubmit" value="<?php echo $this->lang->line('btn_submit');?>" onclick="return ValidateEmail(document.locationForm.email);" id="btn">

                <a href="<?php echo base_url();?>location" class="btn btn-default btn-flat"><!-- Cancel --><?php echo $this->lang->line('btn_cancel');?></a>
                
                
              </div>
              <!-- /.box-footer -->
            </form>
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
        <h4 class="modal-title">Delete Parmanently</h4>
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
<script type="text/javascript">
    $(document).ready(function(){
      
       $("input[name='btnSubmit']").click(function(e){
          
           var b=chkEmpty("locationForm","location_name","Please Enter Location name");
           var g=chkEmpty("locationForm","delivery_address","Please Enter Delivery Address");
           
         
           if((b+g) < 1){
             locationForm.submit();
             return true;
           }else{
             return false;
           }
           
         });
});    
</script>

<?php 
   $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 