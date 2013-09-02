<?php

$di->setShared('notification', function() use ($config, $language) {
    return new \PH\Master\NotificationService();
});
