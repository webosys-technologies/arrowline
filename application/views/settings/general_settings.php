<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_item_category",$user_session))
  {
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
        <li class=active><a href="<?php echo base_url();?>category">Item Categories</a></li>
        <?php }} ?>


        <?php if(isset($user_session)){
            if(in_array("manage_income_expense_category",$user_session)){
          ?>
        <li><a href="<?php echo base_url();?>generalsetting/">Income Expense Category</a></li>
        <?php }} ?>


        <?php if(isset($user_session)){
            if(in_array("manage_unit",$user_session)){
          ?>
        <li ><a href="<?php echo base_url();?>unit">Units</a></li>
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
            <div class="col-md-4">
             <div class="top-bar-title padding-bottom">Item Categories</div>
            </div> 

            <div class="col-md-4 top-left-btn">
                <a href="" class="btn btn-block btn-default btn-flat"><span class="fa fa-upload"> &nbsp;</span>Import Categories</a>
            </div>

            <div class="col-md-4 top-right-btn">
                 <?php if(isset($user_session)){
                    if(in_array("add_item_category",$user_session)){
                  ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#add-category" class="btn btn-block btn-primary btn-flat"><span class="fa fa-plus"> &nbsp;</span>Add New Category</a>
                <?php }} ?>
            </div>
            
          </div>
        </div>
      </div>

          <div class="box">
            <div class="box-header">
              <a href="<?php echo base_url();?>settings/create_csv"><button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span>Download CSV</button></a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Category</th>
                  <th>Unit</th>
                  <th width="5%">Action</th>
                </tr>
                </thead>
                <tbody>
                        <?php foreach ($cat as $row):?>
                  <tr>
                          
                          <td><?php echo $row->category_name;?></td>
                          <td><?php echo $row->unit_name;?></td>
                          
                           <td>
                            <?php if(isset($user_session)){
                                if(in_array("edit_item_category",$user_session)){
                              ?>
                              <a title="message.form.edit" href="<?php echo base_url();?>settings/update_cat/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit"><span class="fa fa-edit"></span></a> &nbsp;

                              <?php }}?>

                              <?php if(isset($user_session)){
                                if(in_array("delete_item_category",$user_session)){
                              ?>
                              <a title="message.form.edit" href="#<?php echo $row->id;?>" class="btn btn-xs btn-danger edit-unit" data-toggle="modal" data-target=""><span class="fa fa-remove"></span></a> &nbsp;
                              <?php }}?>

                        <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">!!  Delete Item Category !!</h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b>Are you sure to delete this Record !!&hellip;</b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="<?php echo base_url();?>settings/delete_cat/<?php echo $row->id;?>" class="btn btn-danger" >Delete</a>
                                    
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
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

<div id="add-category" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add New</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>settings/add_cat" method="post" id="myform1" class="form-horizontal" name=categoryForm>
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Category</label>

            <div class="col-sm-6">
              <input type="text" placeholder="Category" class="form-control" name="category" value="<?php echo set_value('category'); ?>">
              <span id="name" style="color: red"><?php echo form_error('category');?></span>
              <p style="color:#990000;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Units</label>

            <div class="col-sm-6">
              <select class="form-control valdation_select" name="units" value="<?php echo set_value('units'); ?>">
              <span id="name" style="color: red"><?php echo form_error('units');?></span>
              <option value="">Select One</option>
              <?php 
                              foreach($unit as $row)
                              
                              {
                            ?>
                                
                                <option value="<?php echo $row->id;?>">
                                <?php echo $row->unit_name; ?></option>  
                            <?php
                              }
                            ?>
              
                              
            </select>
            </div>
          </div>

          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <a href="<?php echo base_url();?>settings/general_settings" class="btn btn-info btn-flat" data-dismiss="modal">Cancle</a>
              <button type="submit" class="btn btn-primary btn-flat" name="categorySubmit">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<div id="edit-category" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add New</h4>
      </div>
      <div class="modal-body">
        <form action="http://gobilling.techvill.net/update-category" method="post" id="editCat" class="form-horizontal">
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Category</label>

            <div class="col-sm-6">
              <input type="text" placeholder="Name" class="form-control" id="name" name="description">
              <span id="val_name" style="color: red"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Units</label>

            <div class="col-sm-6">
              <select class="form-control" name="dflt_units" id="dflt_units">
              
                              <option value="1" >Each</option>
                            </select>
            </div>
          </div>
          <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <button type="button" class="btn btn-info btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat">Submit</button>
            </div>
          </div>
                    
        </form>
      </div>
    </div>

  </div>
</div>
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
<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='categorySubmit']").click(function(e){
           /*var a=chkEmpty("customerForm","branch","Please Enter Branch Name");*/
           var b=chkEmpty("categoryForm","name","Please Enter Category Name");

          var c=chkDrop("categoryForm","units","Please Enter unit");

          


           /*var c=chkEmpty("categoryForm","abbr","Please Enter Abberivation"); */

           if((b+c) < 1){
             categoryForm.submit();
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