<?php 
	$this->load->view('layout/header');
?>
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script> -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i> 
              <!-- Home -->
              <?php echo $this->lang->line('home');?>
            </a>
          </li>
          <li class="active">
            <!-- Transaction -->
            <?php echo $this->lang->line('lbl_transaction_header');?>
          </li>
        </ol>  
      </h5>
      
    </section>    





    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="box">
        <div class="box-body">
          <div class="col-md-7 col-xs-12">
            <div class="row">
              <form class="form-horizontal" action="" method="POST" id=''>
                
                <div class="col-md-3">
                  <label for="exampleInputEmail1">
                   Account
                      <!-- <?php echo $this->lang->line('lbl_saleshistoryreport_customertype');?> -->
                  </label>
                  <select class="form-control select2" name="account" id="account" required>
                          <option value="all">All</option>
                            <?php foreach($account as $row){?>
                              <option value="<?php echo $row->id;?>">
                                  <?php echo $row->account_name;?>
                              </option>
                            <?php } ?>
                  </select> 
                </div>


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

                

                <div class="col-md-1">
                  <label for="btn">&nbsp;</label>
                  <button type="submit" name="filterbtn" id="filterbtn" class="btn btn-primary btn-flat"> <!-- Filter -->   <?php echo $this->lang->line('lbl_saleshistoryreport_filter');?></button>
                </div>
              </form>
            </div>
          </div>

        </div>
        <br>
      </div><!--Top Box End-->  



      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title"> List Of Users</h3>
            </div> -->

            <div class="box-header with-border">

              <h3 class="box-title" style="padding: 5px;"><i class="fa  fa-user"></i>       <!-- Transaction -->
                <?php echo $this->lang->line('lbl_transaction_header');?>
              </h3>
              <!-- <a class="btn btn-primary btn-flat" style="float: right;" href="<?php echo base_url()?>purchases/purchases_add"><i class="fa fa-user-plus"></i>purchases_list</a> -->
            </div>

            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="indexdesc" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_transaction_date');?>
                  </th>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_transaction_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_transaction_accountno');?>
                  </th>
                  <th>
                    <!-- Type -->
                    <?php echo $this->lang->line('lbl_transaction_type');?>
                  </th>
                  <th>
                    <!-- Category -->
                    <?php echo $this->lang->line('lbl_transaction_category');?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_transaction_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_transaction_amount');?>
                  </th>
                </tr>
                </thead>

                <tbody id="transaction">
                   <?php
                  foreach ($data as $value) {
                ?>
                <tr>
                  <td><?php echo $value->date;?></td>
                  <td><?php echo $value->account_name;?></td>
                  <td><?php echo $value->account_no;?></td>
                  <td><?php echo $value->type;?></td>
                  <td><?php echo $value->name;?></td>
                  <td><?php echo $value->description;?></td>
                  <td><?php echo $value->amount;?></td>
                  
                </tr>
                <?php
                   }
                ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_transaction_date');?>
                  </th>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_transaction_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_transaction_accountno');?>
                  </th>
                  <th>
                    <!-- Type -->
                    <?php echo $this->lang->line('lbl_transaction_type');?>
                  </th>
                  <th>
                    <!-- Category -->
                    <?php echo $this->lang->line('lbl_transaction_category');?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_transaction_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_transaction_amount');?>
                  </th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <section class="content">
    </section>
  </div>

<?php 
	$this->load->view('layout/footer');
?>

<script type="text/javascript">
 $(document).ready(function(){
   
       $("#filterbtn").click(function(e){ 
          
          //var item_id=$('#item').val();
          var account_id=$('#account').val();
          var from_date=$('#datepicker').val();
          var to_date=$('#datepicker1').val();
          
          //alert(account_id+'=='+from_date+'=='+to_date);

          $.ajax({
             url:"<?php echo base_url();?>transaction/transaction_filter",
             type:"POST",
             data:{
              account:account_id,
              st_date:from_date,
              end_date:to_date,
              },
             dataType:"json", 
             success:function(data)
             {
             //alert("success"); 
                  var table = $('#indexdesc').DataTable();
                  table.destroy();
                  $('#transaction').empty();
                for(var i = 0; i< data.length;i++) 
                {
                    //var profit = data[i].margin;
                    table +='<tr>'+
                        '<td class="text-center">'+data[i].date+'</td>'+
                        '<td class="text-center">'+data[i].account_name+'</td>'+
                        '<td class="text-center">'+data[i].account_no+'</td>'+
                        '<td class="text-center">'+data[i].type+'</td>'+
                        '<td class="text-center">'+data[i].name+'</td>'+
                        '<td class="text-center">'+data[i].description+'</td>'+
                        '<td class="text-center">'+data[i].amount+'</td>'+
                        /*'<td class="text-center">'+data[i].profit+'</td>'+
                        '<td class="text-center">'+parseFloat(profit).toFixed(2)+'</td>'+*/
                      '</tr>';  
                } 
                ///alert(table);    
                //$('#sales').html(table); 
                $('#indexdesc tbody').html(table); 
                $(document).ready(function() {
                var t = $('#indexdesc').DataTable( {
                  "columnDefs": [ {
                      "searchable": false,
                      "orderable": false,
                      "targets": 0
                  } ],
                  "order": [[ 0, 'desc' ]]
                });
           
                t.on( 'order.dt search.dt', function () {
                  t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                      //cell.innerHTML = i+1;
                  });
                }).draw();
      });


             }
          });
          e.preventDefault();
       });
    });
</script>  
<!-- <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#indexdesc').DataTable( {
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 0, 'desc' ]]
        });
   
        t.on( 'order.dt search.dt', function () {
          t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              //cell.innerHTML = i+1;
          });
        }).draw();
      });
    </script> -->