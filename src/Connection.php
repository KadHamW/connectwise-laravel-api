<?php

namespace Kadhamw\ConnectAPI;

use PHPUnit\Framework\Exception;

use function PHPUnit\Framework\isEmpty;

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

    public function request(String $query, $a_data = []){
        $url = "https://api-aus.myconnectwise.net/v2020_4/apis/3.0/".$query;
        $headers = array();
        $headers[] = 'Authorization: Basic '.base64_encode($this->username.":".$this->prik);
        $headers[] = 'ClientId: '.$this->clientID;
        $curl = curl_init();
        if (!empty($a_data)){
            $payload = http_build_query($a_data);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            dump($payload);
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Content-Length: ' . strlen($payload);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        if ($result === false) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);
        return $result;
    }
}
