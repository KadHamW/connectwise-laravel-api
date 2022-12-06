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
    public static function getOpportunities(){
        $count = OpportunityFactory::getOpportunitiesCount();
        $pages = (int)ceil($count / 100);
        $tmp_opps = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('sales/opportunities/?pagesize=100&page='.$i);
            $tmp_opps = json_decode($result);
            foreach($tmp_opps as $tmp_opp){
                $tmp_opps[] = $tmp_opp;
            }
        }
        return $tmp_opps;
    }

    public static function getOpportunity($id){
        $conn = new Connection();
        $result = $conn->request('sales/opportunities/'.$id);
        return json_decode($result);
    }

    public static function getOpportunityForecast($id){
        $conn = new Connection();
        $result = $conn->request('sales/opportunities/'.$id.'/forecast');
        return json_decode($result);
    }

    public static function updateStatus(int $oppID, int $statusID){
        $conn = new Connection();
        $data = [
            'status' => [
                'id' => $statusID,
            ],
        ];
        $result = $conn->request('sales/opportunities/'.$oppID,$data,'PATCH');
        return json_decode($result);
    }

    public static function getStatuses(){
        $conn = new Connection();
        $result = $conn->request('sales/opportunities/statuses');
        return json_decode($result);
    }
}
