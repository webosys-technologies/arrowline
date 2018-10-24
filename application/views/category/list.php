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
        <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>Alert!</h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
       <?php } ?>

        
        <!-- /.col -->
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10">
             <div class="top-bar-title padding-bottom">
                  <!-- Item Categories -->
                  <?php echo $this->lang->line('lbl_item_category_header');?>
              </div>
            </div> 
            <div class="col-md-2 top-left-btn">
                 <?php if(isset($user_session)){
                    if(in_array("add_item_category",$user_session)){
                  ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#add-category" class="btn btn-block btn-primary btn-flat"><span class="fa fa-plus"> &nbsp;</span><!-- Add New Category -->
                  <?php echo $this->lang->line('btn_item_category_addcat');?>  
                </a>
                <?php }} ?>
            </div>
            
          </div>
        </div>
      </div>

          <div class="box">
            <div class="box-header">
              <a href="<?php echo base_url();?>category/create_csv"><button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span>
                  <!-- Download CSV -->
                  <?php echo $this->lang->line('btn_download_csv');?>
                </button></a>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Category -->
                    <?php echo $this->lang->line('add_item_category');?>
                  </th>
                  <th>
                    <!-- Unit -->
                    <?php echo $this->lang->line('add_item_category_units');?>
                  </th>
                  <th width="5%">
                      <!-- Action -->
                      <?php echo $this->lang->line('lbl_item_category_unit');?>
                  </th>
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
                              <a title="Edit" href="<?php echo base_url();?>category/update/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-edit"></span></a> &nbsp;

                              <?php }}?>

                              <?php if(isset($user_session)){
                                if(in_array("delete_item_category",$user_session)){
                              ?>
                              <a title="Edit" href="#<?php echo $row->id;?>" class="btn btn-xs btn-danger edit-unit" data-toggle="modal" data-target="" data-tt="tooltip"><span class="fa fa-remove"></span></a> &nbsp;
                              <?php }}?>

                        <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                      <!-- !!  Delete Item Category !! -->
                                        <?php echo $this->lang->line('lbl_category_delete_modal');?>
                                      </h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b><!-- Are you sure to delete this Record !! --><?php echo $this->lang->line('delete_modal');?>&hellip;</b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">
                                      <!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                      <a href="<?php echo base_url();?>category/delete/<?php echo $row->id;?>" class="btn btn-danger" ><!-- Delete -->
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
        <h4 class="modal-title">
            <!-- Add New -->
              <?php echo $this->lang->line('add_item_category_header');?>
        </h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>category/add" method="post" id="myform1" class="form-horizontal" name=categoryForm>
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
                <!-- Category -->
                    <?php echo $this->lang->line('add_item_category');?>
              <span class="text-danger">*</span>
            </label>

            <div class="col-sm-6">
              <input type="text" placeholder="Category" class="form-control" name="category" value="<?php echo set_value('category'); ?>" id="category">
              <span id="name" style="color: red"><?php echo form_error('category');?></span>
              <p style="color:#990000;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">
                <!-- Unit -->
                  <?php echo $this->lang->line('add_item_category_units');?>
                <span class="text-danger">*</span>
            </label>

            <div class="col-sm-6">
              <select class="form-control valdation_select" name="units" value="<?php echo set_value('units'); ?>">
              <span id="name" style="color: red"></span>
              <option value=""><!-- Select One -->
                <?php echo $this->lang->line('lbl_dropdown_customer');?>
              </option>
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
            <p style="color:#990000;"><?php echo form_error('category');?></p>
            </div>
          </div>

          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
            <center>
              <input type="submit" class="btn btn-info btn-flat" name="categorySubmit" value="<?php echo $this->lang->line('btn_submit');?>">
              <a href="<?php echo base_url();?>category" class="btn btn-default btn-flat" data-dismiss="modal">
                <!-- Cancle -->
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


<!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='categorySubmit']").click(function(e){
           
          var b=chkEmpty("categoryForm","category","Please Enter Category Name");
          var c=chkDrop("categoryForm","units","Please Enter unit");

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

<script type="text/javascript">

  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);

</script>