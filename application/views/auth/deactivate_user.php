<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  /*if(!in_array("edit_team_member",$user_session)){
      redirect('auth','refresh');
  }*/

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
                <div class="col-md-12">
                 <div class="top-bar-title padding-bottom"> Deactive User</div>
                </div> 
                <div class="col-md-4">
                 
                </div>
              </div>
            </div>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-4">

                <?php echo form_open("auth/deactivate/".$user->id,'class="form-horizontal row-border"');?>
                  <div class="box-body" style="padding: 20px">
                    
                    <center>
                      <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="yes" checked="checked" class="minimal"/>
                      <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="no" class="minimal"/>
                    </center>

                    <?php echo form_hidden($csrf); ?>
                    <?php echo form_hidden(array('id'=>$user->id)); ?>
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    
                  <center>
                    <?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-info btn-flat"');?>
                    <a href="<?php echo base_url();?>settings/member_list" class="btn btn-default btn-flat">Cancel</a>
                  </center>
                  </div>
                  <!-- /.box-footer -->
                <?php echo form_close();?>

              </div> 
            </div>
          <!-- /.nav-tabs-custom -->
          </div>
        <!-- /.col -->
        </div>
      <!-- /.row -->
      </div>
    </section>
</div>
<?php 
  $this->load->view('layout/footer');
?> 
