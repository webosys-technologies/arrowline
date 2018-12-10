<?php 
  $this->load->view('layout/header');
?>
<?php 
//  foreach ($profit as $value) {
//    # code...
//  }
?>
<div class="content-wrapper">
    <div id="notifications" class="row no-print">
      <div class="col-md-12">
                
      </div>
    </div>
      <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-body">
          <div class="col-md-7 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action="" method="POST" id=''>
              
              <div class="col-md-4">
                  <label for="exampleInputEmail1">
                    <!-- From -->
                      <?php echo $this->lang->line('lbl_saleshistoryreport_from');?>
                  </label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="datepicker" type="text" name="from" value="<?php echo date('Y-m-d');?>" required>
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="exampleInputEmail1">
                    <!-- To -->
                      <?php echo $this->lang->line('lbl_saleshistoryreport_to');?>
                  </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="datepicker1" type="text" name="to" value="<?php echo date('Y-m-d');?>" required>
                  </div>
              </div>

              <div class="col-md-3">
                <label for="exampleInputEmail1">
                 <!--  Customer -->
                    <?php echo $this->lang->line('lbl_saleshistoryreport_customertype');?>
                </label>
                <select class="form-control select2" name="customer" id="customer" required>
                        <option value="all">All</option>
                          <?php 
                            
                                foreach($customer as $row1)
                                {
                          ?>
                            <option value="<?php echo $row1->id;?>">
                                <?php echo $row1->name;?>
                            </option>
                          <?php 
                            }
                          ?>
                </select> 
              </div>

              <div class="col-md-1">
                <label for="btn">&nbsp;</label>
                <button type="submit" name="filterbtn" id="filterbtn" class="btn btn-primary btn-flat"> <!-- Filter -->   <?php echo $this->lang->line('lbl_saleshistoryreport_filter');?></button>
              </div>
            </form>
            </div>
            </div>
          <div class="col-md-5 col-xs-12">
            <br>
            <div class="btn-group pull-right">
              <a href="<?php echo base_url();?>reports/create_csv" title="CSV" class="btn btn-default btn-flat" id="csv"> <!-- CSV  -->  <?php echo $this->lang->line('lbl_saleshistoryreport_csv');?> </a>
              <!-- <a href="<?php echo base_url();?>reports/sales_pdf" title="PDF" class="btn btn-default btn-flat" id="pdf">PDF</a> -->
            </div>

          </div>

        </div>
        <br>
      </div><!--Top Box End-->         
        
      
      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">
                  <!--   Date -->
                      <?php echo $this->lang->line('lbl_saleshistoryreport_date');?>
                  </th>
                  <th class="text-center">
                    <!-- Invoice No -->
                      <?php echo 'Invoice No'//$this->lang->line('lbl_saleshistoryreport_quotationno');?>
                  </th>
                  <th class="text-center">
                   <!--  Customer -->
                      <?php echo $this->lang->line('lbl_saleshistoryreport_customer');?>
                  </th>          
                  <th class="text-center">
                    <!-- Sale Id -->
                      <?php echo 'Sale Id'//$this->lang->line('lbl_saleshistoryreport_quantity');?>
                  </th>
                  <th class="text-center">
                  <!--   Sales Value -->
                      <?php echo 'Sales Value'//$this->lang->line('lbl_saleshistoryreport_salesvalue');?>
                  </th>
                  <th class="text-center">
                   <!--  Paid Value -->
                      <?php echo 'Paid Value'//$this->lang->line('lbl_saleshistoryreport_costvalue');?>
                  </th>
                  
                </tr>
                </thead>
<!--                <tbody id="sales">
                        <?php foreach ($sales as $row):?>
                  <tr>
                          
                          <td><?php echo $row->date;?></td>
                          <td><?php echo $row->reference_no;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->qty;?></td>
                          <td><?php echo $row->retail;?></td>
                          <td><?php echo $row->purchase;?></td>
                          <td><?php echo $row->total_tax;?></td>
                          <td><?php echo $row->profit;?></td>
                          <td>
                            <?php echo number_format((float)$row->margin, 2, '.', '');?>
                             <?php echo $row->margin;?> 
                            
                          </td>   
                  </tr>

                <?php endforeach;?>                                       
                
                </tbody>-->
              </table>
            </div>
            <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>

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
<?php 
  $this->load->view('layout/footer');
?>

<script type="text/javascript">
 $(document).ready(function(){
   
       $("#filterbtn").click(function(e){ 
          
          //var item_id=$('#item').val();
          var customer_id=$('#customer').val();
          var from_date=$('#datepicker').val();
          var to_date=$('#datepicker1').val();
          
          //alert(customer_id+'=='+from_date+'=='+to_date);

          $.ajax({
             url:"<?php echo base_url();?>Ledger/ledger_filter",
             type:"POST",
             data:{
              
              customer1:customer_id,
              st_date:from_date,
              end_date:to_date,
              },
             dataType:"json", 
             success:function(data)
             {
             //alert("success"); 
              var table="";
               $('#sales').html("");
                for(var i = 0; i< data.length;i++) 
                {
                    var profit = data[i].margin;
                    table +='<tr>'+
                        '<td class="text-center">'+data[i].date+'</td>'+
                        '<td class="text-center">'+data[i].invoice_no+'</td>'+
                        '<td class="text-center">'+data[i].name+'</td>'+
                        '<td class="text-center">'+data[i].id+'</td>'+
                        '<td class="text-center">'+data[i].sales_amount+'</td>'+
                        '<td class="text-center">'+data[i].paid_amount+'</td>'+
                      '</tr>';  
                }     
                //$('#sales').html(table); 
                 $('#example1 tbody').html(table); 
             }
          });
          e.preventDefault();
       });
    });
</script>  






