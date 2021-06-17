<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class MemberFactory
{
    public static function getMembers(){
        $conn = new Connection();
        $result = $conn->request('system/members');
        dd($result);
    }
}
