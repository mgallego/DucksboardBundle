# DucksboardBundle for Symfony2

[![Build Status](https://secure.travis-ci.org/mgallego/DucksboardBundle.png?branch=master)](http://travis-ci.org/mgallego/DucksboardBundle)

This bundle integrates Symfony2 applications with the Ducksboard API.

## Dependencies
PHP Curl library http://php.net/manual/en/book.curl.php

## Instalation

### With composer

Add the project in the `composer.json` file:
```json
...
"require": {
...
	"sfm/ducksboard-bundle": "dev-master"
...
}
```

and in the `AppKernel.php` file:
```php
	$bundles = array(
        ...
	    new SFM\DucksboardBundle\SFMDucksboardBundle(),
	...
        );
```

Execute 
	php composer.phar install


### With deps files

Add the project in the `deps` file:

```php
[DucksboardBundle]
    git=https://github.com/mgallego/DucksboardBundle.git
    target=/bundles/SFM/DucksboardBundle
```

and in the `autoload.php' file:

```php
$loader->registerNamespaces(array(
    ...
    'SFM'         => __DIR__.'/../vendor/bundles',
    ...
```

and in the `AppKernel.php` file:
```php
	$bundles = array(
        ...
	    new SFM\DucksboardBundle\SFMDucksboardBundle(),
	...
        );
```

## Use like an own service

First you need to include the Ducksboard apiKey into the `parameters` file (ini/yml):
```php
ducksboard_api    =  xxxxxxxxxxxxxxx
```

Second, create the service:

```php
services:
...
...
    example.ducksboard:
        class: SFM\DucksboardBundle\Adapter\Widget
        arguments: [@sfm.ducksboard.connector]	
        calls:
            - [setApiKey, [%ducksboard_api%]]

```

Now you can use your own service that set automatically the apikey

## Use the bundle service

The bundle has a service prepared to use. Example:

```php
$widget = $this->container->get('sfm.ducksboard.widget');
$widget->setApiKey($this->container->getParameter('ducksboard_api'));
```

## Examples of use

### Push method

*Simple Widget*
```php
        $widget = $this->container->get('screencast.ducksboard');
        $widget->setData(array($widgetID => array('value' => $val1)));
        $widget->push();
```

*Double Widget*
```php
        $widget = $this->container->get('screencast.ducksboard');
        $dateData1 = array(
            array('timestamp' => time(), 'value' => '130'),
            array('timestamp' => time() - ((24*60*60)) , 'value' => '50'),
            array('timestamp' => time() - ((2*24*60*60)) , 'value' => '70'),
            array('timestamp' => time() - ((3*24*60*60)) , 'value' => '20'),
            array('timestamp' => time() - ((4*24*60*60)) , 'value' => '50'),
            array('timestamp' => time() - ((4*24*60*60)) , 'value' => '80'),
            array('timestamp' => time() - ((4*24*60*60)) , 'value' => '100'));

        $dateData2 = array(
            array('timestamp' => time(), 'value' => '80'),
            array('timestamp' => time() - ((24*60*60)) , 'value' => '20'),
            array('timestamp' => time() - ((2*24*60*60)) , 'value' => '70'),
            array('timestamp' => time() - ((3*24*60*60)) , 'value' => '80'),
            array('timestamp' => time() - ((4*24*60*60)) , 'value' => '50'),
            array('timestamp' => time() - ((4*24*60*60)) , 'value' => '90'),
            array('timestamp' => time() - ((4*24*60*60)) , 'value' => '30'));

        $widgetGraphData = array(
            $widgetId1=> $dateData1,
            $widgetId2 => $dateData2
            );

        $widget->setData($widgetGraphData);
        $widget->push();
```

### Pull method

*Get the 3 last data of a widget*
```php
   $widget->getLastValues($widgetId, 3);
   $widgetActualData = $widget->getArrayResponse();		     
   //or
   $widgetActualData = $widget->getRawResponse();		     

```

*Find data by seconds*
```php
   $widget->findBySeconds($widgetId, $seconds);
   $widgetActualData = $widget->getArrayResponse();		     
   //or
   $widgetActualData = $widget->getRawResponse();		     
```

*Find data by timespan*
```php
   $widget->findByTimespan($widgetId, 'monthly', $timezone);
   $widgetActualData = $widget->getArrayResponse();		     
   //or
   $widgetActualData = $widget->getRawResponse();		     

```

## Other resources
Oficial Ducskboard API documentation: http://ducksboard.com/our-apis/

A Demo video with examples (spanish): https://vimeo.com/46636287

