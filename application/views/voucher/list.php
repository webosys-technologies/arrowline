<?php 
	$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_balance_transfer",$user_session)){
      redirect('auth','refresh');
  }



?>
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script> -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i> 
              <!-- Home -->
              <?php echo $this->lang->line('home');?>
            </a>
          </li>
          <li class="active">
            <!-- Voucher -->
            <?php echo 'Voucher'//$this->lang->line('lbl_transfer_header');?>
          </li>
        </ol>
      </h5>
      
    </section>    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">

        <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>
              <?php echo $this->lang->line('alert');?>
            </h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
       <?php } ?>
          <!-- /.box -->
          <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title"> List Of Users</h3>
            </div> -->

            <div class="box-header with-border">

              <h3 class="box-title" style="padding: 5px;"></i>
                <!-- Voucher -->
                <?php echo 'Voucher'//$this->lang->line('lbl_bank_transfer_header');?>
              </h3>
              <?php if(isset($user_session)){
                if(in_array("add_balance_transfer",$user_session)){
              ?>
              <a class="btn btn-primary btn-flat" style="float: right;" href="<?php echo base_url()?>Voucher/view"><i class="fa fa-user-plus"></i>
                 <!-- Add Transfer -->
                 <?php echo 'Add Voucher'// $this->lang->line('lbl_btn_addtransfer');?>
                </a>
              <?php }}?>
            </div>

            <!-- /.box-header -->
            <div id="infoMessage"></div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_transfer_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_transfer_accountno');?>
                  </th>
                  <th>
                    <!-- Voucher Type -->
                    <?php echo 'Voucher Type';?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_transfer_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_transfer_amount');?>
                    (<?php echo $this->session->userdata("currencySymbol");?>)
                  </th>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_transfer_date');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_transfer_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($voch)):
                foreach ($voch as $row):?>
                  <tr> 
                    <td><?php echo $row->account_name;?></td>
                    <td><?php echo $row->account_no;?></td>
                    <td><?php echo $row->voucher_type;?></td>
                    <td><?php echo $row->description;?></td>
                    <td><?php echo $row->amount;?></td>
                    <td><?php echo $row->date;?></td>
                    
                    <td>
                      <?php if(isset($user_session)){
                        if(in_array("edit_balance_transfer",$user_session)){
                      ?>                        
                        <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>transfer/edit/<?php echo $row->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                      <?php }} ?>
                      &nbsp;
                      <?php if(isset($user_session)){
                          if(in_array("delete_balance_transfer",$user_session)){
                      ?>
                        <a class="btn btn-xs btn-danger" href="#<?php echo $row->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                        <i class="fa fa-remove" aria-hidden="true"></i></a>   
                      <?php }} ?>

                      <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center>
                                      <h4 class="modal-title">
                                      <!-- !!  Delete Account !! -->
                                       <?php echo $this->lang->line('lbl_delete_transfer_modal');?>
                                      </h4>
                                    </center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b>
                                      <!-- Are you sure to delete this Record !!&hellip; 
                                      -->
                                      <?php echo $this->lang->line('delete_modal');?>
                                    </b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                      <a href="<?php echo base_url();?>transfer/delete/<?php echo $row->id;?>" class="btn btn-danger" >
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
                <?php endforeach;
                endif;?>
              
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
            <p></p>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
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

