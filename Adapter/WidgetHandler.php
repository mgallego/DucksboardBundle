<?php

namespace SFM\DucksboardBundle\Adapter;

class WidgetHandler{

        protected $apiKey;
        private $pushApiPath = 'https://push.ducksboard.com/values/';
        private $pullApiPath = 'https://pull.ducksboard.com/values/';
        
        public function push($data){
                foreach ($data as $widgetId => $widgetData){
                        $apiPath = $this->pushApiPath . $widgetId;
                        $retData = $this->callApi($apiPath, 'POST', json_encode($widgetData));
                        try{
                                if (json_decode($retData)->response !== 'ok'){
                                        return false;
                                }
                        }
                        catch(\ErrorException $e){
                                die($retData);
                        }
                }
                return true;
        }

        public function callApi($apiPath, $method,  $inputData = null){ 
                $ch = curl_init($apiPath);
                curl_setopt($ch, CURLOPT_USERPWD, $this->apiKey.":ignored");
                if ($inputData){
                        curl_setopt ($ch, CURLOPT_POSTFIELDS, $inputData);
                }
                if ($method === 'POST'){
                        curl_setopt ($ch, CURLOPT_POST, 1);
                }elseif ($method === 'GET'){
                        curl_setopt ($ch, CURLOPT_POST, 0);
                }
                curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
                $outData = curl_exec ($ch);
                curl_close($ch);

                return $outData;
        } 

        public function setApiKey($apiKey){
                $this->apiKey = $apiKey;
        }

        public function getPushApiPath(){
                return $this->pushApiPath;
        }

        public function getPullApiPath(){
                return $this->pullApiPath;
        }
}