 <?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_role",$user_session)){
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
                <div class="col-md-10">
                 <div class="top-bar-title padding-bottom">
                    <!-- User Roles -->
                      <?php echo $this->lang->line('lbl_userrole_header');?>
                  </div>
                </div> 
                <div class="col-md-2">
                   <?php if(isset($user_session)) {
                      if(in_array("add_role",$user_session)){
                    ?>
                    <a href="<?php echo base_url();?>permission/add_group" class="btn btn-block btn-primary btn-flat"><span class="fa fa-plus"> &nbsp;</span>
                      <!-- Add New Role -->
                      <?php echo $this->lang->line('btn_userrole_addrole');?>
                    </a>
                    <?php }} ?>
                </div>
              </div>
            </div>
          </div>

          <?php if($this->session->flashdata('success')) { ?>
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Alert!</h4>
              <?php echo $this->session->flashdata('success');?>
            </div>
          <?php } ?>

          <?php if($this->session->flashdata('fail')) { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Alert!</h4>
              <?php echo $this->session->flashdata('fail');?>
            </div>
          <?php } ?>


          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>
                        <!-- Role Name -->
                        <?php 
                          echo $this->lang->line('lbl_userrole_rolename');
                        ?>
                    </th>
                    <th>
                        <!-- Description -->
                        <?php echo $this->lang->line('lbl_userrole_desc');?>
                    </th>
                    <?php if($this->ion_auth->is_admin()){?>
                    <th>
                        <!-- Action -->
                        <?php echo $this->lang->line('lbl_teammember_action');?>
                    </th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($group as $value) {?>
                  <tr>
                    <td>
                        <?php 
                          if($value->name == "admin"){
                            echo $value->name;
                          }
                        else{ ?>
                          <a href="<?php echo base_url();?>permission/edit_group/<?php echo $value->id;?>"><?php echo $value->name;?></a>
                        <?php }?>
                    </td>
                        
                    <td><?php echo $value->description?></td>
                    
                    <!--  Action <td> -->
                    
                    <?php if($this->ion_auth->is_admin()){?>
                    <td>
                        <?php if($value->name != "admin"){ ?>
                        <a title="Edit" class="btn btn-xs btn-primary btn-flat" href="<?php echo base_url();?>permission/edit_group/<?php echo $value->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span>
                        </a>
                        <?php } ?>
                        &nbsp;
                        <?php if($value->name != "admin"){ ?>
                        <a href="#<?php echo''.$value->id.'';?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger btn-flat" data-tt="tooltip" title="Delete"><span class="fa fa-remove"></span>
                        </a>
                        <?php } ?>

                        <div class="example-modal">
                          <div class="modal fade" id="<?php echo''.$value->id.'';?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <center><h4 class="modal-title">
                                      <!-- !!  Delete User Roles !! -->
                                        <?php echo $this->lang->line('lbl_userrole_delete_modal');?>
                                    </h4>
                                </center>
                                </div>
                                <div class="modal-body">
                                  <p><h4><b><!-- Are you sure to delete this Record !! --><?php echo $this->lang->line('delete_modal');?>&hellip;</b></h4></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                                      <?php echo $this->lang->line('btn_modal_close');?>
                                    </button>
                                    <a href="<?php echo base_url();?>permission/delete/<?php echo $value->id;?>" class="btn btn-danger" ><!-- Delete -->
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
                    <?php } ?>
                    
                    
                    <!--  End Action <td> -->
                    
                  </tr>
                  <?php } ?>
              </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
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
<?php 

  $this->load->view('layout/footer');
?>
 
<script type="text/javascript">
  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);
</script>