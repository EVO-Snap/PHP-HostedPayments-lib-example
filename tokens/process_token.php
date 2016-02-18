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

$merchant_token_id = EvoSnapTools::getParam($_POST, 'merchant_token_id');

$order = new SnapOrder();
$tParam = EvoSnapTools::getParam($_POST, 'token_order');
$order->id = EvoSnapTools::getParam($tParam, 'merchant_order_id');

$billto_address = new SnapAddress();
$billto_address->company = EvoSnapTools::getParam($tParam, 'billto_company');
$billto_address->first_name = EvoSnapTools::getParam($tParam, 'billto_first_name');
$billto_address->last_name = EvoSnapTools::getParam($tParam, 'billto_last_name');
$billto_address->address1 = EvoSnapTools::getParam($tParam, 'billto_address1');
$billto_address->address2 = EvoSnapTools::getParam($tParam, 'billto_address2');
$billto_address->house_number = EvoSnapTools::getParam($tParam, 'billto_house_number');
$billto_address->po_box_number = EvoSnapTools::getParam($tParam, 'billto_po_box_number');
$billto_address->city = EvoSnapTools::getParam($tParam, 'billto_city');
$billto_address->zipcode = EvoSnapTools::getParam($tParam, 'billto_zipcode');
$billto_address->state = EvoSnapTools::getParam($tParam, 'billto_state');
$billto_address->country = EvoSnapTools::getParam($tParam, 'billto_country');

$order->billto_address = $billto_address;

// $shipto_address = new SnapAddress();
// $shipto_address->company = EvoSnapTools::getParam($tParam, 'shipto_company');
// $shipto_address->first_name = EvoSnapTools::getParam($tParam, 'shipto_first_name');
// $shipto_address->last_name = EvoSnapTools::getParam($tParam, 'shipto_last_name');
// $shipto_address->address1 = EvoSnapTools::getParam($tParam, 'shipto_address1');
// $shipto_address->address2 = EvoSnapTools::getParam($tParam, 'shipto_address2');
// $shipto_address->house_number = EvoSnapTools::getParam($tParam, 'shipto_house_number');
// $shipto_address->po_box_number = EvoSnapTools::getParam($tParam, 'shipto_po_box_number');
// $shipto_address->city = EvoSnapTools::getParam($tParam, 'shipto_city');
// $shipto_address->zipcode = EvoSnapTools::getParam($tParam, 'shipto_zipcode');
// $shipto_address->state = EvoSnapTools::getParam($tParam, 'shipto_state');
// $shipto_address->country = EvoSnapTools::getParam($tParam, 'shipto_country');

// $order->shipto_address = $shipto_address;

$order->lines = array();

$oiParam = EvoSnapTools::getParam($_POST, 'token_order_item');

for($i = 0; $i < 1; $i++){
	$orderLine = new SnapOrderLine();
	$orderLine->sku = EvoSnapTools::getParam($oiParam[$i], 'sku');
	$orderLine->name = EvoSnapTools::getParam($oiParam[$i], 'name');
	$orderLine->qty = EvoSnapTools::getParam($oiParam[$i], 'qty');
	$orderLine->price = EvoSnapTools::getParam($oiParam[$i], 'price');
	$orderLine->tax = EvoSnapTools::getParam($oiParam[$i], 'tax');
	
	$order->lines[$i] = $orderLine;
}

$order->total_subtotal = EvoSnapTools::getParam($tParam, 'total_subtotal');
$order->total_tax = EvoSnapTools::getParam($tParam, 'total_tax');
$order->total = EvoSnapTools::getParam($tParam, 'total');

echo '<pre>';
print_r($merchant_token_id);
print_r($order);
echo '</pre>';
try {
	$snapOrder = EvoSnapApi::processTokenOrder($merchant_token_id, $order, $cfg);
	var_dump($snapOrder);
}catch (HostedPayments_Exception $e){
	echo '<h1>Error</h1><p>'.$e->getMessage().'</p>';
}
echo '<a href="?action=new">New</a> ';
echo '<a href="?">Cancel</a>';
echo '<a href="../?merchant_order_id='.$snapOrder['merchant_order_id'].'">View order</a>';
