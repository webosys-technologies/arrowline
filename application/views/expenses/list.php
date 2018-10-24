<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_expense",$user_session)){
      redirect('auth','refresh');
  }

?>

<div class="content-wrapper">
  <section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="top-bar-title pasdding-bottom">
                <!-- Expenses -->
                <?php echo $this->lang->line('lbl_expense_header');?>
              </div>
            </div> 
              <div>
                </div>
                  <div class="col-md-4 top-right-btn">
                    <?php if (isset($user_session)) { 
                       if(in_array("add_expense",$user_session)){?>
                      <a href="<?php echo base_url()?>expense/add" class="btn btn-primary btn-flat pull-right"><span class="fa fa-plus"> &nbsp;</span>
                        <!-- New Expense -->
                        <?php echo $this->lang->line('lbl_btn_addexpense');?>
                      </a>
                  <?php }} ?>
              </div>
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

      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div id="infoMessage"></div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- S/N -->
                    <?php echo $this->lang->line('lbl_expense_sn');?>
                  </th>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_expense_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_expense_accountnumber');?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_expense_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_expense_amount');?>
                  </th>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_expense_date');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_expense_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
          
                <?php
                $i=1; 
                 foreach ($data as $value) {
                 ?>
                  <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $value->account_name;?></td>
                    <td><?php echo $value->account_no;?></td>
                    <td><?php echo $value->description;?></td>
                    <td><?php echo $value->amount;?></td>
                    <td><?php echo $value->date;?></td>
                    <td><?php if(isset($user_session)){
                          if(in_array("edit_expense",$user_session)){
                        ?>
                        <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>expense/edit_data/<?php echo $value->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                        <?php }}?>
                        &nbsp;
                        <?php if(isset($user_session)){
                          if(in_array("delete_expense",$user_session)){
                        ?>                                                            
                         <a class="btn btn-xs btn-danger" href="#<?php echo $value->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                          <i class="fa fa-remove" aria-hidden="true"></i></a>    
                        <?php }} ?>
                          <div class="example-modal">
                             <div class="modal fade" id="<?php echo $value->id;?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      <center><h4 class="modal-title">
                                        <!-- !!  Delete Expense !! -->
                                        <?php echo $this->lang->line('lbl_delete_expense_modal');?>
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         <a title="Delete" class="btn btn-danger" href="<?php echo base_url();?>expense/delete/<?php echo $value->id;?>">Delete</a>
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
                    <!-- S/N -->
                    <?php echo $this->lang->line('lbl_expense_sn');?>
                  </th>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_expense_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_expense_accountnumber');?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_expense_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_expense_amount');?>
                  </th>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_expense_date');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_expense_action');?>
                  </th>
                </tr>
               </tfoot>
            </table>
          </div>
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