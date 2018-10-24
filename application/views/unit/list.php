<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_unit",$user_session)){
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
        <div class="col-md-12">
          <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>Alert!</h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
       <?php } ?>
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                 <div class="top-bar-title padding-bottom">
                    <!-- Units -->
                    <?php echo $this->lang->line('lbl_unit_header');?>
                  </div>
                </div> 
                <div class="col-md-2">

                  <?php if(isset($user_session)){
                    if(in_array("add_unit",$user_session)){
                  ?>

                          <a href="javascript:void(0)" data-toggle="modal" data-target="#add-unit" class="btn btn-block btn-primary btn-flat"><span class="fa fa-plus"> &nbsp;</span>
                            <!-- Add New Unit -->
                            <?php echo $this->lang->line('btn_unit_newunit');?>
                          </a>

                  <?php }} ?>
                    </div>
              </div>
            </div>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Unit Name -->
                      <?php echo $this->lang->line('lbl_unit_name');?>
                  </th>
                  <th>
                    <!-- Abbrivation -->
                      <?php echo $this->lang->line('lbl_unit_abbr');?>
                  </th>
                  <th width="5%">
                    <!-- Action -->
                      <?php echo $this->lang->line('lbl_unit_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($unit as $row):?>
                  <tr>
                          
                          <td><?php echo $row->unit_name;?></td>
                          <td><?php echo $row->abbr;?></td>
                           <td>
                              <?php if(isset($user_session)){
                                if(in_array("edit_unit",$user_session)){
                              ?>
                              <a title="Edit" href="<?php echo base_url();?>unit/update/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-edit"></span></a> &nbsp;
                              <?php }} ?>


                              <?php if(isset($user_session)){
                                if(in_array("delete_unit",$user_session)){
                              ?>
                              <a title="Delete" href="#<?php echo $row->id;?>" class="btn btn-xs btn-danger edit-unit" data-toggle="modal" data-target="" data-tt="tooltip"><span class="fa fa-remove"></span></a> &nbsp;
                              <?php }} ?>
                              
                            <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                        <!-- !!  Delete Units !! -->
                                        <?php echo $this->lang->line('lbl_unit_delete_modal');?>
                                        </h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b><!-- Are you sure to delete this Record !! --><?php echo $this->lang->line('lbl_cust_delete_modal');?>&hellip;</b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                      <a href="<?php echo base_url();?>/unit/delete/<?php echo $row->id;?>" class="btn btn-danger" ><!-- Delete -->
                                        <?php echo $this->lang->line('btn_modal_delete');?>
                                      </a>
                                    
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                          </div>
                          <!-- /.example-modal -->
               
                          </td>      
                  </tr>

                <?php endforeach;?>
                               
                  </tbody>
              </table>
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
        <h4 class="modal-title">
          <!-- Add New -->
          <?php echo $this->lang->line('lbl_add_unit');?>
        </h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>/unit/add" method="post" id="addUnit" class="form-horizontal" name="unitForm">
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
                <!-- Unit Name -->
                <?php echo $this->lang->line('lbl_unit_name');?>
              <span class="text-danger">*</span>
            </label>
            
            <div class="col-sm-6">
              <input type="text" placeholder="Name" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">

              <span id="val_name" style="color: red"><?php echo form_error('name');?></span>

              <p style="color:#990000;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
              <!-- Abbr -->
              <?php echo $this->lang->line('lbl_unit_abbr');?>
              <span class="text-danger">*</span>
            </label>

            <div class="col-sm-6">
                <input type="text" placeholder="Abbr" class="form-control" id="abbr" name="abbr" value="<?php echo set_value('abbr'); ?>">
              <span id="val_ab" style="color:red"><?php echo form_error('abbr');?></span>
              <p style="color:#990000;"></p>
            </div>
          </div>

          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <center>
              <input type="submit" class="btn btn-info btn-flat" name="unitSubmit" value="<?php echo $this->lang->line('btn_submit');?>">

              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><!-- Close --><?php echo $this->lang->line('btn_modal_close');?></button>
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
        <form action="<?php echo base_url();?>/unit/edit" method="post" id="editUnit" class="form-horizontal">
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
          
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
              <button type="button" class="btn btn-info btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat">Submit</button>
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

<?php 
    $this->load->view('layout/footer');
    $this->load->view('layout/validation');
?> 

<script type="text/javascript">

  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);

</script>