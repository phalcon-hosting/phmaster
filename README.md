This repository contains code that belongs to PhalconHosting.

--- This code is meant to be deployed only by the PhalconHosting master ---

[![Build Status](https://drone.io/github.com/Phalcon-hosting/phmaster/status.png)](https://drone.io/github.com/Phalcon-hosting/phmaster/latest)

Requirements
-------------

* Make sure to have phalcon extension loaded into php : ```php -m | grep phalcon```
* Make sure to have memcached server installed : ```service memcached status```
* Make sure to have memcache extension loaded into php : ```php -m | grep memcache```
* Make sure to have the pecl_http extension loaded into php (http://php.net/manual/en/http.install.php) : ```php -m | grep http```

Installing
-------------


Run composer to install dependencies :

```
wget https://getcomposer.org/installer && php installer && php composer.phar install
```


Copy the ```app/config/config.dist.php``` to ```app/config/config.php``` and update the content


Make the volt directory writable by php
```
chown -R www-data app/cache #depends on which user will run the application

OR

chmod 777 -R app/cache
```

When using apache2, make sure that mod_rewrite is enabled:

sudo a2enmod rewrite
