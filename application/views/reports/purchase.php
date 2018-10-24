
<?php 
  $this->load->view('layout/header');
?>

<?php foreach ($total as $value) { }?>  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  
  /*   Draw  Bar Chart */

        google.charts.load('current', {'packages':['bar']});
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawBar);
        function drawBar() {
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url();?>purchasereport/getGraph',
              success: function (data1) {
              // Create our data table out of JSON data loaded from server.
              var data = new google.visualization.DataTable();
                      data.addColumn('string', 'date');
                      data.addColumn('number', 'Purchase');
              var jsonData = $.parseJSON(data1);
              for(var i in jsonData){
                  data.addRow([jsonData[i].date, parseInt(jsonData[i].cost)]);
              }

              var options = {
                chart: {
                  title: 'Purchase Report',
                  //subtitle: 'Show Rent,Expense and Income of Company'
                },
                /*width: 900,*/
                height: 500,
                axes: {
                  x: {
                    0: {side: 'bottom'}
                  }
                }
                /*colors: ['blue', 'red',] */
              };
              var chart = new google.charts.Bar(document.getElementById('bar_chart'));
              chart.draw(data, options);
               }
           });
          }

</script>


<!-- <div id="bar_chart"></div>
 -->

<div class="content-wrapper">
  
<section class="content">
   <div class="box">
      <div class="box-body">
        <div class="col-md-9 col-xs-12">
          <form class="form-horizontal" method="POST">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group" style="margin-right: 5px">
                 <label for="sel1"> <!-- Product --> <?php echo $this->lang->line('lbl_purchasereport_producttype');?></label>
                     <div class="form-group">
                       <div class="box-body">
                           <select class="form-control select2" name="item" id="item" tabindex="-1" aria-hidden="true">
                              <option value="">ALL</option>
                              <?php foreach ($item as $value) {?>
                              <option value="<?php echo $value->id;?>"><?php echo $value->item_name;?></option>
                             <?php } ?>
                       </select>
                     </div>
                  </div>
                </div>
               </div>

               <div class="col-md-3">
                 <div class="form-group" style="margin-right: 5px">
                   <label for="sel1"> <!-- Supplier --> <?php echo $this->lang->line('lbl_purchasereport_suppliertype');?></label>
                     <div class="form-group">
                       <div class="box-body">
                           <select class="form-control" name="supplier" id="supplier" tabindex="-1" aria-hidden="true">
                          <option value="">ALL</option>
                          <?php foreach ($supplier as $value) {?>
                              <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                             <?php } ?>
                       </select>
                     </div>
                   </div>
                </div>
               </div>

               <div class="col-md-3">
                 <div class="form-group">
                    <label for="location"> <!-- Location --> <?php echo $this->lang->line('lbl_purchasereport_location');?></label>
                     <div class="form-group">
                       <div class="box-body">
                           <select class="form-control" name="location" id="location" tabindex="-1" aria-hidden="true">
                               <option value="">ALL</option>
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
                  
                  <?php echo $this->lang->line('lbl_purchasereport_type');?></label>
                   <div class="form-group">
                       <div class="box-body">
                           <select class="form-control" name="type" id="type" required="" tabindex="-1" aria-hidden="true">
                                <option value="daily" selected="">Daily</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                               <option  value="custom">Custom</option>
                        </select>
                    </div>
                </div>
              </div>   
              </div>           --> 

              <!-- <div class="col-md-3 dateField">
                 <div class="form-group" style="margin-right: 5px">
                      <label for="exampleInputEmail1"> 
                            <?php echo $this->lang->line('lbl_purchasereport_from');?> </label>
                           <div class="input-group">
                                <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                               </div>
                   <input class="form-control" id="datepicker" type="text" name="from" value="<?php echo date('Y-m-d');?>">
                   </div>
                 </div>
              </div> -->
              
            <!-- <div class="col-md-3 dateField">
              <div class="form-group">
                  <label for="exampleInputEmail1"> 
                  
                  <?php echo $this->lang->line('lbl_purchasereport_to');?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="datepicker1" type="text" name="to" value="<?php echo date('Y-m-d');?>">
                  </div>
              </div>
              </div> -->

            <div class="col-md-3 yearField" style="display: none;">
               <div class="form-group">
                  <label for="exampleInputEmail1"> Year </label>
                       <div class="input-group">
                           <select class="form-control select2 select2-hidden-accessible" name="year" id="year" style="width:'100%' " tabindex="-1" aria-hidden="true">
                                 <option value="all">All</option>
                                  <option value="2017">2017</option>
                                <option value="2016">2016</option>
                          </select>
                      </div>
                 </div>
              </div>

              
              <div class="col-md-3 monthField" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1">Month</label>
                  <div class="input-group">
                  <select class="form-control" name="month" id="month" style="width:'100%' " tabindex="-1" aria-hidden="true">
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
                <button type="submit" name="btn" id="btn" class="btn btn-primary btn-flat"> <!-- Filter -->  <?php echo $this->lang->line('lbl_purchasereport_filter');?></button>
                </div>
              </div>
              </div>
             </div>

          </form>
          </div>
          <div class="col-md-3 col-xs-12">
            <br>
            <div class="btn-group pull-right">
              <a href="<?php echo base_url();?>purchasereport/create_csv" title="CSV" class="btn btn-default btn-flat" id="csv"> <!-- CSV -->  <?php echo $this->lang->line('lbl_purchasereport_csv');?></a>
              <a href="<?php echo base_url();?>purchasereport/orderPrint/<?php echo $value->id;?>" title="PDF" class="btn btn-default btn-flat" id="pdf" target="_blank"> <!-- PDF -->  
              <?php echo $this->lang->line('lbl_purchasereport_pdf');?></a>
            </div>
          </div>
        </div>
        <br>
      </div><!--Top Box End-->
      
      <div class="box">
        <div class="box-body">
          <?php foreach ($total as $value) { ?>  
          <div class="col-md-4 col-xs-6 border-right text-center">
          
              <h3 class="bold"><?php echo $value->id;?></h3>
              <span class="text-info"> <!-- No Of Orders -->  <?php echo $this->lang->line('lbl_purchasereport_header_nooforders');?></span>
          </div>
          <div class="col-md-4 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->qty;?></h3>
              <span class="text-info"> <!-- Purchase Volume -->  <?php echo $this->lang->line('lbl_purchasereport_header_purchasevolume');?> </span>
          </div>
          <div class="col-md-4 col-xs-6 text-center">
              <h3 class="bold"><?php echo $value->cost;?></h3>
              <span class="text-info"> <!-- Cost Value -->  <?php echo $this->lang->line('lbl_purchasereport_header_costvalue');?></span>
          </div>
         
        </div>
      </div>
           <?php
              }
              ?>
       
     

      <div class="box">
            <div class="box-body">
              <div id="reportList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
               <!-- <div class="row">-->
              <!--<div class="col-sm-6">
              <div class="dataTables_length" id="reportList_length">
              <label>Show <select name="reportList_length" aria-controls="reportList" class="form-control input-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
              </select> </label>
             
              <label>entries</label>
              </div>
              </div>-->
              
             <!-- <div class="col-sm-6">

              <div id="reportList_filter" class="dataTables_filter">
              <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="reportList"></label>
              </div>
              </div>
              </div>-->
              <div class="row">
              <div class="col-sm-12">
              <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="reportList_info">
                <thead>
                <tr role="row">
                  <th class="text-center sorting" tabindex="0" aria-controls="reportList" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 144px;"> <!-- Date -->  <?php echo $this->lang->line('lbl_purchasereport_date');?></th>

                  <th class="text-center sorting" tabindex="0" aria-controls="reportList" rowspan="1" colspan="1" aria-label="No Of Orders: activate to sort column ascending" style="width: 226px;"> <!-- No Of Orders -->  <?php echo $this->lang->line('lbl_purchasereport_nooforders');?></th>

                  <th class="text-center sorting" tabindex="0" aria-controls="reportList" rowspan="1" colspan="1" aria-label="Purchase Volume: activate to sort column ascending" style="width: 287px;"> <!-- Purchase Volume  --> <?php echo $this->lang->line('lbl_purchasereport_salesvolume');?></th>

                  <th class="text-center sorting" tabindex="0" aria-controls="reportList" rowspan="1" colspan="1" aria-label="Cost Value(Rp): activate to sort column ascending" style="width: 251px;"> 
                   <!--  Cost Value(Rp) --> 
                     <?php echo $this->lang->line('lbl_purchasereport_costvalue');?></th>
                </tr>
                </thead>
                <tbody>
                
                <?php foreach ($purchase as $value) { ?>
                 <tr>
                  <td class="text-center"><a href="<?php echo base_url();?>purchasereport/date/<?php echo $value->date;?>"><?php echo $value->date;?></a></td>
                  <td class="text-center"><?php echo $value->total;?></td>
                  <td class="text-center"><?php echo $value->qty;?></td>
                  <td class="text-center"><?php echo $value->cost_volume;?></td>
                  </tr>
              <?php } ?>
               
              </tbody>
              </table>
               </div>
               </div>

         <!-- <div class="row">-->
            <!--<div class="col-sm-5">
             <div class="dataTables_info" id="reportList_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
                </div>-->
               <!--<div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="reportList_paginate">
                    <ul class="pagination">
                          <li class="paginate_button previous disabled" id="reportList_previous"><a href="#" aria-controls="reportList" data-dt-idx="0" tabindex="0">Previous</a></li>
                          <li class="paginate_button active"><a href="#" aria-controls="reportList" data-dt-idx="1" tabindex="0">1</a></li>
                          <li class="paginate_button next disabled" id="reportList_next"><a href="#" aria-controls="reportList" data-dt-idx="2" tabindex="0">Next</a></li>
                    </ul>
                </div>
                </div>
                </div>-->
                </div> 
            </div>
      </div>

       <div class="box">
           <div class="box-body">
              <div id="bar_chart" class="col-sm-12">
                
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
          var supplier_id=$('#supplier').val();
          var location_id=$('#location').val();
          /*var type=$('#type').val();
          var from1=$('#datepicker').val();
          var to1=$('#datepicker1').val();*/
          
          //alert(item_id+'=='+location_id+'=='+supplier_id);

          $.ajax({
             url:"<?php echo base_url();?>purchasereport/myFunction",
             type:"POST",
             data:{
              item1:item_id,
              supplier1:supplier_id,
              location1:location_id
              },
             dataType:"json", 
             success:function(data)
             {
             // alert(data); 
              var table="";
              $('#example1 tbody').html("");
              for(var i = 0; i< data.length;i++) 
              {
                  table +='<tr>'+
                      '<td class="text-center"><a href="<?php echo base_url();?>purchasereport/date/'+data[i].date+'">'+data[i].date+'</td>'+
                      '<td class="text-center">'+data[i].no_of_order+'</td>'+
                      '<td class="text-center">'+data[i].purchase_volume+'</td>'+
                      '<td class="text-center">'+data[i].cost_value+'</td>'+
                    '</tr>';
              }

              $('#example1 tbody').html(table); 
             }
          });
          e.preventDefault();
       });
    });
</script>  

   