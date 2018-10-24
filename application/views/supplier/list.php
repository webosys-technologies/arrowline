<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
?>
<div class="content-wrapper">
  <section class="content">
    <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
                 <div class="top-bar-title padding-bottom">
                  <!-- Supplier -->
                  <?php echo $this->lang->line('supplier_heading');?>
                  </div>
            </div> 
            <div class="col-md-2 top-left-btn">
                <a href="<?php echo base_url();?>supplier/import" class="btn btn-block btn-default btn-flat btn-border-purple"><span class="fa fa-upload"> &nbsp;</span>
                <!-- Import Supplier -->
                <?php echo $this->lang->line('btn_import_supplier');?>
                </a>
            </div>
            <?php if(in_array("add_supplier",$user_session)){?>
            <div class="col-md-2 top-right-btn">
                <a href="<?php echo base_url()?>supplier/add_supplier" class="btn btn-block btn-primary btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span>
                  <!-- Add Supplier -->
                  <?php echo $this->lang->line('btn_add_supplier');?>
                </a>
            </div>
            <?php } ?>
            </div>
        </div>
      </div>  


      <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> 
            <!-- Alert! -->
            <?php echo $this->lang->line('alert');?>
            </h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
      <?php } ?>



    <!-- Top Box-->
      <div class="box">
        <div class="box-footer">
          <div class="col-md-4 col-xs-6 border-right">
              <h3 class="bold"><?php echo $supplier->total;?></h3>
              <span>
                <!-- Total Supplier -->
                <?php echo $this->lang->line('total_supplier');?>
              </span>
          </div>
          <div class="col-md-4 col-xs-6 border-right">
              <h3 class="bold"><?php echo $status->Active;?></h3>
              <span>
                <!-- Active Supplier -->
                <?php echo $this->lang->line('active_supplier');?>
              </span>
          </div>
          <div class="col-md-4 col-xs-6 border-right">
              <h3 class="bold"><?php echo $deactive->Deactive;?></h3>
              <span>
                <!-- Inactive Supplier -->
                <?php echo $this->lang->line('inactive_supplier');?>
              </span>
          </div>
            </div>
        </div>

      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            
             <div class="box-header">
              <a href="<?php echo base_url();?>supplier/create_full_csv">
                <button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span>
                  <!-- Download CSV -->
                   <?php echo $this->lang->line('btn_download_csv');?>
                </button>
              </a>
            </div>
            <!-- /.box-header -->
           
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Supplier Name -->
                    <?php echo $this->lang->line('supplier_heading');?>
                  </th>
                  <th>
                    <!-- Email -->
                    <?php echo $this->lang->line('lbl_email');?>
                  </th>
                  <th>
                    <!-- Phone -->
                    <?php echo $this->lang->line('lbl_phone');?>
                  </th>
                  <th>
                    <!-- Address -->
                    <?php echo $this->lang->line('lbl_supplier_address');?>
                  </th>
                  <th>
                    <!-- Status -->
                    <?php echo $this->lang->line('cust_status');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('cust_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
                     <?php
                           foreach ($data as $value) { 
                      ?>
                      <tr>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td><?php echo $value->phone; ?></td>
                        <td><?php echo $value->street; ?></td>
                         <td>
                          <?php if($value->delete_status=="0"){?>
                          <span class="label label-success"><?php echo $this->lang->line('lbl_status_active');?></span>
                        <?php } else {?>
                          <span class="label label-warning"><?php echo $this->lang->line('lbl_status_deactive');?></span>
                        <?php } ?>

                        </td>
                        
                          <td>
                            <?php if(in_array("edit_supplier",$user_session)){?>
                            <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>supplier/edit_data/<?php echo $value->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                            <?php } ?>
                             &nbsp;
                            <?php if(in_array("delete_supplier",$user_session)){?>
                            <a class="btn btn-xs btn-danger" href="#<?php echo $value->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                              <i class="fa fa-remove" aria-hidden="true"></i></a>
                            <?php } ?>

                          <div class="example-modal">
                            <div class="modal fade" id="<?php echo $value->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                    <!-- !!  Delete supplier !! -->
                                    <?php echo $this->lang->line('lbl_supplier_delete_modal');?>
                                    </h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b>
                                      <!-- Are you sure to delete this Record !!&hellip; -->
                                      <?php echo $this->lang->line('delete_modal');?>
                                      </b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $value->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                                      <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                    
                                       <a title="Delete" class="btn btn-danger" href="<?php echo base_url();?>supplier/delete/<?php echo $value->id;?>">
                                       <!-- Delete -->
                                       <?php echo $this->lang->line('btn_modal_delete');?>
                                       </a>
                                    
                                  </div>
                                </div>
                              
                              </div>
                              
                            </div>
                        </div>
                        
                        </td>

                    </tr>
                     <?php
                      }
                        ?>
              </tbody>
                <tfoot>
                <tr>
                  <th>
                    <!-- Supplier Name -->
                    <?php echo $this->lang->line('supplier_heading');?>
                  </th>
                  <th>
                    <!-- Email -->
                    <?php echo $this->lang->line('lbl_email');?>
                  </th>
                  <th>
                    <!-- Phone -->
                    <?php echo $this->lang->line('lbl_phone');?>
                  </th>
                  <th>
                    <!-- Address -->
                    <?php echo $this->lang->line('lbl_supplier_address');?>
                  </th>
                  <th>
                    <!-- Status -->
                    <?php echo $this->lang->line('cust_status');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('cust_action');?>
                  </th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div>
      </div>
  </section>
</div>

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