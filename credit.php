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
	<title>Order <?php echo $order->merchant_order_id ?></title>
</head>
<body>
	<div><a href="?action=new">New</a> <a href="?">Back</a> <?php if($order->status === 'Paid'){?><a href="?action=credit&merchant_order_id=<?php echo $order->merchant_order_id ?>">Credit</a><?php }?></div>
	<h1>Pedido: <?php echo $order->merchant_order_id ?> <?php echo $order->created ?></h1>
	<form name="HostedPayments" action="index.php" method="post">
	<input type="hidden" name="action" value="credit" />
	<input type="hidden" name="merchant_order_id" value="<?php echo $order->merchant_order_id ?>" />
	<input type="hidden" name="txn_id" value="<?php echo $order->payment_transaction->txn_id ?>" />
	<h2>Credit</h2>
		<table>  
			<tr>
				<td align="left" valign="middle">Amount</td>
				<td><input id="orderid" type="text" name="amount" value="<?php echo $order->total - $order->total_refunded ?>"/></td>
			</tr>                      
		</table>
		<button type='submit'>Credit Order</button>
	</form>  
    </body>
</html>
