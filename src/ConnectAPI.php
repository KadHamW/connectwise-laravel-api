<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;
use Kadhamw\ConnectAPI\API\Opportunity;
use Kadhamw\ConnectAPI\API\Contact;
use Kadhamw\ConnectAPI\API\ProductFactory;
use Kadhamw\ConnectAPI\Models\Product;
use Kadhamw\ConnectAPI\API\LocationFactory;

class ConnectAPI
{
    public function test(){
        //return LocationFactory::getLocations();
        // $product = new Product();


        // 52, "Test Description", 1, 900, 150, 652
        $product = new Product(53,'TEST',1,90.20,123,673,11,1);
        return ProductFactory::postProduct($product);
    }
}
