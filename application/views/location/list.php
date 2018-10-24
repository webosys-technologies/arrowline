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
      <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>Alert!</h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
       <?php } ?>
     
        <!-- /.col -->
        <div class="col-md-12">

          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                 <div class="top-bar-title padding-bottom">
                      <!-- Locations -->
                      <?php echo $this->lang->line('lbl_warehouses');?>  
                  </div>
                </div> 
                <div class="col-md-2">
                    <a href="<?php echo base_url();?>location/new_location" class="btn btn-primary btn-flat"><span class="fa fa-plus "> &nbsp;</span>
                        <!-- Add New Location -->
                        <?php echo $this->lang->line('btn_add_warehouse');?>
                    </a>
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
                      <!-- Location Name -->
                      <?php echo $this->lang->line('lbl_warehouse_name');?>
                  </th>
                  <th>
                      <!-- Location Code -->
                      <?php echo $this->lang->line('lbl_warehouse_code');?>
                  </th>
                  <th>
                      <!-- Delivery Address -->
                      <?php echo $this->lang->line('lbl_location_address');?>
                  </th>
                  <th>
                      <!-- Phone -->
                      <?php echo $this->lang->line('lbl_location_phone');?>  
                  </th> 
                  <th width="5%">
                      <!-- Action -->
                      <?php echo $this->lang->line('lbl_location_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($location as $row):?>
                    <tr>
                          
                        <td><?php echo $row->location_name;?></td>
                        <td><?php echo $row->location_code;?></td>
                        <td><?php echo $row->delivery_address;?></td>
                        <td><?php echo $row->phone;?></td>
                        
                        <td>
              
                              
                              <a title="Edit" href="<?php echo base_url();?>/location/update/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-edit"></span></a> &nbsp;
                              
                              <a title="Delete" href="#<?php echo $row->id;?>" class="btn btn-xs btn-danger edit-unit" data-toggle="modal" data-target="" data-tt="tooltip"><span class="fa fa-remove"></span></a> &nbsp;

                      <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                          <!-- !!  Delete Location !! -->
                                          <?php echo $this->lang->line('lbl_location_delete_modal');?>
                                        </h4>
                                    </center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b><!-- Are you sure to delete this Record !! --><?php echo $this->lang->line('delete_modal');?>&hellip;</b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                      <a href="<?php echo base_url();?>/location/delete/<?php echo $row->id;?>" class="btn btn-danger" ><!-- Delete -->
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
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>

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