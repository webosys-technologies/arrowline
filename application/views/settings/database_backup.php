<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_db_backup",$user_session)){
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
        <div class="col-md-3">
          <!-- Profile Image -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Manage General Settings</h3>
  </div>
  <div class="box-body no-padding" style="display: block;">
    <ul class="nav nav-pills nav-stacked">
      <?php if(isset($user_session)){
            if(in_array("manage_item_category",$user_session)){
          ?>
        <li><a href="<?php echo base_url();?>settings/general_settings">Item Categories</a></li>
        <?php }} ?>


        <?php if(isset($user_session)){
            if(in_array("manage_income_expense_category",$user_session)){
          ?>
        <li><a href="<?php echo base_url();?>general_setting/">Income Expense Category</a></li>
        <?php }} ?>


        <?php if(isset($user_session)){
            if(in_array("manage_unit",$user_session)){
          ?>
        <li><a href="<?php echo base_url();?>settings/units">Units</a></li>
        <?php }} ?>


        <?php if(isset($user_session)){
            if(in_array("manage_db_backup",$user_session)){
          ?>
        <li class=active><a href="<?php echo base_url();?>settings/database_backup">Database Backups</a></li>
        <?php }} ?>


        <?php if(isset($user_session)){
            if(in_array("manage_email_setup",$user_session)){
          ?>
        <li ><a href="<?php echo base_url();?>emailsetup/">Email Setup</a></li>
        <?php }} ?>  
    </ul>
  </div>
  <!-- /.box-body -->
</div>        </div>
        <!-- /.col -->
        <div class="col-md-9">

          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                 <div class="top-bar-title padding-bottom">Database Backups</div>
                </div> 
                <div class="col-md-3">
                                      <a href="" class="btn btn-block btn-default btn-flat btn-border-orange" id="backupid"><span class="fa fa-plus"> &nbsp;</span>New Backup</a>
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
                  <th>#</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th width="5%">Action</th>
                </tr>
                </thead>
                <tbody>
                                                </tfoot>
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