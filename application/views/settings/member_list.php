 <?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_team_member",$user_session)){
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
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                 <div class="top-bar-title padding-bottom">
                    <!-- Team Members -->
                    <?php echo $this->lang->line('lbl_sidemenu_teammember');?>
                  </div>
                </div> 
                <div class="col-md-2">
                  <a href="<?php echo base_url()?>auth/create_user" class="btn btn-block btn-primary btn-flat"><span class="fa fa-plus"> &nbsp;</span>
                    <!-- Add New Member -->
                    <?php echo $this->lang->line('btn_add_teammember');?>
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
                  <th><!-- First Name -->
                      <?php echo $this->lang->line('lbl_teammember_name');?>
                  </th>
                  <!-- <th>Last Name</th> -->
                  <th><!-- Email -->
                    <?php echo $this->lang->line('lbl_teammember_email');?>
                  </th>
                  <th><!-- Group -->
                    <?php echo $this->lang->line('lbl_teammember_group');?>
                  </th>
                  <th><!-- Status -->
                    <?php echo $this->lang->line('lbl_teammember_ststus');?>
                  </th>
                  <th><!-- Action -->
                    <?php echo $this->lang->line('lbl_teammember_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user):?>
                  <tr>
                    <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                    <!--  <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td> -->
                    <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                    <td>
                      <?php foreach ($user->groups as $group):?>
                        <!-- <?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?> -->
                        <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?> 
                        <br />
                        <?php endforeach?>
                    </td>
                    
                    <td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, '<span class="label label-success">'.lang('index_active_link').'</span>') : anchor("auth/activate/". $user->id, '<span class="label label-danger">'.lang('index_inactive_link').'</span>');?></td>
                    
                    <td>
                        
                      <?php 
                        if(isset($user_session)){
                          if(in_array("edit_team_member",$user_session)){
                          ?>


                        <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>auth/edit_user/<?php echo $user->id;?>" data-tt="tooltip">
                            <span class="fa fa-edit"></span>
                        </a>
                      <?php }} ?>
                    </td>
                  </tr>
                <?php endforeach;?>
                    
                </tbody>
                <tfoot>
                <tr>
                  <th><!-- First Name -->
                      <?php echo $this->lang->line('lbl_teammember_name');?>
                  </th>
                  <!-- <th>Last Name</th> -->
                  <th><!-- Email -->
                    <?php echo $this->lang->line('lbl_teammember_email');?>
                  </th>
                  <th><!-- Group -->
                    <?php echo $this->lang->line('lbl_teammember_group');?>
                  </th>
                  <th><!-- Status -->
                    <?php echo $this->lang->line('lbl_teammember_ststus');?>
                  </th>
                  <th><!-- Action -->
                    <?php echo $this->lang->line('lbl_teammember_action');?>
                  </th>
                </tr>
                </tfoot>
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