<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;
use Kadhamw\ConnectAPI\API\Opportunity;
use Kadhamw\ConnectAPI\API\Contact;
use Kadhamw\ConnectAPI\API\ProductFactory;
use Kadhamw\ConnectAPI\Models\Product;
use Kadhamw\ConnectAPI\API\Location;

class ConnectAPI
{
    public function test(){
        // return Location::getLocations();
        // $product = new Product();


        // 52, "Test Description", 1, 900, 150, 652
        return ProductFactory::postProduct($product);
    }
}
