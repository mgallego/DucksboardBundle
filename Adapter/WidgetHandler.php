<?php

namespace SFM\DucksboardBundle\Adapter;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use SFM\DucksboardBundle\Adapter\Exception\DucksboardPushException;

class WidgetHandler{

    protected $apiKey;
    private $pushApiPath = 'https://push.ducksboard.com/values/';
    private $pullApiPath = 'https://pull.ducksboard.com/values/';
    protected $data;
        
    public function push(){
	$encoders = array('json' => new JsonEncoder());
	$normalizers = array(new GetSetMethodNormalizer());
	$serializer = new Serializer($normalizers, $encoders);

	$data = $this->data;
	foreach ($data as $widgetId => $widgetData){
	    $apiPath = $this->pushApiPath . $widgetId;
	    $retData = $this->callApi($apiPath, 'POST', $serializer->serialize($widgetData, 'json'));
	    $retResponse = $serializer->decode($retData, 'json');
	    try{
		if ($retResponse['response'] !== 'ok'){
		    return false;
		}
	    }
	    catch(\ErrorException $e){
		throw new DucksboardPushException($apiPath, $retData);
	    }
	}
	return true;
    }

    public function callApi($apiPath, $method,  $inputData = null){ 
	$ch = curl_init($apiPath);
	curl_setopt($ch, CURLOPT_USERPWD, $this->apiKey.":ignored");
	if ($inputData){
	    curl_setopt ($ch, CURLOPT_POSTFIELDS, $inputData);
	}
	if ($method === 'POST'){
	    curl_setopt ($ch, CURLOPT_POST, 1);
	}elseif ($method === 'GET'){
	    curl_setopt ($ch, CURLOPT_POST, 0);
	}
	curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
	$outData = curl_exec ($ch);
	curl_close($ch);

	return $outData;
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
}