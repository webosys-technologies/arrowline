<?php 
  $this->load->view('layout/header');
?>
<?php
foreach ($unit as $row) {
  # code...
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
                    <!-- Update Units -->
                   <?php echo $this->lang->line('lbl_unit_header');?>
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
              <form action="<?php echo base_url();?>/unit/edit" method="post" id="editUnit" class="form-horizontal">
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
           <input type="hidden" name="unit_id" id="unit_id" value="<?php echo $row->id;?>">
          <div class="form-group">
            <label class="col-sm-2 control-label require" for="inputEmail3">
                <!-- Unit Name -->
                  <?php echo $this->lang->line('lbl_unit_name');?>    
            </label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="unit_name" name="name" value="<?php echo $row->unit_name;?>">
              <span id="val_name" style="color: red"></span>
               <p style="color:#990000;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label require" for="inputEmail3">
              <!-- Abbrivation -->
              <?php echo $this->lang->line('lbl_unit_abbr');?>
            </label>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="unit_abbr" name="abbr" value="<?php echo $row->abbr;?>">
              <span id="val_ab" style="color: red"></span>
               <p style="color:#990000;"></p>
            </div>
          </div>
         
          
                    <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
            
              <input type="submit" class="btn btn-info btn-flat" value="<?php echo $this->lang->line('btn_submit');?>" name="unitSubmit">
              <a href="<?php echo base_url();?>unit" class="btn btn-default btn-flat" data-dismiss="modal">
                  <!-- Close -->
                  <?php echo $this->lang->line('btn_modal_close');?>      
              </a>
              
            
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
<div id="add-unit" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add New</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>/unit/add" method="post" id="addUnit" class="form-horizontal">
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Unit Name</label>
            
            <div class="col-sm-6">
              <input type="text" placeholder="Name" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">

              <span id="val_name" style="color: red"><?php echo form_error('name');?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Abbr</label>

            <div class="col-sm-6">
                <input type="text" placeholder="Abbr" class="form-control" id="abbr" name="abbr" value="<?php echo set_value('abbr'); ?>">
              <span id="val_ab" style="color:red"><?php echo form_error('abbr');?></span>
            </div>
          </div>

          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <center>
              <input type="submit" class="btn btn-info btn-flat" value="Submit" name="unitSubmit">

              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<div id="edit-unit" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Update unit</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>/unit/edit" method="post" id="editUnit" class="form-horizontal" name="unitForm">      
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Unit Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="unit_name" name="name" value="<?php echo $row->unit_name;?>">
              <span id="val_name" style="color: red"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Abbr</label>

            <div class="col-sm-6">
                <input type="text" class="form-control" id="unit_abbr" name="abbr" value="<?php echo $row->abbr;?>">
              <span id="val_ab" style="color: red"></span>
            </div>
          </div>
          <input type="hidden" name="id" id="unit_id" value="<?php echo $row->id;?>">
          
                    <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <center>
              <input type="submit" class="btn btn-info btn-flat" value="Submit" name="unitSubmit">

              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              </center>
            </div>
          </div>
          
        </form>
      </div>
    </div>

  </div>
</div>
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
       $("input[name='unitSubmit']").click(function(e){
           
           var b=chkEmpty("unitForm","name","Please Enter Unit Name");
           var c=chkEmpty("unitForm","abbr","Please Enter Abberivation"); 

           if((b+c) < 1){
             unitForm.submit();
             return true;
           }else{
             return false;
           }
           
         });      
   });
</script>
<script type="text/javascript">
  $('#unit_name').keyup(function() 
    {
      $('span.error-keyup-2').remove();
      var inputVal = $(this).val();
      var characterReg = /\s[a-zA-Z,\s]\s*$/;
      if(!characterReg.test(inputVal)) 
      {
          $(this).after('<span class="error error-keyup-2 text-danger">Only characters allowed.</span>');
      } 
  });
      $("#unit_name").keypress(function(e) {
     if (!/[a-zA-Z\b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
   });
</script>
<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 