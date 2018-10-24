<!DOCTYPE html>
<html>
<head>
  <title>
      Barcode
  </title>
  <style type="text/css">
    

  </style>
</head>
<body>
          <center>
            <table width="40%" align="center">
                <tr>
                <?php
                $i=0;
                foreach ($barcode as $value) {
                  if($i==2){
                    $i=0;
                    echo "<tr>";
                  }
                  ?>
                  <?php if(isset($value->bar_code)){?>
                  <td align="center" style="height: 100px;">
                    <b><?php echo $value->item_name; ?></b><br>
                    
                    <img src="<?php echo base_url();?>assets/barcode/<?php echo $value->bar_code;?>"><br>
                    
                  </td>
                  <?php
                  $i++;
                  }}
                ?>
                </tr>
            </table>
          </center>
</body>
</html>