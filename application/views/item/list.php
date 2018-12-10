<?php 
	$this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("manage_item",$user_session)){
      redirect('auth','refresh');
  }

?>
<div class="content-wrapper">
       
  <section class="content">
    <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-7">
                 <div class="top-bar-title padding-bottom">
                 <!-- Items -->
                 <b><?php echo 'Products'//$this->lang->line('item_heading');?></b>
                 </div>
            </div> 
            <?php if(in_array("add_item",$user_session)){ ?>
              <div class="col-md-3 top-left-btn">
                  <a href="<?php echo base_url();?>item/import" class="btn btn-block btn-default btn-flat btn-border-purple"><span class="fa fa-upload"> &nbsp;</span>
                  <!-- Import New Products -->
                  <?php echo 'Import New Products'// $this->lang->line('btn_import_items');?>
                  </a>
              </div>
            <?php } ?>

            <?php if(in_array("add_item",$user_session)){ ?>
              <div class="col-md-2 top-right-btn">
                  <a href="<?php echo base_url()?>item/create_item" class="btn btn-block btn-primary btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span>
                    <!-- Add New Product -->
                    <?php echo 'Add New Product'// $this->lang->line('btn_add_items');?>
                  </a>
              </div>
            <?php } ?>

            </div>
        </div>
      </div>  
    <!-- Top Box-->
      <div class="box">
        <div class="box-body">
          <?php foreach($total as $value) {?>
          <div class="col-md-2 col-xs-6 border-right text-center" style="border-color:#6F7173;">
              <h3 class="bold"><?php echo $value->item?></h3>
              <span class="text-info bold">
                Available Products
                <!-- <?php echo $this->lang->line('item_heading');?> -->
              </span>
          </div>
          <div class="col-md-2 col-xs-6 border-right text-center" style="border-color:#6F7173;">
              <h3 class="bold"><?php echo $value->qty?></h3>
              <span class="text-info bold">
                <!-- Quantity -->
                <?php echo $this->lang->line('lbl_quantity');?>
              </span>
          </div>


          <div class="col-md-3 col-xs-6 border-right text-center" style="border-color:#6F7173;">
              <h3 class="bold">
                <!-- <?php echo $value->purchase?> -->
                <?php if(isset($value->purchase)){echo number_format((float)$value->purchase, 2, '.', '');}?> 
              </h3>
              <span class="text-info">
                <!-- Cost Value of Stock on Hand -->
                <?php echo $this->lang->line('lbl_cost_value');?>
              </span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center" style="border-color:#6F7173;">
              <h3 class="bold">
                <?php if(isset($value->retail)){echo number_format((float)$value->retail, 2, '.', '');}?> 
                <!-- <?php echo $value->retail?> -->
              </h3>
              <span class="text-info">
                <!-- Retail Value of Stock on Hand  -->
                <?php echo $this->lang->line('lbl_retail_value');?>
              </span>
          </div>
          <div class="col-md-2 col-xs-6 text-center">
              <h3 class="bold">
              <?php if(isset($value->profit)){echo number_format((float)$value->profit, 2, '.', '');}?> 
                <!-- <?php echo $value->profit?> -->
              </h3>
              <span class="text-info">
                <!-- Profit Value of Stock on Hand -->
                <?php echo $this->lang->line('lbl_profit_value');?>
              </span>
          </div>
          <?php 
          }
          ?>
        </div>
      </div><!--Top Box End-->
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
          <!-- /.box -->
          <div class="box">
            
             <div class="box-header">
              <a href="<?php echo base_url();?>item/create_full_csv">
                <button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span>
                  <!-- Download CSV -->
                  <?php echo $this->lang->line('btn_download_csv');?>
                </button>
              </a>

              <a href="<?php echo base_url();?>barcode/print_barcode" target="_blank">
                <button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-barcode"> &nbsp;</span>
                  Product Barcode
                  <!-- <?php echo $this->lang->line('btn_download_csv');?> -->
                </button>
              </a>

            </div>
            <!-- /.box-header -->
           
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    <!-- Picture -->
                    <?php echo $this->lang->line('lbl_item_image');?>
                  </th>
                  <th>
                    <!-- Name -->
                    <?php echo $this->lang->line('lbl_item_name');?>
                  </th>
                  <th>
                    HSN Code
                    <!-- <?php echo $this->lang->line('lbl_item_name');?> -->
                  </th>
                  <th>
                    <!-- Category -->
                    <?php echo $this->lang->line('lbl_item_category');?>
                  </th>
                  <th>
                    <!-- Purchase Price -->
                    <?php echo $this->lang->line('lbl_item_purchaseprice');?>
                    (<?php echo $this->session->userdata("currencySymbol");?>)
                  </th>
                  <th>
                    <!-- Sales Price -->
                    <?php echo $this->lang->line('lbl_item_salesprice');?>
                    (<?php echo $this->session->userdata("currencySymbol");?>)
                  </th>
                  <th>
                    <!-- Status -->
                    <?php echo $this->lang->line('lbl_item_status');?>
                  </th>
                  <th>
                    <!-- Action -->
                    <?php echo $this->lang->line('lbl_item_action');?>
                  </th>
                </tr>
                </thead>
                <tbody>
                 
                <?php foreach ($item as $row):?>
                  <tr>
                        <td></td>
                        <td>
                        <?php if(isset($row->picture)){?>
                            <img src="<?php echo base_url();?>uploads/<?php echo $row->picture?>" height="60" width="60">
                        <?php }else{?>
                            <img src="<?php echo base_url();?>assets/logo/no_image.png" height="60" width="60">
                        <?php } ?>
                        </td>
                        <td><?php echo $row->item_name;?></td>
                        <td><?php echo $row->hsn_code;?></td>
                        <td><?php echo $row->category_name;?></td>   
                        <td><?php echo $row->purchase_price;?></td>
                        <td><?php echo $row->sales_price;?></td>
           

                        <td>
                          <?php if($row->status=="0"){?>
                            <span class="label label-success">
                              <!-- Active -->
                              <?php echo $this->lang->line('lbl_status_active');?>
                            </span>
                          <?php } 
                          else {?>
                            <span class="label label-warning">
                              <!-- Deactive -->
                              <?php echo $this->lang->line('lbl_status_deactive');?>
                            </span>
                        <?php } ?>
                        
                        </td>
                        <td>

                          <?php if(in_array("edit_item",$user_session)){ ?>
                          <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>item/edit_item/<?php echo $row->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                          <?php } ?>
                          &nbsp;
                          <?php if(in_array("edit_item",$user_session)){ ?>
                          <a class="btn btn-xs btn-danger" href="#<?php echo'' .$row->id.'';?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                          <i class="fa fa-remove" aria-hidden="true"></i></a>
                          <?php } ?>                          

                        <div class="example-modal">
                            <div class="modal fade" id="<?php echo $row->id;?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                      <!-- !!  Delete Item !! -->
                                      <?php echo $this->lang->line('lbl_item_delete_modal');?>
                                    </h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b>
                                      <!-- Are you sure to delete this Record !!&hellip; -->
                                      <?php echo $this->lang->line('delete_modal');?>
                                    </b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal"> <!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                      <a href="<?php echo base_url();?>item/delete/<?php echo $row->id;?>" class="btn btn-danger">
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
            
          <!-- /.box -->
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

<script type="text/javascript">

  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);

</script>
