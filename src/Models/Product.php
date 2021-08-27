<?php

namespace Kadhamw\ConnectAPI\Models;

use Kadhamw\ConnectAPI\API\ProductFactory;

class Product
{
    public $catalog_cwid;
    public $customer_desc;
    public $quantity;
    public $price;
    public $cost;
    public $opp_cwid;
    public $locationID;
    public $businessUnitId;
    public $description = "";
    public $sequenceNumber;

    private $required = ['catalog_cwid', 'customer_desc', 'quantity', 'price', 'cost', 'opp_cwid', 'locationID', 'businessUnitId'];

    public function __construct(int $catalog_cwid, string $customer_desc, int $quantity, float $price, float $cost, int $opp_cwid, int $locationID, int $businessUnitId, int $sequenceNumber = 1)
    {
        $this->catalog_cwid = $catalog_cwid;
        $this->customer_desc = $customer_desc;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->cost = $cost;
        $this->opp_cwid = $opp_cwid;
        $this->locationID = $locationID;
        $this->businessUnitId = $businessUnitId;
        $this->sequenceNumber = $sequenceNumber;
    }
}
