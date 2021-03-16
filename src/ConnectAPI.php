<?php

namespace Kadhamw\ConnectAPI;

use Kadhamw\ConnectAPI\API\Company;
use Kadhamw\ConnectAPI\API\Opportunity;
use Kadhamw\ConnectAPI\API\Contact;

class ConnectAPI
{
    public function test(){
        $contacts = Contact::getContacts();
        return Contact::getEmail($contacts[0]);
    }
}
