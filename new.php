<?php
/**
 * Copyright (c) 2015-2017 EVO Payments International - All Rights Reserved.
 *
 * This software and documentation is subject to and made
 * available only pursuant to the terms of an executed license
 * agreement, and may be used only in accordance with the terms
 * of said agreement. This software may not, in whole or in part,
 * be copied, photocopied, reproduced, translated, or reduced to
 * any electronic medium or machine-readable form without
 * prior consent, in writing, from EVO Payments International, INC.
 *
 * Use, duplication or disclosure by the U.S. Government is subject
 * to restrictions set forth in an executed license agreement
 * and in subparagraph (c)(1) of the Commercial Computer
 * Software-Restricted Rights Clause at FAR 52.227-19; subparagraph
 * (c)(1)(ii) of the Rights in Technical Data and Computer Software
 * clause at DFARS 252.227-7013, subparagraph (d) of the Commercial
 * Computer Software--Licensing clause at NASA FAR supplement
 * 16-52.227-86; or their equivalent.
 *
 * Information in this software is subject to change without notice
 * and does not represent a commitment on the part of EVO Payments
 * International.
 *
 * Sample Code is for REFERENCE ONLY and is intended to be used for
 * educational purposes. It's the responsibility of the software
 * company to properly integrate into their solution code that best
 * meets their production needs.
 */

// Allow us to generate a unique order/sub number by default:
$subscriptionNumber = $orderNumber = null;
if (isset($_REQUEST['sub']) && ($_REQUEST['sub'] == '1')) {
    $subscriptionNumber = 'sub' . time();
} else {
    $orderNumber = 'order' . time();
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
</head>
<body>
	<form name="HostedPayments" action="index.php" method="post">
	<input type="hidden" name="action" value="new" />
    <h4>Customer Information</h4>
		<table>  
			<tr>
				<td align="left" valign="middle">Customer Id</td>
				<td><input id="customer" type="text" name="customer[merchant_customer_id]" value="abc123" /></td>
			</tr>                      
			<tr>
				<td align="left" valign="middle">First Name:</td>
				<td><input type="text" name="customer[first_name]" value="Test"/></td>
				<td align="left" valign="middle">Last Name:</td>
				<td><input type="text" name="customer[last_name]" value="Person"/></td>
			</tr>
			<tr>                                         
				<td align="left" valign="middle">Phone:</td>
				<td><input type="text" name="customer[phone]" value="303 3030303"/></td>
				<td align="left" valign="middle">Email:</td>
				<td><input type="text" name="customer[email]" value="Test@test.com"/></td>   	
			</tr>
		</table>
	
	<h2>Order</h2>
	<h4>Billing Information</h4>
			<table>            
				<tr>
    				<td align="left" valign="middle">Order Id (Empty for no order)</td>
    				<td><input id="orderid" type="text" name="order[merchant_order_id]" value="<?php echo $orderNumber; ?>"/></td>
    				<td align="left" valign="middle">Company (Not Required):</td>
					<td><input type="text" name="order[billto_company]"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">First Name:</td>
					<td><input type="text" name="order[billto_first_name]" value="Test"/></td>                
					<td align="left" valign="middle">Last Name:</td>
					<td><input type="text" name="order[billto_last_name]" value="Person"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Address:</td>
					<td><input type="text" name="order[billto_address1]" value="1234 Fake St"/></td>               
					<td align="left" valign="middle">Apt/Ste#:</td>
					<td><input type="text" name="order[billto_address2]"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">House #:</td>
					<td><input type="text" name="order[billto_house_number]" value="1234" /></td>
					<td align="left" valign="middle">PO Box:</td>
					<td><input type="text" name="order[billto_po_box_number]" value="1234" /></td>
				</tr>
					<tr>
					<td align="left" valign="middle">City:</td>
					<td><input type="text" name="order[billto_city]" value="Denver"/></td>                
					<td align="left" valign="middle">State (ISO 3166-2):</td>
					<td><input type="text" name="order[billto_state]" value="CO"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Country (ISO 3166-2):</td>
					<td><input type="text" name="order[billto_country]" value="US"/></td>               
					<td align="left" valign="middle">Zipcode:</td>
					<td><input type="text" name="order[billto_zipcode]" value="80202"/></td>
				</tr>
				</table>
			<h4>Item Information</h4>
				<table>
					<tr>
						<td align="left" valign="middle">Item SKU:</td>
						<td><input type="text" name="order_item[0][sku]" value="BT-001" /></td>
						<td align="left" valign="middle">Item Name:</td>
						<td><input type="text" name="order_item[0][name]" value="Back Office Charge" /></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Item qty:</td>
						<td><input type="text" name="order_item[0][qty]" value="2" /></td>
					</tr>
					<tr>
						<td height="24">Line Item Price:</td>
						<td><input type="text" name="order_item[0][price]" value="10.00"/></td>
						<td height="24">Line Item Tax:</td>
						<td><input type="text" name="order_item[0][tax]" value="2.00"/></td>
					</tr>						
				</table>
			<h4>Amount</h4>
				<table>
					<tr>
						<td height="24">Sub Total:</td>
						<td><input  type="text" name="order[total_subtotal]" id="order_subtotal" value="20.00"/></td>
					</tr>			
					<tr>
						<td height="24">Tax:</td>
						<td><input type="text" name="order[total_tax]" id="order_tax" value="4.00"/></td>
					</tr>
					<tr>
						<td height="24">Total:</td>
						<td><input type="text" name="order[total]" value="24.00"/></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Currency</td>
						<td>
							<select name="order[currency_code]">
								<option selected="selected">USD</option>
								<option>EUR</option>
							</select>
						</td>
					</tr>
				</table>

	<h2>Subscription</h2>
	<h4>Billing Information</h4>
			<table>            
				<tr>
    				<td align="left" valign="middle">Subscription Id (Empty for no subscription)</td>
    				<td><input id="subid" type="text" name="sub[merchant_subscription_id]" value="<?php echo $subscriptionNumber; ?>"/></td>
    				<td align="left" valign="middle">Company (Not Required):</td>
					<td><input type="text" name="sub[billto_company]"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">First Name:</td>
					<td><input type="text" name="sub[billto_first_name]" value="Test"/></td>                
					<td align="left" valign="middle">Last Name:</td>
					<td><input type="text" name="sub[billto_last_name]" value="Person"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Address:</td>
					<td><input type="text" name="sub[billto_address1]" value="1234 Fake St"/></td>               
					<td align="left" valign="middle">Apt/Ste#:</td>
					<td><input type="text" name="sub[billto_address2]"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">House #:</td>
					<td><input type="text" name="sub[billto_house_number]" value="1234" /></td>
					<td align="left" valign="middle">PO Box:</td>
					<td><input type="text" name="sub[billto_po_box_number]" value="1234" /></td>
				</tr>
					<tr>
					<td align="left" valign="middle">City:</td>
					<td><input type="text" name="sub[billto_city]" value="Denver"/></td>                
					<td align="left" valign="middle">State (ISO 3166-2):</td>
					<td><input type="text" name="sub[billto_state]" value="CO"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Country (ISO 3166-2):</td>
					<td><input type="text" name="sub[billto_country]" value="US"/></td>               
					<td align="left" valign="middle">Zipcode:</td>
					<td><input type="text" name="sub[billto_zipcode]" value="80202"/></td>
				</tr>
				</table>
			<h4>Item Information</h4>
				<table>
					<tr>
						<td align="left" valign="middle">Item SKU:</td>
						<td><input type="text" name="sub_item[0][sku]" value="BT-001" /></td>
						<td align="left" valign="middle">Item Name:</td>
						<td><input type="text" name="sub_item[0][name]" value="Back Office Charge" /></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Item qty:</td>
						<td><input type="text" name="sub_item[0][qty]" value="2" /></td>
					</tr>
					<tr>
						<td height="24">Line Item Price:</td>
						<td><input type="text" name="sub_item[0][price]" value="10.00"/></td>
						<td height="24">Line Item Tax:</td>
						<td><input type="text" name="sub_item[0][tax]" value="2.00"/></td>
					</tr>						
				</table>
			<h4>Interval</h4>
				<table>
					<tr>
						<td align="left" valign="middle">Length:</td>
						<td><input type="text" name="sub[interval_length]" value="1" /></td>
						<td align="left" valign="middle">Unit:</td>
						<td>
							<select name="sub[interval_unit]">
								<option selected="selected">days</option>
								<option>weeks</option>
								<option>months</option>
								<option>years</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">Start Date:</td>
						<td><input type="text" name="sub[start_date]" value="<?php echo date('m/d/Y', time()+86400); ?>" /></td>
						<td align="left" valign="middle">Total Occurrences (9999 for unlimited):</td>
						<td><input type="text" name="sub[total_occurrences]" value="3" /></td>
						<td align="left" valign="middle">Auto Process:</td>
    					<td>
    						<select name="sub[auto_process]">
    							<option value="1" selected="selected">Yes</option>
    							<option value="0">No</option>
    						</select>
    					</td>
					</tr>
					<tr>
						<td height="24">Trial occurrences:</td>
						<td><input type="text" name="sub[trial_occurrences]" value="0"/></td>
						<td height="24">Trial Amount:</td>
						<td><input type="text" name="sub[trial_amount]" value="0.00"/></td>
					</tr>						
				</table>
		  <h4>Amount</h4>
				<table>
					<tr>
						<td height="24">Sub Total:</td>
						<td><input  type="text" name="sub[total_subtotal]" id="sub_subtotal" value="20.00"/></td>
					</tr>			
					<tr>
						<td height="24">Tax:</td>
						<td><input type="text" name="sub[total_tax]" id="sub_tax" value="4.00"/></td>
					</tr>
					<tr>
						<td height="24">Total:</td>
						<td><input type="text" name="sub[total]" value="24.00"/></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Currency</td>
						<td>
							<select name="sub[currency_code]">
								<option selected="selected">USD</option>
								<option>EUR</option>
							</select>
						</td>
					</tr>
				</table>
				
		<h4>Additional Options</h4>
			<table>
				<tr>
					<td align="left" valign="middle">Return URL:</td>
					<td><input type="text" name="return_url" value ="http://www.evosnap.com/" id="returnurl"/></td>
					<td align="left" valign="middle">Cancel URL:</td>
					<td><input type="text" name="cancel_url" value ="http://www.evosnap.com/" id="cancelurl" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Auto Return:</td>
					<td>
						<select name="auto_return">
							<option value="1" selected="selected">Yes</option>
							<option value="0">No</option>
						</select>
					</td>
					<td align="left" valign="middle">Create Token:</td>
					<td>
						<select name="create_token">
							<option value="1" selected="selected">Yes</option>
							<option value="0">No</option>
						</select>
					</td>
					<td align="left" valign="middle">Layout:</td>
					<td>
						<select name="checkout_layout">
							<option value="iframe" selected="selected">iframe</option>
							<option value="">Redirect</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle">Language:</td>
					<td>
						<select name="language">
							<option value="ENG" selected="selected">English</option>
							<option value="FRA">French</option>
							<option value="SPA">Spanish</option>
						</select>
					</td>
					<td align="left" valign="middle">Enable 3D Secure:</td>
					<td>
						<select name="enable_3d">
							<option value="1" selected="selected">Yes</option>
							<option value="0">No</option>
						</select>
					</td>
					</tr>
			</table>
	   <button type='submit'>Process Order</button>
	</form>  
    </body>
</html>
