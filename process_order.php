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
use EvoSnap\HostedPayments\Model\ComboCheckout;
use EvoSnap\HostedPayments\Model\Customer;
use EvoSnap\HostedPayments\Model\LineItem;
use EvoSnap\HostedPayments\Model\Order;
use EvoSnap\HostedPayments\Model\OrderCheckout;
use EvoSnap\HostedPayments\Model\Subscription;
use EvoSnap\HostedPayments\Model\SubscriptionCheckout;
use EvoSnap\HostedPayments\Tools;

$customer = new Customer();
$cParam = Tools::getParam($_POST, 'customer');
$customer->id = Tools::getParam($cParam, 'merchant_customer_id');
$customer->first_name = Tools::getParam($cParam, 'first_name');
$customer->last_name = Tools::getParam($cParam, 'last_name');
$customer->phone = Tools::getParam($cParam, 'phone');
$customer->email = Tools::getParam($cParam, 'email');

$enable3d = Tools::getParam($_POST, 'enable_3d');

// Order

$order = new Order();
$tParam = Tools::getParam($_POST, 'order');
$order->id = Tools::getParam($tParam, 'merchant_order_id');

if (!empty($order->id)) {
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

    $shipto_address = new Address();
    $shipto_address->company = Tools::getParam($tParam, 'shipto_company');
    $shipto_address->first_name = Tools::getParam($tParam, 'shipto_first_name');
    $shipto_address->last_name = Tools::getParam($tParam, 'shipto_last_name');
    $shipto_address->address1 = Tools::getParam($tParam, 'shipto_address1');
    $shipto_address->address2 = Tools::getParam($tParam, 'shipto_address2');
    $shipto_address->house_number = Tools::getParam($tParam, 'shipto_house_number');
    $shipto_address->po_box_number = Tools::getParam($tParam, 'shipto_po_box_number');
    $shipto_address->city = Tools::getParam($tParam, 'shipto_city');
    $shipto_address->zipcode = Tools::getParam($tParam, 'shipto_zipcode');
    $shipto_address->state = Tools::getParam($tParam, 'shipto_state');
    $shipto_address->country = Tools::getParam($tParam, 'shipto_country');

    $order->shipto_address = $shipto_address;
    $order->lines = [];

    $oiParam = Tools::getParam($_POST, 'order_item');

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
    $order->currency_code = Tools::getParam($tParam, 'currency_code');
}

// Subscription

$sub = new Subscription();
$sParam = Tools::getParam($_POST, 'sub');
$sub->id = Tools::getParam($sParam, 'merchant_subscription_id');

if (!empty($sub->id)) {
    $billto_address = new Address();
    $billto_address->company = Tools::getParam($sParam, 'billto_company');
    $billto_address->first_name = Tools::getParam($sParam, 'billto_first_name');
    $billto_address->last_name = Tools::getParam($sParam, 'billto_last_name');
    $billto_address->address1 = Tools::getParam($sParam, 'billto_address1');
    $billto_address->address2 = Tools::getParam($sParam, 'billto_address2');
    $billto_address->house_number = Tools::getParam($sParam, 'billto_house_number');
    $billto_address->po_box_number = Tools::getParam($sParam, 'billto_po_box_number');
    $billto_address->city = Tools::getParam($sParam, 'billto_city');
    $billto_address->zipcode = Tools::getParam($sParam, 'billto_zipcode');
    $billto_address->state = Tools::getParam($sParam, 'billto_state');
    $billto_address->country = Tools::getParam($sParam, 'billto_country');

    $sub->billto_address = $billto_address;

    $shipto_address = new Address();
    $shipto_address->company = Tools::getParam($sParam, 'shipto_company');
    $shipto_address->first_name = Tools::getParam($sParam, 'shipto_first_name');
    $shipto_address->last_name = Tools::getParam($sParam, 'shipto_last_name');
    $shipto_address->address1 = Tools::getParam($sParam, 'shipto_address1');
    $shipto_address->address2 = Tools::getParam($sParam, 'shipto_address2');
    $shipto_address->house_number = Tools::getParam($sParam, 'shipto_house_number');
    $shipto_address->po_box_number = Tools::getParam($sParam, 'shipto_po_box_number');
    $shipto_address->city = Tools::getParam($sParam, 'shipto_city');
    $shipto_address->zipcode = Tools::getParam($sParam, 'shipto_zipcode');
    $shipto_address->state = Tools::getParam($sParam, 'shipto_state');
    $shipto_address->country = Tools::getParam($sParam, 'shipto_country');

    $sub->shipto_address = $shipto_address;
    $sub->lines = [];

    $oiParam = Tools::getParam($_POST, 'sub_item');

    for ($i = 0; $i < 1; $i++) {
        $subLine = new LineItem();
        $subLine->sku = Tools::getParam($oiParam[$i], 'sku');
        $subLine->name = Tools::getParam($oiParam[$i], 'name');
        $subLine->qty = Tools::getParam($oiParam[$i], 'qty');
        $subLine->price = Tools::getParam($oiParam[$i], 'price');
        $subLine->tax = Tools::getParam($oiParam[$i], 'tax');

        $sub->lines[$i] = $subLine;
    }

    $sub->interval_length = Tools::getParam($sParam, 'interval_length');
    $sub->interval_unit = Tools::getParam($sParam, 'interval_unit');
    $sub->start_date = Tools::getParam($sParam, 'start_date');
    $sub->total_occurrences = Tools::getParam($sParam, 'total_occurrences');
    $sub->auto_process = Tools::getParam($sParam, 'auto_process');
    $sub->trial_occurrences = Tools::getParam($sParam, 'trial_occurrences');
    $sub->trial_amount = Tools::getParam($sParam, 'trial_amount');
    $sub->total_subtotal = Tools::getParam($sParam, 'total_subtotal');
    $sub->total_tax = Tools::getParam($sParam, 'total_tax');
    $sub->total = Tools::getParam($sParam, 'total');
    $sub->currency_code = Tools::getParam($sParam, 'currency_code');
}

if (!empty($order->id) && !empty($sub->id)) {
    $checkout = new ComboCheckout();
    $checkout->customer = $customer;
    $checkout->order = $order;
    $checkout->subscription = $sub;
} else {
    if (!empty($sub->id)) {
        $checkout = new SubscriptionCheckout();
        $checkout->customer = $customer;
        $checkout->subscription = $sub;
    } else {
        $checkout = new OrderCheckout();
        $checkout->customer = $customer;
        $checkout->order = $order;
    }
}

$checkout->return_url = Tools::getParam($_POST, 'return_url');
$checkout->cancel_url = Tools::getParam($_POST, 'cancel_url');
$checkout->auto_return = Tools::getParam($_POST, 'auto_return');
$checkout->create_token = Tools::getParam($_POST, 'create_token');
$checkout->checkout_layout = Tools::getParam($_POST, 'checkout_layout');
$checkout->language = Tools::getParam($_POST, 'language');

echo '<pre>';
print_r($checkout);
echo '</pre>';
try {
    $snapOrder = Api::getCheckoutUrl($checkout, $enable3d ? 0.00 : null, $cfg);
    echo '<iframe src="' . $snapOrder . '" style="width: 100%; height: 720px; border: none;"></iframe>';
} catch (ErrorResponseException $e) {
    echo '<h1>Error</h1><p>' . $e->getMessage() . '</p>';
}
