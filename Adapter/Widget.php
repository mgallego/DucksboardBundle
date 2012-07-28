<?php

namespace SFM\DucksboardBundle\Adapter;

use SFM\DucksboardBundle\Adapter\WidgetHandler;

class Widget extends WidgetHandler{

        public function getLastValue($widgetId){
                $apiPath = $this->getPullApiPath() . $widgetId . '/last/';
                return json_decode($this->callApi($apiPath, 'GET'));
        }


}