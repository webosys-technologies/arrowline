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
<center><h4>Purchase Reports</h4></center>
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
            Supplier
          </th>
          <th>
            Total
            (<?php echo $this->session->userdata("currencySymbol");?>)
          </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderdetails as $value) { ?>
      <tr>
        <td><?php if(isset($value->reference_no)){echo $value->reference_no;}?></td>
        <td><?php if(isset($value->date)){echo $value->date;}?></td>
        <td><?php if(isset($value->name)){echo $value->name;}?></td>
        <td align="right">
          <?php if(isset($value->total_amount)){echo number_format((float)$value->total_amount, 2, '.', '');}?> 
        </td>
      </tr>
      <?php 
      
      } ?>

    </tbody>
  </table>
  <br><br>
</body>
</html>