<?php

namespace SFM\DucksboardBundle\Adapter\Exception;

class DucksboardPushException extends \Exception
{
        public function __construct($apiPath, $retData)
    {
            parent::__construct(sprintf("The Ducksboard API Push call {$apiPath} returns {$retData}" ));
    }
}