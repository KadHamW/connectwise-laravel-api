<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class Location
{
    public static function getLocations(){
        $conn = new Connection();
        $_locations = [];
        $result = $conn->request('system/locations');
        $tmp_locations = json_decode($result);
        foreach($tmp_locations as $tmp_location){
            $_locations[] = $tmp_location;
        }
        return $_locations;
    }
}
