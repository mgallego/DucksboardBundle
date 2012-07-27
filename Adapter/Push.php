<?php

namespace SFM\DucksboardBundle\Adapter;

class Push{
        public function sendValue($apiKey, $widgetId, $value){
                $ch = curl_init('https://push.ducksboard.com/v/'.$widgetId);
                curl_setopt($ch, CURLOPT_USERPWD, $apiKey.":ignored");
                curl_setopt ($ch, CURLOPT_POSTFIELDS, '{"value": '.$value.' }');
                curl_setopt ($ch, CURLOPT_POST, 1);
                curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
                $data = curl_exec ($ch);
                curl_close($ch);
                return json_decode($data);
        }

        public function getCountValue($apiKey, $widgetId){
                $ch = curl_init('https://pull.ducksboard.com/values/'.$widgetId.'/last/');
                curl_setopt($ch, CURLOPT_USERPWD, $apiKey.":ignored");
                curl_setopt ($ch, CURLOPT_POST, 0);
                curl_setopt ($ch, CURLOPT_HEADER, 0);
                curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
                $data = curl_exec ($ch);
                curl_close($ch);
                return json_decode($data);
        }


}