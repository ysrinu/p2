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

if (isset($_GET['shipType']))  $shipType=$_GET['shipType'];

# based on shipping type, set the corresponding radio button as checked
if ($shipType=="ground")
  $ground="CHECKED";
elseif ($shipType=="express")
  $express="CHECKED";
elseif ($shipType=="overnight")
  $overnight="CHECKED";

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
