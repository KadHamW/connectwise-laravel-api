<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class Opportunity
{
    public static function postOpportunity($name, $primarySalesRepIdent, $companyID, $contactID){
        $conn = new Connection();
        $data = [
            'name' => $name,
            'primarySalesRep' => [
                'identifier' => $primarySalesRepIdent
            ],
            'company' => [
                'id' => $companyID
            ],
            'contact' => [
                'id' => $contactID
            ],
        ];

        $result = $conn->request('sales/opportunities', $data);
        return json_decode($result)->id;
    }

    public static function getOpportunitiesCount(){
        $conn = new Connection();
        $result = $conn->request('sales/opportunities/count');
        return json_decode($result)->count;
    }
}
