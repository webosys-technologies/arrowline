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
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i>Alert!</h4>
                Database Backup is not available in demo version
            </div>
        </div> 
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="top-bar-title padding-bottom">
                    Database Backup
                    <!-- <?php echo $this->lang->line('lbl_unit_header');?> -->
                  </div>
                </div> 
                <div class="col-md-2">
                  <!-- <?php if(isset($user_session)){
                    if(in_array("add_db_backup",$user_session)){
                  ?> -->
<!--                      <a href="<?php echo base_url("backup/dbbackup") ?>" class="btn btn-block btn-primary btn-flat"><i class="fa fa-cloud-download">&nbsp;</i>
                        Database Backup
                         <?php echo $this->lang->line('btn_unit_newunit');?> 
                      </a>-->
                      <a href="#" class="btn btn-block btn-primary btn-flat"><i class="fa fa-cloud-download">&nbsp;</i>
                        Database Backup
                        <!-- <?php echo $this->lang->line('btn_unit_newunit');?> -->
                      </a>
                  <!-- <?php }} ?> -->
                </div>
              </div>
            </div>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="indexdesc" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                      # Sr No.
                      <!-- <?php echo $this->lang->line('lbl_unit_name');?> -->
                  </th>
                  <th>
                      Name
                      <!-- <?php echo $this->lang->line('lbl_unit_abbr');?> -->
                  </th>
                  <th>
                    Date
                      <!-- <?php echo $this->lang->line('lbl_unit_action');?> -->
                  </th>
                  <th>
                    <!-- Action -->
                      <?php echo $this->lang->line('lbl_unit_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($db as $row):?>
                  <tr>
                          <td><?php echo $row->id;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->date;?></td>
                          <td>
                              <!-- <?php if(isset($user_session)){
                                if(in_array("download_db_backup",$user_session)){
                              ?> -->
                              <!--<a title="Download Database" href="<?php echo base_url("backup/download/".$row->name) ?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-cloud-download"></span></a> &nbsp;-->
                              <a title="Download Database" href="" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-cloud-download"></span></a> &nbsp;
                              <!-- <?php }} ?> -->


                               <?php if(isset($user_session)){
                                if(in_array("delete_db_backup",$user_session)){
                              ?> 
                              <a title="Delete" href="<?php echo base_url("backup/delete/".$row->id) ?>" class="btn btn-xs btn-danger edit-unit" data-tt="tooltip"><span class="fa fa-remove"></span></a> &nbsp;
                               <?php }} ?> 
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

    <!-- /.content -->
</div>


<?php 
    $this->load->view('layout/footer');
?> 
