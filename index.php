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

include_once (__DIR__.'/vendor/autoload.php');
include_once (__DIR__.'/config.php');

if(isset($_GET['action']) && ($_GET['action'] == 'new')){
	include ('new.php');
}elseif(isset($_POST['action']) && ($_POST['action'] == 'new')){
	include ('process_order.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'credit')){
	$order = EvoSnapApi::getOrder($_GET['merchant_order_id'], $cfg);
	include ('credit.php');
}elseif(isset($_POST['action']) && ($_POST['action'] == 'credit')){
	include ('process_credit.php');
}elseif(isset($_GET['merchant_order_id'])){
	$order = EvoSnapApi::getOrder($_GET['merchant_order_id'], $cfg);
	include ('order_view.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'callbacks')){
	echo '<a href="?action=new">New</a> <a href="?">Back</a>';
	
	$params = array(
		'created[start]' => '09/01/2015 00:00:00',
		'created[end]' => '12/31/2015 00:00:00'
	);
	
	echo "<ul>";
	$callbacks = EvoSnapApi::getCallbacks($params, $cfg);
	
	foreach($callbacks as $callback){
		echo "<li>".var_dump($callback)."</li>";
	}

	echo "</ul>";
}elseif(isset($_GET['action']) && ($_GET['action'] == 'subscription')){
    if(isset($_GET['merchant_subscription_id']) && $_GET['merchant_subscription_id']){
    	$subscription = EvoSnapApi::getSubscription($_GET['merchant_subscription_id'], $cfg);
    }
	include ('subscription_view.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'process_subscription')){
	include ('process_subscription.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'suspend_subscription')){
	include ('process_suspend_subscription.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'resume_subscription')){
	include ('process_resume_subscription.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'cancel_subscription')){
	include ('process_cancel_subscription.php');
}else{
	echo '<a href="?action=new">New</a> <a href="tokens/">Tokens</a> <a href="?action=subscription">View Subscription</a>';
	
	$params = array(
		'created[start]' => '09/01/2015 00:00:00',
		'created[end]' => '12/31/2015 00:00:00'
	);
	
	echo "<ul>";
	$tokens = EvoSnapApi::getOrders($params, $cfg);
	
	foreach($tokens as $order){
		echo "<li><a href='?merchant_order_id=".$order."'>".$order."</a></li>";
	}

	echo "</ul>";
}