<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;
use Kadhamw\ConnectAPI\API\OpportunityFactory;
use Kadhamw\ConnectAPI\API\Contact;
use Kadhamw\ConnectAPI\API\ProductFactory;
use Kadhamw\ConnectAPI\Models\Product;
use Kadhamw\ConnectAPI\API\LocationFactory;
use Kadhamw\ConnectAPI\API\MemberFactory;
use Kadhamw\ConnectAPI\API\CompanyFactory;
use Kadhamw\ConnectAPI\API\TicketFactory;
use Kadhamw\ConnectAPI\Connection;

class ConnectAPI
{
    public function test(){
        // $conn = new Connection;
        // $conn->version();
        // dd(OpportunityFactory::getStatuses());
        $oppID = OpportunityFactory::postOpportunity('Quoter:TEST',
            "khampson",
            19966,
            1245,
            11
        );
        dd($oppID);
        //return CompanyFactory::getCompanies()[0];
        //return LocationFactory::getLocations();
        // $product = new Product();

        // return ProductFactory::deleteProduct(6715);
        // 52, "Test Description", 1, 900, 150, 652
        // $data = [
        //     52,'TEST',1,90.20,123,673,11,1
        // ];
        // return ProductFactory::putProduct(
        //     6719,
        //     52,
        //     678,
        //     "Bundled Service",
        //     1,
        //     214,
        //     0,
        //     11,
        //     1,
        //     "Description"
        // );
    }
}
