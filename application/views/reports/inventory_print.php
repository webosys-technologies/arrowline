<!DOCTYPE html>
<html>
<head>
  <title>
      Sales Reports
  </title>
  <style type="text/css">
    .table td{
      border: 1px solid black;
    }
    .table th{
      border: 1px solid black;
    }
   
  </style>
</head>
<body>
<center><h4>Inventory Stock On Hand</h4></center>
  <table width="100%" border="1" style="border: 1px solid black; border-collapse: collapse" class="table">
    <thead>
      <tr>
          <th class="text-center">
            <!-- Product -->
            <?php echo $this->lang->line('lbl_inventory_pdf_product');?>
          </th>
          <th class="text-center">
            Warehouse Name
            <!-- <?php echo $this->lang->line('lbl_inventory_pdf_product');?> -->
          </th>
          <th class="text-center">
            <!-- In Stock -->
            <?php echo $this->lang->line('lbl_inventory_pdf_instock');?>
          </th>
          <th class="text-center">
           <!--  Retail Price -->
            <?php echo $this->lang->line('lbl_inventory_pdf_retailprice');?>
          </th>
          <th class="text-center">
            <!-- In Value -->
            <?php echo $this->lang->line('lbl_inventory_pdf_invalue');?>
          </th>
          <th class="text-center">
           <!--  Retail Value -->
            <?php echo $this->lang->line('lbl_inventory_pdf_retailvalue');?>
          </th>
          <th class="text-center">
           <!--  Profit Value -->
            <?php echo $this->lang->line('lbl_inventory_pdf_profitvalue');?>
          </th>
          <th class="text-center">
           <!--  Profit Margin -->
            <?php echo $this->lang->line('lbl_inventory_pdf_profitmargin');?>
          </th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($orderdetails as $value) { ?>
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
      <?php 
      
      } ?>

    </tbody>
  </table>
  <br><br>
</body>
</html>


