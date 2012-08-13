#v.0.1
####Include the connector service in the own service

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

####The push and pull methods dont return data. The correct way to obtain the response is this:
```php
   ...
   $widgetActualData = $widget->getArrayResponse();		     
   //or
   $widgetActualData = $widget->getRawResponse();		     

```
