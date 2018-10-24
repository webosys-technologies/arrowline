<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gst_return_model extends CI_Model
{
	/*

	*/
	public function GSTR1b2b($month,$year){

		$data=$this->db->select('gstin')->from('company_settings')->get()->row();
		/*echo $data->gstin;
		print_r($data);exit();*/

		return $this->db->select('"'.$data->gstin.'" as GSTIN/UIN of Recipient,
							   	si.sub_invoice_no as Invoice Number,
							   	DATE_FORMAT(i.invoice_date,"%d-%b-%y") as "Invoice date",
							   	SUM(si.amount) as "Invoice Value",
							   	CONCAT(sc.tin_number,"-",st.name) as "Place Of Supply",
							   	s.gst_payable as Reverse Charge,
							   	(
							   		CASE
							   			WHEN sales_invoice = 2 THEN "SEZ Supplies with Payment"
							   			WHEN sales_invoice = 3 THEN "SEZ Supplies without Payment"
							   			WHEN sales_invoice = 4 THEN "Deemed Export"
							   		ELSE "Regular"
							   		END
							   	) as "Invoice Type",
							   	cu.gstin as E-Commerce GSTIN,
							   	t.tax_value as Rate,
							   	SUM(si.amount-si.tax_amount) as "Taxable Value",
							   	"0.00" as "Cess Amount"
							  ')
						 ->from('sales s')
						 ->join('customer cu','cu.id=s.customer_id')
						 ->join('invoice i','i.sales_id=s.id')
						 ->join('states st','st.id=s.state_id')
						 ->join('state_code sc','sc.state_id=st.id')
						 ->join('sales_item si','si.sales_id=s.id')
						 ->join('tax t','t.tax_id=si.tax_id')
						 ->where('MONTH(s.date)',$month)
						 ->where('YEAR(s.date)',$year)
						 ->group_by('si.sub_invoice_no')
						 ->get();
		/*echo "<pre>";
		print_r($)*/
	}
	/*

	*/
	public function GSTR1b2cs($month,$year){

		$data=$this->db->select('state_id')->from('company_settings')->get()->row();

		return $this->db->query('
									SELECT 
									(
								   		CASE
								   			WHEN sales_type = 1 THEN "OE"
								   		ELSE "E"
								   		END
								   	) as "Type",
									CONCAT(sc.tin_number,"-",st.name) as "Place Of Supply",
									t.tax_value as Rate,
									SUM(si.amount-si.tax_amount) as "Taxable Value",
									"0.00" as "Cess Amount",
									cu.gstin as "E-Commerce GSTIN"
									FROM sales s
									INNER JOIN customer cu ON cu.id = s.customer_id 
									INNER JOIN invoice i ON i.sales_id=s.id
									INNER JOIN states st ON st.id=s.state_id
									INNER JOIN state_code sc ON sc.state_id=st.id 
									INNER JOIN sales_item si ON si.sales_id=s.id
									INNER JOIN tax t ON si.tax_id=t.tax_id
									WHERE MONTH(i.invoice_date) = ?
									AND YEAR(i.invoice_date) = ?
									AND i.id IN (
										SELECT ii.id 
										FROM customer cc
										INNER JOIN sales ss ON cc.id = ss.customer_id
										INNER JOIN sales_item ssi ON ssi.sales_id=ss.id
										INNER JOIN invoice ii ON ii.sales_id = ss.id
										WHERE cc.gst_registration_type = "Unregistered"
										AND 
											IF(ss.state_id = "'.$data->state_id.'",1,IF(ssi.amount-ssi.tax_amount<250000,1,0))
									)
									GROUP BY si.sub_invoice_no
								',
								array(
										$month,
										$year
									)
								);
		/*echo "<pre>";
		print_r($row->result());
		exit();*/
	}
	public function GSTR1b2cl($month,$year){
		$data=$this->db->select('state_id')->from('company_settings')->get()->row();
		return $this->db->query('
									SELECT 
									si.sub_invoice_no as "Invoice Number",
									DATE_FORMAT(i.invoice_date,"%d-%b-%y") as "Invoice date",
									sum(si.amount) as "Invoice Value",
									CONCAT(sc.tin_number,"-",st.name) as "Place Of Supply",
									t.tax_value as Rate,
									SUM(si.amount-si.tax_amount) as "Taxable Value",
									"0.00" as "Cess Amount",
									cu.gstin as "E-Commerce GSTIN"
									FROM sales s
									INNER JOIN customer cu ON cu.id = s.customer_id 
									INNER JOIN invoice i ON i.sales_id=s.id
									INNER JOIN states st ON st.id=s.state_id
									INNER JOIN state_code sc ON sc.state_id=st.id 
									INNER JOIN sales_item si ON si.sales_id=s.id
									INNER JOIN tax t ON si.tax_id=t.tax_id
									WHERE MONTH(i.invoice_date) = ?
									AND YEAR(i.invoice_date) = ?
									AND si.sub_invoice_no IN (
										SELECT sub_invoice_no FROM customer cc
										INNER JOIN sales ss ON cc.id = ss.customer_id
										INNER JOIN invoice ii ON ii.sales_id = ss.id
										INNER JOIN sales_item ssi ON ssi.sales_id=ss.id
										WHERE cc.gst_registration_type = "Unregistered" AND IF(ss.state_id != "'.$data->state_id.'",TRUE,FALSE)
										GROUP BY sub_invoice_no HAVING sum(amount) > 250000
									)
									GROUP BY si.sub_invoice_no

								',
								array(
										$month,
										$year
									)
								);
		/*echo "<pre>";
		print_r($row->result());
		exit();*/

	}
	public function GSTR1cdnr($month,$year){
		$data=$this->db->select('gstin')->from('company_settings')->get()->row();
		return $this->db->query('
									SELECT 
									"'.$data->gstin.'" as "GSTIN/UIN of Recipient",
									si.sub_invoice_no as "Invoice/Advance Receipt Number",
									DATE_FORMAT(i.invoice_date,"%d-%b-%y") as "Invoice/Advance Receipt date",
									cd.note_or_refund_voucher_no as "Note/Refund Voucher Number",
									DATE_FORMAT(cd.note_or_refund_voucher_date,"%d-%b-%y") as "Note/Refund Voucher Date",
									cd.document_type as "Document Type",
									(
								   		CASE
								   			WHEN cd.reason_for_issue_document = 2 THEN "02-Post Sale Discount"
								   			WHEN cd.reason_for_issue_document = 3 THEN "03-Dificiency in Service"
								   			WHEN cd.reason_for_issue_document = 4 THEN "04-Correction of Invoice"
								   			WHEN cd.reason_for_issue_document = 5 THEN "05-Change in POS"
								   			WHEN cd.reason_for_issue_document = 6 THEN "06-Finalization of Provisional assessment"
								   			WHEN cd.reason_for_issue_document = 7 THEN "07-Others"
								   		ELSE "01-Sales Retun"
								   		END
								   	) as "Reason For Issuing document",
								   	CONCAT(sc.tin_number,"-",st.name) as "Place Of Supply",
								   	cd.note_or_refund_voucher_value as "Note/Refund Voucher Value",
								   	t.tax_value as Rate,
								   	(si.amount-si.tax_amount) as "Taxable Value",
									"0.00" as "Cess Amount",
									(
								   		CASE
								   			WHEN cd.pre_gst = "Y" THEN "Y"
								   		ELSE "N"
								   		END
								   	) as "Pre GST"
									FROM sales s
									INNER JOIN customer cu ON cu.id = s.customer_id 
									INNER JOIN invoice i ON i.sales_id=s.id
									INNER JOIN credit_debit_note cd ON cd.invoice_id=i.id
									INNER JOIN states st ON st.id=s.state_id
									INNER JOIN state_code sc ON sc.state_id=st.id 
									INNER JOIN sales_item si ON si.sales_id=s.id
									INNER JOIN tax t ON si.tax_id=t.tax_id
									WHERE cu.gst_registration_type = "Registered"
									AND MONTH(i.invoice_date) = ?
									AND YEAR(i.invoice_date) = ?
									GROUP BY si.sub_invoice_no
								',
								array(
										$month,
										$year
									)
								);
		// echo "<pre>";
		// print_r($row->result());
		// exit();
	}
	public function GSTR1cdnur($month,$year){
		$data=$this->db->select('state_id')->from('company_settings')->get()->row();
		return $this->db->query('
									SELECT 
									(
								   		CASE
								   			WHEN sales_invoice = 1 THEN "B2CL"
								   			WHEN sales_invoice = 2 THEN "EXPWP"
								   			WHEN sales_invoice = 3 THEN "EXPWOP"
								   		ELSE ""
								   		END
								   	) as "UR Type",
									cd.note_or_refund_voucher_no as "Note/Refund Voucher Number",
									DATE_FORMAT(cd.note_or_refund_voucher_date,"%d-%b-%y") as "Note/Refund Voucher Date",
									cd.document_type as "Document Type",
									si.sub_invoice_no as "Invoice/Advance Receipt Number",
									DATE_FORMAT(i.invoice_date,"%d-%b-%y") as "Invoice/Advance Receipt date",
									(
								   		CASE
								   			WHEN cd.reason_for_issue_document = 2 THEN "02-Post Sale Discount"
								   			WHEN cd.reason_for_issue_document = 3 THEN "03-Dificiency in Service"
								   			WHEN cd.reason_for_issue_document = 4 THEN "04-Correction of Invoice"
								   			WHEN cd.reason_for_issue_document = 5 THEN "05-Change in POS"
								   			WHEN cd.reason_for_issue_document = 6 THEN "06-Finalization of Provisional assessment"
								   			WHEN cd.reason_for_issue_document = 7 THEN "07-Others"
								   		ELSE "01-Sales Retun"
								   		END
								   	) as "Reason For Issuing document",
								   	CONCAT(sc.tin_number,"-",st.name) as "Place Of Supply",
								   	cd.note_or_refund_voucher_value as "Note/Refund Voucher Value",
								   	t.tax_value as Rate,
								   	SUM(si.amount-si.tax_amount) as "Taxable Value",
									"0.00" as "Cess Amount",
									(
								   		CASE
								   			WHEN cd.pre_gst = "Y" THEN "Y"
								   		ELSE "N"
								   		END
								   	) as "Pre GST"
									FROM sales s
									INNER JOIN customer cu ON cu.id = s.customer_id
									INNER JOIN invoice i ON i.sales_id=s.id
									INNER JOIN credit_debit_note cd ON cd.invoice_id=i.id
									INNER JOIN states st ON st.id=s.state_id
									INNER JOIN state_code sc ON sc.state_id=st.id
									INNER JOIN sales_item si ON si.sales_id=s.id
									INNER JOIN tax t ON si.tax_id=t.tax_id
									WHERE cu.gst_registration_type = "Unregistered" 
									AND MONTH(i.invoice_date) = ?
									AND YEAR(i.invoice_date) = ?
									AND 
										IF(s.state_id !="'.$data->state_id.'" ,TRUE,FALSE)
										GROUP BY si.sub_invoice_no HAVING sum(si.amount) > 250000
								',
								array(
										$month,
										$year
									)
								);

		/*echo "<pre>";
		print_r($row->result());
		exit();*/
	}
	public function GSTR1exp($month,$year){

		return $this->db->query('
									SELECT 
									(
								   		CASE
								   			WHEN sales_invoice = 2 THEN "WPAY"
								   			WHEN sales_invoice = 3 THEN "WOPAY"
								   			WHEN sales_invoice = 4 THEN "WOPAY"
								   		END
								   	) as "Export Type",
								   	si.sub_invoice_no as "Invoice Number",
								   	DATE_FORMAT(i.invoice_date,"%d-%b-%y") as "Invoice date",
								   	SUM(si.amount) as "Invoice Value",
								   	s.port_code as "Port Code",
								   	s.shipping_bill_no as "Shipping Bill Number",
								   	DATE_FORMAT(s.shipping_bill_date,"%d-%b-%y") as "Shipping Bill Date",
				
								   	t.tax_value as Rate,
									SUM(si.amount-si.tax_amount) as "Taxable Value"
									FROM sales s
									INNER JOIN customer cu ON cu.id = s.customer_id 
									INNER JOIN invoice i ON i.sales_id=s.id
									INNER JOIN states st ON st.id=s.state_id
									INNER JOIN state_code sc ON sc.state_id=st.id 
									INNER JOIN sales_item si ON si.sales_id=s.id
									INNER JOIN tax t ON si.tax_id=t.tax_id
									WHERE s.sales_invoice != 1
									AND MONTH(i.invoice_date) = ?
									AND YEAR(i.invoice_date) = ?
									GROUP BY si.sub_invoice_no

								',
								array(
										$month,
										$year
									)
								);

		/*echo "<pre>";
		print_r($row->result());
		exit();*/
	}
	public function GSTR1exemp($month,$year){
		$data=$this->db->select('state_id')->from('company_settings')->get()->row();
		return $this->db->query('
		SELECT * FROM
		(
			SELECT 
			"Inter-State Supplies to registerd persons" as "Description", 
			(
				SELECT 
				   	COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 3
				AND cu.gst_registration_type = "Registered"
				AND "'.$data->state_id.'" = s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Nil Rated Supplies",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 4
				AND cu.gst_registration_type = "Registered"
				AND "'.$data->state_id.'" = s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Exempted(other than nil rated/non GST supply)",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 2
				AND cu.gst_registration_type = "Registered"
				AND "'.$data->state_id.'" = s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Non-GST supplies"
		) as r1
		UNION
		SELECT * FROM
		(
			SELECT 
			"Intra-State Supplies to registerd persons" as "Description", 
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 3
				AND cu.gst_registration_type = "Registered"
				AND "'.$data->state_id.'" != s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Nil Rated Supplies",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 4
				AND cu.gst_registration_type = "Registered"
				AND "'.$data->state_id.'" != s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Exempted(other than nil rated/non GST supply)",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id
				WHERE t.tax_type = 2
				AND cu.gst_registration_type = "Registered"
				AND "'.$data->state_id.'" != s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Non-GST supplies"
		) as r2
		UNION
		SELECT * FROM
		(
			SELECT 
			"Inter-State Supplies to unregisterd persons" as "Description", 
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 3
				AND cu.gst_registration_type = "unregistered"
				AND "'.$data->state_id.'" = s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Nil Rated Supplies",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 4
				AND cu.gst_registration_type = "unregistered"
				AND "'.$data->state_id.'" = s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Exempted(other than nil rated/non GST supply)",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 2
				AND cu.gst_registration_type = "unregistered"
				AND "'.$data->state_id.'" = s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Non-GST supplies"
		) as r3
		UNION
		SELECT * FROM
		(
			SELECT 
			"Intra-State Supplies to unregisterd persons" as "Description", 
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 3
				AND cu.gst_registration_type = "unregistered"
				AND "'.$data->state_id.'" != s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Nil Rated Supplies",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 4
				AND cu.gst_registration_type = "unregistered"
				AND "'.$data->state_id.'" != s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Exempted(other than nil rated/non GST supply)",
			(
				SELECT 
					COALESCE(SUM(si.amount),0)
				FROM  sales s
				INNER JOIN sales_item si ON si.sales_id = s.id
				INNER JOIN tax t ON t.tax_id = si.tax_id
				INNER JOIN customer cu ON cu.id = s.customer_id 
				INNER JOIN invoice i ON i.sales_id=s.id
				INNER JOIN states st ON st.id=s.state_id
				INNER JOIN state_code sc ON sc.state_id=st.id 
				WHERE t.tax_type = 2
				AND cu.gst_registration_type = "unregistered"
				AND "'.$data->state_id.'" != s.state_id
				AND MONTH(i.invoice_date) = ?
				AND YEAR(i.invoice_date) = ?
			) as "Non-GST supplies"
		) as r2
		',
		array(
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year,
				$month,
				$year
			)
		);
		
		/*echo "<pre>";
		print_r($row->result());
		exit();*/

	}
	public function GSTR1hsn($month,$year){
		$data=$this->db->select('state_id')->from('company_settings')->get()->row();
		//echo $data->state_id;exit();
		return $this->db->query('
					SELECT 
						pr.hsn_code as "HSN",
						pr.item_name as "Description",
						u.unit_name as "UQC",
						sum(si.qty) as "Total Quantity",
						sum(si.amount) as "Total Value",
						sum(si.amount-si.tax_amount) as "Taxable Value",
						(
							CASE
								WHEN s.state_id != "'.$data->state_id.'" THEN TRUNCATE(sum(si.tax_amount),2)
								ELSE 0
							END
						) as "Integrated Tax Amount",
						(
							CASE
								WHEN s.state_id = "'.$data->state_id.'" THEN TRUNCATE(sum(si.tax_amount)/2,2)
								ELSE 0
							END
						) as "Central Tax Amount",
						(
							CASE
								WHEN s.state_id = "'.$data->state_id.'" THEN TRUNCATE(sum(si.tax_amount)/2,2)
								ELSE 0
							END  
						) as "State/UT Tax Amount",
						"0.00" as "Cess Amount"
					FROM sales s
					INNER JOIN customer cu ON cu.id = s.customer_id 
					INNER JOIN invoice i ON i.sales_id=s.id
					
					INNER JOIN sales_item si ON si.sales_id=s.id
					INNER JOIN item pr ON pr.id = si.item_id
					INNER JOIN unit u ON u.id = pr.unit_id
					AND MONTH(i.invoice_date) = ?
					AND YEAR(i.invoice_date) = ?
					GROUP BY pr.hsn_code

				',
				array(
						$month,
						$year
					)
				);
	}
}
?>