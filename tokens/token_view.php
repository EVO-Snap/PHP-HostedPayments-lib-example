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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<title>Token <?php echo $token->merchant_token_id; ?></title>
</head>
<body>

<?php
    if (isset($message)) {
        ?>
	<div><strong><?php echo $message; ?>:</strong></div>
<?php
    }
    if ('TOKEN_STATUS_ACTIVE' === $token->status) {
        ?><a href="?action=token&merchant_token_id=<?php echo $token->merchant_token_id; ?>">Process Order</a><?php
    } ?>
		<h1>Token: <?php echo $token->merchant_token_id; ?> <?php echo $token->created; ?></h1>
		<h2>Billing Address</h2>
        <table>
            <tr>
                <td align="right"><strong>Name:</strong></td>
                <td><?php echo $token->billto_first_name; ?> <?php echo $token->billto_last_name; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>Company:</strong></td>
                <td><?php echo $token->billto_company; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>Address:</strong></td>
                <td><?php echo $token->billto_address1; ?><br/><?php echo $token->billto_address2; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>House Number:</strong></td>
                <td><?php echo $token->billto_house_number; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>PO Box:</strong></td>
                <td><?php echo $token->billto_po_box_number; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>City:</strong></td>
                <td><?php echo $token->billto_city; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>ZIP/Postcode:</strong></td>
                <td><?php echo $token->billto_zipcode; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>State:</strong></td>
                <td><?php echo $token->billto_state; ?></td>
            </tr>
            <tr>
                <td align="right"><strong>Country:</strong></td>
                <td><?php echo $token->billto_country; ?></td>
            </tr>
        </table>
        <hr/>
        <h2>Raw Token Info</h2>
        <pre><?php var_dump($token); ?></pre>
	</body>
</html>
