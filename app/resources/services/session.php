<?php
/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function() {
    $session = new \Phalcon\Session\Adapter\Memcache(array(
            'host' => 'localhost'
        )
    );
//    $session = new Phalcon\Session\Adapter\Files();

    $session->start();

    return $session;
});