<?php

namespace SFM\DucksboardBundle\Tests\Adapter;

use SFM\DucksboardBundle\Adapter\Widget;

class WidgetTest extends \PHPUnit_Framework_TestCase
{
    
    public function testSetData(){
	$widget = new Widget();
	$data = array(1, array('value'=>1));
	
	$widget->setData($data);
	$this->assertEquals($data, $widget->getData());
    }

    public function testAppendData(){
	$widget = new Widget();
	$dataOne = array(1, array('value'=>1));
	$dataTwo = array(2, array('value'=>2));

	$widget->setData($dataOne);
	$widget->appendData($dataTwo);
	
	$this->assertEquals($dataOne+$dataTwo, $widget->getData());
    }
    

}