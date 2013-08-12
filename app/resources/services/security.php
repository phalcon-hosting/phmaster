 <?php
//
 /**
  * Initialize the security plugin
  */
$di->set('dispatcher', function() use ($di) {


//   //Obtain the standard eventsManager from the DI
    $eventsManager = $di->getShared('eventsManager');

//     //Instantiate the Security plugin
     $security = new \PH\Master\Security($di);

//     //Listen for events produced in the dispatcher using the Security plugin
     $eventsManager->attach('dispatch', $security);

     $dispatcher = new Phalcon\Mvc\Dispatcher();

//     //Bind the EventsManager to the Dispatcher
     $dispatcher->setEventsManager($eventsManager);
//


     return $dispatcher;
 });