<?php 
  //$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
?>
<?php //foreach ($sales_print as $value)?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Invoice
		
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

	<table width="100%" border="1" cellspacing="0" style="border: 0px solid black; border-collapse: collapse;" class="table" cellpadding="2">
			<tr>
				<td colspan="6" style="border: 0px;text-align: right;">Invoice</td>
				<td colspan="8" style="border: 0px;text-align: right;">(ORIGINAL FOR RECIPIENT)</td>
			</tr>

			<tr>
    			<td rowspan="3" colspan="6">
    				<table>
    					<tr>
    						<td style="border: 0px;font-size:13px;">
    							<?php if(isset($country->loginpage_image)){?>
    								<img src="<?php echo base_url();?>/assets/images/<?php echo $country->invoice_image;?>" width="80" height="50">	
    							<?php }else{?>
    								<img src="<?php echo base_url();?>/assets/images/invoice_logo.jpeg;?>" width="70" height="50">
    							<?php } ?>
    						</td>
    						<td style="border: 0px;font-size: 13px;"
    						>
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
    			</td>
    		
				<td valign="top" style="width: 25%;font-size: 13px;" colspan="4">
					Invoice Number<br>
					<p style="font-size: 13px;"><?php if(isset($sales->reference_no)){echo $sales->reference_no;}?></p>
				</td>
				<td valign="top" style="width: 25%;font-size: 13px;" colspan="3">
					Date<br>
					<p style="font-size: 13px;"><?php if(isset($sales->date)){echo $sales->date;}?></p>
				</td>
    		</tr>
		<tr style="font-size: 13px;">
			<td valign="top" colspan="4" style="font-size: 13px;">
				Delivery note<br>
				<p style="font-size: 13px;"><?php if(isset($sales->delivery_note)){echo $sales->delivery_note;}?></p>
			</td>
			<td valign="top" colspan="3" style="font-size: 13px;">
				Mode / Term of payment<br>
				<p style="font-size: 13px;"><?php if(isset($sales->payment_method_name)){echo $sales->payment_method_name;}?> / <?php if(isset($sales->due_days)){echo $sales->due_days;}?></p>
			</td>
		</tr>

		<tr style="font-size: 13px;">
			<td valign="top" colspan="4" style="font-size: 13px;">
				Supplier's Ref <br>
				<p style="font-size: 13px;"><?php if(isset($sales->delivery_note)){echo $sales->delivery_note;}?></p>
			</td>
			<td valign="top" colspan="3" style="font-size: 13px;">
				Other Reference<br>

			</td>
		</tr>
		<tr>
			<td valign="top" rowspan="5" style="text-align:left;font-size: 13px;padding-left: 5px;" colspan="6" >
					Buyer<br>
				
					<?php if(isset($sales->cust_name)){echo $sales->cust_name;} ?><br>
					<?php if(isset($sales->cust_street)){echo $sales->cust_street; }?><br>
					<?php if(isset($sales->cust_city)){echo $sales->cust_city.','.$sales->cust_state; }?><br>
					<?php if(isset($sales->country_name)){echo $sales->country_name; }?> - <?php if(isset($sales->cust_zipcode)){echo $sales->cust_zipcode;} ?><br>
					<?php if(isset($sales->phone)){echo $sales->phone;} ?><br>
					<?php if(isset($sales->email)){echo $sales->email;} ?><br>
					GSTIN/UIN :<?php if(isset($sales->gstin)){echo $sales->gstin;}?><br>
					
				
			</td>
		</tr>		
		<tr>
			<td valign="top" colspan="4" style="font-size: 13px;">
				Buyer Order <br>
				<p style="font-size: 13px;"><?php if(isset($sales->buyer_order)){echo $sales->buyer_order;}?></p>
			</td>
			<td valign="top" colspan="3" style="font-size: 15px;">
				Date<br>
				<p style="font-size: 13px;"><?php if(isset($sales->date)){echo $sales->date;}?></p>
			</td>
		</tr>
		<tr>
			<td valign="top" colspan="4" style="font-size: 13px;">
				Despatch Document No<br>
				<p style="font-size: 13px;"><?php if(isset($sales->dispatch_doc_no)){echo $sales->dispatch_doc_no;}?></p>
			</td>
			<td valign="top" colspan="3" style="font-size: 13px;">
				Delivery note date<br>
				<p style="font-size: 13px;"><?php if(isset($sales->dilivery_note_date)){echo $sales->dilivery_note_date;}?></p>
			</td>
		</tr>
		<tr>
			<td valign="top" colspan="4" style="font-size: 13px;">
				Despatched Through<br>
				<p style="font-size: 13px;"><?php if(isset($sales->dispatch_through)){echo $sales->dispatch_through;}?></p>
			</td>
			<td valign="top" colspan="3" style="font-size: 13px;">
				Destination<br>
				<p style="font-size: 13px;"><?php if(isset($address->city_name)){echo $address->city_name;}?></p>
			</td>
		</tr>
		<tr>
			<td valign="top" colspan="7" style="height: 50px;font-size: 13px;">
				Terms of Delivery<br>
				<p style="font-size: 10px;"><?php if(isset($value->notes)){echo $value->notes;}?></p>
			</td>
		</tr>

		<tr>
			<th style="text-align: center;font-size: 12px;">
				S.No
				<!-- <?php echo $this->lang->line('no');?>  -->
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- Item Name -->
				<?php echo $this->lang->line('add_item_name');?> 
			</th>
			<!-- <th style="font-size: 12px;">
				<?php echo $this->lang->line('lbl_addpurchase_description');?>
			</th> -->
			<th style="font-size: 12px;">
				<!-- HSN/SAC Code -->
				<?php echo $this->lang->line('lbl_hsn_code');?>
			</th>
			<th style="text-align: center;font-size: 12px;">
				Qty
				<!-- <?php echo $this->lang->line('lbl_addpurchase_quantity');?> -->
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- Rate  -->
				<?php echo $this->lang->line('lbl_add_quotation_rate');?>
				(<?php echo $this->session->userdata("currencySymbol");?>)
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- Total Sales -->
				<?php echo $this->lang->line('lbl_total_sales');?>
                        (<?php echo $this->session->userdata("currencySymbol");?>)
			</th>
			<th style="text-align: center;font-size: 12px;" width="5%">
				Disc
				<!-- <?php echo $this->lang->line('lbl_add_quotation_discount');?> -->(%)
			</th>
			<th style="text-align: center;font-size: 12px;">
				Disc
				<!-- <?php echo $this->lang->line('lbl_discount_value');?> -->
                        (<?php echo $this->session->userdata("currencySymbol");?>)
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- Taxable Value -->
				<?php echo $this->lang->line('lbl_taxable_value');?>
                        (<?php echo $this->session->userdata("currencySymbol");?>)
			</th>

			<th style="text-align: center;font-size: 12px;">
				<!-- SGST -->
				<?php echo $this->lang->line('lbl_sgst');?>
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- CGST -->
				<?php echo $this->lang->line('lbl_cgst');?>
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- IGST -->
				<?php echo $this->lang->line('lbl_igst');?>
			</th>
			<th style="text-align: center;font-size: 12px;">
				<!-- Subtotal --> 
				<?php echo $this->lang->line('lbl_add_quotation_amount');?>
				(<?php echo $this->session->userdata("currencySymbol");?>)
			</th>
		</tr>
		

		<?php 
              $qty_total=0;
              $sub_total=0;$cnt = 1;
              $total_salesvalue = 0;
              $total_discount = 0;
//              $tax = 0;
              $total_tax = 0;
              $total_sgst = 0;
              $total_cgst = 0;
              $total_igst = 0;
            ?>

            <?php
              foreach ($sales_print as $value) {
                $qty_total=$qty_total + $value->qty; 
                $sub_total=$sub_total + $value->amount;
                $tax += $value->tax_amount;
                $total_sales = $value->qty * $value->rate;
                $discount_value = ($total_sales * $value->discount / 100);
                $taxable_value = $total_sales - $discount_value;

                $sgst = 0;
                $cgst = 0;
                $igst = 0;
                $sgst_percent ='';
                $cgst_percent ='';
                $igst_percent ='';

                if($country->state_id == $s->state_id)
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


                /*$sgst = $value->tax_amount/2;
                $cgst = $value->tax_amount/2;*/

                $total_sgst += $sgst;
                $total_cgst += $cgst;
                $total_igst += $igst;

                $total_salesvalue += $total_sales; 
                $total_discount +=$discount_value;
                $total_tax +=$taxable_value;
              ?>
			<tr>
				<td align="center" class="fontS"><?php if(isset($cnt)){echo $cnt;}?></td>
				<td class="fontS"><?php if(isset($value->item_name)){echo $value->item_name;}?></td>
				<!-- <td class="fontS"><?php if(isset($value->item_description)){echo $value->item_description;}?></td> -->
				<td class="fontS"><?php if(isset($value->hsn_code)){echo $value->hsn_code;}?></td>
				<td align="center" class="fontS"><?php if(isset($value->qty)){echo $value->qty;}?></td>
				<td align="right" class="fontS"><?php if(isset($value->rate)){echo $value->rate;}?>.00</td>
				<td align="right" class="fontS"><?php if(isset($total_sales)){echo $total_sales;}?>.00</td>
				<td align="right" class="fontS"><?php if(isset($value->discount)){echo $value->discount;}?></td>
				<td align="right" class="fontS"><?php if(isset($discount_value)){echo $discount_value;}?>.00</td>
				<td align="right" class="fontS"><?php if(isset($taxable_value)){echo $taxable_value;}?>.00</td>
				<td align="right" class="fontS"><?php if(isset($sgst)){echo $sgst.' ('.$sgst_percent.'%)';}?></td>
				<td align="right" class="fontS"><?php if(isset($cgst)){echo $cgst.' ('.$sgst_percent.'%)';}?></td>
				<td align="right" class="fontS"><?php if(isset($igst)){echo $igst.' ('.$igst_percent.'%)';}?></td>
				<td align="right" class="fontS"><?php if(isset($value->amount)){echo $value->amount;}?></td>
			</tr>
			<?php 
			$cnt++;
			} ?>
			<tr>
				<td colspan="5" align="right" style="font-size: 11px;font-weight: bold;"><?php echo $this->lang->line('lbl_quotation_total');?></td>
				<td align="right" style="font-size: 10px;">
					<!-- <?php echo $total_salesvalue?> -->
					<?php if(isset($total_salesvalue)){echo number_format((float)$total_salesvalue, 2, '.', '');}?>		
				</td>
				<td></td>
				<td align="right" class="fontS">
					<!-- <?php echo $total_discount?> -->
					<?php if(isset($total_discount)){echo number_format((float)$total_discount, 2, '.', '');}?>	
				</td>
				<td align="right" class="fontS">
					<!-- <?php echo $total_tax?> -->
					<?php if(isset($total_tax)){echo number_format((float)$total_tax, 2, '.', '');}?>	
				</td>
				<td align="right" class="fontS">
					<!-- <?php echo $total_sgst;?> -->
					<?php if(isset($total_sgst)){echo number_format((float)$total_sgst, 2, '.', '');}?>	
				</td>
				<td align="right" class="fontS">
					<!-- <?php echo $total_cgst;?> -->
					<?php if(isset($total_cgst)){echo number_format((float)$total_cgst, 2, '.', '');}?>	
				</td>
				<td align="right" class="fontS">
					<!-- <?php echo $total_igst?> -->
					<?php if(isset($total_igst)){echo number_format((float)$total_igst,2,'.','');}?>
				</td>
				<td align="right" class="fontS">
					<!-- <?php echo $sub_total?> -->
					<?php if(isset($sub_total)){echo number_format((float)$sub_total, 2, '.', '');}?>		
				</td>
				
			</tr>
			<tr>
				<td colspan="13" style="padding: 10px;"></td>
			</tr>
			<tr>
				<td colspan="11" align="right" class="footerpad fontH"><b>
					<!-- Total Quantity -->
					<?php echo $this->lang->line('lbl_quantity_total');?>
					</b></td>
				<td align="right" colspan="2" class="fontH"><?php if(isset($qty_total)){echo $qty_total;}?></td>
			</tr>

			<!-- <tr>
				<td colspan="12" align="right" class="footerpad fontH"><b>
					<?php echo $this->lang->line('lbl_total_taxable_value');?>
                          (<?php echo $this->session->userdata("currencySymbol");?>)
					</b></td>
				<td align="right" colspan="2" class="fontH">
					<?php if(isset($total_salesvalue)){echo number_format((float)$total_salesvalue, 2, '.', '');}?>	
				</td>
			</tr>

			<tr>
				<td colspan="12" align="right" class="footerpad fontH"><b>
					 <?php echo $this->lang->line('lbl_total_discount');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
					</b></td>
				<td align="right" colspan="2" class="fontH">
					<?php if(isset($total_discount)){echo number_format((float)$total_discount, 2, '.', '');}?>		
				</td>
			</tr>
			<tr>
				<td colspan="12" align="right" class="footerpad fontH"><b>
					<?php echo $this->lang->line('lbl_total_sgst');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right" colspan="2" class="fontH">
					<?php if(isset($total_sgst)){echo number_format((float)$total_sgst, 2, '.', '');}?>	
				</td>
			</tr>

			<tr>
				<td colspan="12" align="right" class="footerpad fontH"><b>
					<?php echo $this->lang->line('lbl_total_cgst');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right" colspan="2" class="fontH">
					<?php if(isset($total_cgst)){echo number_format((float)$total_cgst, 2, '.', '');}?>	
				</td>
			</tr>
			<tr>
				<td colspan="12" align="right" class="footerpad fontH"><b>
					<?php echo $this->lang->line('lbl_total_igst');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right" colspan="2" class="fontH">
					<?php if(isset($total_igst)){echo number_format((float)$total_igst, 2, '.', '');}?>
				</td>
			</tr> -->

			<tr>
				<td colspan="11" align="right" class="footerpad fontH"><b>
					<?php echo $this->lang->line('lbl_shipping');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right" colspan="2" class="fontH">
					<!-- <?php echo $value->shipping_charges;?> -->
					<?php if(isset($value->shipping_charges)){echo number_format((float)$value->shipping_charges, 2, '.', '');}?>
				</td>
			</tr>
				
			<tr>
				<td colspan="11" align="right" class="footerpad fontH"><b>
					<!-- <?php echo $this->lang->line('lbl_total_igst');?> -->
					Total Tax
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right" colspan="2" class="fontH">
					<?php if(isset($tax)){echo number_format((float)$tax, 2, '.', '');}?>
				</td>
			</tr>

			<tr>
				<td colspan="11" align="right" class="footerpad fontH"><b>
					<!-- Grand Total  -->
					<?php echo $this->lang->line('lbl_add_quotation_grandtotal');?>
					(<?php echo $this->session->userdata("currencySymbol");?>)</b></td>
				<td align="right" colspan="2" class="fontH">
					<!-- <?php echo $value->total_amount + $value->shipping_charges?> -->
					<?php if(isset($value->total_amount)){echo number_format((float)$value->total_amount, 2, '.', '');}?>
				</td>
			</tr>

			<tr>
				<td colspan="11" align="right" class="footerpad fontH"><b>
					<!-- Grand Total  -->
					<?php echo $this->lang->line('btn_payment_status_paid');?>
                          (<?php echo $this->session->userdata("currencySymbol");?>)
				</td>
				<td align="right" colspan="2" class="fontH">
					<!-- <?php echo $value->total_amount + $value->shipping_charges?> -->
					<?php if(isset($sales->paid_amount)){echo $sales->paid_amount;}?>
				</td>
			</tr>

			<tr>
				<td colspan="11" align="right" class="footerpad fontH"><b>
					<!-- Grand Total  -->
						<?php echo $this->lang->line('lbl_payment_due');?>
                            (<?php echo $this->session->userdata("currencySymbol");?>)
					</b></td>
				<td align="right" colspan="2" class="fontH">
					<!-- <?php echo $value->total_amount + $value->shipping_charges?> -->
					<?php
                        $due =  $sales->total_amount - $sales->paid_amount;
                    ?>
                    <?php if(isset($due)){echo number_format((float)$due, 2, '.', '');}?>
				</td>
			</tr>



        <tr>
        	<td colspan="13" valign="top" style="height: 60px;border-bottom: 0px;font-size: 13px;">
        		Total Amount (in Words)<br>
        		<b> INR <?php echo $this->numbertowords->convert_number($value->total_amount); ?> Only</b>
        	</td>
        </tr>
        <tr>
        	<td colspan="13" style="height: 60px;border-bottom: 0px;font-size: 13px;">Company's PAN  : <b><?php if(isset($country->pan)){echo $country->pan;}?></b></td>
        </tr>
        <tr>
        	<td colspan="6" style="border-top:0px;border-right: 0px;font-size: 13px;">
        		Declartion<br>
        		We declare that this invoice shows the actual price of the goods describe and that all paticular are true and correct.
        	</td>
        	<td style="font-size: 10px;" colspan="7" style="border-top: 0px;border-top: 0px;border-left:0px;font-size: 13px;">
        		Company Bank Details
        		<table>
        			<tr>
        				<td style="border: 0px;font-size: 13px;" >Bank Name</td>
          				<td style="border: 0px;font-size: 13px;"> : <?php if(isset($country->bank_name)){echo $country->bank_name;}?></td>
        			</tr>
        			<tr>
						<td style="border: 0px;font-size: 13px;">A/C No</td>
						<td style="border: 0px;font-size: 13px;"> : <?php if(isset($country->ac_no)){echo $country->ac_no;}?></td>
	        		</tr>
        		<tr>
					<td style="border: 0px;font-size: 13px;">Branch code & Ifsc code</td>
					<td style="border: 0px;font-size: 13px;"> : <?php if(isset($country->ifs_code)){echo $country->ifs_code;}?> </td>
        		</tr>
        		</table>
        	</td>
        </tr>
        <tr>
        	<td colspan="6" style="height: 80px;font-size: 13px;" valign="top">
        		Custom Seal Signature
        		<br>
        		<br>
        	</td>
        	<td colspan="7" valign="top" style="text-align: right;font-size: 13px;">
        		For <?php if(isset($country->name)){echo $country->name;}?>
        		<br>
        		Authorised signatory
        	</td>
        </tr>    
	</table>
	<table>
		<tr>
        	<td colspan="13" style="border:0px;text-align: center;font-size: 13px;"><b>This is Computer Generated Invoice</b></td>
        </tr>
	</table>
</body>
</html>