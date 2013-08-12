<?php
/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function(){
    $flash = new Phalcon\Flash\Session(array(
        'error' => 'alert alert-error',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
    return $flash;
});