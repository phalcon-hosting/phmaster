<?php

use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

$di->set('dispatcher', function() use ($config){

    $dispatcher = new \Phalcon\Mvc\Dispatcher();

    // when working on the development environment, we need the debugger to show us what is going bad
    if("development" != APPLICATION_ENV){

        //Create an event manager
        $eventsManager = new \Phalcon\Events\Manager();

        //Attach a listener for 404 and other errors
        $eventsManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {

            //Handle 404 exceptions
            if ($exception instanceof DispatchException) {
                $dispatcher->forward(array(
                    'controller' => 'error',
                    'action' => 'notFound'
                ));
                return false;
            }

            // Not a 404, then we trigger an error (that aims go in the error log)
            trigger_error("An exception has been detected from the dispatcher event :" . $exception->getMessage(),E_USER_WARNING);



            //Handle other exceptions
            $dispatcher->forward(array(
                'controller' => 'error',
                'action' => 'fatal'
            ));

            return false;
        });

        //Bind the eventsManager to the view component
        $dispatcher->setEventsManager($eventsManager);

    }

    return $dispatcher;
});
