<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class CompanyFactory
{
    public static function getCompaniesCount(){
        $conn = new Connection();
        $result = $conn->request('company/companies/count');
        return json_decode($result)->count;
    }

    public static function getCompanies(){
        $count = CompanyFactory::getCompaniesCount();
        $pages = (int)ceil($count / 100);
        $_companies = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('company/companies/?pagesize=100&page='.$i);
            $tmp_companies = json_decode($result);
            foreach($tmp_companies as $tmp_company){
                $_companies[] = $tmp_company;
            }
        }
        return $_companies;
    }
}

//
