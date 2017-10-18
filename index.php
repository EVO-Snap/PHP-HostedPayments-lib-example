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

include_once(__DIR__ . '/vendor/autoload.php');
include_once(__DIR__ . '/config.php');

// Get one month time interval for time based queries.
$now = new DateTime();
$params = [
    'created[end]'   => $now->modify('tomorrow')->format('m/d/Y H:i:s'),
    'created[start]' => $now->modify('-1 month')->format('m/d/Y H:i:s'),
];

echo '<p>Choose a function: </p><a href="?action=new">New Hosted Payment</a> <a href="tokens/">Manage Tokens</a> <a href="?action=subscription">View A Subscription</a> <a href="index.php">Back to Main</a>';

if (isset($_GET['action']) && ('new' == $_GET['action'])) {
    include('new.php');
} elseif (isset($_POST['action']) && ('new' == $_POST['action'])) {
    include('process_order.php');
} elseif (isset($_GET['action']) && ('credit' == $_GET['action'])) {
    include('credit.php');
} elseif (isset($_POST['action']) && ('credit' == $_POST['action'])) {
    include('process_credit.php');
} elseif (isset($_GET['merchant_order_id'])) {
    include('order_view.php');
} elseif (isset($_GET['action']) && ('callbacks' == $_GET['action'])) {
    echo '<ul>';
    $callbacks = Api::getCallbacks($params, $cfg);

    foreach ($callbacks as $callback) {
        echo '<li>' . var_dump($callback) . '</li>';
    }

    echo '</ul>';
} elseif (isset($_GET['action']) && ('subscription' == $_GET['action'])) {
    include('subscription_view.php');
} elseif (isset($_GET['action']) && ('process_subscription' == $_GET['action'])) {
    include('process_subscription.php');
} elseif (isset($_GET['action']) && ('suspend_subscription' == $_GET['action'])) {
    include('process_suspend_subscription.php');
} elseif (isset($_GET['action']) && ('resume_subscription' == $_GET['action'])) {
    include('process_resume_subscription.php');
} elseif (isset($_GET['action']) && ('cancel_subscription' == $_GET['action'])) {
    include('process_cancel_subscription.php');
} else {
    echo '<ul>';
    $tokens = Api::getOrders($params, $cfg);

    foreach ($tokens as $order) {
        echo "<li><a href='?merchant_order_id=" . $order . "'>" . $order . '</a></li>';
    }

    echo '</ul>';
}
