<?php 
	$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("add_purchase",$user_session)){
      redirect('auth','refresh');
  }

?>
<div class="content-wrapper">
    <section class="content">
     <div class="box-footer">
          <h4 class="box-title">
            <!-- Purchases -->
            <?php echo $this->lang->line('lbl_purchase_heading');?>
            <?php if(in_array("add_purchase",$user_session)){?>
              <a class="btn btn-primary btn-flat pull-right" href="<?php echo base_url()?>purchases/add_purchase"><i class="fa fa-user-plus"></i> 
              <!-- New Purchase -->
              <?php echo $this->lang->line('btn_add_purchase');?>
              </a>
            <?php } ?>
          </h4>

      </div>
      <br>   
      <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> 
            <?php echo $this->lang->line('alert');?>
            </h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
      <?php } ?>
       <div class="row">
          <div class="col-xs-12">
             <div class="box">
            <div class="box-body">
              <table id="indexdesc" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Inavoice# -->
                    <?php echo $this->lang->line('lbl_purchase_invoiceno');?>
                  </th>
                  <th>
                    <!-- Supplier Name -->
                    <?php echo $this->lang->line('lbl_purchase_suppliername');?>
                  </th>
                  <th>
                    <!-- Total -->
                    <?php echo $this->lang->line('lbl_purchase_total');?>
                  </th>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_purchase_date');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_purchase_action');?>
                  </th>
                </tr>
                </thead>
                

                <tbody>
                <?php foreach ($purchase as $value) {?>
                <tr>
                  <td><a href="<?php echo base_url();?>purchases/purchase_details/<?php echo $value->purchase_id;?>"><?php echo $value->reference_no;?></a></td>
                  <td><?php echo $value->name;?></td>
                  <td><?php echo $value->total_amount;?></td>
                  <td><?php echo $value->date;?></td>
                  <td>


                  <?php if(in_array("edit_purchase",$user_session)){ ?>
                    <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>purchases/edit/<?php echo $value->purchase_id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                  <?php } ?>
                  &nbsp;
                  <?php  if(in_array("delete_purchase",$user_session)){ ?>
                    <a href="#<?php echo''.$value->purchase_id.'';?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger" data-tt="tooltip" title="Delete"><span class="fa fa-remove"></span></a>
                  <?php } ?>

                  


                        <div class="example-modal">
                              <div class="modal fade" id="<?php echo''.$value->purchase_id.'';?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      <center><h4 class="modal-title">
                                        <!-- !!  Delete Purchases !! -->
                                        <?php echo $this->lang->line('lbl_purchase_delete_modal');?>
                                      </h4></center>
                                    </div>
                                    <div class="modal-body">
                                      <p><h4><b>
                                        <!-- Are you sure to delete this Record !!&hellip; -->
                                        <?php echo $this->lang->line('delete_modal');?>
                                      </b></h4></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                          <?php echo $this->lang->line('btn_modal_close');?>
                                        </button>
                                        <a href="<?php echo base_url();?>purchases/delete/<?php echo $value->purchase_id; ?>" class="btn btn-danger" >
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
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>
                    <!-- Inavoice# -->
                    <?php echo $this->lang->line('lbl_purchase_invoiceno');?>
                  </th>
                  <th>
                    <!-- Supplier Name -->
                    <?php echo $this->lang->line('lbl_purchase_suppliername');?>
                  </th>
                  <th>
                    <!-- Total -->
                    <?php echo $this->lang->line('lbl_purchase_total');?>
                  </th>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_purchase_date');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_purchase_action');?>
                  </th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
      </div>
    </section> 
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