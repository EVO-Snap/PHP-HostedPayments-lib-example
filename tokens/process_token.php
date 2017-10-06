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
use EvoSnap\HostedPayments\Api;
use EvoSnap\HostedPayments\Exception\ErrorResponseException;
use EvoSnap\HostedPayments\Model\Address;
use EvoSnap\HostedPayments\Model\LineItem;
use EvoSnap\HostedPayments\Model\Order;
use EvoSnap\HostedPayments\Tools;

$merchant_token_id = Tools::getParam($_POST, 'merchant_token_id');

$order = new Order();
$tParam = Tools::getParam($_POST, 'token_order');
$order->id = Tools::getParam($tParam, 'merchant_order_id');

$billto_address = new Address();
$billto_address->company = Tools::getParam($tParam, 'billto_company');
$billto_address->first_name = Tools::getParam($tParam, 'billto_first_name');
$billto_address->last_name = Tools::getParam($tParam, 'billto_last_name');
$billto_address->address1 = Tools::getParam($tParam, 'billto_address1');
$billto_address->address2 = Tools::getParam($tParam, 'billto_address2');
$billto_address->house_number = Tools::getParam($tParam, 'billto_house_number');
$billto_address->po_box_number = Tools::getParam($tParam, 'billto_po_box_number');
$billto_address->city = Tools::getParam($tParam, 'billto_city');
$billto_address->zipcode = Tools::getParam($tParam, 'billto_zipcode');
$billto_address->state = Tools::getParam($tParam, 'billto_state');
$billto_address->country = Tools::getParam($tParam, 'billto_country');

$order->billto_address = $billto_address;

// $shipto_address = new SnapAddress();
// $shipto_address->company = Tools::getParam($tParam, 'shipto_company');
// $shipto_address->first_name = Tools::getParam($tParam, 'shipto_first_name');
// $shipto_address->last_name = Tools::getParam($tParam, 'shipto_last_name');
// $shipto_address->address1 = Tools::getParam($tParam, 'shipto_address1');
// $shipto_address->address2 = Tools::getParam($tParam, 'shipto_address2');
// $shipto_address->house_number = Tools::getParam($tParam, 'shipto_house_number');
// $shipto_address->po_box_number = Tools::getParam($tParam, 'shipto_po_box_number');
// $shipto_address->city = Tools::getParam($tParam, 'shipto_city');
// $shipto_address->zipcode = Tools::getParam($tParam, 'shipto_zipcode');
// $shipto_address->state = Tools::getParam($tParam, 'shipto_state');
// $shipto_address->country = Tools::getParam($tParam, 'shipto_country');

// $order->shipto_address = $shipto_address;

$order->lines = [];

$oiParam = Tools::getParam($_POST, 'token_order_item');

for ($i = 0; $i < 1; $i++) {
    $orderLine = new LineItem();
    $orderLine->sku = Tools::getParam($oiParam[$i], 'sku');
    $orderLine->name = Tools::getParam($oiParam[$i], 'name');
    $orderLine->qty = Tools::getParam($oiParam[$i], 'qty');
    $orderLine->price = Tools::getParam($oiParam[$i], 'price');
    $orderLine->tax = Tools::getParam($oiParam[$i], 'tax');

    $order->lines[$i] = $orderLine;
}

$order->total_subtotal = Tools::getParam($tParam, 'total_subtotal');
$order->total_tax = Tools::getParam($tParam, 'total_tax');
$order->total = Tools::getParam($tParam, 'total');

try {
    $snapOrder = Api::processTokenOrder($merchant_token_id, $order, $cfg);
    $apiOut = '<pre>' . print_r($snapOrder, true) . '</pre>';
    echo ' <a href="../?merchant_order_id=' . $snapOrder['merchant_order_id'] . '">View order</a>';
} catch (ErrorResponseException $e) {
    $apiOut = '<strong>Error</strong><p>' . $e->getMessage() . '</p>';
    $snapOrder = '';
}
?>
<table width="100%">
    <tr>
        <td colspan="2"><h2>Token order processed: <?php print_r($merchant_token_id); ?></h2></td>
    </tr>
    <tr>
        <td width="50%" valign="top">
            <h2>Order:</h2>
            <pre><?php print_r($order); ?></pre>
        </td>
        <td width="50%" valign="top">
            <h2>API Call:</h2>
            <?php echo $apiOut; ?>
        </td>
    </tr>
</table>