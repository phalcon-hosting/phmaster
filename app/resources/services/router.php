<?php

use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

$di->set('router', function() use ($config){

    $router= include __DIR__ . "/../router.php";
    return $router;
});
