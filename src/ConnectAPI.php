<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;
use Kadhamw\ConnectAPI\API\Opportunity;
use Kadhamw\ConnectAPI\API\Contact;

class ConnectAPI
{
    public function test(){
        return Opportunity::postOpportunity('Test', 'khampson', '19563', '591');
    }
}
