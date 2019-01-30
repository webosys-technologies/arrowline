<?php 
  //$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
?>
<?php foreach ($orderdetails as $value)?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Ledger
		
	</title>
	<style type="text/css">
		.table td{
			border: 1px solid black;
		}
		.table th{
			border: 1px solid black;
		}
		.table{
			margin: 10px;
		}
		.footerpad
		{
			padding: 4px;
		}
		.footerpad{
			padding: 5px;
		}
		.minheight{
		    min-height: 1000px;
		}
		.fontS{
			font-size: 10px;
		}
		.fontH{
			font-size: 11px;
		}
	</style>
</head>
<body>

	<table width="100%" border="1" cellspacing="50" style="border: 0px solid black; border-collapse: collapse;" class="table" cellpadding="2">
<!--			<tr>
				<td colspan="6" style="border: 0px;text-align: right;">Order Invoice</td>
				<td colspan="8" style="border: 0px;text-align: right;">(ORIGINAL FOR RECIPIENT)</td>
			</tr>-->

			
    			
    					<tr>
    						<td valign="right" style="border: 0px;font-size:13px;">
    							<?php if(isset($country->loginpage_image)){?>
    								<img src="<?php echo base_url();?>/assets/images/<?php echo $country->invoice_image;?>" width="80" height="50">	
    							<?php }else{?>
    								<img src="<?php echo base_url();?>/assets/images/invoice_logo.jpeg;?>" width="70" height="50">
    							<?php } ?>
    						</td>
    						<td style="border: 0px;font-size: 13px;">
    							<b><?php if(isset($country->name)){echo $country->name;}?></b><br>
			    				
			    					<b>Address :</b><?php if(isset($country->street)){echo $country->street;}?><br> 
									<?php if(isset($country->city_name)){echo $country->city_name;}?> <br>
									<?php if(isset($country->state_name)){echo $country->state_name;} ?><br>
									<?php if(isset($country->country_name)){echo $country->country_name;} ?> - <?php if(isset($country->zip_code)){echo $country->zip_code;}?><br>
									<?php if(isset($country->phone)){echo $country->phone;} ?><br>
									GSTIN/UIN : <?php if(isset($country->gstin)){echo $country->gstin;} ?><br>
									Email : <?php if(isset($country->email)){echo $country->email;} ?><br>
								
    						</td>
    					</tr>
    				
    		
		
	</table>
    <table>
        <tr>
            <th>Supplier Name:</th><td><?php echo $customer;?></td><td></td><td></td><td></td><td  style='text-align:right'><?php echo $from?> to <?php echo $to;?></td>
        </tr>
        
    </table>
    <table width="100%" border="1px" style="border: 1px solid black; border-collapse: collapse;" class="table">
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
        <?php 
        $cr=0;
        $db=0;
        $temp=0;
        $temp1=0;
        if(isset($ledger_data))
        { 
          
     foreach ($ledger_data as $ledger) {
         $cr=$cr+$ledger->credit;
         $db=$db+$ledger->debit;
         ?>
        <tr>
          <td><?php echo $ledger->date;?></td>
            <td><?php echo $ledger->purchase_no;?></td>
            <td><?php echo $ledger->debit;?></td>
            <td><?php echo $ledger->credit;?></td>           
        </tr>
        
        <?php } } ?>
        
    </table>
    <h4 style='text-align:right'>Closing Balance: <?php echo $db-$cr; ?></h4>
	<table>
		<tr>
        	<td colspan="11" style="border:0px;text-align: center;font-size: 13px;"><b>This is Computer Generated Ledger</b></td>
        </tr>
	</table>
</body>
</html>