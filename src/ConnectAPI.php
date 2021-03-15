<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;
use Kadhamw\ConnectAPI\API\Opportunity;

class ConnectAPI
{
    public function test(){
        return Opportunity::postOpportunity("Test");
    }
}
