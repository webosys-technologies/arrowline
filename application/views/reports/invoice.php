<?php 
  $this->load->view('layout/header');
?>

<div class="content-wrapper">
    <div id="notifications" class="row no-print">
      <div class="col-md-12">
                
      </div>
    </div>
            <!-- Main content -->
  <section class="content">
      <!--Default box -->
    <div class="box">
      <div class="panel-body">
        <ul class="nav nav-tabs cus" role="tablist">
            <li  class="">
            <a href='<?php echo base_url();?>reports/team_view'> 
              <!-- Purchases Orders --> 
             <?php echo $this->lang->line('lbl_teammember_invoice_purchaseorders');?></a>
            </li>

            <li class="">
              <a href='<?php echo base_url();?>reports/quotation'> 
               <!--  Quotations -->
                 <?php echo $this->lang->line('lbl_teammember_invoice_quotation');?>
              </a>
            </li>
            
            <li class="active">
              <a href='<?php echo base_url();?>reports/invoice'>
               <!--  Invoices -->
                 <?php echo $this->lang->line('lbl_teammember_invoice_invoice');?>
              </a>
            </li>

            <li class="">
              <a href='<?php echo base_url();?>reports/payment'>
                P<!-- ayments -->
                 <?php echo $this->lang->line('lbl_teammember_invoice_payments');?>
              </a>
            </li>

       </ul>
      <div class="clearfix"></div>
   </div>
</div>        
 <h3>
<!-- Admin -->
 <?php echo $this->lang->line('lbl_teammember_invoice_admin');?>
</h3> 
        
         <div class="box">
            <!-- /.box-header -->
            <div class="box-body">       
          <div class="col-md-12 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action="" method="POST" id=''>
              <div class="col-md-2">
                  <label for="exampleInputEmail1">
                    <!-- From -->
                     <?php echo $this->lang->line('lbl_teammember_invoice_from');?>
                  </label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="datepicker" type="text" name="from" value="<?php echo date('Y-m-d');?>" required>
                  </div>
              </div>
              
              <div class="col-md-2">
                  <label for="exampleInputEmail1">
                    <!-- To -->
                    <?php echo $this->lang->line('lbl_teammember_invoice_to');?>  
                  </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="datepicker1" type="text" name="to" value="<?php echo date('Y-m-d');?>" required>
                  </div>
              </div>

              <div class="col-md-2">
                <label for="exampleInputEmail1">
                  <!-- Customer -->
                   <?php echo $this->lang->line('lbl_teammember_invoice_customer');?>
                </label>
                <select class="form-control select2" name="customer" id="customer" required>
                      <option value="all" selected>All</option>
                      <?php 
                            
                                foreach($cust as $row)
                                {
                          ?>
                            <option value="<?php echo $row->id;?>">
                                <?php echo $row->name;?>
                            </option>
                          <?php 
                            }
                          ?>
                </select>
              </div>

              <div class="col-md-2">
                <label for="exampleInputEmail1">
                 <!--  Location -->
                 <?php echo $this->lang->line('lbl_teammember_invoice_location');?>
               </label>
                <select class="form-control select2" name="location" id="location" required>
                      <option value="all" selected>All</option>
                      <?php 
                                foreach($location as $row)
                                {
                          ?>
                            <option value="<?php echo $row->id;?>">
                                <?php echo $row->location_name;?>
                            </option>
                          <?php 
                            }
                          ?>
                </select>
              </div>

              <div class="col-md-1">
                <label for="btn">&nbsp;</label>
                <button type="submit" name="btn" id="btn" class="btn btn-primary btn-flat"> <!-- Filter  --> <?php echo $this->lang->line('lbl_teammember_invoice_filter');?></button>
              </div>
            </form>
          </div>
          </div>
          </div>
      </div> 

        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>
                      <!-- Invoice -->
                       <?php echo $this->lang->line('lbl_teammember_invoice_invoice');?>
                    </th>
                    <th>
                    <!--   Quotation -->
                       <?php echo $this->lang->line('lbl_teammember_invoice_quotation');?>
                    </th>
                    <th>
                      <!-- Customer Name -->
                       <?php echo $this->lang->line('lbl_teammember_invoice_customername');?>
                    </th>
                    <th>
                      <!-- Total Price -->
                       <?php echo $this->lang->line('lbl_teammember__invoice_totalprice');?>
                    </th>
                    <th>
                     <!--  Paid Amount -->
                       <?php echo $this->lang->line('lbl_teammember__invoice_paidamount');?>
                    </th>
                    <th>
                     <!--  Status -->
                       <?php echo $this->lang->line('lbl_teammember__invoice_status');?>
                    </th>
                    <th>
                     <!--  Invoice Date -->
                       <?php echo $this->lang->line('lbl_teammember_invoice_invoicedate');?>
                    </th>
                    
                  </tr>
                  </thead>
                  <tbody id="invoice">
                    <?php foreach ($invoice as $row):?>
                      <tr>
                          
                          <td><?php echo $row->invoice_no;?></td>
                          <td><?php echo $row->reference_no;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->sales_amount;?></td>
                          <td><?php echo $row->paid_amount;?></td>
                          <td>
                            <?php 
                                if($row->paid_amount==0)
                                {?>
                                  <span class="label label-danger">Unpaid</span>
                                <?php
                                  }
                                  else if($row->sales_amount == $row->paid_amount)
                                  {?>
                                    <span class="label label-success">paid</span>
                                  <?php  }
                                  else{?>

                                    <span class="label label-warning">Partialy paid</span>
                                  <?php } ?>
                          </td>
                          <td><?php echo $row->invoice_date;?></td>
                      </tr>
                  <?php endforeach;?>      
                  </tbody>    
              </table>             
            </div>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.box-footer-->
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
</section>
    <!-- /.content -->
 </div>
 <?php 
  $this->load->view('layout/footer');
?>

<script type="text/javascript">
 $(document).ready(function(){
   
       $("#btn").click(function(e){ 
          
          //var item_id=$('#item').val();
          var customer_id=$('#customer').val();
          var location_id=$('#location').val();
          var from_date=$('#datepicker').val();
          var to_date=$('#datepicker1').val();
          
          alert(customer_id+'=='+location_id+'=='+from_date+'=='+to_date);

          $.ajax({
             url:"<?php echo base_url();?>reports/invoice_filter",
             type:"POST",
             data:{
              
              customer1:customer_id,
              location1:location_id,
              st_date:from_date,
              end_date:to_date,
              },
             dataType:"json", 
             success:function(data)
             {
              
             
              //alert("success"); 
              var table="";
               $('#invoice').html("");
                for(var i = 0; i< data.length;i++) 
                {
                    table+='<tr>'+
                        '<td class="text-center">'+data[i].invoice_no+'</td>'+
                        '<td class="text-center">'+data[i].reference_no+'</td>'+
                        '<td class="text-center">'+data[i].name+'</td>'+
                        '<td class="text-center">'+data[i].total_amount+'</td>'+
                        '<td class="text-center">'+data[i].paid_amount+'</td>'+
                        '<td class="text-center">'+data[i].status+'</td>'+
                        '<td class="text-center">'+data[i].date+'</td>'+
                        
                      '</tr>';  
                }
                 
            $('#example1 tbody').html(table); 
             }
          });
          e.preventDefault();
       });
    });
</script>  