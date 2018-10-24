<?php 
	$this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_bank_account",$user_session)){
      redirect('auth','refresh');
  }


?>

<div class="content-wrapper">
    <section class="content">
     <div class="box-footer">
          <h4 class="box-title">
          <!-- Bank Account -->
          <?php echo $this->lang->line('lbl_bankaccount_header');?>
            <?php if(in_array("add_bank_account",$user_session)){?>
              <a class="btn btn-primary btn-flat" style="float: right;" href="<?php echo base_url()?>bank/view"><i class="fa fa-user-plus"></i>
              <!-- New Bank Account -->
              <?php echo $this->lang->line('lbl_btn_add_account');?>
              </a>
            <?php } ?>
          </h4>
      </div>
      <br>   
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
       <div class="box-body">
              <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_bank_accountname');?>
                  </th>
                  <th>
                    <!-- Account Type -->
                    <?php echo $this->lang->line('lbl_bank_accounttype');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_bank_accountno');?>
                  </th>
                  <th>
                    <!-- Bank Name -->
                    <?php echo $this->lang->line('lbl_bank_bankname');?>
                  </th>
                  <th>
                    <!-- Bank Address -->
                    <?php echo $this->lang->line('lbl_bank_bankaddres');?>
                  </th>
                  <th>
                    <!-- Balance -->
                    <?php echo $this->lang->line('lbl_bank_balance');?>
                      (<?php echo $this->session->userdata("currencySymbol");?>)
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_bank_action');?>
                  </th>

                </tr>
                </thead>
                

                <tbody>
                <?php foreach ($acc as $row):?>
                  <tr>
                          <td><a href="<?php echo base_url();?>bank/show_transaction/<?php echo $row->id;?>"><?php echo $row->account_name;?></a></td>
                          <td><?php echo $row->account_type;?></td>
                          <td><?php echo $row->account_no;?></td>
                          <td><?php echo $row->bank_name;?></td>
                          <td><?php echo $row->bank_address;?></td>
                          <td><?php echo $row->opening_balance;?></td>
                          <td>
                          <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>bank/edit/<?php echo $row->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                          &nbsp;
                          <!-- <a class="btn btn-xs btn-danger" href="#<?php echo $row->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                          <i class="fa fa-remove" aria-hidden="true"></i></a> -->   
                      
                      <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                      <!-- !!  Delete Bank Account !! -->
                                      <?php echo $this->lang->line('lbl_bank_delete_modal');?>
                                    </h4></center>
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
                                        <!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                      <a href="<?php echo base_url();?>bank/delete/<?php echo $row->id;?>" class="btn btn-danger">
                                      <!-- Delete -->
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

                <?php endforeach;?>
              
                </tbody>
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
  $this->load->view('layout/validation')
?>
<script type="text/javascript">

  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);

</script>
