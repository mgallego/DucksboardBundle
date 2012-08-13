<?php

/**
 * This file is part of the DucksboardBundle package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace SFM\DucksboardBundle\Connection;

class Connector
{

    protected $connector;


    public function createConnector($apiPath, $apiKey){
	$this->connector = curl_init($apiPath);
	curl_setopt($this->connector, CURLOPT_USERPWD, $apiKey.":ignored");
	curl_setopt ($this->connector,CURLOPT_RETURNTRANSFER,true);
    }

    
    public function setMethod($method = 'POST'){
	$methodKey = 1;

	if ($method === 'GET'){
	    $methodKey = 0;
	}
	curl_setopt ($this->connector, CURLOPT_POST, $methodKey);
    }


    public function exec(){
	return curl_exec ($this->connector);
    }



    public function  setData($data){
	if ($data){
	    curl_setopt ($this->connector, CURLOPT_POSTFIELDS, $data);
	}
    }



    public function close(){
	curl_close($this->connector);
    }

}