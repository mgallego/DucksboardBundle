<?php

/**
 * This file is part of the DucksboardBundle package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace SFM\DucksboardBundle\Adapter;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use SFM\DucksboardBundle\Adapter\Exception\DucksboardPushException;
use SFM\DucksboardBundle\Connection\Connector;


class WidgetHandler{

    protected $apiKey;
    private $pushApiPath = 'https://push.ducksboard.com/values/';
    private $pullApiPath = 'https://pull.ducksboard.com/values/';
    protected $data;
        


    public function push(){
	$serializer = $this->getSerializer();
	$data = $this->data;
	$response = array();
	foreach ($data as $widgetId => $widgetData){
	    try{
		$apiPath = $this->pushApiPath . $widgetId;
		$retData = $this->callApi($apiPath, 'POST', $serializer->serialize($widgetData, 'json'));
		$response[] = $serializer->decode($retData, 'json');
	    }
	    catch(\ErrorException $e){
		throw new DucksboardPushException($apiPath, $e);
	    }
	}
	return $response;
    }



    public function createConnector($apiPath, $method){
	$connector = new Connector($apiPath, $this->apiKey);
	$connector->setMethod($method);
	return $connector;
    }


    public function callApi($apiPath, $method,  $inputData = null){ 
	$connector = $this->createConnector($apiPath, $method);
	$connector->setData($inputData);
	$response = $connector->exec();
	$connector->close();
	return $response;
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

    public function getSerializer(){
	$encoders = array('json' => new JsonEncoder());
	$normalizers = array(new GetSetMethodNormalizer());
	return new Serializer($normalizers, $encoders);
    }

}