<?php 
  $this->load->view('layout/header');
?>
<?php
foreach ($unit as $row) {
  # code...
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
                <div class="col-md-12">
                 <div class="top-bar-title padding-bottom">
                     <!--  Update Category -->
                      
                      <b><?php echo $this->lang->line('lbl_edit_item_category');?></b>
                  </div>
                </div> 
                <div class="col-md-3">
                          
                    </div>
              </div>
            </div>
          </div>

          <div class="box">
            
            <div class="box-body">
              <form action="<?php echo base_url();?>category/edit" method="post" id="editCat" class="form-horizontal" name="categoryForm">
            
          
          <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat->id;?>">
          <div class="form-group">
            <label class="col-sm-2 control-label require" for="inputEmail3">
                <!-- Category -->
                    <?php echo $this->lang->line('add_item_category');?>
            </label>

            <div class="col-sm-4">
              <input type="text" placeholder="Name" class="form-control" id="category" name="category" value="<?php echo $cat->category_name;?>">
              <p style="color:#990000;"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label require" for="inputEmail3">
                <!-- Unit -->
                    <?php echo $this->lang->line('add_item_category_units');?>
            </label>

            <div class="col-sm-4">
              <select class="form-control" name="units" id="dflt_units">
              <option value=""><!-- Select One -->
                <?php echo $this->lang->line('lbl_dropdown_customer');?>
              </option>
              <?php 
                      foreach($unit as $row)
                      
                      {
                    ?>
                      <option value="<?php echo $row->id; ?>" <?php if($row->id==$cat->unit){echo "selected";}?>>
                        <?php echo $row->unit_name; ?></option> 
                        
                    <?php
                      }
                    ?>
                  </select>
                <p style="color:#990000;"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
                  
              <input type="submit" class="btn btn-info btn-flat" value="<?php echo $this->lang->line('btn_submit');?>" name="categorySubmit">  
              <a href="<?php echo base_url();?>category/" class="btn btn-default btn-flat" data-dismiss="modal">
                  <!-- Cancle -->
                <?php echo $this->lang->line('btn_cancel');?>
              </a>
            
            </div>
          </div>
                    
        </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


<div id="edit-category" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Add New</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url();?>/settings/edit_cat" method="post" id="editCat" class="form-horizontal">
            <input type="hidden" name="_token" value="ckmfeJs5hvv46CwEMiGrLcSu2sRw00nVZ8NEvt7L">
          
          <input type="text" name="cat_id" id="cat_id" value="<?php echo $cat->id;?>">
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3">Category</label>

            <div class="col-sm-6">
              <input type="text" placeholder="Name" class="form-control" id="name" name="category" value="<?php echo $cat->category_name;?>">
              <span id="val_name" style="color: red"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label require" for="inputEmail3">Units</label>

            <div class="col-sm-4">
              <select class="form-control" name="units" id="dflt_units">
              <option value="">Select One</option>
              <?php 
                      foreach($unit as $row)
                      
                      {
                    ?>
                        
                        <option value="<?php echo $row->id; ?>">
                        <?php echo $row->unit_name; ?></option>  
                    <?php
                      }
                    ?>
                  </select>
            </div>
          </div>
          <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group">
            <label for="btn_save" class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
            <center>
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info btn-flat">Submit</button>
            </center>
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