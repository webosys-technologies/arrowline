<?php 
  $this->load->view('layout/header');
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
 google.charts.load('current', {'packages':['line']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawLine);
        function drawLine() {
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>Salesreport/graph',
            success: function (data1) {
            // Create our data table out of JSON data loaded from server.
            //alert(data1);
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Date');
                data.addColumn('number', 'Sales');
                data.addColumn('number', 'Cost');
                data.addColumn('number', 'Profit');
                var jsonData = $.parseJSON(data1);
                for (var i = 0; i < jsonData.length; i++) {
                      data.addRow([jsonData[i].date, parseInt(jsonData[i].sales_volume), parseInt(jsonData[i].cost_volume),parseInt(jsonData[i].profit)]);
                }
                var options = {
                  chart: {
                    title: 'Company Performance',
                    subtitle: 'Show Sales volume, Cost volume And Profit of Company'
                  },
                  height: 500,
                  axes: {
                    x: {
                      0: {side: 'bottom'} 
                    }
                  }
                };
                var chart = new google.charts.Line(document.getElementById('line_chart'));
                chart.draw(data, options);
            }
         });
        }
</script>

<div class="content-wrapper">
  <section class="content">
     <div class="box-footer">
         <div class="box-body">
            <form class="form-horizontal" action="" method="POST">
          <div class="col-sm-9 col-xs-12">
             <div class="row">
               <div class="col-sm-3">
                    <div class="box-body">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1">
                    <!-- Product -->
                    <?php echo $this->lang->line('lbl_salesreport_producttype');?>
                  </label>
                  <div class="form-group">
                     <select class="form-control select2" id="item" name="item">
                          <option value="">All</option>
                          <?php foreach ($item as $value) {?>
                              <option value="<?php echo $value->id;?>"><?php echo $value->item_name;?></option>
                          <?php } ?>
                      </select>
                      </div>
                  </div>
                </div>
               </div>

             
           <div class="col-md-3">
           <div class="box-body">
               <div class="form-group" style="margin-right: 5px">
                    <label for="sel1">
                      <!-- Customer -->
                      <?php echo $this->lang->line('lbl_salesreport_customertype');?>
                    </label>
                      <div class="form-group">
                           <select class="form-control select2" id="customer" name="customer">
                                
                                <option value="">All</option>
                              <?php foreach ($customer as $value) {?>
                              <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                             <?php } ?>
                         </select>
                      </div>
                      </div>
                  </div>
               </div>


           <div class="col-md-3">
              <div class="form-group">
              <div class="box-body">
                  <label for="location">
                   <!--  Location -->
                    <?php echo $this->lang->line('lbl_salesreport_location');?>
                  </label>
                    <div class="form-group">
                        <select class="form-control select2" id="location" name="location">
                                
                                <option value="">All</option>
                              <?php foreach ($location as $value) {?>
                              <option value="<?php echo $value->id;?>"><?php echo $value->location_name;?></option>
                             <?php } ?>
                       </select>
                       </div>
                   </div>
               </div>
           </div>               
       </div>
           
    <div class="row">
          <!-- <div class="col-md-3">
            <div class="form-group" style="margin-right: 5px">
              <label for="exampleInputEmail1">
                
                <?php echo $this->lang->line('lbl_salesreport_type');?>
              </label>
                <div class="form-group">
                     <select class="form-control select2" name="type" id="type">
                        <option value="daily" selected="">Daily</option>
                        <option value="monthly">Monthly</option>
                         <option value="yearly">Yearly</option>
                        <option value="custom">Custom</option>
                   </select>
                </div>
                </div>
          </div> -->              

            <!-- <div class="col-md-3 dateField">
              <div class="form-group" style="margin-right: 5px">
                  <label for="exampleInputEmail1">
                  
                    <?php echo $this->lang->line('lbl_salesreport_from');?>
                  </label>
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i>
                    </div>
                  <input class="form-control" id="datepicker" type="text" name="from" value="<?php echo date('Y-m-d');?>">
                  </div>
                </div>
            </div>
              
          <div class="col-md-3 dateField">
              <div class="form-group">
                  <label for="exampleInputEmail1">
                    
                      <?php echo $this->lang->line('lbl_salesreport_to');?>
                  </label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="datepicker1" type="text" name="to" value="<?php echo date('Y-m-d');?>">
                  </div>
              </div>
          </div> -->

          <div class="col-md-3 yearField" style="display: none;">
            <div class="form-group">
                <label for="exampleInputEmail1">Year</label>
                  <div class="input-group">
                  <select class="form-control">
                     <option value="all">All</option>
                     <option value="2017">2017</option>
                  </select>>
              </div>
              </div>
              </div>

              
          <div class="col-md-3 monthField" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1">Month</label>
                      <div class="input-group">
                           <select class="form-control">
                                <option value="all">All</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                 <option value="07">July</option>
                                 <option value="08">August</option>
                                 <option value="09">September</option>
                                 <option value="10">October</option>
                                 <option value="11">November</option>
                                 <option value="12">December</option>
                        </select>
                  </div>
                </div>
              </div>
          </div>
     <div class="row">
         <div class="col-md-1">
             <div class="form-group">
                <div class="input-group">
              <input type="submit" name="submit" id="btn" class="btn btn-primary btn-flat" value="Filter">
                </div>
              </div>
              </div>
             </div>
          </div>
          </form>
<div class="col-md-3 col-xs-12"><br>
    <div class="btn-group pull-right">
            <a href="<?php echo base_url();?>Salesreport/createCsv" title="CSV" class="btn btn-default btn-flat" id="csv"><!--  CSV -->   <?php echo $this->lang->line('lbl_salesreport_csv');?></a>
              <a href="<?php echo base_url();?>Salesreport/orderPrint" title="PDF" class="btn btn-default btn-flat" id="pdf" target="_blank"><!--  PDF -->   <?php echo $this->lang->line('lbl_salesreport_pdf');?></a>
            </div>
          </div>
        </div>
     <br>
</div>
<br>
<div class="box">

        <div class="box-body">
          <?php foreach ($total as $value) {?>
          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->id;?></h3>
              <span class="text-info">
               <!--  No Of Orders -->
                  <?php echo $this->lang->line('lbl_salesreport_header_nooforders');?>
              </span>
          </div>
          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->qty;?></h3>
              <span class="text-info">
              <!--   Sales Volume -->
                  <?php echo $this->lang->line('lbl_salesreport_header_salesvolume');?>
              </span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->sales_volume;?></h3>
              <span class="text-info">
              <!--   Sales Value -->
                  <?php echo $this->lang->line('lbl_salesreport_header_salesvalue');?> 
              </span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->cost_volume;?></h3>
              <span class="text-info">
               <!--  Cost Value -->
                  <?php echo $this->lang->line('lbl_salesreport_header_costvalue');?>
              </span>
          </div>
          <div class="col-md-2 col-xs-6 text-center">
              <h3 class="bold"><?php echo $value->profit;?></h3>
             <span class="text-info">
             <!--  Profit -->
                <?php echo $this->lang->line('lbl_salesreport_profit');?>
            </span>
        </div>

        <?php
        }
        ?>
          </div>
          </div>
          
        
       
                                                                                                                 
<div class="box">
    <div class="box-body">
       <div id="salesList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
         <!-- <div class="row">
             <div class="col-sm-6">
                <div class="dataTables_length" id="salesList_length">
                   <label>Show<select name="salesList_length" aria-controls="salesList" class="form-control input-sm">
                           <option value="10">10</option>
                           <option value="25">25</option>
                           <option value="50">50</option>
                           <option value="100">100</option>
                  </select> entries</label>
             </div>
       </div>
    <div class="col-sm-6">
        <div id="salesList_filter" class="dataTables_filter">
            <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="salesList"></label>
        </div>
    </div>
    </div>-->
       <div class="row">
          <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr role="row">
                    <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 68px;">
                     <!--  Date -->
                        <?php echo $this->lang->line('lbl_salesreport_date');?>
                      </th>
                          <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="No Of Orders: activate to sort column ascending" style="width: 116px;">
                            <!-- No Of Orders -->
                              <?php echo $this->lang->line('lbl_salesreport_nooforders');?>
                          </th>

                          <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Sales Volume: activate to sort column ascending" style="width: 120px;">
                          <!--   Sales Volume -->
                              <?php echo $this->lang->line('lbl_salesreport_salesvolume');?>
                          </th>

                          <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Sales Value($): activate to sort column ascending" style="width: 126px;">
                            <!-- Sales Value($) -->
                              <?php echo $this->lang->line('lbl_salesreport_salesvalue');?>
                          </th>

                          <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Cost Value($): activate to sort column ascending" style="width: 119px;">
                           <!--  Cost Value($) -->
                              <?php echo $this->lang->line('lbl_salesreport_costvalue');?>
                          </th>

                          <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Profit($): activate to sort column ascending" style="width: 90px;">
                           <!--  Profit($) -->
                              <?php echo $this->lang->line('lbl_salesreport_profit');?>
                          </th>

                          <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Profit Margin(%): activate to sort column ascending" style="width: 149px;">
                           <!--  Profit Margin(%) -->
                              <?php echo $this->lang->line('lbl_salesreport_profitmargin');?>
                          </th></tr>
                   </tr>
                    </thead>
                    <tbody id="suraj">
                      <?php foreach ($sales as $value) {?>
                      <tr>
                      <td class="text-center"><a href="<?php echo base_url();?>Salesreport/date/<?php echo $value->date;?>"><?php echo $value->date;?></a></td>
                      <td class="text-center"><?php echo $value->id;?></td>
                      <td class="text-center"><?php echo $value->qty;?></td>
                      <td class="text-center"><?php echo $value->sales_volume;?></td>
                      <td class="text-center"><?php echo $value->cost_volume;?></td>
                      <td class="text-center"><?php echo $value->profit;?></td>
                      <td class="text-center"><?php echo number_format((float)$value->main, 2, '.', '');?></td>
                       </tr>
                     <?php } ?>
                    </tbody>
               </table>
          </div>
      </div>
<!--  <div class="row">
       <div class="col-sm-5">
          <div class="dataTables_info" id="salesList_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
      </div>
      
  <div class="col-sm-7">
       <div class="dataTables_paginate paging_simple_numbers" id="salesList_paginate">
   <ul class="pagination">
        <li class="paginate_button previous disabled" id="salesList_previous"><a href="#" aria-controls="salesList" data-dt-idx="0" tabindex="0">Previous</a></li>
       <li class="paginate_button active"><a href="#" aria-controls="salesList" data-dt-idx="1" tabindex="0">1</a></li>
       <li class="paginate_button next disabled" id="salesList_next"><a href="#" aria-controls="salesList" data-dt-idx="2" tabindex="0">Next</a>
                       </li>
                       </ul>
                     </div>
                  </div>
                </div>-->
               </div>
             </div>
        </div>
    </section>
  </div>



<?php 
  $this->load->view('layout/footer');
?>

<script type="text/javascript">
 $(document).ready(function(){
       $("#btn").click(function(e){ 
          var item_id=$('#item').val();
          var customer_id=$('#customer').val();
          var location_id=$('#location').val();
          //var type=$('#type').val();
          /*var from1=$('#datepicker').val();
          var to1=$('#datepicker1').val();*/
          
          //alert("item :"+item_id + "cust :"+customer_id + "location :"+location_id );
         $.ajax({
             url:"<?php echo base_url();?>Salesreport/myFunction",
             type:"POST",
             data:{
              item1:item_id,
              customer1:customer_id,
              location1:location_id
              },
             dataType:"json", 
             success:function(data)
             {
              
                var table="";
                $('#example1 tbody').html("");
                for(var i = 0; i< data.length;i++) 
                {
                    var percent = data[i].main;
                     table +='<tr>'+
                        '<td class="text-center"><a href="<?php echo base_url();?>Salesreport/date/'+data[i].date+'">'+data[i].date+'</td>'+
                        '<td class="text-center">'+data[i].id+'</td>'+
                        '<td class="text-center">'+data[i].qty+'</td>'+
                        '<td class="text-center">'+data[i].sales_volume+'</td>'+
                        '<td class="text-center">'+data[i].cost_volume+'</td>'+
                        '<td class="text-center">'+data[i].profit+'</td>'+
                        '<td class="text-center">'+ parseFloat(percent).toFixed(2) +'</td>'+
                      '</tr>';
                      
                }
                
                $('#example1 tbody').html(table);
            
             }
          });
          e.preventDefault();
       });
    });
</script>  