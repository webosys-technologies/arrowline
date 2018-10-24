<?php 
  $this->load->view('layout/header');


  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_finance",$user_session)){
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
          <?php if($this->session->flashdata('success')) { ?>
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i>Alert!</h4>
                <?php echo $this->session->flashdata('success');?>
              </div>
           <?php } ?>

           <?php if($this->session->flashdata('fail')) { ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i>Alert!</h4>
                <?php echo $this->session->flashdata('fail');?>
              </div>
           <?php } ?>
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                 <div class="top-bar-title padding-bottom">
                    <!-- Taxes -->
                      <?php echo $this->lang->line('lbl_tax_header');?>
                  </div>
                </div> 
                <div class="col-md-2">
                    <a href="<?php echo base_url()?>tax/add" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><!-- Add New -->
                      <?php echo $this->lang->line('btn_tax_addtax');?>
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
                  <th>Tax Type</th>
                  <th>Tax Name</th>
                  <th>Registration Number</th>
                  <th>Filling Frequency</th>
                  <th>Sales Tax (%)</th>
                  <th>Purchase Tax (%)</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                        $id= $row->tax_id;
                    ?>
                    <tr>
                      <td><?php 
                        if($row->tax_type == 1){
                          echo "GST";    
                        }  
                        else if($row->tax_type == 2){
                          echo "Non-GST Supplies";    
                        }
                        else if($row->tax_type == 3){
                          echo "Nil Rated";
                        }
                        else
                        {
                          echo "Exempted";
                        }
                       ?></td>
                      <td><?php echo $row->tax_name; ?></td>
                      <td><?php echo $row->registration_number; ?></td>
                      <td><?php echo $row->filling_frequency; ?></td>
                      <td align="right"><?php echo $row->tax_value; ?>%</td>
                      <td align="right"><?php echo $row->purchase_tax_value; ?>%</td>
                      <td>
                          <?php
                            if($row->active==1){
                          ?>
                              <a href="#" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#<?php echo $row->tax_id;?>">Inactive</a>&nbsp;&nbsp;
                          <?php
                            }
                            else{
                          ?>
                              <a href="<?php echo base_url('tax/active/'); echo $row->tax_id;?>" class="btn btn-xs btn-success">Active</span></a>&nbsp;&nbsp;
                          <?php
                            }
                          ?>
                          <!-- Modal -->
                            <div id="<?php echo $row->tax_id;?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Mark Inactive</h4>
                                  </div>
                                  <form action="<?php echo base_url('tax/in_active/'); ?><?php echo $row->tax_id;?>" method="post">
                                    <div class="modal-body">
                                     Inactive Date
                                        <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date('Y-m-d');?>">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-info btn-flat">Save</button>
                                      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>

                          <a href="<?php echo base_url('tax/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info" data-tt="tooltip"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger" data-tt="tooltip"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th>Tax Name</th>
                  <th>Registration Number</th>
                  <th>Filling Frequency</th>
                  <th>Sales Tax (%)</th>
                  <th>Purchase Tax (%)</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<div id="add-tax" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">
          <!-- Add New -->
            <?php echo $this->lang->line('lbl_add_tax_header');?>
        </h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action='<?php echo base_url();?>tax/add' method="post" id="addTex" name="taxForm">
        <input type="hidden" value="wAMmkt7rFAKjG90YmJZr7eK598leZX7AZiFuZ1Wh" name="_token" id="token-rm">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
              <!-- Name -->
              <?php echo $this->lang->line('lbl_tax_name');?>
                <span class="text-danger">*</span>
            </label>

            <div class="col-sm-6">
              <input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" id="name">

              <span id="name" style="color: red"><?php echo form_error('name');?></span>
              <p style="color:#990000;"></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
              <!-- Tax Rate (%) -->
              <?php echo $this->lang->line('lbl_tax_rate');?>
              <span class="text-danger">*</span>
            </label>

            <div class="col-sm-6">
              <input type="number" class="form-control" name="tax_rate" value="<?php echo set_value('tax_rate'); ?>">
              <span id="name" style="color: red"><?php echo form_error('tax_rate');?></span>
              <p style="color:#990000;"></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
              <!-- Default -->
              <?php echo $this->lang->line('lbl_tax_default');?>
            </label>

            <div class="col-sm-6">
                <select class="form-control" name="defaults" value="<?php echo set_value('defaults');?>">
                <span id="name" style="color: red"><?php echo form_error('defaults');?></span>
                <!-- <span style="font-size:20px;"></span> -->
                        
                    <option value="0" >No</option>
                    <option value="1" >Yes</option>
                </select>
            </div>
          </div>

          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <center>
              <input type="submit" class="btn btn-info btn-flat" name="taxSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><!-- Close --><?php echo $this->lang->line('btn_modal_close');?></button>
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>


<div id="edit-tax" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Update tax rate</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action='' method="post" id="editTex">
        <input type="hidden" value="wAMmkt7rFAKjG90YmJZr7eK598leZX7AZiFuZ1Wh" name="_token" id="token-rm">
          
          <input type="hidden" name="tax_id" id="tax_id">
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Name</label>

            <div class="col-sm-6">
              <input type="text" placeholder="Name" class="form-control" name="name" id="name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Tax Rate (%)</label>

            <div class="col-sm-6">
              <input type="number" class="form-control" name="tax_rate" id="tax_rate">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Default</label>

            <div class="col-sm-6">
                <select class="form-control" name="defaults" id="defaults">
                    <option value="0" >No</option>
                    <option value="1" >Yes</option>
                </select>
            </div>
          </div>
          <input type="hidden" name="tax_id" id="tax_id">

                    <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <button type="button" class="btn btn-info btn-flat" data-dismiss="modal">Close</button>
              
              <button type="submit" class="btn btn-primary btn-flat">Update</button>
            </div>
          </div>
                    
        </form>
      </div>
    </div>

  </div>
</div>

    </section>
    <!-- Modal Dialog -->
 <!-- /.content -->
</div>


 <?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('tax/delete/'); ?>'+id;
     }
  }
</script>

<script type="text/javascript">

  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);

</script>