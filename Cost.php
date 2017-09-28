<?php

namespace Shipping;
use Exception; # Use this instead of definition a new exception within our class definition

class Cost {

  /**
  * Properties
  */
  private $custName; # Customer name
  private $shipTypes = ['ground','express','overnight']; # possible list of shipping types
  private $shipType; # Provided shipping type
  private $booksOnly; # if shipping only booksOnly
  private $fromZipCode; # shipping origin
  private $toZipCode; # shipping destination
  const CHARGE_PER_MILE=0.25; # charge per shipping mile in $.

  /**
  * Magic method that's invoked whenever an object of this class is instantiated
  */
  public function __construct($custName,$shipType,$booksOnly,$fromZipCode,$toZipCode){

    # Confirm the provided shipping type is valid
    if (!in_array($shipType, $this->shipTypes)) {
      throw new Exception("Shipping type `".$shipType."` is not valid", 1);
    }

    $this->shipType = $shipType;
    $this->custName = $custName;
    $this->booksOnly = $booksOnly;
    $this->fromZipCode = $fromZipCode;
    $this->toZipCode = $toZipCode;
  }

  /**
  * Business logic to compute the shipping cost
  */
  public function getShippingCost() {

    # based on shipping type, set the surcharge
    $shipTypeSurcharge=0;

    switch ($this->shipType) {
      case "ground":
      $shipTypeSurcharge=10;
      break;
      case "express":
      $shipTypeSurcharge=50;
      break;
      case "overnight":
      $shipTypeSurcharge=100;
      break;
    }

    # Initialize total cost to zero dolllars
    $shipCost=0;

    # For the sake of simplicity, we will calculate the distance between two zipcodes as the differene of their numeric zipcodes, miles as the unit
    # Ideally, we should lookup a web service that will return distance between geogrphical pg_connection_status
    $dist = ABS( intval($this->fromZipCode) - intval($this->toZipCode));
    $shipCost=($dist * self::CHARGE_PER_MILE) + $shipTypeSurcharge;

    # if book-only, give 10% discount
    if ($this->booksOnly==true) $shipCost = $shipCost * 0.90;

    return $shipCost;
  }
}
