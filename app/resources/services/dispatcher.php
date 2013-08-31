<?php

use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

$di->set('dispatcher', function() use ($config){

    $dispatcher = new \Phalcon\Mvc\Dispatcher();

    $eventsManager = new \Phalcon\Events\Manager();

    // when working on the development environment, we need the debugger to show us what is going bad
    if("development" != APPLICATION_ENV){

        /*
         * Attach a listener for 404 and other errors
         */
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


    }

    /**
     * attach a listener to redirect to the login page if not logged
     */
    $eventsManager->attach("dispatch:beforeExecuteRoute", function($event, $dispatcher, $exception) {
        /* @var $dispatcher \Phalcon\Dispatcher */

        $authService = $dispatcher->getDi()->get("auth");

        // if user is not logged and not in the AuthController, then we redirect him to the login screen
        if (
            !$authService->isLogged()
            && $dispatcher->getControllerName() != "auth"
        ) {
            return $dispatcher->getDi()->get("response")->redirect('login');
        }

        return true;

    });


    //Bind the eventsManager to the view component
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});
