<?php // 
  $this->load->view('layout/header'); 

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_quotation",$user_session)){
      redirect('auth','refresh');
  }

?>

 <div class="content-wrapper">
    <section class="content">
        <div class="box-footer">
            <h4 class="box-title">
            <!-- Quotation   -->
              <?php echo "Sales Order";?>
              <?php if(in_array("add_quotation",$user_session)){?>
                <a class="btn btn-primary btn-flat pull-right" href="<?php echo base_url()?>Order/add_form"><i class="fa fa-plus"></i>
                 <!-- New Quotation -->
                 <?php echo "New Order";?>
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
            <?php //echo $this->session->flashdata('fail');?>
          </div>
      <?php } ?>

  <div class="row">
    <div class="col-xs-12">
       <div class="box">
            <div class="box-body">
               <table id="indexdesc" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>
                        <!-- Quotation No -->
                        <?php echo "Order No";?>
                      </th>
                      <th>
                        <!-- Customer Name -->
                        <?php echo $this->lang->line('lbl_cust_name');?>
                      </th>
                      <th>
                        <!-- Quantity -->
                        <?php echo $this->lang->line('lbl_quotation_quantity');?>
                      </th>
                      <th>
                        <!-- Total  -->
                        <?php echo $this->lang->line('lbl_quotation_total');?>
                        (<?php echo $this->session->userdata("currencySymbol");?>)
                      </th>
                      <th>
                        <!-- Quotation Date -->
                        <?php echo $this->lang->line('lbl_quotation_date');?>
                      </th>
                      <th>
                        <!-- Action -->
                        <?php echo $this->lang->line('lbl_quotation_action');?>
                      </th>
                  </tr>
                </thead>
                <tbody>
                <?php if(isset($orders)){
//                    print_r($orders);
                    foreach ($orders as $value){ 
                        $invoice=$this->Order_model->getInvoiceDetails($value->order_id);
                  ?>
                  <tr>
                      <td><a href="<?php echo base_url();?>order/order_details/<?php echo $value->order_id;?>"><?php echo $value->reference_no;?></td>
                      <td><a href="<?php echo base_url();?>customer/edit_data/<?php echo $value->customer_id;?>"><?php echo $value->name;?></a></td>
                      <td><?php echo $value->salesqty;?></td>
                      <td><?php echo $value->total_amount;?></td>
                      <td><?php echo $value->date;?></td>
                      <td>

                        <?php 
                          if($value->status == "draft"){
                        ?>

                        <?php if(in_array("edit_quotation",$user_session)){?>
                          <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>quotation/edit_data/<?php echo $value->order_id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                        <?php }} ?>

                        <!-- <a title="Edit" class="btn btn-xs btn-danger" href="<?php echo base_url();?>invoice/edit"><span class="fa fa-remove"></span></a> -->


                        <?php if(in_array("delete_quotation",$user_session)){?>
                          <a href="#<?php echo''.$value->order_id.'';?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger" title="Delete" data-tt="tooltip"><span class="fa fa-remove"></span></a>
                        <?php } ?>

                        <a title="Print" class="btn btn-xs btn-info" target="_blank" href="<?php echo base_url();?>order/order_print/<?php echo $value->order_id;?>" data-tt="tooltip"><span class="fa fa-print"></span></a>
                         <?php if(!isset($invoice)){ ?>
                        <a title="Convert" class="btn btn-xs btn-warning" href="<?php echo base_url();?>order/convert_invoice/<?php echo $value->order_id;?>" data-tt="tooltip"><span class="glyphicon glyphicon-share"></span></a>
                         <?php } ?>       
                         <!--<a title="Convert" class="btn btn-xs btn-info" href="<?php echo base_url();?>order/order_details/<?php echo $value->order_id;?>" data-tt="tooltip"><span class="glyphicon glyphicon-share"></span></a>-->

                        <div class="example-modal">
                          <div class="modal fade" id="<?php echo''.$value->order_id.'';?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <center><h4 class="modal-title">
                                    <!-- !!  Delete Quotation !! -->
                                    <?php echo $this->lang->line('lbl_quotation_delete_modal');?>
                                  </h4></center>
                                </div>
                                <div class="modal-body">
                                  <p><h4><b>
                                    <!-- Are you sure to delete this Record !!&hellip; -->
                                    <?php echo $this->lang->line('delete_modal');?>
                                  </b></h4></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                                    <?php echo $this->lang->line('btn_modal_close');?>
                                    </button>
                                    <a href="<?php echo base_url();?>quotation/delete/<?php echo $value->order_id; ?>" class="btn btn-danger">
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
                  <?php } }?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
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