<?php

namespace SFM\DucksboardBundle\Tests\Adapter;

class WidgetHanlderTest extends \PHPUnit_Framework_TestCase
{
    
    private $widget;
    private $connector;
    
    public function setUp(){
	$this->connector = $this->getMock('SFM\DucksboardBundle\Connection\Connector');
	$this->widget = $this->getMockForAbstractClass('SFM\DucksboardBundle\Adapter\Widget', array($this->connector));
    }

    public function testGetApiPath(){
	$parameters = array('1');
	$this->assertEquals($this->widget->getApiPath('push', $parameters), 'https://push.ducksboard.com/values/1');
	$parameters = array('2','/last/?counter=1');
	$this->assertEquals($this->widget->getApiPath('pull', $parameters), 'https://pull.ducksboard.com/values/2/last/?counter=1');

    }

    
    public function testGetRawResponse(){
	$this->widget->setResponse('{"response": "ok"}');
	$response = array('{"response": "ok"}');
	$this->assertEquals($this->widget->getRawResponse(), $response); 
    }


    public function testGetArrayResponse(){
	$this->widget->setResponse('{"response": "ok"}');
	$response = array(array("response" => "ok"));
	$this->assertEquals($this->widget->getArrayResponse(), $response); 

    }


}