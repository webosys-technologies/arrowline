<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
?>
<?php foreach ($purchasedetail as $value)?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<!-- INVOICE -->
		<!-- <?php echo $this->lang->line('lbl_invoice_header');?> -->
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
	</style>
</head>
<body>
	<table style="border:0px solid black;margin: 0px; width:100%; font-size: 14px;height:100%; font-family: arial;">
		<tr>
			<td style="font-size: 16px;font-weight: bold;">
				<?php if(isset($country->name)){echo $country->name;} ?>
			</td>
			<td align="right">
				<?php echo $this->lang->line('lbl_invoice_header');?>
			</td>
		</tr>
		<tr>
			<td char="" olspan="2"></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="2"><?php if(isset($country->street)){echo $country->street;} ?></td>
		</tr>
		<tr>
			<td><?php if(isset($country->city_name)){echo $country->city_name;} ?>,<?php if(isset($country->zip_code)){echo $country->zip_code;} ?></td>
			<td align="right">INVOICE #<?php if(isset($value->reference_no)){echo $value->reference_no;} ?></td>
			<td align="right"></td>
		</tr>
		<tr>
			<td> <?php echo $this->lang->line('lbl_add_teammember_phone');?> <?php if(isset($country->phone)){echo $country->phone;} ?></td>
			<td align="right"><?php echo $this->lang->line('date');?> : <?php if(isset($value->date)){echo $value->date;} ?></td>
		</tr>
		<tr><td>GSTIN : <?php if(isset($country->gstin)){echo $country->gstin;}?></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td style="font-size:20px;font-weight: bold;"><b><?php echo $this->lang->line('lbl_bill_to');?> </b></td>
			<td style="font-size: 20px;font-weight: bold;"><b><?php if(isset($country->name)){echo $country->name;} ?> </b></td>
		</tr>
		<tr>
			<td><?php if(isset($value->name)){echo $value->name;} ?></td>
			<td><?php if(isset($country->name)){echo $country->name;} ?></td>
		</tr>
		<tr>
			<td><?php if(isset($value->street)){echo $value->street;} ?></td>
			<td><?php if(isset($country->street)){echo $country->street;} ?></td>
		</tr>
		<tr>
			<td><?php if(isset($value->cust_city)){echo $value->cust_city.','.$value->zipcode;} ?></td>
			<td><?php if(isset($country->city_name)){echo $country->city_name.','.$country->zip_code;} ?></td>
		</tr>
		<tr>
			<td>phone :<?php if(isset($value->phone)){echo $value->phone;} ?></td>
			<td>Phone :<?php if(isset($country->phone)){echo $country->phone;} ?></td>
		</tr>
		<tr>
			<td colspan="2">GSTIN :<?php if(isset($value->gstin)){echo $value->gstin;} ?></td>
			
		</tr>
	</table>
	<br><br>

	<table width="100%" border="1" cellspacing="0" style="border: 1px solid black; border-collapse: collapse" class="table">
		<thead>
			<tr>
    			<th style="text-align: center;">
    				<!-- NO -->
    				<?php echo $this->lang->line('no');?> 
    			</th>
    			<th width="20%" style="text-align: center;">
    				<!-- Item Name -->
    				<?php echo $this->lang->line('add_item_name');?> 
    			</th>
<!--    			<th width="">
    				 Item Description 
    				<?php echo $this->lang->line('lbl_addpurchase_description');?>
    			</th>-->
    			<th width="">
    				<!-- HSN/SAC Code -->
    				<?php echo $this->lang->line('lbl_hsn_code');?>
    			</th>
    			<th style="text-align: center;">
    				Qty
    				<!-- <?php echo $this->lang->line('lbl_addpurchase_quantity');?> -->
    			</th>
    			<th style="text-align: center;">
    				<!-- Rate  -->
    				<?php echo $this->lang->line('lbl_add_quotation_rate');?>
    				(<?php echo $this->session->userdata("currencySymbol");?>)
    			</th>
    			<th style="text-align: center;">
    				<!-- Total Sales -->
    				<?php echo $this->lang->line('lbl_total_sales');?>
    				(<?php echo $this->session->userdata("currencySymbol");?>)
    			</th>
<!--    			<th style="text-align: center;" width="5%">
    				 Discount 
    				<?php echo $this->lang->line('lbl_add_quotation_discount');?>(%)
    			</th>
    			<th style="text-align: center;">
    				 Discount Value 
    				<?php echo $this->lang->line('lbl_discount_value');?>
    			</th>-->
    			<th style="text-align: center;">
    				<!-- Taxable Value -->
    				<?php echo $this->lang->line('lbl_taxable_value');?>
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
    				<!-- Subtotal --> 
    				<?php echo $this->lang->line('lbl_add_quotation_amount');?>
    				(<?php echo $this->session->userdata("currencySymbol");?>)
    			</th>
    		</tr>
		</thead>
		<tbody>
			<?php 
              $qty_total=0;
              $sub_total=0;$cnt = 1;
              $total_salesvalue = 0;
              $total_discount = 0;
              $total_tax = 0;
              $total_sgst = 0;
              $total_cgst = 0;
              $total_igst = 0;
            ?>

            <?php
              foreach ($purchase as $value) {
                $qty_total=$qty_total + $value->qty; 
                $sub_total=$sub_total + $value->amount;

                $total_sales = $value->qty * $value->rate;
                $discount_value = ($total_sales * $value->discount / 100);
                $taxable_value = $total_sales - $discount_value;

                /*$sgst = $value->tax_amount/2;
                $cgst = $value->tax_amount/2;*/

                $sgst = 0;
                $cgst = 0;
                $igst = 0;

                $sgst_percent ='';
                $cgst_percent ='';
                $igst_percent ='';

                if($country->state_id == $value->state_id)
                {
                  $sgst = $value->tax_amount/2;
                  $cgst = $value->tax_amount/2;  

                  $sgst_percent = $value->tax_value/2;
                  $cgst_percent = $value->tax_value/2;

                }
                else
                {
                  $igst = $value->tax_amount;  
                  $igst_percent = $value->tax_value;
                }

                $total_sgst += $sgst;
                $total_cgst += $cgst;
                $total_igst += $igst;

                $total_salesvalue += $total_sales; 
                $total_discount +=$discount_value;
                $total_tax +=$taxable_value;
              ?>
			<tr>
				<td align="center"><?php if(isset($cnt)){echo $cnt;}?></td>
				<td><?php if(isset($value->item_name)){echo $value->item_name;}?></td>
				<!--<td><?php if(isset($value->item_description)){echo $value->item_description;}?></td>-->
				<td><?php if(isset($value->hsn_code)){echo $value->hsn_code;}?></td>
				<td align="center"><?php if(isset($value->qty)){echo $value->qty;}?></td>
				<td align="right"><?php if(isset($value->rate)){echo $value->rate;}?>.00</td>
				<td align="right"><?php if(isset($total_sales)){echo $total_sales;}?>.00</td>
<!--				<td align="right"><?php if(isset($value->discount)){echo $value->discount;}?></td>
				<td align="right"><?php if(isset($discount_value)){echo $discount_value;}?>.00</td>-->
				<td align="right"><?php if(isset($taxable_value)){echo $taxable_value;}?>.00</td>
				<td align="right"><?php if(isset($sgst)){echo $sgst.' ('.$sgst_percent.'%)';}?></td>
				<td align="right"><?php if(isset($cgst)){echo $cgst.' ('.$sgst_percent.'%)';}?></td>
				<td align="right"><?php if(isset($igst)){echo $igst.' ('.$igst_percent.'%)';}?></td>
				<td align="right"><?php if(isset($value->amount)){echo $value->amount;}?></td>
			</tr>
			<?php 
			$cnt++;
			} ?>
			<tr>
				<td colspan="5" align="right" style="font-size: 15px;" class="footerpad"><?php echo $this->lang->line('lbl_quotation_total');?></td>
				<td align="right">
					<!-- <?php echo $total_salesvalue?> -->
					<?php if(isset($total_salesvalue)){echo number_format((float)$total_salesvalue, 2, '.', '');}?>		
				</td>
<!--				<td></td>
				<td align="right">
					 <?php echo $total_discount?> 
					<?php if(isset($total_discount)){echo number_format((float)$total_discount, 2, '.', '');}?>		
				</td>-->
				<td align="right">
					<!-- <?php echo $total_tax?> -->
					<?php if(isset($total_tax)){echo number_format((float)$total_tax, 2, '.', '');}?>		
				</td>
				<td align="right">
					<!-- <?php echo $total_sgst;?> -->
					<?php if(isset($total_sgst)){echo number_format((float)$total_sgst, 2, '.', '');}?>		
				</td>
				<td align="right">
					<!-- <?php echo $total_cgst;?> -->
					<?php if(isset($total_cgst)){echo number_format((float)$total_cgst, 2, '.', '');}?>		
				</td>
				<td align="right">
					<!-- <?php echo $total_igst?> -->
					<?php if(isset($total_igst)){echo number_format((float)$total_igst, 2, '.', '');}?>		
				</td>
				<td align="right">
					<!-- <?php echo $sub_total?> -->
					<?php if(isset($sub_total)){echo number_format((float)$sub_total, 2, '.', '');}?>		
				</td>
				
			</tr>
			<tr>
				<td colspan="11" style="padding: 10px"></td>
			</tr>
			<tr>
				
			</tr>
			<tr>
				<td colspan="10" align="right" class="footerpad"><b>
					<!-- Total Quantity -->
					<?php echo $this->lang->line('lbl_quantity_total');?>
					</b></td>
				<td align="right"><?php if(isset($qty_total)){echo $qty_total;}?></td>
			</tr>

			<tr>
				<td colspan="10" align="right" class="footerpad"><b>
					<!-- Total Sales Value -->
					<?php echo $this->lang->line('lbl_total_sales_value');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)
					</b></td>
				<td align="right"><?php if(isset($total_salesvalue)){echo $total_salesvalue;}?></td>
			</tr>

<!--			<tr>
				<td colspan="13" align="right" class="footerpad"><b>
					 Total Discount 
					<?php echo $this->lang->line('lbl_total_discount');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)
					</b></td>
				<td align="right"><?php if(isset($total_discount)){echo $total_discount;}?></td>
			</tr>-->
			<tr>
				<td colspan="10" align="right" class="footerpad"><b>
					<!-- Tax  -->
					<?php echo $this->lang->line('lbl_add_quotation_totaltax');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right"><?php if(isset($value->total_tax)){echo $value->total_tax;}?></td>
			</tr>
			<tr>
				<td colspan="10" align="right" class="footerpad"><b>
					<!-- Total SGST -->
					<?php echo $this->lang->line('lbl_total_sgst');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right"><?php if(isset($total_sgst)){echo $total_sgst;}?></td>
			</tr>

			<tr>
				<td colspan="10" align="right" class="footerpad"><b>
					<!-- Total CGST -->
					<?php echo $this->lang->line('lbl_total_cgst');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right"><?php if(isset($total_cgst)){echo $total_cgst;}?></td>
			</tr>
			<tr>
				<td colspan="10" align="right" class="footerpad"><b>
					<!-- Total IGST -->
					<?php echo $this->lang->line('lbl_total_igst');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right"><?php if(isset($total_igst)){echo $total_igst;}?></td>
			</tr>

			<!-- <tr>
				<td colspan="13" align="right"><b>
					Sub Total 
					<?php echo $this->lang->line('lbl_add_quotation_subtotal');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right"><?php echo $sub_total;?></td>
			</tr> -->
			
			<tr>
				<td colspan="10" align="right" style="font-weight: bold;" class="footerpad"><b>
					<!-- Grand Total  -->
					<?php echo $this->lang->line('lbl_add_quotation_grandtotal');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right"><?php if(isset($value->total_amount)){echo $value->total_amount;}?></td>
			</tr>
		</tbody>
	</table>
	<br><br>
	<table style=" border-collapse: collapse;" width="100%">
		<tr>
			<td>
				<?php echo $this->lang->line('lbl_print_footer_line1');?> <b><?php if(isset($country->name)){echo $country->name;}?></b>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->lang->line('lbl_print_footer_line2');?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->lang->line('lbl_print_footer_line3');?> <?php if(isset($country->phone)){echo $country->phone;}?>,<?php if(isset($country->email)){echo $country->email; }?> 
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>
				<?php echo $this->lang->line('lbl_print_footer_line4');?>
			</td>
		</tr>
	</table>
</body>
</html>