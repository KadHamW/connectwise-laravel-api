<?php

namespace Kadhamw\ConnectAPI;

use PHPUnit\Framework\Exception;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Log;

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

    public function version(){
        $url = "https://api-aus.myconnectwise.net/login/companyinfo/".$this->companyID;
        $headers = array();
        $headers[] = 'Authorization: Basic '.base64_encode($this->username.":".$this->prik);
        $headers[] = 'ClientId: '.$this->clientID;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($curl));

        return $result->Codebase;
    }

    public function request(String $query, $a_data = [], $method = ""){
        $url = "https://api-aus.myconnectwise.net/".$this->version()."apis/3.0/".$query;
        $headers = array();
        $headers[] = 'Authorization: Basic '.base64_encode($this->username.":".$this->prik);
        $headers[] = 'ClientId: '.$this->clientID;
        $curl = curl_init();
        if (!empty($a_data)){
            $payload = json_encode($a_data);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Content-Length: ' . strlen($payload);
        }
        if($method){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (config('CWDEBUG'))
        {
            Log::debug("Request: URL: " . $url . '. Headers: ' . implode(',', $headers) . '. Data: ' . implode(',', $a_data));
        }

        $result = curl_exec($curl);

        if ($result === false) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);
        if (config('CWDEBUG')){ Log::debug("Result: " . $result); }
        return $result;
    }
}
