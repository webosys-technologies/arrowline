<?php 
	$this->load->view('layout/header');
?>


<div class="content-wrapper">
    <section class="content">

      <div class="box-footer">
        <div class="box-body">
          <div class="col-md-6 col-xs-12">
                <div class="row">
                    <form class="form-horizontal"  method="POST">
                  
                      <div class="col-md-5">
                            <label for="exampleInputEmail1">
                              <!-- Product Type -->
                              <?php echo $this->lang->line('lbl_inventory_producttype');?>
                            </label>
                            <select class="form-control" name="item" id="item">
                                <option value="all">All Type</option>
                                <?php foreach ($item as $value) {?>
                                  <option value="<?php echo $value->id;?>"><?php echo $value->item_name;?></option>
                                <?php } ?>
                            </select>
                      </div>

                      <div class="col-md-5">
                          <label for="exampleInputEmail1">
                           <!--  Location -->
                            <?php echo $this->lang->line('lbl_inventory_location');?>
                          </label>
                          <select class="form-control" name="location" id="location">
                            <option value="all">All Location</option>
                            <?php foreach ($location as $value) {?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->location_name;?></option>
                           <?php } ?>
                          </select>
                      </div>

                      <div class="col-md-2">
                          <label for="pwd">&nbsp;</label>
                             <button type="submit" id="btn" class="btn btn-primary btn-flat">
                              <!-- Filter -->
                               <?php echo $this->lang->line('lbl_inventory_filter');?>
                            </button>
                      </div>
                    </form>
                </div>
          </div>
          <div class="col-md-6 col-xs-12"><br>
              <div class="btn-group pull-right">
                  <a href="<?php echo base_url();?>inventorystockhand/create_csv" title="CSV" class="btn btn-default btn-flat" id="csv"><!-- CSV --> <?php echo $this->lang->line('lbl_inventory_csv');?></a>
                  <a target="_blank" href="<?php echo base_url();?>inventorystockhand/orderPrint" title="PDF" class="btn btn-default btn-flat" id="pdf"><!-- PDF --> <?php echo $this->lang->line('lbl_inventory_pdf');?></a>
              </div>
          </div>
        </div>
      </div> 



      </br>
      <div class="box-footer">
          <div class="box-body">
            <?php foreach ($total as $value) {?>

                    <div class="col-md-3 col-xs-6 border-right">
                        <h3 class="bold"><?php echo $value->qty;?></h3>
                        <span class="text-info">
                          <!-- Total Units on Hand -->
                           <?php echo $this->lang->line('lbl_inventory_totalunitsonhand');?>
                        </span>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right">
                        <h3 class="bold"><?php echo $value->invalue;?></h3>
                        <span class="text-info">
                         <!--  Cost Value of Stock on Hand -->
                          <?php echo $this->lang->line('lbl_inventory_costvalueofstockonhand');?>
                        </span>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right">
                        <h3 class="bold"><?php echo $value->retail;?></h3>
                        <span class="text-info">
                         <!--  Retail Value of Stock on Hand  -->
                          <?php echo $this->lang->line('lbl_inventory_retailvalueofstockhand');?>
                        </span>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <h3 class="bold"><?php echo $value->profit;?></h3>
                        <span class="text-info">
                         <!--  Profit Value of Stock on Hand -->
                          <?php echo $this->lang->line('lbl_inventory_rprofitvalueofstockhand');?>
                        </span>
                    </div>          
            <?php } ?>
          </div>
      </div>
      <br>
                
            
      <div class="box-footer">
          <div class="row">
            <div class="col-xs-12">
                <div class="box btn-flat">
                  <div class="box-body">
                    <table id="example1" class="table">
                      <thead>
                        <tr>
                              <th>
                               <!--  Product --> 
                                <?php echo $this->lang->line('lbl_inventory_product');?>
                              </th>
                              <th>
                                Warehouse
                                <!-- <?php echo $this->lang->line('lbl_inventory_product');?> -->
                              </th>
                              <th><!-- In Stock --> 
                                <?php echo $this->lang->line('lbl_inventory_intock');?>
                              </th>
                              <th>
                                <!-- Retail Price  -->
                                <?php echo $this->lang->line('lbl_inventory_retailprice');?>
                              </th>
                              <th>
                               <!--  In Value --> 
                                <?php echo $this->lang->line('lbl_inventory_invalue');?>
                              </th>
                              <th>
                               <!--  Retail Value --> 
                                <?php echo $this->lang->line('lbl_inventory_retailvalue');?>
                              </th>
                              <th>
                                <!-- Profit Value --> 
                                <?php echo $this->lang->line('lbl_inventory_profitvalue');?>
                              </th>
                              <th>
                               <!--  Profit Value  -->
                                <?php echo $this->lang->line('lbl_inventory_profitmargin');?>
                              </th>
                        </tr>
                      </thead>
                      <tbody id="suraj">
                        <?php foreach ($warehouse as $value) {?>
                          <tr>
                              <td><?php echo $value->product;?></td>
                              <td><?php echo $value->location_name;?></td>
                              <td><?php echo $value->qty;?></td>
                              <td><?php echo $value->sales_price;?></td>
                              <td><?php echo $value->value;?></td>
                              <td><?php echo $value->retail;?></td>
                              <td><?php echo $value->profit;?></td>
                              <td class="text-center"><?php echo number_format((float)$value->main, 2, '.', '');?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
          </div>
      </div>
    </section>
</div>


<?php 
	$this->load->view('layout/footer');
?>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js">
</script> -->
<script type="text/javascript">
 $(document).ready(function(){
  
       $("#btn").click(function(e){ 
      
          var item_id=$('#item').val();
          var location_id=$('#location').val();
          
          $.ajax({
             url:"<?php echo base_url();?>inventorystockhand/myFunction",
             type:"POST",
             data:{
              item1:item_id,
              location1:location_id,
              },
             dataType:"json", 
             success:function(data)
             {
                
              var table="";
              $('#suraj').html("");
              for(var i = 0; i< data.length;i++) 
              {
                   //alert(data[i].product);
                   var profit = data[i].main;
                    table +='<tr>'+
                      '<td>'+data[i].product+'</td>'+
                      '<td>'+data[i].location_name+'</td>'+
                      '<td>'+data[i].qty+'</td>'+
                      '<td>'+data[i].sales_price+'</td>'+
                      '<td>'+data[i].value+'</td>'+
                      '<td>'+data[i].retail+'</td>'+
                      '<td>'+data[i].profit+'</td>'+
                      '<td>'+ parseFloat(profit).toFixed(2) +'</td>'+
                    '</tr>';
              }
              $('#example1 tbody').html(table);  
              
             }
          });
          e.preventDefault();
       });
    });
</script>

