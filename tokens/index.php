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

include_once(__DIR__ . '/../vendor/autoload.php');
include_once(__DIR__ . '/../config.php');

echo 'Choose a function: </p><a href="../?action=new">New Hosted Payment</a> <a href="..">Back to Main</a> <a href="?">Manage Tokens</a> <a href="?action=new">New Token</a>';

if (isset($_GET['action']) && ('new' == $_GET['action'])) {
    include('new.php');
} elseif (isset($_POST['action']) && ('new' == $_POST['action'])) {
    include('new_token.php');
} elseif (isset($_GET['action']) && ('token' == $_GET['action'])) {
    $token = Api::getToken($_GET['merchant_token_id'], $cfg);
    include('token.php');
} elseif (isset($_POST['action']) && ('token' == $_POST['action'])) {
    include('process_token.php');
} elseif (isset($_GET['merchant_token_id'])) {
    $token = Api::getToken($_GET['merchant_token_id'], $cfg);
    include('token_view.php');
} else {
    $now = new DateTime();
    $params = [
        'created[end]'   => $now->modify('tomorrow')->format('m/d/Y H:i:s'),
        'created[start]' => $now->modify('-1 month')->format('m/d/Y H:i:s'),
    ];

    echo '<ul>';
    $tokens = Api::getTokens($params, $cfg);

    foreach ($tokens as $token) {
        echo "<li><a href='?merchant_token_id=" . $token . "'>" . $token . '</a></li>';
    }

    echo '</ul>';
}
