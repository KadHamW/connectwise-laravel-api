<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class OpportunityFactory
{
    /***
     * @return ID
     */
    public static function postOpportunity(string $name, string $primarySalesRepIdent, int $companyID, int $contactID, int $locationId){
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
            'locationId' => $locationId,
            'businessUnitId' => 1,
        ];

        $result = $conn->request('sales/opportunities', $data);
        return (int)json_decode($result)->id;
    }

    public static function getOpportunitiesCount(){
        $conn = new Connection();
        $result = $conn->request('sales/opportunities/count');
        return json_decode($result)->count;
    }
}
