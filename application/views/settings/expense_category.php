<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_income_expense_category",$user_session)){
      redirect('auth','refresh');
  }
?>

<div class="content-wrapper">
   <div id="notifications" class="row no-print">
     <div class="col-md-12">
      </div>
   </div>
  
    <section class="content">
      <div class="row">
       
      <div class="col-md-12">
          <div class="box box-default">
             <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="top-bar-title padding-bottom">
                          <!-- Income Expense Categories -->
                          <?php echo $this->lang->line('lbl_income_category_header');?>
                        </div>
                    </div> 
              
                    <div class="col-md-2 top-right-btn">
                          <?php if(isset($user_session)){
                            if(in_array("add_income_expense_category",$user_session)){
                          ?>

                             <a href="" data-toggle="modal" data-target="#add-category" class="btn btn-block btn-primary btn-flat"><span class="fa fa-plus"> &nbsp;</span><!-- Add New Category -->
                              <?php echo $this->lang->line('btn_income_category_add');?>
                            </a>
                          <?php }} ?>
                    </div>
                </div>
              </div>
          </div>

            <?php if($this->session->flashdata('success')) { ?>
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                <?php echo $this->session->flashdata('success');?>
              </div>
            <?php } ?>
                 

        <div class="box">
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                        <th>
                            <!-- Name -->
                            <?php echo $this->lang->line('lbl_income_category_name');?>
                        </th>
                        <th>
                            <!-- Default -->
                            <?php echo $this->lang->line('lbl_income_category_default');?>
                        </th>
                        <th width="5%">
                            <!-- Action -->
                            <?php echo $this->lang->line('lbl_income_category_action');?>
                        </th>
                  </tr>
              </thead>
              <tbody>
               <?php
                    foreach ($data as $row){
                ?>
                <tr> 
                   <td><?php echo $row->name;?></td>
                   <td><?php echo $row->type;?></td>
                   <td>              

                   <?php if(isset($user_session)){
                      if(in_array("edit_income_expense_category",$user_session)){
                    ?>
                   <a title="Edit" href="<?php echo base_url();?>generalsetting/edit_data/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                   <?php }}?>
                   &nbsp;
                   <?php if(isset($user_session)){
                    if(in_array("delete_income_expense_category",$user_session)){
                  ?>
                     <a class="btn btn-xs btn-danger" href="#<?php echo $row->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                      <i class="fa fa-remove" aria-hidden="true"></i></a>   
                      <?php }}?>

                      <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                      <!-- !!  Delete Account !! -->
                                        <?php echo $this->lang->line('lbl_income_category_delete_modal');?>
                                      </h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b><!-- Are you sure to delete this Record !! --><?php echo $this->lang->line('delete_modal');?>&hellip;</b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                    
                                      <a title="message.form.edit" href="<?php echo base_url();?>generalsetting/delete/<?php echo $row->id;?>" 
                                       class="btn btn-danger"><!-- Delete -->
                                         <?php echo $this->lang->line('btn_modal_delete');?>
                                       </a> &nbsp;
                                    
                                  </div>
                                </div>
                               </div>
                              </div>
                      </div>
                          
                  </td>
                </tr>  
                <?php } ?>     
                 
                </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
    </section>
</div>

<div id="add-category" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">
                          <!-- Add New -->
                  <?php echo $this->lang->line('add_income_category_header');?>
                </h4>
            </div>
     
            <div class="modal-body">
                 <form name="Form" action="<?php echo base_url();?>generalsetting/add" method="post" id="myform1" class="form-horizontal">
                    <div class="form-group">
                          <label class="col-sm-3 control-label require" for="inputEmail3">
                              <!-- Category -->
                              <?php echo $this->lang->line('add_income_category');?>      
                          </label>

                          <div class="col-sm-6">
                              <input type="text" placeholder="Category" class="form-control" name="name" id="name" tabindex="2" onblur='chkEmpty("Form","name","Please Enter Name");'>
                              <span id="name" style="color: red"><?php echo form_error('name');?></span>
                               <p style="color:#990000;"></p>
                          </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label require" for="inputEmail3">
                          <!-- Type -->
                          <?php echo $this->lang->line('add_income_category_type');?>
                      </label>
                      <div class="col-sm-6">
                          <select class="form-control valdation_select" name="type" value="<?php echo set_value('units'); ?>">
                            <option value=""><!-- Select One -->
                              <?php echo $this->lang->line('lbl_dropdown_customer');?>
                            </option>
                            <option value="expense">Expense</option>
                            <option value="income">Income</option>
                          </select>
                            <span id="name" style="color: red"><?php echo form_error('type');?></span>
                            <p style="color:#990000;"></p>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="btn_save" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                              <center>
                                <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                                <a class="btn btn-default btn-flat" data-dismiss="modal">
                                  <!-- Close -->
                                  <?php echo $this->lang->line('btn_cancel');?>
                                </a>
                              </center>
                           </div>
                    </div>

                  </form>
            </div>


        </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='formSubmit']").click(function(e){
           /*var a=chkEmpty("customerForm","branch","Please Enter Branch Name");*/
           var b=chkEmpty("Form","name","Please Enter Name");
           var d=chkDrop("Form","type","Please Select type");

           if((b+d) < 1){
             Form.submit();
             return true;
           }else{
             return false;
           }
           
         });      
   });
</script>
  <?php 

  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>           

<script type="text/javascript">

    window.setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
        });
    }, 4000);
</script>

