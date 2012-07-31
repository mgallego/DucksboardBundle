<?php

namespace SFM\DucksboardBundle\Adapter;

use SFM\DucksboardBundle\Adapter\WidgetHandler;

class Widget extends WidgetHandler{

        public function getLastValues($widgetId, $count = null){
                $apiPath = $this->getPullApiPath() . $widgetId . '/last/';
                if ($count){
                        $apiPath = $apiPath . "?count={$count}";
                }
                return json_decode($this->callApi($apiPath, 'GET'));
        }

        public function findBySeconds($widgetId, $seconds){
                $apiPath = $this->getPullApiPath() . $widgetId . "/since?seconds={$seconds}";
                return json_decode($this->callApi($apiPath, 'GET'));
        }
        
        public function findByTimespan($widgetId, $timespan, $timezone){
                $apiPath = $this->getPullApiPath() . $widgetId . "/timespan?timespan={$timespan}&timezone={$timezone}";
                return json_decode($this->callApi($apiPath, 'GET'));
        }

        public function setData($data){
                $this->data = $data;
        }

        public function appendData($data){
                $this->data +=  $data;
        }

        public function getData(){
                return $this->data;
        }
}