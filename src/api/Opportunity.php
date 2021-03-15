<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class Opportunity
{
    public static function postOpportunity($name){
        $conn = new Connection();
        $data = [
            'name' => $name,
        ];
        $result = $conn->request('​sales​/opportunities', $data);
        dd($result);
    }

    public static function getOpportunitiesCount(){
        $conn = new Connection();
        $result = $conn->request('sales/opportunities/count');
        return json_decode($result)->count;
    }
}
