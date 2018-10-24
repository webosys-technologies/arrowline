<?php 
	$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_sale",$user_session)){
      redirect('auth','refresh');
  }

?>
<div class="content-wrapper">
    <section class="content">
        <div class="box-footer">
          <h4 class="box-title">
            <!-- Invoice -->
             <?php echo $this->lang->line('lbl_invoice_header');?>
            <?php if(in_array("add_invoice",$user_session)){?>
              <a class="btn btn-primary btn-flat pull-right" href="<?php echo base_url()?>sales/add_form"><i class="fa fa-user-plus"></i> 
              <!-- New Invoice -->
              <?php echo $this->lang->line('btn_add_invoice');?>
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
                    <table id="indexdesc" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                            <!-- Invoice No -->
                            <?php echo $this->lang->line('lbl_invoice_invoiceno');?>
                          </th>
                          <th>
                            <!-- Customer Name -->
                            <?php echo $this->lang->line('lbl_invoice_cust_name');?>
                          </th>
                          <th>
                            <!-- Total Price  -->
                            <?php echo $this->lang->line('lbl_invoice_totalprice');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </th>
                          <th>
                            <!-- Paid Amount  -->
                            <?php echo $this->lang->line('lbl_invoice_paidamount');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
                          </th>
                          <th>
                            <!-- Status -->
                            <?php echo $this->lang->line('lbl_invoice_status');?>
                          </th>
                          <th>
                            <!-- Invoice Date -->
                            <?php echo $this->lang->line('lbl_invoice_date');?>
                          </th>
                          <th>
                            <!-- Action -->
                            <?php echo $this->lang->line('lbl_invoice_action');?>
                          </th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($sales as $value) {?>
                        <tr>
                          <td><a href="<?php echo base_url();?>invoice/invoice_details/<?php echo $value->sales_id;?>"><?php echo $value->invoice_no;?></a></td>
                          <td>
                            <a href="<?php echo base_url();?>customer/edit_data/<?php echo $value->customer_id;?>"><?php echo $value->name;?></a>
                          </td>

                          <!-- <td><?php echo $value->name;?></td> -->
                          <td><?php echo $value->sales_amount + $value->shipping_charges;?></td>
                          <td><?php echo $value->paid_amount;?></td>
                          <td>
                            <?php 
                              if($value->paid_amount == 0)
                              {
                                echo '<span class="label label-danger">'.$this->lang->line('btn_payment_status_unpaid').'</span>';
                              }
                              else if($value->paid_amount < $value->sales_amount)
                              {
                                echo '<span class="label label-info">'.$this->lang->line('btn_payment_status_partially').'</span>'; 
                              }
                              else
                              {
                                echo '<span class="label label-success">'.$this->lang->line('btn_payment_status_paid').'</span>';
                              }
                            ?>
                            </td>
                          <td><?php echo $value->invoice_date;?></td>
                          <td>

                          <?php if(in_array("edit_invoice",$user_session)){ 
                              if($value->status == "draft"){
                            ?>
                            <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>sales/edit_data/<?php echo $value->sales_id;?>" data-tt="tooltip"><span class="fa fa-edit"></span></a>
                          <?php }} ?>
                          &nbsp;

                          <?php  if(in_array("delete_invoice",$user_session)){ 
                                    if($value->paid_amount == 0){
                            ?>
                            <a href="#<?php echo''.$value->sales_id.'';?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger" data-tt="tooltip" title="Delete"><span class="fa fa-remove"></span></a>
                            <?php }} ?>
                             &nbsp;

                          <a title="Print" class="btn btn-xs btn-info" target="_blank" href="<?php echo base_url();?>invoice/sales_print/<?php echo $value->sales_id;?>" data-tt="tooltip"><span class="fa fa-print"></span></a>

                          &nbsp;                          

                          <?php $due = $value->sales_amount - $value->paid_amount;?>
                          <?php 
                            if(isset($user_session)){
                              if(in_array("add_payment",$user_session)){?>
                                <?php if($due > 0){?>
                                    <a href="<?php echo base_url();?>invoice/payment_details/<?php echo $value->sales_id;?>/<?php echo $value->invoice_id;?>" title="Payment" class="btn btn-xs btn-warning" data-tt="tooltip">
                                      <span class="fa fa-cc-mastercard"></span>
                                    </a>
                          <?php }}} ?>


                            <div class="example-modal">
                                    <div class="modal fade" id="<?php echo''.$value->sales_id.'';?>">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <center><h4 class="modal-title">
                                            <!-- !!  Delete Sales !! -->
                                            <?php echo $this->lang->line('lbl_sales_delete_modal');?>
                                            </h4></center>
                                          </div>
                                          <div class="modal-body">
                                            <p><h4><b>
                                              <!-- Are you sure to delete this Record !!&hellip; -->
                                              <?php echo $this->lang->line('delete_modal');?>
                                            </b></h4></p>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">
                                              <!-- Close -->
                                              <?php echo $this->lang->line('btn_modal_close');?>
                                              </button>
                                              <a href="<?php echo base_url();?>sales/delete/<?php echo $value->sales_id; ?>" class="btn btn-danger">
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
                        <?php  } ?>
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