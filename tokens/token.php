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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
</head>
<body>
	<form name="HostedPayments" action="index.php" method="post">
	<input type="hidden" name="action" value="token" />
	<h2>Order</h2>
        <h4>Customer Information</h4>
			<table>  
				<tr>
					<td align="left" valign="middle">Token ID:</td>
					<td><input type="text" name="merchant_token_id" readonly="readonly" value="<?php echo $token->merchant_token_id; ?>"/></td>
					<td align="left" valign="middle">Customer:</td>
					<td><?php echo $token->acct_name; ?></td>
				</tr>
				<tr>
					<td align="left" valign="middle">PAN:</td>
					<td><?php echo $token->acct_num; ?></td>
					<td align="left" valign="middle">Expiration Date:</td>
					<td><?php echo $token->acct_exp; ?></td>
					<td align="left" valign="middle">Brand:</td>
					<td><?php echo $token->acct_type; ?></td>
				</tr>
			</table>
		<h4>Billing Information</h4>
			<table>
                <tr>
					<td align="left" valign="middle">Order Id</td>
					<td><input id="orderid" type="text" name="token_order[merchant_order_id]" value="order<?php echo time(); ?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Company (Not Required):</td>
					<td><input type="text" name="token_order[billto_company]" value="<?php echo $token->billto_company; ?>" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle">First Name:</td>
					<td><input type="text" name="token_order[billto_first_name]" value="<?php echo $token->billto_first_name; ?>"/></td>                
					<td align="left" valign="middle">Last Name:</td>
					<td><input type="text" name="token_order[billto_last_name]" value="<?php echo $token->billto_last_name; ?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Address:</td>
					<td><input type="text" name="token_order[billto_address1]" value="<?php echo $token->billto_address1; ?>"/></td>               
					<td align="left" valign="middle">Apt/Ste#:</td>
					<td><input type="text" name="token_order[billto_address2]" value="<?php echo $token->billto_address2; ?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">House #:</td>
					<td><input type="text" name="token_order[billto_house_number]" value="<?php echo $token->billto_house_number; ?>" /></td>
					<td align="left" valign="middle">PO Box:</td>
					<td><input type="text" name="token_order[billto_po_box_number]" value="<?php echo $token->billto_po_box_number; ?>" /></td>
				</tr>
					<tr>
					<td align="left" valign="middle">City:</td>
					<td><input type="text" name="token_order[billto_city]" value="<?php echo $token->billto_city; ?>"/></td>
					<td align="left" valign="middle">State (ISO 3166-2):</td>
					<td><input type="text" name="token_order[billto_state]" value="<?php echo $token->billto_state; ?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Country (ISO 3166-2):</td>
					<td><input type="text" name="token_order[billto_country]" value="<?php echo $token->billto_country; ?>"/></td>               
					<td align="left" valign="middle">Zipcode:</td>
					<td><input type="text" name="token_order[billto_zipcode]" value="<?php echo $token->billto_zipcode; ?>"/></td>
				</tr>
				</table>
			<h4>Item Information</h4>
				<table>
					<tr>
						<td align="left" valign="middle">Item SKU:</td>
						<td><input type="text" name="token_order_item[0][sku]" value="BT-001" /></td>
						<td align="left" valign="middle">Item Name:</td>
						<td><input type="text" name="token_order_item[0][name]" value="Back Office Charge" /></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Item qty:</td>
						<td><input type="text" name="token_order_item[0][qty]" value="2" /></td>
					</tr>
					<tr>
						<td height="24">Line Item Price:</td>
						<td><input type="text" name="token_order_item[0][price]" value="10.00"/></td>
						<td height="24">Line Item Tax:</td>
						<td><input type="text" name="token_order_item[0][tax]" value="2.00"/></td>
					</tr>						
				</table>
			<h4>Amount</h4>
				<table>
					<tr>
						<td height="24">Sub Total:</td>
						<td><input  type="text" name="token_order[total_subtotal]" id="token_order_subtotal" value="20.00"/></td>
					</tr>			
					<tr>
						<td height="24">Tax:</td>
						<td><input type="text" name="token_order[total_tax]" id="token_order_tax" value="4.00"/></td>
					</tr>
					<tr>
						<td height="24">Total:</td>
						<td><input type="text" name="token_order[total]" value="24.00"/></td>
					</tr>
					<tr>
						<td align="left" valign="middle">Currency</td>
						<td><?php echo $token->currency_code; ?></td>
					</tr>
				</table>
			<h4>Additional Options</h4>
				<table>
					<tr>
						<td align="left" valign="middle">Language:</td>
						<td>
							<select name="language">
								<option value="ENG" selected="selected">English</option>
								<option value="FRA">French</option>
								<option value="SPA">Spanish</option>
							</select>
						</td>
					</tr>
				</table>
		<button type='submit'>Process Order by Token</button>
	</form>  
    </body>
</html>
