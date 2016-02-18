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

<?php if(isset($message)): ?>
	<div>
		<strong><?php echo $message ?></strong>
	</div>
<?php endif; ?>

	<div>
	<a href="?action=new">New</a> <a href="?">Back</a> 
	<?php if((($order->status === 'Paid') || ($order->status === 'Refunded')) && ($order->total > $order->total_refunded)){?>
	<a href="?action=credit&merchant_order_id=<?php echo $order->merchant_order_id ?>">Credit</a>
	<?php }?>
	</div>
	<h1>Order: <?php echo $order->merchant_order_id ?> <?php echo $order->created ?></h1>
	<h2>Billing Address</h2>
	<pre>
		    <?php echo $order->billto_first_name ?>
		    <?php echo $order->billto_last_name ?>
		    <?php echo $order->billto_company ?> 
		    <?php echo $order->billto_address1 ?> 
		    <?php echo $order->billto_address2 ?> 
		    <?php echo $order->billto_house_number ?>
		    <?php echo $order->billto_po_box_number ?> 
		    <?php echo $order->billto_city ?>
		    <?php echo $order->billto_zipcode ?>
		    <?php echo $order->billto_state ?> 
		    <?php echo $order->billto_country ?>
		</pre>
	<h2>Direcci&oacute;n de env&iacute;o</h2>
	<pre>
		    <?php echo $order->billto_first_name ?>
		    <?php echo $order->billto_last_name ?>
		    <?php echo $order->billto_company ?> 
		    <?php echo $order->billto_address1 ?> 
		    <?php echo $order->billto_address2 ?> 
		    <?php echo $order->billto_house_number ?>
		    <?php echo $order->billto_po_box_number ?> 
		    <?php echo $order->billto_city ?>
		    <?php echo $order->billto_zipcode ?>
		    <?php echo $order->billto_state ?> 
		    <?php echo $order->billto_country ?>
		</pre>
	<h2>Total: <?php echo $order->total ?> <?php echo $order->currency_code ?></h2>
	<h2>Products:</h2>
	<table border="1">
		<thead>
			<tr>
				<td>SKU</td>
				<td>Name</td>
				<td>Qty</td>
				<td>Price</td>
				<td>Tax</td>
			</tr>
		</thead>
		<tbody>
<?php
	foreach ($order->items as $item){ 
?>
				<tr>
				<td><?php echo $item->sku?></td>
				<td><?php echo $item->name?></td>
				<td><?php echo $item->qty?></td>
				<td><?php echo $item->price?></td>
				<td><?php echo $item->tax?></td>
			</tr>
<?php
	}
?>		
			</tbody>
	</table>
	<h2>Transactions:</h2>
	<table border="1">
		<thead>
			<tr>
				<td>Brand</td>
				<td>PAN</td>
				<td>Name</td>
				<td>State</td>
				<td>Amount</td>
			</tr>
		</thead>
		<tbody>
<?php
	if(isset($order->transactions) && is_array($order->transactions)){
		foreach ($order->transactions as $txn){ 
?>
				<tr>
				<td><?php echo $txn->acct_type?></td>
				<td><?php echo $txn->acct_num?></td>
				<td><?php echo $txn->acct_name?></td>
				<td><?php echo $txn->txn_action?></td>
				<td><?php echo $txn->txn_amount?> <?php echo $txn->currency_code?></td>
			</tr>
<?php
		}
	}
?>		
			</tbody>
	</table>
		
<?php var_dump($order) ?>
	</body>
</html>
