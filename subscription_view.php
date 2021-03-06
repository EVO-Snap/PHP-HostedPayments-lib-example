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

if (isset($_GET['merchant_subscription_id']) && $_GET['merchant_subscription_id']) {
    $subscription = Api::getSubscription($_GET['merchant_subscription_id'], $cfg);
}

?>
<?php if (isset($subscription)):?>
    <?php if ('SUB_STATUS_ACTIVE' === $subscription->status):?>
        <a href="?action=process_subscription&merchant_subscription_id=<?php echo $subscription->merchant_subscription_id; ?>">Process This Subscription</a>
        <a href="?action=suspend_subscription&merchant_subscription_id=<?php echo $subscription->merchant_subscription_id; ?>">Suspend This Subscription</a>
        <a href="?action=cancel_subscription&merchant_subscription_id=<?php echo $subscription->merchant_subscription_id; ?>">Cancel This Subscription</a>
    <?php endif; ?>
    <?php if ('SUB_STATUS_SUSPENDED' === $subscription->status):?>
        <a href="?action=resume_subscription&merchant_subscription_id=<?php echo $subscription->merchant_subscription_id; ?>">Resume This Subscription</a>
        <a href="?action=cancel_subscription&merchant_subscription_id=<?php echo $subscription->merchant_subscription_id; ?>">Cancel This Subscription</a>
    <?php endif; ?>
<?php endif; ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<title>Subscription <?php echo $subscription->merchant_subscription_id; ?></title>
</head>
<body>

<?php if (isset($message)): ?>
	<div>
		<strong><?php echo $message; ?></strong>
	</div>
<?php endif; ?>

<form action="?" method="get">
    <input type="hidden" name="action" value="subscription" />
    <label for="merchant_subscription_id">Subscription ID:</label>
    <input type="text" name="merchant_subscription_id" id="merchant_subscription_id" value="<?php if (isset($_GET['merchant_subscription_id'])) {
    echo $_GET['merchant_subscription_id'];
} ?>"/>
    <input type="submit" value="View">
</form>

<?php if (isset($subscription)):?>
    <h1>Subscription: <?php echo $subscription->merchant_subscription_id; ?></h1>
    <pre><?php var_dump($subscription); ?></pre>
<?php endif; ?>
</body>
</html>
