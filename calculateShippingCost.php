<?php
require('helpers.php');
#---------------------------------------------#
# Set default values for variables if not Set
#---------------------------------------------#

if (isset($_GET['custName'])) {
  $custName=$_GET['custName'];
}else {
  $custName='';
}

# default ship type options (radio buttons) to null (unchecked)
$ground="";
$express="";
$overnight="";
$shipType="";
$shipTypeSurcharge=0;

if (isset($_GET['shipType']))  $shipType=$_GET['shipType'];

# based on shipping type, set the corresponding radio button as checked
if ($shipType=="ground"){
    $ground="CHECKED";
    $shipTypeSurcharge=10;
}
elseif ($shipType=="express"){
  $express="CHECKED";
  $shipTypeSurcharge=50;
}
elseif ($shipType=="overnight"){
  $overnight="CHECKED";
  $shipTypeSurcharge=100;
}


$booksOnly="";
# GET will not have booksOnly value (checkbox) if not set.
#The 2nd check in the if statmeent (to check if 'on'') is therefore redudant
if (isset($_GET['booksOnly']) && $_GET['booksOnly']=="on") {
  $booksOnly="CHECKED";
}

# set from and to Zipcodes
if (isset($_GET['fromZipCode'])) {
  $fromZipCode=$_GET['fromZipCode'];
}else {
  $fromZipCode='';
}

if (isset($_GET['toZipCode'])) {
  $toZipCode=$_GET['toZipCode'];
}else {
  $toZipCode='';
}

# Compute shipping cost
$shipCost=0;

# For the sake of simplicity, we will calculate the distance between two zipcodes as the differene of their numeric zipcodes, miles as the unit
# Ideally, we should lookup a web service that will return distance between geogrphical pg_connection_status
$dist = ABS( intval($fromZipCode) - intval($toZipCode));
$chargePerMile=0.25; // 25 cents!
$shipCost=($dist * $chargePerMile) + $shipTypeSurcharge;

# if book-only, give 10% discount
if ($booksOnly=="CHECKED") $shipCost = $shipCost * 0.90;
