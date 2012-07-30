# DucksboardBundle for Symfony2

## Dependencies
PHP Curl library http://php.net/manual/en/book.curl.php

## Instalation

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

