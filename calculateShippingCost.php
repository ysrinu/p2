<?php
require('Form.php');
require('helpers.php');
require('Cost.php');

#import classes
use Shipping\Cost;
use DWA\Form;

# Instantiate a new Form object
$form = new Form($_GET);

if (!$form->isSubmitted()) return; # if form not submitted then nothing to do further here

# Retrieve data from form, default to empty string (or false if boolean) if value not provided
$custName = $form->get('custName', '');
$shipType = $form->get('shipType', '');
$fromZipCode = $form->get('fromZipCode', '');
$toZipCode = $form->get('toZipCode', '');
$booksOnly = $form->isChosen('booksOnly');

# peform validation on the form fields
$errors = $form->validate(
  [
    'custName' => 'required|alpha',
    'shipType' => 'required',
    'fromZipCode' => 'required|zipcode',
    'toZipCode' => 'required|zipcode',
  ]
);

if (!empty($errors)) return; # if any form input errors then return at this point

# Instantiate a new Cost object
$cost = new Cost($custName,$shipType,$booksOnly,$fromZipCode,$toZipCode);

# Call function to compute the shipping cost
$shippingCost = $cost->getShippingCost();
