<?php

namespace SFM\DucksboardBundle\Tests\Adapter;

use SFM\DucksboardBundle\Adapter\Widget;
use SFM\DucksboardBundle\Connection\Connector;

class WidgetTest extends \PHPUnit_Framework_TestCase
{

    private $widget;
    private $connector;

    public function setUp(){
	$this->connector = $this->getMock('SFM\DucksboardBundle\Connection\Connector');
	$this->widget = $this->getMockForAbstractClass('SFM\DucksboardBundle\Adapter\Widget', array($this->connector));
    }

    public function testSetData(){
	$data = array(1, array('value'=>1));
	$this->widget->setData($data);
	$this->assertEquals($data, $this->widget->getData());
    }

    public function testAppendData(){
	$dataOne = array(1, array('value'=>1));
	$dataTwo = array(2, array('value'=>2));

	$this->widget->setData($dataOne);
	$this->widget->appendData($dataTwo);
	
	$this->assertEquals($dataOne+$dataTwo, $this->widget->getData());
    }
    

}