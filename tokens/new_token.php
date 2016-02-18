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

$customer = new SnapCustomer();
$cParam = EvoSnapTools::getParam($_POST, 'customer');
$customer->id = EvoSnapTools::getParam($cParam, 'merchant_customer_id');
$customer->first_name = EvoSnapTools::getParam($cParam, 'first_name');
$customer->last_name = EvoSnapTools::getParam($cParam, 'last_name');
$customer->phone = EvoSnapTools::getParam($cParam, 'phone');
$customer->email = EvoSnapTools::getParam($cParam, 'email');

$token = new SnapToken();
$tParam = EvoSnapTools::getParam($_POST, 'token');
$token->id = EvoSnapTools::getParam($tParam, 'merchant_token_id');
$enable3d = EvoSnapTools::getParam($tParam, 'enable_3d');

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

$token->billto_address = $billto_address;

$token->auth_amount = EvoSnapTools::getParam($tParam, 'auth_amount');
$token->currency_code = EvoSnapTools::getParam($tParam, 'currency_code');

$checkout = new SnapToken_Checkout();
$checkout->customer = $customer;
$checkout->token = $token;

$checkout->return_url = EvoSnapTools::getParam($_POST, 'return_url');
$checkout->cancel_url = EvoSnapTools::getParam($_POST, 'cancel_url');
$checkout->auto_return = EvoSnapTools::getParam($_POST, 'auto_return');
$checkout->checkout_layout = EvoSnapTools::getParam($_POST, 'checkout_layout');
$checkout->language = EvoSnapTools::getParam($_POST, 'language');

echo '<pre>';
print_r($checkout);
echo '</pre>';
try {
	$snapOrder = EvoSnapApi::getTokenCheckoutUrl($checkout, $enable3d, $cfg);
	echo '<iframe src="'.$snapOrder.'" style="width: 100%; height: 720px; border: none;"></iframe>';
}catch (HostedPayments_Exception $e){
	echo '<h1>Error</h1><p>'.$e->getMessage().'</p>';
}
echo '<a href="?action=new">New</a> ';
echo '<a href="?">Cancel</a>';
