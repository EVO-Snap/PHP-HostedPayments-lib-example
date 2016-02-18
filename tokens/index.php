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

include_once (__DIR__.'/../vendor/autoload.php');
include_once (__DIR__.'/../config.php');

if(isset($_GET['action']) && ($_GET['action'] == 'new')){
	include ('new.php');
}elseif(isset($_POST['action']) && ($_POST['action'] == 'new')){
	include ('new_token.php');
}elseif(isset($_GET['action']) && ($_GET['action'] == 'token')){
	$token = EvoSnapApi::getToken($_GET['merchant_token_id'], $cfg);
	include ('token.php');
}elseif(isset($_POST['action']) && ($_POST['action'] == 'token')){
	include ('process_token.php');
}elseif(isset($_GET['merchant_token_id'])){
	$token = EvoSnapApi::getToken($_GET['merchant_token_id'], $cfg);
	include ('token_view.php');
}else{
	echo '<a href="?action=new">New</a>';
	
	$params = array(
		'created[start]' => '01/01/2016 00:00:00',
		'created[end]' => '12/31/2016 00:00:00'
	);
	
	echo "<ul>";
	$tokens = EvoSnapApi::getTokens($params, $cfg);
	
	foreach($tokens as $token){
		echo "<li><a href='?merchant_token_id=".$token."'>".$token."</a></li>";
	}

	echo "</ul>";
}