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
            <li  class="active">
              <a href="<?php echo base_url();?>reports/team_view">
                <!-- Purchases Orders -->
                <?php echo $this->lang->line('lbl_teammember_purchasereport_purchaseorders');?>
              </a>
            </li>

            <li class="">
              <a href='<?php echo base_url();?>reports/quotation'>
               <!--  Quotations -->
                <?php echo $this->lang->line('lbl_teammember_purchasereport_quotation');?>
              </a>
            </li>
            
            <li class="">
              <a href='<?php echo base_url();?>reports/invoice'>
               <!--  Invoices -->
                <?php echo $this->lang->line('lbl_teammember_purchasereport_invoices');?>
              </a>
            </li>

            <li class="">
              <a href='<?php echo base_url();?>reports/payment'>
               <!--  Payments -->
                <?php echo $this->lang->line('lbl_teammember_purchasereport_payments');?>
              </a>
            </li>

       </ul>
      <div class="clearfix"></div>
   </div>
</div>
        <h3>
          <!-- Admin -->
        <?php echo $this->lang->line('lbl_teammember_purchasereport_admin');?>
      </h3> 
         <div class="box">
            <!-- /.box-header -->
            <div class="box-body">       
          <div class="col-md-12 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action="" method="POST" id="">
              
              <div class="col-md-2">
                  <label for="exampleInputEmail1">
                   <!--  From -->
                    <?php echo $this->lang->line('lbl_teammember_purchasereport__from');?>
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
                   <!--  To -->
                    <?php echo $this->lang->line('lbl_teammember_purchasereport__to');?>
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
                 <!--  Supplier -->
                  <?php echo $this->lang->line('lbl_teammember_purchasereport__supplier');?>
                </label>
                <select class="form-control select2" name="supplier" id="supplier" required>
                      <option value="all">All</option>
                          <?php foreach($supply as $row1)
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

              <div class="col-md-2">
                <label for="exampleInputEmail1">
                 <!--  Location -->
                  <?php echo $this->lang->line('lbl_teammember_purchasereport__location');?>
                </label>
                <select class="form-control select2" name="location" id="location" required>
                        <option value="all">All</option>
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
                <button type="submit" name="btn" id="btn" class="btn btn-primary btn-flat"> <!-- Filter --> <?php echo $this->lang->line('lbl_teammember_purchasereport__filter');?></button>
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
                    <th width="10%">
                     <!--  Invoice -->
                      <?php echo $this->lang->line('lbl_teammember_purchasereport__invoice');?>
                    </th>
                    <th>
                      <!-- Supplier Name -->
                      <?php echo $this->lang->line('lbl_teammember_purchasereport__suppliername');?>
                    </th> 
                    <th>
                      <!-- Total -->
                      <?php echo $this->lang->line('lbl_teammember_purchasereport__total');?>
                    </th>
                    <th>
                     <!--  Quotation Date -->
                      <?php echo $this->lang->line('lbl_teammember_purchasereport__quotation');?>
                    </th>
                    <th width="10%" class="hideColumn">
                     <!--  Action -->
                      <?php echo $this->lang->line('lbl_teammember_purchasereport__action');?>
                    </th>
                  </tr>
                  </thead>
                  <tbody id="purchase">
                    <?php foreach ($supplier as $row):?>
                    <tr>
                      <td><?php echo $row->reference_no;?></td>
                      <td><?php echo $row->name;?></td>
                      <td><?php echo $row->total_amount;?></td>
                      <td><?php echo $row->date;?></td>                 
                      <td>
                        <!--  -->
                      </td>
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
          var supplier_id=$('#supplier').val();
          var location_id=$('#location').val();
          var from_date=$('#datepicker').val();
          var to_date=$('#datepicker1').val();
          
          alert(supplier_id+'=='+location_id+'=='+from_date+'=='+to_date);

          $.ajax({
             url:"<?php echo base_url();?>reports/purchase_filter",
             type:"POST",
             data:{
              
              supplier1:supplier_id,
              location1:location_id,
              st_date:from_date,
              end_date:to_date,
              },
             dataType:"json", 
             success:function(data)
             {
              
             
              //alert("success"); 
              var table="";
               $('#purchase').html("");
                for(var i = 0; i< data.length;i++) 
                {
                    
                    table+='<tr>'+
                        '<td class="text-center">'+data[i].reference_no+'</td>'+
                        '<td class="text-center">'+data[i].name+'</td>'+
                        '<td class="text-center">'+data[i].total_amount+'</td>'+
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