<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;
use Kadhamw\ConnectAPI\Models\CW_Object;

class Consume
{
    function getCount(CW_Object $object){
        $request = $object->area . $object->type . "/count";
        $conn = new Connection();
        $result = $conn->request($request);
        return json_decode($result)->count;
    }
}
