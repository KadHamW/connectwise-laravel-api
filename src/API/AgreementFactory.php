<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class AgreementFactory
{
    public static function getAgreementsCount(){
        $conn = new Connection();
        $result = $conn->request('finance/agreements/count');
        return json_decode($result)->count;
    }

    public static function getAgreement(){
        $count = AgreementFactory::getAgreementsCount();
        $pages = (int)ceil($count / 100);
        $_companies = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('finance/agreements/?pagesize=100&page='.$i);
            $tmp_companies = json_decode($result);
            foreach($tmp_companies as $tmp_company){
                $_companies[] = $tmp_company;
            }
        }
        return $_companies;
    }

    public static function updateAddition(int $agreeID, int $addID, int $qty){
        $conn = new Connection();
        $data = [
                [
                    'op' => 'replace',
                    'path' => 'quantity',
                    'value' => "$qty"
                ]
        ];
        $result = $conn->request('finance/agreements/'.$agreeID.'/additions/'.$addID,$data,'PATCH');
        return json_decode($result);
    }

    public static function getAgreementAdditions($id){
        $conn = new Connection();
        $result = $conn->request('finance/agreements/'.$id.'/additions');
        return json_decode($result);
    }
}

//
