 <?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
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
      <!-- Default box -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
            <div class="box-header with-border">
              <a href="<?php echo base_url();?>item/create_csv" class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span>
                  <!-- Download CSV Sample  -->
                <?php echo $this->lang->line('lbl_sample_csv');?> 
              </a>
            </div>
            <div class="box-body">
            <div class="tab-content">
                <p>
                  <!-- Your CSV data should be in the format below. The first line of your CSV file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems. -->
                  <?php echo $this->lang->line('import_desc');?>
                </p>
                
                <!-- <small class="text-red">Duplicate Item ID rows wont be imported</small><br><br> -->
            
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        <!-- Item Name -->
                        <?php echo $this->lang->line('import_lbl_item_name');?>
                      </th>
                      <th>
                        HSN/SAC Code
                      </th>
                      <th>
                        <!-- Long Description -->
                        <?php echo $this->lang->line('import_lbl_item_long_desc');?>
                      </th>
                      <th>
                        <!-- Purchase Price -->
                        <?php echo $this->lang->line('import_lbl_item_purchase');?>
                      </th>
                      <th>
                        <!-- Retail Price -->
                        <?php echo $this->lang->line('import_lbl_item_retail');?>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>        
                        <td><?php echo $item->item_name;?></td>
                        <th><?php echo $item->hsn_code;?></th>
                        <td><?php echo $item->item_description;?></td> 
                        <td><?php echo $item->purchase_price;?></td>
                        <td><?php echo $item->sales_price;?></td>
                    </tr>
                  </tbody>
                </table>
            </div><br/><br/>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo base_url();?>item/update_csv" method="post" id="myform" name="myform" class="form-horizontal" enctype="multipart/form-data">
                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Category -->
                    <?php echo $this->lang->line('add_item_category');?>
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-5">
                    <div class="control">
                          <select class="form-control select2" id="" name="category" tabindex="1">
                            <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                            <?php foreach($cat as $row){ ?>
                                <option value="<?php echo $row->id; ?>">
                                <?php echo $row->category_name; ?></option>  
                            <?php } ?>
                        </select>
                        <p style="color:#990000;"></p>
                        <h5 style="color:#990000;"><?php echo form_error('category'); ?></h5>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    Units (Units Of Measurement)
                    <!-- <?php echo $this->lang->line('add_item_units');?> -->
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-5">
                    <div class="control">
                          <select class="form-control select2" id="" name="unit" tabindex="1">
                          <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                            <?php foreach($unit as $row) {?>
                                <option value="<?php echo $row->id; ?>">
                                <?php echo $row->unit_name; ?></option>  
                            <?php } ?>

                        </select>
                        <p style="color:#990000;"></p>
                        <h5 style="color:#990000;"><?php echo form_error('unit'); ?></h5>
                      </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">
                    <!-- Tax Type -->
                    <?php echo $this->lang->line('add_item_taxtype');?>
                      <span class="text-danger">*</span>
                  </label>
                  <div class="col-sm-5">
                    <div class="control">
                        <select class="form-control select2" id="tax_type" name="tax_type" tabindex="1">
                          <option value="">
                            <?php echo $this->lang->line('lbl_dropdown_customer');?>
                          </option>
                          <?php foreach($tax as $row) {?>
                              <option value="<?php echo $row->tax_id; ?>">
                              <?php echo $row->tax_name; ?></option>  
                          <?php } ?>
                        </select>
                        <p style="color:#990000;"></p>
                        <h5 style="color:#990000;"><?php echo form_error('tax_type'); ?></h5>
                    </div> 
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label require" for="inputEmail3"> 
                    <!-- Choose CSV File -->
                    <?php echo $this->lang->line('lbl_choose_csv')?>
                  </label>

                  <div class="col-sm-5">
                    <input type="file" class="form-control valdation_check input-file-field" id="file" name="file">
                    <span id="val_name" style="color: red"></span>
                  </div>
                </div><br/><br/>
            
              <!-- /.box-body -->
              <div class="box-footer">
              <center>

                <input type="submit" name="itemSubmit" class="btn btn-info btn-flat" tabindex="" value="<?php echo $this->lang->line('btn_submit');?>">

                <!-- <button class="btn btn-info btn-flat" type="submit">
                
                 <?php echo $this->lang->line('btn_submit')?>
                </button> -->
                <a href="<?php echo base_url();?>item/" class="btn btn-default btn-flat">
                 <!--  Cancel -->
                  <?php echo $this->lang->line('btn_cancel')?>
                </a>
               </center> 
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          </div>
          </div>          
        </div>
        
        <!-- /.box-footer-->
      
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <?php 

  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 


<script type="text/javascript">
$(document).ready(function(){ 
       $("input[name='itemSubmit']").click(function(e)
       {
           
           var cat=chkDrop("myform","category","Please Select Category");  
           var unit=chkDrop("myform","unit","Please Select Unit");
           var tax=chkDrop("myform","tax_type","Please Select Tax Type");
           
  
           if((cat+unit+tax) < 1){
             myform.submit();
             return true;
           }
           else{
             return false;
           }
           
        });
    });
</script>