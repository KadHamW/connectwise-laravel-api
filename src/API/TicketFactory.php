<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class TicketFactory
{
    /***
     * @return ID
     */
    public static function postOpportunity(string $name, string $primarySalesRepIdent, int $companyID, int $contactID){
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
        return (int)json_decode($result)->id;
    }

    public static function getTicketCount(){
        $conn = new Connection();
        $result = $conn->request('/service/tickets/count');
        return json_decode($result)->count;
    }
}