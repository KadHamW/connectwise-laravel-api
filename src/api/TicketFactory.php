<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\API\TicketFactory as APITicketFactory;
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

    public static function getTickets(){
        $count = TicketFactory::getTicketCount();
        $pages = (int)ceil($count / 100);
        $_tickets = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('service/tickets/?pagesize=100&page='.$i);
            $tmp_tickets = json_decode($result);
            $_tickets[] = $tmp_tickets;
        }

        return $_tickets;
    }
}
