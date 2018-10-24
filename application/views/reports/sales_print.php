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
<center><h4>Sales Reports</h4></center>
  <table width="100%" border="1" style="border: 1px solid black; border-collapse: collapse" class="table">
    <thead>
      <tr>
          <th>
            Invoice No
          </th>
          <th>
            Date
          </th>
          <th>
            Customer Name
          </th>
          <th>
            Customer GSTIN
          </th>
          <th>
            Phone
          </th>
          <th style="text-align: center;">
            Tax Amount
            (<?php echo $this->session->userdata("currencySymbol");?>)
          </th>
          <th style="text-align: center;">
            <!-- Discount -->
            <?php echo $this->lang->line('lbl_add_quotation_discount');?>
            (<?php echo $this->session->userdata("currencySymbol");?>)
          </th>
          <th style="text-align: center;">
            <!-- SGST -->
            <?php echo $this->lang->line('lbl_sgst');?>
          </th>
          <th style="text-align: center;">
            <!-- CGST -->
            <?php echo $this->lang->line('lbl_cgst');?>
          </th>
          <th style="text-align: center;">
            <!-- IGST -->
            <?php echo $this->lang->line('lbl_igst');?>
          </th>
          <th style="text-align: center;">
            <!-- Total Sales -->
            <?php echo $this->lang->line('lbl_total_sales');?>
            (<?php echo $this->session->userdata("currencySymbol");?>)
          </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderdetails as $value) { ?>
      <tr>
        <td><?php if(isset($value->reference_no)){echo $value->reference_no;}?></td>
        <td><?php if(isset($value->dates)){echo $value->dates;}?></td>
        <td><?php if(isset($value->customer_Name)){echo $value->customer_Name;}?></td>
        <td><?php if(isset($value->Customer_GSTIN)){echo $value->Customer_GSTIN;}?></td>
        <td align="center"><?php if(isset($value->phone)){echo $value->phone;}?></td>
        <td align="center"><?php if(isset($value->TaxAmount)){echo $value->TaxAmount;}?></td>
        <td align="right"><?php if(isset($value->DiscountValue)){echo $value->DiscountValue;}?></td>
        <td align="right">
          <?php if(isset($value->CGST)){echo number_format((float)$value->CGST, 2, '.', '');}?>   
        </td>
        <td align="right"><?php if(isset($value->SGST)){echo number_format((float)$value->SGST, 2, '.', '');}?></td>
        <td align="right"><?php if(isset($value->IGST)){echo number_format((float)$value->IGST, 2, '.', '');}?></td>
        <td align="right">
          <?php if(isset($value->SalesAmount)){echo number_format((float)$value->SalesAmount, 2, '.', '');}?> 
        </td>
      </tr>
      <?php 
      
      } ?>

    </tbody>
  </table>
  <br><br>
</body>
</html>