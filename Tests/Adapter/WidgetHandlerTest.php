<?php

namespace SFM\DucksboardBundle\Tests\Adapter;

use SFM\DucksboardBundle\Adapter\WidgetHandler;
use SFM\DucksboardBundle\Connection\Connector;

class WidgetHanlderTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGetApiPath(){
	$widgetHandler = new WidgetHandler($connector = new Connector());
	$parameters = array('1');
	$this->assertEquals($widgetHandler->getApiPath('push', $parameters), 'https://push.ducksboard.com/values/1');
	$parameters = array('2','/last/?counter=1');
	$this->assertEquals($widgetHandler->getApiPath('pull', $parameters), 'https://pull.ducksboard.com/values/2/last/?counter=1');
    }


}