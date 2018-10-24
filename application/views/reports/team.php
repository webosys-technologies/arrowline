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
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                 <div class="top-bar-title padding-bottom">
                 <!--  Team Members -->
                   <?php echo $this->lang->line('lbl_teammembereport_teammembers');?>
                </div>
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
                   <!--  Name -->
                     <?php echo $this->lang->line('lbl_teammembereport_name');?>
                  </th>
                  <th>
                    <!-- Email -->
                     <?php echo $this->lang->line('lbl_teammemberreport_email');?>
                  </th> 
                  <th width="1%">
                   <!--  Action -->
                     <?php echo $this->lang->line('lbl_teammemberreport_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($team as $row):?>
                  <tr>
                  <td><?php echo $row->username;?></td>
                  <td><?php echo $row->email;?></td>
                 
                  <td>
                  <a class="btn btn-xs btn-info" href='<?php echo base_url();?>reports/team_view'><span class="fa fa-eye"></span></a> &nbsp;
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