<?php 
  $this->load->view('layout/header');
?>

<?php foreach ($data as $value)?>
<div class="content-wrapper">

	<section class="content">
      <div class="box">
        <div class="box-body">
        <div class="col-md-6">
          <div style="font-weight:bold;font-size:18px;padding-top:5px;">
            <!-- Sales Report On --> 
            <?php echo $this->lang->line('lbl_salesreport_datewise_salesreporton');?>
          </div>
        </div>
          <!-- <div class="col-md-6">
            <div class="btn-group pull-right">
              <a href="<?php echo base_url();?>salesreport/createcsvdDate/<?php echo $value->date;?>" title="CSV" class="btn btn-default btn-flat">  <?php echo $this->lang->line('lbl_salesreport_datewaise_csv');?></a>
              <a href="<?php echo base_url();?>salesreport/orderprintDate/<?php echo $value->date;?>" title="PDF" class="btn btn-default btn-flat"> <?php echo $this->lang->line('lbl_salesreport_datewaise_pdf');?></a>
            </div>
          </div> -->
        </div>
      </div><!--Top Box End-->
       <div class="box">
        <div class="box-body">
          <?php foreach ($total as $value) {
          ?>
          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->qty;?></h3>
              <span class="text-info">
                <!-- Quantity -->
                <?php echo $this->lang->line('lbl_salesreport_datewise_header_quantity');?>
              </span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->sales_value;?></h3>
              <span class="text-info">
              <!--   Sales Value -->
                <?php echo $this->lang->line('lbl_salesreport_datewise_header_salesvalue');?> 
              </span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->cost_volume;?></h3>
              <span class="text-info">
                <!-- Cost Value -->
                <?php echo $this->lang->line('lbl_salesreport_datewise_header_costvalue');?>
              </span>
          </div>

          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo $value->total_tax;?></h3>
              <span class="text-info">
                <!-- Tax -->
                <?php echo $this->lang->line('lbl_salesreport_datewise_header_tax');?>
              </span>
          </div>

          <div class="col-md-2 col-xs-6 text-center">
              <h3 class="bold"><?php echo $value->profit;?></h3>
                            <span class="text-info">
                            <!--   Profit -->
                              <?php echo $this->lang->line('lbl_salesreport_datewise_header_profit');?>
                            </span>
                        </div> 
                  </div>
                </div>
                <?php 
                 }
               ?>

      <!--Top Box End-->
      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div id="salesList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><!-- 
<div class="row">
  <div class="col-sm-6">
    <div class="dataTables_length" id="salesList_length">
    <label>Show 
      <select name="salesList_length" aria-controls="salesList" class="form-control input-sm">

        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select> entries</label>
</div>
</div>
<div class="col-sm-6">
<div id="salesList_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="salesList"></label></div></div></div> -->
<div class="row">
  <div class="col-sm-12">
    <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="salesList_info">
      <thead>
      <tr role="row">

        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Order No: activate to sort column ascending" style="width: 75px;">
        <!--   Order No -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_ordersno');?>
        </th>

        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Customer: activate to sort column ascending" style="width: 101px;">
         <!--  Customer -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_customer');?>
        </th>

        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 74px;">
          <!-- Quantity -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_quantity');?>
        </th>

        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Sales Value($): activate to sort column ascending" style="width: 113px;">
         <!--  Sales Value($) -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_salesvalue');?>
        </th>

        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Cost Value($): activate to sort column ascending" style="width: 107px;">
         <!--  Cost Value($) -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_costvalue');?>
        </th>

        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Tax($): activate to sort column ascending" style="width: 80px;">
         <!--  Tax($) -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_tax');?>
        </th>
        <th class="text-center sorting" tabindex="0" aria-controls="salesList" rowspan="1" colspan="1" aria-label="Profit($): activate to sort column ascending" style="width: 80px;">
         <!--  Profit($) -->
          <?php echo $this->lang->line('lbl_salesreport_datewise_profit');?>
        </th>

        <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Profit Margin(%)" style="width: 135px;">
          <!-- Profit Margin(%) -->
           <?php echo $this->lang->line('lbl_salesreport_datewise_profitmargin');?>
        </th>
        </tr>
      </thead>
      <tbody>            
            <?php 
            foreach ($data as $value) {
              ?>
              <tr role="row" class="even">
                  <td class="text-center"><a href="<?php echo base_url();?>invoice/invoice_details/<?php echo $value->id;?>"><?php echo $value->reference_no;?></a></td>
            
                  <td class="text-center"><a href=""><?php echo $value->name;?></a></td>
                  <td class="text-center"><?php echo $value->qty;?></td>
                  <td class="text-center"><?php echo $value->sales_volume;?></td>
                  <td class="text-center"><?php echo $value->cost_volume;?></td>
                  <td class="text-center"><?php echo $value->tax;?></td>
                  <td class="text-center"><?php echo $value->profit;?></td>
                  <td class="text-center">
                    <?php echo number_format((float)$value->main, 2, '.', '');?>  
                  </td>
                </tr>
            <?php
              }
              ?>
      </tbody>
    </table>
    </div>
  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
    </section>

</div>

<?php 
  $this->load->view('layout/footer');
?>
