<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class Contact
{
    public static function getContactCount(){
        $conn = new Connection();
        $result = $conn->request('company/contacts/count');
        return json_decode($result)->count;
    }

    public static function getContacts(){
        $count = Contact::getContactCount();
        $pages = (int)ceil($count / 100);
        $tmp_contacts = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('company/contacts/?pagesize=100&page='.$i);
            $tmp_contacts = json_decode($result);
            foreach($tmp_contacts as $tmp_contact){
                $tmp_contacts[] = $tmp_contact;
            }
        }
        return $tmp_contacts;
    }

    public static function getEmail($contact){
        foreach ($contact->communicationItems as $commItem) {
            if ($commItem->communicationType == "Email"){
                return $commItem->value;
            }
        }
        return "";
    }
}
