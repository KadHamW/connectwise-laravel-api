<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;

class ConnectAPI
{
    public function test(){
        return Company::getCompanies();
    }
}
