<?php

namespace SFM\DucksboardBundle\Adapter;

use SFM\DucksboardBundle\Adapter\WidgetHandler;

class Widget extends WidgetHandler{


    public function getLastValues($widgetId, $count = 3){
	$this->callApi($this->getApiPath('pull', array($widgetId, "/last/?count={$count}")),'GET');
    }

    public function findBySeconds($widgetId, $seconds){
	$this->callApi($this->getApiPath('pull', array($widgetId, "/since?seconds={$seconds}")),'GET');
    }
        
    public function findByTimespan($widgetId, $timespan, $timezone){
	$this->callApi($this->getApiPath('pull', array($widgetId, "/timespan?timespan={$timespan}&timezone={$timezone}" )),'GET');
    }

    public function addToCounter($widgetId)
    {
	$currentValue = 0;
	$this->getLastValues($widgetId, 1);
	$currentWidgetData = $this->getArrayResponse();
	
	if ($currentWidgetData[0]['data']){
	    $currentValue = $currentWidgetData[0]['data'][0]['value'];
	}

	$widgetData = array($widgetId => array('value' => $currentValue + 1 ));
	$this->setData($widgetData);
	$this->push();
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