<?php 

/* Copyright (c) 2015 EVO Payments International - All Rights Reserved.
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
* and does not represent a commitment on the part of EVO Payments International.
* 
* Sample Code is for reference Only and is intended to be used for educational purposes. It's the responsibility of 
* the software company to properly integrate into thier solution code that best meets thier production needs. 
*/

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
</head>
<body>
	<div><a href="?action=new">New</a> <a href="?">Back</a></div>
	<form name="HostedPayments" action="index.php" method="post">
	<input type="hidden" name="action" value="new" />
	<h2>Token</h2>
        <h4>Customer Information</h4>
			<table>  
				<tr>
					<td align="left" valign="middle">Token Id</td>
					<td><input id="tokenid" type="text" name="token[merchant_token_id]" value="token01"/></td>
					<td align="left" valign="middle">Customer Id</td>
					<td><input id="customer" type="text" name="customer[merchant_customer_id]" value="" /></td>
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
		<h4>Billing Information</h4>
			<table>            
				<tr>
					<td align="left" valign="middle">Company (Not Required):</td>
					<td><input type="text" name="token[billto_company]"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">First Name:</td>
					<td><input type="text" name="token[billto_first_name]" value="Test"/></td>                
					<td align="left" valign="middle">Last Name:</td>
					<td><input type="text" name="token[billto_last_name]" value="Person"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Address:</td>
					<td><input type="text" name="token[billto_address1]" value="1234 Fake St"/></td>               
					<td align="left" valign="middle">Apt/Ste#:</td>
					<td><input type="text" name="token[billto_address2]"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">House #:</td>
					<td><input type="text" name="token[billto_house_number]" value="1234" /></td>
					<td align="left" valign="middle">PO Box:</td>
					<td><input type="text" name="token[billto_po_box_number]" value="1234" /></td>
				</tr>
					<tr>
					<td align="left" valign="middle">City:</td>
					<td><input type="text" name="token[billto_city]" value="Denver"/></td>                
					<td align="left" valign="middle">State (ISO 3166-2):</td>
					<td><input type="text" name="token[billto_state]" value="CO"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle">Country (ISO 3166-2):</td>
					<td><input type="text" name="token[billto_country]" value="US"/></td>               
					<td align="left" valign="middle">Zipcode:</td>
					<td><input type="text" name="token[billto_zipcode]" value="80202"/></td>
				</tr>
				</table>
			<h4>Amount</h4>
				<table>
					<tr>
						<td height="24">Auth amount (Optional):</td>
						<td><input  type="text" name="token[auth_amount]" id="token_subtotal" value="1.00"/></td>
					</tr>			
					<tr>
						<td align="left" valign="middle">Currency</td>
						<td>
							<select name="token[currency_code]">
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
							<select name="token[enable_3d]">
								<option value="1" selected="selected">Yes</option>
								<option value="0">No</option>
							</select>
						</td>
					</tr>
				</table>
		<button type='submit'>Process Token</button>
	</form>  
    </body>
</html>
