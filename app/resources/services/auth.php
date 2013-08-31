<?php

use Phalcon\Mvc\Dispatcher\Exception as DispatchException;
use \PH\Master\Auth\OAuth\GithubAuth;
use \PH\Master\Auth\OAuth\GoogleAuth;

$di->setShared("auth",function() use ($di,$config){

    return new \PH\Master\Auth\AuthService();

});

$di->set('githubAuth', function() use ($di,$config){

    $githubAuth = new GithubAuth();

    $githubAuth->setDi($di);
    $githubAuth->setConfig($config);
    $githubAuth->setup();

    return $githubAuth;

});

$di->set('googleAuth', function() use ($di, $config){

    $googleAuth = new GoogleAuth();

    $googleAuth->setDi($di);
    $googleAuth->setConfig($config);
    $googleAuth->setup();

    return $googleAuth;
});
