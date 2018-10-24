<?php 
	$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_payment",$user_session)){
      redirect('auth','refresh');
  }


?>
<div class="content-wrapper">
    <section class="content">
     <div class="box-footer">
          <h4 class="box-title">
            <!-- Payment -->
            <?php echo $this->lang->line('payment_header');?>
          </h4>
      </div>
      <br>   
      <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>
            <?php echo $this->lang->line('alert');?>
            </h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
      <?php } ?>
       <div class="row">
          <div class="col-xs-12">
             <div class="box">
             <!--   <div class="box-header">
                  <h3 class="box-title" style="padding: 8px;">Payment</h3>
             
                </div>
          <br/> -->
        
    <div class="box-body">
           <table id="indexdesc" class="table table-bordered table-striped">
               <thead>
                <tr>
                    <th>
                      <!-- Payment No -->
                      <?php echo $this->lang->line('lbl_payment_paymentno');?>
                    </th>
                    <th>
                      <!-- Invoice No -->
                      <?php echo $this->lang->line('lbl_payment_invoiceno');?>
                    </th>
                    <th>
                      <!-- Customer Name -->
                      <?php echo $this->lang->line('lbl_payment_custname');?>
                    </th>
                    <th>
                      <!-- Payment Method -->
                      <?php echo $this->lang->line('lbl_payment_paymentmethod');?>
                    </th>
                    <th>
                      <!-- Amount  -->
                      <?php echo $this->lang->line('lbl_payment_amount');?>
                      (<?php echo $this->session->userdata("currencySymbol");?>)
                    </th>
                    <th>
                      <!-- Payment Date -->
                      <?php echo $this->lang->line('lbl_payment_date');?>
                    </th>
                    <th>
                      <!-- Status -->
                      <?php echo $this->lang->line('lbl_payment_status');?>
                    </th>
                    <th>
                      <!-- Action -->
                      <?php echo $this->lang->line('lbl_payment_action');?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payment as $value) {?>
                <tr>
                  <td><a href="<?php echo base_url();?>payment/receipt/<?php echo $value->payment_id;?>/<?php echo $value->sales_id;?>"><?php echo $value->payment_no;?></a></td>
                  <td><a href="<?php echo base_url();?>invoice/invoice_details/<?php echo $value->sales_id;?>"><?php echo $value->reference_no;?></a></td>
                  <td><a href="<?php echo base_url();?>customer/edit_data/<?php echo $value->customer_id;?>"><?php echo $value->cust_name;?></a></td>
                  <td><?php echo $value->payment_method;?></td>
                  <td><?php echo $value->amount;?></td>
                  <td><?php echo $value->payment_date;?></td>
                  <td>
                  <?php 
                    if($value->status == 0)
                    {
                      echo '<span class="label label-danger">'.$this->lang->line('lbl_payment_status_pending').'</span>';
                    }
                    else
                    {
                      echo '<span class="label label-success">'.$this->lang->line('lbl_payment_status_complete').'</span>';
                    }
                  ?>

                  </td>
                  <td>

                    <a  title="View" class="btn btn-xs btn-primary" href='<?php echo base_url();?>payment/receipt/<?php echo $value->payment_id;?>/<?php echo $value->sales_id;?>' data-tt="tooltip"><span class="fa fa-eye"></span></a>
                    &nbsp;
                    <?php if(in_array("delete_payment",$user_session)){ ?>
                      <a href="#<?php echo''.$value->payment_id.'';?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger" data-tt="tooltip" title="Delete"><span class="fa fa-remove"></span></a>
                    <?php } ?>

                    <div class="example-modal">
                      <div class="modal fade" id="<?php echo''.$value->payment_id.'';?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <center><h4 class="modal-title">
                                <!-- !!  Delete Sales !! -->
                                <?php echo $this->lang->line('lbl_payment_delete_modal');?>
                              </h4></center>
                            </div>
                            <div class="modal-body">
                              <p><h4><b>
                                <!-- Are you sure to delete this Record !!&hellip; -->
                                <?php echo $this->lang->line('delete_modal');?>
                              </b></h4></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_modal_close');?></button>
                                <a href="<?php echo base_url();?>payment/delete/<?php echo $value->payment_id; ?>" class="btn btn-danger" ><?php echo $this->lang->line('btn_modal_delete');?></a>
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
                <?php } ?>
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