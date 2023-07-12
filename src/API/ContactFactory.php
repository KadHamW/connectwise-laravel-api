<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class ContactFactory
{
    public static function getContactCount(){
        $conn = new Connection();
        $result = $conn->request('company/contacts/count');
        return json_decode($result)->count;
    }

    public static function getContacts(){
        $count = ContactFactory::getContactCount();
        $pages = (int)ceil($count / 100);
        $tmp_contacts = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('company/contacts/?pagesize=100&page='.$i);
            $_tmp_contacts = json_decode($result);
            foreach($_tmp_contacts as $tmp_contact){
                $tmp_contacts[] = $tmp_contact;
            }
        }
        return $tmp_contacts;
    }

    public static function getEmail($contact){
        if (isset($contact->communicationItems)){
            foreach ($contact->communicationItems as $commItem) {
                if ($commItem->communicationType == "Email"){
                    return $commItem->value;
                }
            }
        }
        return "";
    }
}
