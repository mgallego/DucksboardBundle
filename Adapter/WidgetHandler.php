<?php

namespace SFM\DucksboardBundle\Adapter;

class WidgetHandler{

        protected $apiKey;
        private $pushApiPath = 'https://push.ducksboard.com/values/';

        public function setApiKey($apiKey){
                $this->apiKey = $apiKey;
        }

        public function push($data){
                foreach ($data as $widgetId => $widgetData){
                        $ch = curl_init($this->pushApiPath.$widgetId);
                        curl_setopt($ch, CURLOPT_USERPWD, $this->apiKey.":ignored");
                        curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($widgetData));
                        curl_setopt ($ch, CURLOPT_POST, 1);
                        curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
                        $retData = curl_exec ($ch);
                        curl_close($ch);
                        try{
                        if (json_decode($retData)->response !== 'ok'){
                                return false;
                        }}
                        catch(\ErrorException $e){
                                return false;
                        }
                }
                return true;
        }

        public function getCountValue($widgetId){
                $ch = curl_init('https://pull.ducksboard.com/values/'.$widgetId.'/last/');
                curl_setopt($ch, CURLOPT_USERPWD, $this->apiKey.":ignored");
                curl_setopt ($ch, CURLOPT_POST, 0);
                curl_setopt ($ch, CURLOPT_HEADER, 0);
                curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
                $data = curl_exec ($ch);
                curl_close($ch);
                return json_decode($data);
        }


}