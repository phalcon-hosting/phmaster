<?php

use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

$di->set('githubAuth', function() use ($di,$config){

    $auth = new \PH\Master\Auth\OAuth\GithubAuth();

    $auth->setDi($di);
    $auth->setConfig($config);
    $auth->setup();

    return $auth;

});
