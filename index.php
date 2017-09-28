<?php
require('calculateShippingCost.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Shipping Cost Calculator</title>
</head>
<body>
    <section>
    <header><h1>Shipping Cost Calculator</h1></header>
    <p>
        Calculate shipping cost between two zip codes.
    </p>
    </section>
    <form action="/" method="GET">
        <fieldset>
            <legend>Customer and Package Information</legend>
            <label for="custName" class="category">Name (Required)</label><br />
            <input type="text" name="custName" required id="custName" value="<?= $form->get('custName','') ?>" placeholder="Enter Customer Name" autofocus="autofocus"/><br /><br />
            <label class="category">Shipping Type (Required)</label><br />
            <input type="radio" name="shipType" required id="ground" value="ground" <?php if ($form->isMatch('shipType','ground')) echo 'CHECKED' ?> /><label for="ground">Ground</label><br>
            <input type="radio" name="shipType" required id="express" value="express" <?php if ($form->isMatch('shipType','express')) echo 'CHECKED' ?> /><label for="express">Express</label><br>
            <input type="radio" name="shipType" required id="overnight" value="overnight" <?php if ($form->isMatch('shipType','overnight')) echo 'CHECKED' ?> /><label for="overnight">Overnight</label><br>
            <br />
            <input type="checkbox" name="booksOnly" id="booksOnly" <?php if ($form->isChosen('booksOnly')) echo 'CHECKED' ?> /><label for="booksOnly">Books only</label><br />
        </fieldset><br />
        <fieldset>
            <legend>Shipping Origin and Destination</legend>
            <label for="fromZipCode" class="category">From ZIP Code (Required)</label><br />
            <input type="text" pattern="[0-9]{5}" required name="fromZipCode" id="fromZipCode" value="<?= $form->get('fromZipCode','') ?>" placeholder="Enter 5-digit origin zip code" title="Enter 5-digit zipcode"/><br /><br />
            <label for="toZipCode" class="category">To ZIP Code (Required)</label><br />
            <input type="text" pattern="[0-9]{5}" required name="toZipCode" id="toZipCode" value="<?= $form->get('toZipCode','') ?>" placeholder="Enter 5-digit destination zip code" title="Enter 5-digit zipcode"/><br /><br />
        </fieldset><br />
        <input id="submitButton" type="submit" name="submitButton" value="Calculate Cost"/><br /><br />
        <?php if (isset($errors) && !empty($errors)) :?>
            <div class='alertdanger'>
                <ul>
                    <?php foreach ($errors as $error) :?>
                        <li><?=$error?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif (isset($shippingCost)): ?>
          <div class='output'>
            <label type="text" name="ShippingCost"> Shipping Cost is $<?=sanitize($shippingCost)?></label>
          </div>
        <?php endif; ?>
    </form>
</body>
