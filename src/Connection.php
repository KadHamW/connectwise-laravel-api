<?php

namespace Kadhamw\ConnectAPI;

use PHPUnit\Framework\Exception;

class Connection
{

    private $pubk;
    private $prik;
    private $companyID;
    private $clientID;
    private $username;

    public function __construct()
    {
        $this->pubk = config('connectapi.pubk');
        $this->prik = config('connectapi.prik');
        $this->companyID = config('connectapi.companyID');
        $this->clientID = config('connectapi.clientID');
        $this->username = $this->companyID .'+'. $this->pubk;
    }

    public function request(String $query){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_URL, "https://api-aus.myconnectwise.net/v2020_4/apis/3.0/".$query);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        $headers = array();
        $headers[] = 'Authorization: Basic '.base64_encode($this->username.":".$this->prik);
        $headers[] = 'ClientId: '.$this->clientID;
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        if ($result === false) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);
        return $result;
    }
}
